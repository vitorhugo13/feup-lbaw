---------------------------
-- VOTE RELATED TRIGGERS --
---------------------------

DROP TRIGGER IF EXISTS add_vote ON rating;
DROP FUNCTION IF EXISTS add_vote();

DROP TRIGGER IF EXISTS rem_vote ON rating;
DROP FUNCTION IF EXISTS rem_vote();

DROP TRIGGER IF EXISTS update_vote ON rating;
DROP FUNCTION IF EXISTS update_vote();


CREATE FUNCTION add_vote() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NEW.rating::text = 'upvote' THEN
        UPDATE content SET upvotes = upvotes + 1 WHERE id = NEW.content;
        UPDATE user SET glory = glory + 1 WHERE id = (SELECT author FROM content WHERE id = NEW.content);
        UPDATE category_glory SET glory = glory + 1 WHERE (
                user_id = (SELECT author FROM content WHERE id = NEW.content) AND
                category = (SELECT category FROM post_category WHERE post = NEW.content)
            );
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
    AFTER UPDATE ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE update_vote();


-------------------------------
-- CATEGORY RELATED TRIGGERS --
-------------------------------

DROP TRIGGER IF EXISTS add_category_post ON post_category;
DROP FUNCTION IF EXISTS add_category_post();

DROP TRIGGER IF EXISTS rem_category_post ON post_category;
DROP FUNCTION IF EXISTS rem_category_post();


CREATE FUNCTION add_category_post() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE category SET num_posts = num_posts + 1 WHERE id = NEW.category;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER add_category_post
    AFTER INSERT ON post_category
    FOR EACH ROW
    EXECUTE PROCEDURE add_category_post();


CREATE FUNCTION rem_category_post() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE category SET num_posts = num_posts - 1 WHERE id = OLD.category;
    RETURN OLD;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER rem_category_post
    AFTER DELETE ON post_category
    FOR EACH ROW
    EXECUTE PROCEDURE rem_category_post();


---------------------------
-- BLOCKED USER TRIGGERS --
---------------------------

DROP TRIGGER IF EXISTS block_add_vote ON rating;
DROP TRIGGER IF EXISTS block_rem_vote ON rating;
DROP TRIGGER IF EXISTS block_update_vote ON rating;

DROP TRIGGER IF EXISTS block_add_content ON content;
DROP TRIGGER IF EXISTS block_rem_content ON content;
DROP TRIGGER IF EXISTS block_update_content ON content;

DROP FUNCTION IF EXISTS block_access();

CREATE FUNCTION block_access() RETURNS TRIGGER AS
$BODY$
BEGIN
    RAISE EXCEPTION 'A blocked user cannot perform this action.';
    RETURN OLD;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER block_add_vote
    BEFORE INSERT ON rating
    WHEN EXISTS (SELECT id FROM "user" WHERE id = NEW.user AND role::text = 'Blocked')
    FOR EACH ROW
    EXECUTE PROCEDURE block_access();

CREATE TRIGGER block_rem_vote
    BEFORE DELETE ON rating
    WHEN EXISTS (SELECT id FROM "user" WHERE id = OLD.user AND role::text = 'Blocked')
    FOR EACH ROW
    EXECUTE PROCEDURE block_access();

CREATE TRIGGER block_update_vote
    BEFORE UPDATE ON rating
    WHEN EXISTS (SELECT id FROM "user" WHERE id = NEW.user AND role::text = 'Blocked')
    FOR EACH ROW
    EXECUTE PROCEDURE block_access();

CREATE TRIGGER block_add_content
    BEFORE INSERT ON content
    WHEN EXISTS (SELECT id FROM "user" WHERE id = NEW.author AND role::text = 'Blocked')
    FOR EACH ROW
    EXECUTE PROCEDURE block_access();

CREATE TRIGGER block_update_content
    BEFORE UPDATE ON content
    WHEN EXISTS (SELECT id FROM "user" WHERE id = NEW.author AND role::text = 'Blocked')
    FOR EACH ROW
    EXECUTE PROCEDURE block_access();

CREATE TRIGGER block_add_report
    BEFORE INSERT ON report
    WHEN EXISTS (SELECT id FROM "user" WHERE id = NEW.author AND role::text = 'Blocked')
    FOR EACH ROW
    EXECUTE PROCEDURE block_access();
