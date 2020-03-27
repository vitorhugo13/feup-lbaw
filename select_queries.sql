----------- Selecting info for post page ---------
SELECT author, title, body, visible, tracking, creation_time, upvotes, downvotes, num_comments
FROM content JOIN post ON id
WHERE post.id=$id;
