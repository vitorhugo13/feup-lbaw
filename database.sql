----------------------- Drop Existing Tables --------------------------------

DROP TABLE IF EXISTS "rating";
DROP TABLE IF EXISTS "star_category";
DROP TABLE IF EXISTS "star_post";
DROP TABLE IF EXISTS "category_glory";
DROP TABLE IF EXISTS "assigned_category";
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
    count INTEGER DEFAULT 1 CONSTRAINT POSITIVE_COUNT CHECK (count >= 1),
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

CREATE TABLE "assigned_category" (
    user_id INTEGER REFERENCES "user" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    category INTEGER REFERENCES "category" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (user_id, category)
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
