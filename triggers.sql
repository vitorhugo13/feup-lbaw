--------------------------------- drop existing triggers -------------------------------------

DROP TRIGGER IF EXISTS new_vote ON rating;


--------------------------------- triggers ---------------------------------

CREATE FUNCTION add_vote(IN content_id INTEGER, IN type TEXT) RETURNS TRIGGER AS
$BODY$
BEGIN
    IF type = 'upvote' THEN
        -- increment upvotes on content
        UPDATE content SET upvotes = upvotes + 1 WHERE id = content_id;
    END IF;

    IF type = 'downvote' THEN
        UPDATE content SET downvotes = downvotes + 1 WHERE id = content_id;
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER new_vote 
    AFTER INSERT ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE add_vote(NEW.content, NEW.rating::text);