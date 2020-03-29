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

