See comments in a post *
See trending posts *
See a post page *
Get posts from a given category *
Get posts with a given username *
Get posts with a given string in the title *
Get a user three top categories*



-- See post page

SELECT DISTINCT title, body, creation_time, upvotes, downvotes, num_comments, 
				(CASE 
				 WHEN ("content".author = "user".id) THEN
				 "user".username 
				 WHEN ("content".author IS NULL) THEN
				 'anon'
				 END) AS username
FROM content JOIN post ON "content".id = "post".id, "user"
WHERE post.id=$post_id AND "content".visible = True
ORDER BY username
LIMIT 1;

SELECT DISTINCT post 
FROM "star_post"
WHERE "star_post".user_id = $user_id AND "star_post".post_id = $post_id;

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


-- Get trending posts (NOT SURE IF IT WORKS THERE AREN'T ANY RATINGS YET)

SELECT title, username, body, upvotes, downvotes, num_comments
FROM (SELECT "post".id AS post, title, num_comments, COUNT(DISTINCT "rating".user_id) AS recent_rating
      FROM "post", "content", "rating"
      WHERE ("rating".time > CURRENT_TIMESTAMP - '1 day'::interval) AND "content".visible = TRUE
      GROUP BY post) AS "posts_recent_ratings", "content", "user", "rating",
	 (SELECT AVG(ratings) AS average_rating
	  FROM (SELECT COUNT(DISTINCT "rating".user_id) AS ratings
		    FROM "post", "content", "rating"
		    WHERE ("rating".time > CURRENT_TIMESTAMP - '1 day'::interval) AND "content".visible = TRUE
		    GROUP BY post) AS "num_ratings") AS "average_rating"
WHERE post = "content".id AND recent_rating > average_rating


-- Get user profile information (GLORY ALSO NOT SURE IF IT WORKS)

SELECT username, bio, role, photo, glory, release_date
FROM "user"
WHERE "user".id = $user_id

SELECT user_id, category, "category_glory".glory AS category_glory
FROM "user", "category_glory"
WHERE "user".id = $user_id AND "category_glory".user_id = $user_id 
ORDER BY category_glory
LIMIT 3
