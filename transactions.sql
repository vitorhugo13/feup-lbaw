-- T01 --
-- Insert a new post --
BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ

    -- insert content --
    INSERT INTO content(id, author, body) VALUES($id, $author, $content);

    -- insert post --
    -- (how does currval works) https://dba.stackexchange.com/questions/3281/how-do-i-use-currval-in-postgresql-to-get-the-last-inserted-id/3284 --
    INSERT INTO post(id, title) VALUES (currval(content_id_seq), $title);

COMMIT;



-- TO2 --
-- Insert a new comment --
BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ

    -- insert content --
    INSERT INTO content(id, author, body) VALUES($id, $author, $content);

    -- insert post --
    INSERT INTO comment(id) VALUES (currval(content_id_seq));

COMMIT;