----------------------- Drop Existing Tables --------------------------------

DROP TABLE IF EXISTS "rating";
DROP TABLE IF EXISTS "star_category";
DROP TABLE IF EXISTS "star_post";
DROP TABLE IF EXISTS "category_glory";
DROP TABLE IF EXISTS "post_category";
DROP TABLE IF EXISTS "category";
DROP TABLE IF EXISTS "user_notification";
DROP TABLE IF EXISTS "notification";
DROP TABLE IF EXISTS "contest";
DROP TABLE IF EXISTS "report";
DROP TABLE IF EXISTS "report_file";
DROP TABLE IF EXISTS "reply";
DROP TABLE IF EXISTS "thread";
DROP TABLE IF EXISTS "comment";
DROP TABLE IF EXISTS "post";
DROP TABLE IF EXISTS "content";
DROP TABLE IF EXISTS "user";


----------------------- Drop Existing Types --------------------------------

DROP TYPE IF EXISTS ROLES;
DROP TYPE IF EXISTS MOTIVES; 
DROP TYPE IF EXISTS RATINGS;
DROP TYPE IF EXISTS REASONS;


----------------------- Drop Existing Triggers --------------------------------

DROP TRIGGER IF EXISTS add_vote ON rating;
DROP TRIGGER IF EXISTS rem_vote ON rating;
DROP TRIGGER IF EXISTS update_vote ON rating;

DROP TRIGGER IF EXISTS add_category_post ON post_category;
DROP TRIGGER IF EXISTS rem_category_post ON post_category;
DROP TRIGGER IF EXISTS create_cat_glory ON post_category;

DROP TRIGGER IF EXISTS block_add_vote ON rating;
DROP TRIGGER IF EXISTS block_rem_vote ON rating;
DROP TRIGGER IF EXISTS block_update_vote ON rating;

DROP TRIGGER IF EXISTS block_add_content ON content;
DROP TRIGGER IF EXISTS block_update_content ON content;

DROP TRIGGER IF EXISTS block_add_report ON report;


----------------------- Drop Existing Functions --------------------------------

DROP FUNCTION IF EXISTS add_vote();
DROP FUNCTION IF EXISTS rem_vote();
DROP FUNCTION IF EXISTS update_vote();

DROP FUNCTION IF EXISTS add_category_post();
DROP FUNCTION IF EXISTS rem_category_post();
DROP FUNCTION IF EXISTS create_cat_glory();

DROP FUNCTION IF EXISTS block_add_vote();
DROP FUNCTION IF EXISTS block_rem_vote();

DROP FUNCTION IF EXISTS block_add_content();
DROP FUNCTION IF EXISTS block_update_content();

DROP FUNCTION IF EXISTS block_add_report();


-------------------------------- Types --------------------------------

CREATE TYPE ROLES as ENUM ('Member', 'Blocked', 'Moderator', 'Administrator');
CREATE TYPE MOTIVES as ENUM ('Block', 'New Comment', 'Rating', 'Content Deleted', 'Community Post');
CREATE TYPE RATINGS as ENUM ('upvote', 'downvote');
CREATE TYPE REASONS as ENUM ('Offensive', 'Spam', 'Harassment', 'Sexually Explicit', 'Violent', 'Terrorism', 'Repulsive', 'Harmful', 'Wrong Category');

-------------------------------- Tables --------------------------------

CREATE TABLE "user" (
    id SERIAL PRIMARY KEY,
    username TEXT NOT NULL CONSTRAINT USERNAME_UK UNIQUE,
    email TEXT NOT NULL CONSTRAINT EMAIL_UK UNIQUE,
    password TEXT NOT NULL,
    bio TEXT,
    glory INTEGER NOT NULL DEFAULT 0,
    role ROLES NOT NULL DEFAULT 'Member',
    photo TEXT NOT NULL DEFAULT 'default_picture.png',
    release_date TIMESTAMP CONSTRAINT INVALID_RELEASE_DATE CHECK (release_date > CURRENT_TIMESTAMP OR release_date IS NULL)
);

CREATE TABLE "content" (
    id SERIAL PRIMARY KEY,
    author INTEGER REFERENCES "user" (id) ON UPDATE CASCADE ON DELETE SET NULL,
    body TEXT NOT NULL,
    visible BOOLEAN NOT NULL DEFAULT TRUE, 
    tracking BOOLEAN NOT NULL DEFAULT TRUE, 
    creation_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    upvotes INTEGER NOT NULL DEFAULT 0 CONSTRAINT NEGATIVE_UPVOTE CHECK (upvotes   >= 0),
    downvotes INTEGER NOT NULL DEFAULT 0 CONSTRAINT NEGATIVE_DOWNVOTE CHECK (downvotes >= 0)
);

CREATE TABLE "post" (
    id INTEGER PRIMARY KEY REFERENCES "content" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    title TEXT NOT NULL,
    num_comments INTEGER NOT NULL DEFAULT 0 CONSTRAINT NEGATIVE_COMMENTS CHECK (num_comments >= 0)
);

CREATE TABLE "comment" (
    id INTEGER PRIMARY KEY REFERENCES "content" (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE "thread" (
    id SERIAL PRIMARY KEY,
    post INTEGER NOT NULL REFERENCES "post" (id) ON UPDATE CASCADE ON DELETE CASCADE, 
    main_comment INTEGER NOT NULL REFERENCES "comment" (id) ON UPDATE CASCADE ON DELETE CASCADE CONSTRAINT ONE_MAIN_COMMENT UNIQUE
);

CREATE TABLE "reply" (
    comment INTEGER PRIMARY KEY NOT NULL REFERENCES "comment" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    thread INTEGER NOT NULL REFERENCES "thread" (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE "report_file" (
    id SERIAL PRIMARY KEY,
    content INTEGER NOT NULL REFERENCES "content" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    reviewer INTEGER REFERENCES "user" (id) ON UPDATE CASCADE ON DELETE SET NULL,
    sorted BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE "report" (
    id SERIAL PRIMARY KEY,
    file INTEGER NOT NULL REFERENCES "report_file" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    author INTEGER REFERENCES "user" (id) ON UPDATE CASCADE ON DELETE SET NULL,
    reason REASONS NOT NULL, 
    time DATE NOT NULL DEFAULT CURRENT_DATE
);

CREATE TABLE "contest" (
    id SERIAL PRIMARY KEY,
    report INTEGER NOT NULL REFERENCES "report_file" (id) ON UPDATE CASCADE ON DELETE CASCADE UNIQUE,
    justification TEXT NOT NULL,
    time DATE NOT NULL DEFAULT CURRENT_DATE
);

CREATE TABLE "notification" (
    id SERIAL PRIMARY KEY,
    content INTEGER REFERENCES "content" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    description TEXT NOT NULL,
    viewed BOOLEAN NOT NULL DEFAULT FALSE,
    count INTEGER NOT NULL DEFAULT 1 CONSTRAINT POSITIVE_COUNT CHECK (count >= 1),
    motive MOTIVES NOT NULL 
);

CREATE TABLE "user_notification" (
    user_id INTEGER REFERENCES "user" (id) ON UPDATE CASCADE ON DELETE CASCADE, 
    notification INTEGER REFERENCES "notification" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (user_id, notification)
);

CREATE TABLE "category" (
    id SERIAL PRIMARY KEY,
    title TEXT NOT NULL CONSTRAINT CATEGORY_TITLE_UK UNIQUE, 
    num_posts INTEGER NOT NULL DEFAULT 0 CONSTRAINT NEGATIVE_POSTS CHECK (num_posts >= 0),
    last_activity TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE "post_category" (
    post INTEGER REFERENCES "post" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    category INTEGER REFERENCES "category" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (post, category)
);

CREATE TABLE "category_glory" (
    user_id INTEGER REFERENCES "user" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    category INTEGER REFERENCES "category" (id) ON UPDATE CASCADE ON DELETE CASCADE,
	glory INTEGER NOT NULL DEFAULT 0,
    PRIMARY KEY (user_id, category)
);

CREATE TABLE "star_post" (
    user_id INTEGER REFERENCES "user" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    post INTEGER REFERENCES "post" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (user_id, post)
);

CREATE TABLE "star_category" (
    user_id INTEGER REFERENCES "user" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    category INTEGER REFERENCES "category" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (user_id, category)
);

CREATE TABLE "rating" (
    user_id INTEGER REFERENCES "user" (id) ON UPDATE CASCADE ON DELETE SET NULL,
    content INTEGER REFERENCES "content" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (user_id, content),
    rating RATINGS NOT NULL,
    time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);


-------------------------------- Indixes --------------------------------

CREATE INDEX user_username ON "user" USING hash (username);

CREATE INDEX rating_time ON "rating" USING btree ("time");

CREATE INDEX report_time ON "report" USING btree ("time");

CREATE INDEX glory_category ON "category_glory" USING btree ("glory");

CREATE INDEX title_search ON post USING gist (setweight(to_tsvector('english', title), 'A'));

CREATE INDEX username_search ON "user" USING gist (setweight(to_tsvector('simple', "user".username), 'C'));

CREATE INDEX category_search ON category USING gist (setweight(to_tsvector('english', category.title), 'B'));

-------------------------------- Functions --------------------------------

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

CREATE FUNCTION add_category_post() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE category SET num_posts = num_posts + 1 WHERE id = NEW.category;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE FUNCTION rem_category_post() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE category SET num_posts = num_posts - 1 WHERE id = OLD.category;
    RETURN OLD;
END
$BODY$
LANGUAGE plpgsql;

CREATE FUNCTION create_cat_glory() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF( NOT EXISTS( SELECT *
                     FROM (SELECT content.author AS author
                            FROM content JOIN post_category ON (content.id = post_category.post)
                            WHERE content.id = NEW.post) AS author_id
                          JOIN category_glory ON (category_glory.user_id=author_id.author)
                    WHERE category_glory.category=NEW.category)
        AND NEW.post NOT IN (SELECT content.id 
                             FROM content
                                  JOIN post ON (content.id = post.id)
                             WHERE author IS NULL AND content.id = NEW.post)) THEN
        INSERT INTO category_glory
                SELECT author, NEW.category
                FROM content
                WHERE content.id = NEW.post;
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

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

-------------------------------- Triggers --------------------------------

CREATE TRIGGER add_vote 
    AFTER INSERT ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE add_vote();
CREATE TRIGGER rem_vote 
    AFTER DELETE ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE rem_vote();
CREATE TRIGGER update_vote 
    AFTER UPDATE ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE update_vote();

CREATE TRIGGER add_category_post
    AFTER INSERT ON post_category
    FOR EACH ROW
    EXECUTE PROCEDURE add_category_post();
CREATE TRIGGER rem_category_post
    AFTER DELETE ON post_category
    FOR EACH ROW
    EXECUTE PROCEDURE rem_category_post();

CREATE TRIGGER create_cat_glory
    AFTER INSERT ON post_category
    FOR EACH ROW
    EXECUTE PROCEDURE create_cat_glory();

CREATE TRIGGER block_add_vote
    BEFORE INSERT ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE block_add_vote();
CREATE TRIGGER block_update_vote
    BEFORE UPDATE ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE block_add_vote();
CREATE TRIGGER block_rem_vote
    BEFORE DELETE ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE block_rem_vote();

CREATE TRIGGER block_add_content
    BEFORE INSERT ON content
    FOR EACH ROW
    EXECUTE PROCEDURE block_add_content();
CREATE TRIGGER block_update_content
    BEFORE UPDATE ON content
    FOR EACH ROW
    EXECUTE PROCEDURE block_update_content();

CREATE TRIGGER block_add_report
    BEFORE INSERT ON report
    FOR EACH ROW
    EXECUTE PROCEDURE block_add_report();
