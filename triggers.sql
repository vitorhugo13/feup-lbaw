--------------------------------- drop existing triggers -------------------------------------

DROP TRIGGER IF EXISTS new_vote ON rating;
DROP FUNCTION IF EXISTS add_vote();


--------------------------------- triggers ---------------------------------

CREATE FUNCTION add_vote() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NEW.rating::text = 'upvote' THEN
        -- increment upvotes on content
        UPDATE content SET upvotes = upvotes + 1 WHERE id = NEW.content;
    END IF;

    IF NEW.rating::text = 'downvote' THEN
        UPDATE content SET downvotes = downvotes + 1 WHERE id = NEW.content;
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER new_vote 
    AFTER INSERT ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE add_vote();