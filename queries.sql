See comments in a post *
See trending posts *
See a post page *
Get posts from a given category *
Get posts with a given username *
Get posts with a given string in the title *
Get a user three top categories*


SELECT 

SELECT main_comment, comment
FROM "post", "thread", "reply", "comment", "content"
WHERE "post".id = $post_id AND "thread".post = $post_id AND "comment".id = "content".id




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
