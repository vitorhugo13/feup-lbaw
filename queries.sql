See comments in a post *
See trending posts *
See a post page *
Get posts from a given category *
Get posts with a given username *
Get posts with a given string in the title *
Get a user three top categories*


SELECT 

SELECT DISTINCT main_comment
FROM "thread" JOIN "reply" ON("thread".id = "reply".thread)
WHERE "thread".post = 19;


SELECT comment
FROM "thread" JOIN "reply" ON("thread".id = "reply".thread)
WHERE "thread".post = 19;


SELECT author, body, creation_time, upvotes, downvotes
FROM "content" JOIN
	(SELECT comment
	FROM "thread" JOIN "reply" ON("thread".id = "reply".thread)
	WHERE "thread".post = $post_id) AS "thread_comments" ON comment = "content".id
WHERE "content".visible = True

SELECT main_comment, author, body, creation_time, upvotes, downvotes
FROM "content" JOIN
	(SELECT DISTINCT main_comment
     FROM "thread" JOIN "reply" ON("thread".id = "reply".thread)
	 WHERE "thread".post = 19) AS "thread_main" ON main_comment = "content".id
WHERE "content".visible = True




SELECT title, username, body, upvotes, downvotes, comments
FROM (SELECT "post".id AS post, title, comments, COUNT(DISTINCT "rating".user) AS recent_rating
      FROM "post", "content", "rating"
      WHERE ("rating".time > CURRENT_TIMESTAMP - '1 day'::interval) AND "content".visible = TRUE
      GROUP BY post) ,
     "content", "user", "rating"
WHERE post = "content".id AND recent_rating > AVG(recent_rating) * 1.4



SELECT username, bio, role, photo, glory, release_date
FROM "user"
WHERE "user".id = $user_id

SELECT user_id, category, glory AS category_glory
FROM "user", "category_glory"
WHERE "user".id = $user_id AND "category_glory".user_id = $user_id 
ORDER BY category_glory
LIMIT 3
