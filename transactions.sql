-- T01 - create a post
BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ

    INSERT INTO content(author, body) VALUES($author, $content);
    INSERT INTO post(id, title) VALUES (currval(content_id_seq), $title);

COMMIT;


-- T02 - comment a post
BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ

    INSERT INTO content(author, body) VALUES ($author, $body);
    INSERT INTO comment(id) VALUES (currval(content_id_seq));
    INSERT INTO thread(post, main_comment) VALUES ($post, currval(comment_id_seq));

COMMIT;

-- T03 - reply to a comment
BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ

    INSERT INTO content(author, body) VALUES ($author, $body);
    INSERT INTO comment(id) VALUES (currval(content_id_seq));
    INSERT INTO reply(comment, thread) VALUES (currval(comment_id_seq), $thread);

COMMIT;

-- T04 - search for posts and get info for post previews
BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL READ ONLY

    -- search for post by title, username and category
    SELECT post_info.id, ts_rank(post_info.document, to_tsquery('english', $search)) AS rank
    FROM (
        SELECT post.id AS id,
            setweight(to_tsvector('english', "post".title), 'A') ||
            setweight(to_tsvector('simple', "user".username), 'C') ||
            setweight(to_tsvector('english', coalesce(string_agg(category.title, ' '))), 'B') as document
        FROM post
        JOIN content ON (post.id = content.id)
        JOIN "user" ON (content.author = "user".id)
        JOIN post_category ON (post.id = post_category.post)
        JOIN category ON (post_category.category = category.id)
        GROUP BY post.id, "user".id) AS post_info
    WHERE post_info.document @@ to_tsquery('english', $search)
    ORDER BY rank DESC;

    -- get the information needed to display the post previews
    SELECT title, body, creation_time, upvotes, downvotes, num_comments, username
    FROM (SELECT DISTINCT title, body, creation_time, upvotes, downvotes, num_comments, author AS id
	    FROM content, post
		WHERE "content".id = "post".id AND post.id=$post_id AND "content".visible = True) AS visible_post LEFT JOIN "user" ON visible_post.id="user".id;

    SELECT CASE WHEN COUNT(post) = 1 THEN TRUE ELSE FALSE END
    FROM "star_post"
    WHERE user_id = $user_id AND post = $post_id;

    SELECT rating
    FROM "rating"
    WHERE user_id = $user_id AND content = $post_id;

COMMIT;
