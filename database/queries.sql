---------------------------------------------------------------------------
----------------------------- Get a post page -----------------------------
---------------------------------------------------------------------------

SELECT title, body, creation_time, upvotes, downvotes, num_comments, username
FROM (SELECT DISTINCT title, body, creation_time, upvotes, downvotes, num_comments, author AS id
	FROM content, post
	WHERE "content".id = "post".id AND post.id=$post_id AND "content".visible = True) AS visible_post LEFT JOIN "user" ON visible_post.id="user".id;

SELECT CASE WHEN COUNT(post) = 1 THEN TRUE ELSE FALSE END
FROM "star_post"
WHERE user_id = $user_id AND "star_post".post = $post_id;

SELECT rating
FROM "rating"
WHERE user_id = $user_id AND content = $post_id;

SELECT author, body, creation_time, upvotes, downvotes, "thread_comments".id AS thread
FROM "content" JOIN
	(SELECT "thread".id, comment
	 FROM "thread" JOIN "reply" ON("thread".id = "reply".thread)
	 WHERE "thread".post = $post_id) AS "thread_comments" ON comment = "content".id
WHERE "content".visible = True;

SELECT author, body, creation_time, upvotes, downvotes, "thread_main".id AS thread
FROM "content" JOIN
	(SELECT DISTINCT main_comment, "thread".id AS id
       FROM "thread" JOIN "reply" ON("thread".id = "reply".thread)
	 WHERE "thread".post = $post_id) AS "thread_main" ON main_comment = "content".id
WHERE "content".visible = True;

----------------------------------------------------------------------------
------------- Selecting info for post preview (trending posts) -------------
----------------------------------------------------------------------------

SELECT post
FROM ((SELECT "post".id AS post, COUNT("rating".user_id) AS rating
	 FROM ("post" JOIN "content" ON "post".id = "content".id) JOIN "rating" ON "content".id = "rating".content
	 WHERE ("rating".time > CURRENT_TIMESTAMP - '50 day'::interval) AND "content".visible = TRUE
	 GROUP BY "post".id) AS post_ratings JOIN "content" ON "content".id = post),
	 (SELECT AVG(ratings) AS avg_rating
	  FROM ((SELECT COUNT("rating".user_id) AS ratings
	  FROM ("post" JOIN "content" ON "post".id = "content".id) JOIN "rating" ON "content".id = "rating".content
	  WHERE ("rating".time > CURRENT_TIMESTAMP - '50 day'::interval) AND "content".visible = TRUE
	  GROUP BY "post".id)) AS all_ratings) AS average
WHERE rating > avg_rating

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

----------------------------------------------------------------------------
------ Get user profile information (GLORY ALSO NOT SURE IF IT WORKS) ------
----------------------------------------------------------------------------

SELECT username, bio, role, photo, glory, release_date
FROM "user"
WHERE "user".username = $user_email;

SELECT user_id, category, "category_glory".glory AS category_glory
FROM "user", "category_glory"
WHERE "user".id = $user_id AND "category_glory".user_id = $user_id  AND "category_glory".glory > 0
ORDER BY category_glory DESC
LIMIT 3

----------------------------------------------------------------------------
-------- Get reports for a moderator (posts, comments and contests) --------
----------------------------------------------------------------------------

SELECT report_file, title, time, reason
FROM (SELECT report_file, content, body, time, reason
      FROM((SELECT id AS report_file, content
            FROM "report_file" AS rpf
            WHERE NOT EXISTS (SELECT DISTINCT "report_file".id
                              FROM "report_file" JOIN "report" ON "report_file".id = "report".file
                              WHERE author = $user_id AND rpf.id = "report_file".id)
				      AND rpf.sorted = FALSE) AS valid_reports JOIN "content" ON content = "content".id) JOIN "report" ON report_file = "report".file
      ORDER BY report_file) AS all_reports JOIN "post" ON content = "post".id
ORDER BY time DESC;

SELECT report_file, body, time, reason
FROM (SELECT report_file, content, body, time, reason
      FROM((SELECT id AS report_file, content
            FROM "report_file" AS rpf
            WHERE NOT EXISTS (SELECT DISTINCT "report_file".id
                              FROM "report_file" JOIN "report" ON "report_file".id = "report".file
                              WHERE author = $user_id AND rpf.id = "report_file".id)
                  AND rpf.sorted = FALSE) AS valid_reports JOIN "content" ON content = "content".id) JOIN "report" ON report_file = "report".file
      ORDER BY report_file) AS all_reports JOIN "comment" ON content = "comment".id
ORDER BY time DESC;

SELECT report_file, title, time, justification
FROM (SELECT report_file, content, body, time, justification
      FROM((SELECT id AS report_file, content
            FROM "report_file" AS rpf
            WHERE NOT EXISTS (SELECT DISTINCT "report_file".id
                              FROM "report_file" JOIN "report" ON "report_file".id = "report".file
                              WHERE author = $user_id AND rpf.id = "report_file".id)
                  AND rpf.sorted = FALSE) AS valid_reports JOIN "content" ON content = "content".id) JOIN "contest" ON report_file = "contest".report
ORDER BY report_file) AS all_reports JOIN "post" ON content = "post".id
ORDER BY time DESC;

SELECT report_file, body, time, justification
FROM (SELECT report_file, content, body, time, justification
      FROM((SELECT id AS report_file, content
            FROM "report_file" AS rpf
            WHERE NOT EXISTS (SELECT DISTINCT "report_file".id
                              FROM "report_file" JOIN "report" ON "report_file".id = "report".file
                              WHERE author = $user_id AND rpf.id = "report_file".id)
                  AND rpf.sorted = FALSE) AS valid_reports JOIN "content" ON content = "content".id) JOIN "contest" ON report_file = "contest".report
ORDER BY report_file) AS all_reports JOIN "comment" ON content = "comment".id
ORDER BY time DESC;

----------------------------------------------------------------------------
------------------------ Get a user's notifications ------------------------
----------------------------------------------------------------------------

SELECT content, motive, count, description
FROM "notification" JOIN "user_notification" ON "notification".id = "user_notification".notification
WHERE "user_notification".user_id = $user_id AND "notification".viewed = FALSE

-----------------------------------------------------------------------------------
------------------------ Search on title, username and tag ------------------------
-----------------------------------------------------------------------------------

SELECT post_info.id, ts_rank(post_info.document, to_tsquery('english', $search)) AS rank
FROM (SELECT post.id AS id,
       setweight(to_tsvector('english', "post".title), 'A') ||
       setweight(to_tsvector('simple', coalesce("user".username, '')), 'C') ||
       setweight(to_tsvector('english', coalesce(string_agg(category.title, ' '))), 'B') as document
      FROM post
       JOIN content ON (post.id = content.id)
       LEFT JOIN "user" ON (content.author = "user".id)
       JOIN post_category ON (post.id = post_category.post)
       JOIN category ON (post_category.category = category.id)
      GROUP BY post.id, "user".id) AS post_info
WHERE post_info.document @@ to_tsquery('english', $search)
ORDER BY rank DESC;
