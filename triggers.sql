--------------------------------- drop existing triggers -------------------------------------

DROP TRIGGER IF EXISTS add_vote ON rating;
DROP FUNCTION IF EXISTS add_vote();

DROP TRIGGER IF EXISTS rem_vote ON rating;
DROP FUNCTION IF EXISTS rem_vote();

DROP TRIGGER IF EXISTS update_vote ON rating;
DROP FUNCTION IF EXISTS update_vote();

--------------------------------- triggers ---------------------------------

CREATE FUNCTION add_vote() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NEW.rating::text = 'upvote' THEN
        UPDATE content SET upvotes = upvotes + 1 WHERE id = NEW.content;
    END IF;
    IF NEW.rating::text = 'downvote' THEN
        UPDATE content SET downvotes = downvotes + 1 WHERE id = NEW.content;
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER add_vote 
    AFTER INSERT ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE add_vote();


CREATE FUNCTION rem_vote() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF OLD.rating::text = 'upvote' THEN
        UPDATE content SET upvotes = upvotes - 1 WHERE id = OLD.content;
    END IF;
    IF OLD.rating::text = 'downvote' THEN
        UPDATE content SET downvotes = downvotes - 1 WHERE id = OLD.content;
    END IF;
    RETURN OLD;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER rem_vote 
    AFTER DELETE ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE rem_vote();


CREATE FUNCTION update_vote() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF OLD.rating::text = 'upvote' THEN
        UPDATE content SET upvotes = upvotes - 1 WHERE id = OLD.content;
    END IF;
    IF OLD.rating::text = 'downvote' THEN
        UPDATE content SET downvotes = downvotes - 1 WHERE id = OLD.content;
    END IF;

    IF NEW.rating::text = 'upvote' THEN
        UPDATE content SET upvotes = upvotes + 1 WHERE id = NEW.content;
    END IF;
    IF NEW.rating::text = 'downvote' THEN
        UPDATE content SET downvotes = downvotes + 1 WHERE id = NEW.content;
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER update_vote 
    AFTER DELETE ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE update_vote();