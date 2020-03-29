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
        UPDATE "user" SET glory = glory + 1 WHERE id = (SELECT author FROM content WHERE id = NEW.content);
        IF( NEW.content IN (SELECT id FROM post) ) THEN -- only run for posts
            UPDATE category_glory SET glory = glory + 1 WHERE (
                user_id IN (SELECT author FROM content WHERE id = NEW.content) AND
                category IN (SELECT category FROM post_category WHERE post = NEW.content)
            );
        END IF;
    END IF;
    IF NEW.rating::text = 'downvote' THEN
        UPDATE content SET downvotes = downvotes + 1 WHERE id = NEW.content;
        UPDATE "user" SET glory = glory - 1 WHERE id = (SELECT author FROM content WHERE id = NEW.content);
        IF( NEW.content IN (SELECT id FROM post) ) THEN -- only run for posts
            UPDATE category_glory SET glory = glory - 1 WHERE (
                user_id IN (SELECT author FROM content WHERE id = NEW.content) AND
                category IN (SELECT category FROM post_category WHERE post = NEW.content)
            );
        END IF;
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
        UPDATE "user" SET glory = glory - 1 WHERE id = (SELECT author FROM content WHERE id = OLD.content);
        IF( NEW.content IN (SELECT id FROM post) ) THEN -- only run for posts
            UPDATE category_glory SET glory = glory - 1 WHERE (
                user_id IN (SELECT author FROM content WHERE id = NEW.content) AND
                category IN (SELECT category FROM post_category WHERE post = NEW.content)
            );
        END IF;
    END IF;
    IF OLD.rating::text = 'downvote' THEN
        UPDATE content SET downvotes = downvotes - 1 WHERE id = OLD.content;
        UPDATE "user" SET glory = glory + 1 WHERE id = (SELECT author FROM content WHERE id = OLD.content);
        IF( NEW.content IN (SELECT id FROM post) ) THEN -- only run for posts
            UPDATE category_glory SET glory = glory + 1 WHERE (
                user_id IN (SELECT author FROM content WHERE id = NEW.content) AND
                category IN (SELECT category FROM post_category WHERE post = NEW.content)
            );
        END IF;
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
        UPDATE "user" SET glory = glory - 1 WHERE id = (SELECT author FROM content WHERE id = OLD.content);
        IF( OLD.content IN (SELECT id FROM post) ) THEN -- only run for posts
            UPDATE category_glory SET glory = glory - 1 WHERE (
                    user_id = (SELECT author FROM content WHERE id = OLD.content) AND
                    category IN (SELECT category FROM post_category WHERE post = OLD.content)
                );
        END IF;
    END IF;
    IF OLD.rating::text = 'downvote' THEN
        UPDATE content SET downvotes = downvotes - 1 WHERE id = OLD.content;
        UPDATE "user" SET glory = glory + 1 WHERE id = (SELECT author FROM content WHERE id = OLD.content);
        IF( OLD.content IN (SELECT id FROM post) ) THEN -- only run for posts
            UPDATE category_glory SET glory = glory + 1 WHERE (
                    user_id = (SELECT author FROM content WHERE id = OLD.content) AND
                    category IN (SELECT category FROM post_category WHERE post = OLD.content)
                );
        END IF;
    END IF;

    IF NEW.rating::text = 'upvote' THEN
        UPDATE content SET upvotes = upvotes + 1 WHERE id = NEW.content;
        UPDATE "user" SET glory = glory + 1 WHERE id = (SELECT author FROM content WHERE id = NEW.content);
        IF( NEW.content IN (SELECT id FROM post) ) THEN -- only run for posts
            UPDATE category_glory SET glory = glory + 1 WHERE (
                    user_id = (SELECT author FROM content WHERE id = NEW.content) AND
                    category IN (SELECT category FROM post_category WHERE post = NEW.content)
                );
        END IF;
    END IF;
    IF NEW.rating::text = 'downvote' THEN
        UPDATE content SET downvotes = downvotes + 1 WHERE id = NEW.content;
        UPDATE "user" SET glory = glory - 1 WHERE id = (SELECT author FROM content WHERE id = NEW.content);
        IF( NEW.content IN (SELECT id FROM post) ) THEN -- only run for posts
            UPDATE category_glory SET glory = glory - 1 WHERE (
                    user_id = (SELECT author FROM content WHERE id = NEW.content) AND
                    category IN (SELECT category FROM post_category WHERE post = NEW.content)
                );
        END IF;
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

DROP TRIGGER IF EXISTS create_cat_glory ON post_category;
DROP FUNCTION IF EXISTS create_cat_glory();

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

CREATE FUNCTION create_cat_glory() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF( NOT EXISTS ( SELECT user_id
                     FROM category_glory
                          JOIN NEW ON (category_glory.category = NEW.category)
                          JOIN content ON (content.id = NEW.post)
                     WHERE category_glory.category = NEW.category)) THEN
        INSERT INTO category_glory
                SELECT author, NEW.category
                FROM NEW JOIN content ON (NEW.post = content.id);
    END IF;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER create_cat_glory
    BEFORE INSERT ON post_category
    FOR EACH ROW
    EXECUTE PROCEDURE create_cat_glory();

---------------------------
-- BLOCKED USER TRIGGERS --
---------------------------

DROP TRIGGER IF EXISTS block_add_vote ON rating;
DROP TRIGGER IF EXISTS block_rem_vote ON rating;
DROP TRIGGER IF EXISTS block_update_vote ON rating;
DROP FUNCTION IF EXISTS block_add_vote();
DROP FUNCTION IF EXISTS block_rem_vote();

DROP TRIGGER IF EXISTS block_add_content ON content;
DROP TRIGGER IF EXISTS block_update_content ON content;
DROP FUNCTION IF EXISTS block_add_content();
DROP FUNCTION IF EXISTS block_update_content();

DROP TRIGGER IF EXISTS block_add_report ON report;
DROP FUNCTION IF EXISTS block_add_report();


CREATE FUNCTION block_add_vote() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT id FROM "user" WHERE id = NEW.user_id AND role::text = 'Blocked') THEN 
        RAISE EXCEPTION 'A blocked user cannot perform this action.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER block_add_vote
    BEFORE INSERT ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE block_add_vote();

CREATE TRIGGER block_update_vote
    BEFORE UPDATE ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE block_add_vote();


CREATE FUNCTION block_rem_vote() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT id FROM "user" WHERE id = OLD.user AND role::text = 'Blocked') THEN 
        RAISE EXCEPTION 'A blocked user cannot perform this action.';
    END IF;
    RETURN OLD;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER block_rem_vote
    BEFORE DELETE ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE block_rem_vote();


CREATE FUNCTION block_add_content() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT id FROM "user" WHERE id = NEW.author AND role::text = 'Blocked') THEN 
        RAISE EXCEPTION 'A blocked user cannot perform this action.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER block_add_content
    BEFORE INSERT ON content
    FOR EACH ROW
    EXECUTE PROCEDURE block_add_content();


CREATE FUNCTION block_update_content() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT id FROM "user" WHERE id = NEW.author AND role::text = 'Blocked') THEN 
        RAISE EXCEPTION 'A blocked user cannot perform this action.';
    END IF;
    RETURN OLD;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER block_update_content
    BEFORE UPDATE ON content
    FOR EACH ROW
    EXECUTE PROCEDURE block_update_content();


CREATE FUNCTION block_add_report() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT id FROM "user" WHERE id = NEW.author AND role::text = 'Blocked') THEN 
        RAISE EXCEPTION 'A blocked user cannot perform this action.';
    END IF;
    RETURN OLD;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER block_add_report
    BEFORE INSERT ON report
    FOR EACH ROW
    EXECUTE PROCEDURE block_add_report();

