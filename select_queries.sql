----------- Selecting info for post preview ---------

DROP VIEW IF EXISTS post_info;
CREATE VIEW post_info AS
SELECT DISTINCT title, body, creation_time, upvotes, downvotes, num_comments, author AS id
FROM content, post
WHERE "content".id = "post".id AND post.id=1 AND "content".visible = True;

SELECT title, body, creation_time, upvotes, downvotes, num_comments, username
FROM post_info LEFT JOIN "user" ON post_info.id="user".id;

SELECT COUNT(post)
FROM "star_post"
WHERE user_id = 10 AND post = 1;

SELECT rating
FROM "rating"
WHERE user_id = 10 AND post = 1;

----------- Selecting all comments in a thread ------

DROP VIEW IF EXISTS replies;
CREATE VIEW replies AS
SELECT "thread".id AS id, comment
FROM "thread" JOIN "reply" ON("thread".id = "reply".thread)
WHERE "thread".id = 43;

SELECT author, body, creation_time, upvotes, downvotes, "thread".id AS thread
FROM "content" JOIN "thread" ON main_comment = "content".id
WHERE "thread".id = 43 AND "content".visible = True
UNION
SELECT author, body, creation_time, upvotes, downvotes, replies.id AS thread
FROM "content" JOIN replies ON comment = "content".id
WHERE "content".visible = True;

----------- Selecting info for post page ---------
-- apart from the post preview we need to retrieve the comment section

DROP VIEW IF EXISTS replies;
CREATE VIEW replies AS
SELECT "thread".id AS id, comment
FROM "thread" JOIN "reply" ON("thread".id = "reply".thread)
WHERE "thread".post = 3;

SELECT author, body, creation_time, upvotes, downvotes, replies.id AS thread
FROM "content" JOIN replies ON comment = "content".id
WHERE "content".visible = True;

SELECT thread.id, post, content.id, username, body, creation_time, upvotes, downvotes
FROM thread JOIN content ON ("thread".main_comment="content".id) JOIN "user" ON (author="user".id)
WHERE post=20
UNION
SELECT thread.id, post, content.id, username, body, creation_time, upvotes, downvotes
FROM thread JOIN reply ON ("thread".id="reply".thread) JOIN "content" ON (content.id="reply".comment) JOIN "user" ON (author="user".id)
WHERE post=20;