-- Types

CREATE TYPE ROLES as ENUM ('Member', 'Blocked', 'Moderator', 'Administrator');
CREATE TYPE TYPES as ENUM ('Block', 'New Comment', 'Rating', 'Content Deleted', 'Community Post');
CREATE TYPE RATINGS as ENUM ('upvote', 'downvote');
CREATE TYPE REASONS as ENUM ('Offensive', 'Spam', 'Harassment', 'Sexually Explicit', 'Violent', 'Terrorism', 'Repulsive', 'Harmful', 'Wrong Category');
CREATE TYPE DEF_PIC as TEXT DEFAULT "default_pic.png"; 

CREATE TABLE "content" (
    id SERIAL PRIMARY KEY,
    author INTEGER REFERENCES "user" (id) ON UPDATE CASCADE,
    body TEXT NOT NULL,
    visible BOOLEAN DEFAULT TRUE,
    creation_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP, /* Mudei o nome? É que timestamp é uma keyword */
    upvotes   DEFAULT 0 CONSTRAINT NEGATIVE_VOTE CHECK (upvotes >= 0),
    downvotes DEFAULT 0 CONSTRAINT NEGATIVE_VOTE CHECK (downvotes >= 0)
);

CREATE TABLE "thread" (
    id SERIAL PRIMARY KEY,
    post INTEGER NOT NULL REFERENCES "post" (id) ON UPDATE CASCADE, /* NOT NULL?? Na tabela não temos */
    main_comment INTEGER NOT NULL REFERENCES "comment" (id) CONSTRAINT ONE_MAIN_COMMENT UNIQUE ON UPDATE CASCADE
);

CREATE TABLE "reply" (
    PRIMARY KEY (comment),
    comment INTEGER NOT NULL REFERENCES,
    thread INTEGER NOT NULL REFERENCES "thread" (id) ON UPDATE CASCADE
);

CREATE TABLE "post" (
    id SERIAL PRIMARY KEY,
    title TEXT NOT NULL
);

CREATE TABLE "comment" (
    id SERIAL PRIMARY KEY,
);

CREATE TABLE "report" (
    id SERIAL PRIMARY KEY,
    content INTEGER NOT NULL REFERENCES "content" (id) ON UPDATE CASCADE,
    reason TEXT NOT NULL, /* Não será também uma ENUM?? */
    time DATE DEFAULT CURRENT_DATE
);

CREATE TABLE "contest" (
    id SERIAL PRIMARY KEY,
    report INTEGER NOT NULL REFERENCES "report" (id) UNIQUE ON UPDATE CASCADE, /* UNIQUE faz sentido aqui? Quer dizer que um report só pode ter um contest? */
    justification TEXT NOT NULL,
    time DATE DEFAULT CURRENT_DATE
);

CREATE TABLE "user" (
    id SERIAL PRIMARY KEY,
    username TEXT NOT NULL CONSTRAINT USERNAME_UK UNIQUE,
    email TEXT NOT NULL CONSTRAINT EMAIL_UK UNIQUE,
    password TEXT NOT NULL,
    bio TEXT,
    glory INTEGER DEFAULT 0,
    role ROLES NOT NULL DEFAULT ROLES,
    photo TEXT DEFAULT DEF_PIC,
    release_date TIMESTAMP CONSTRAINT INVALID_RELEASE_DATE CHECK (release_date > CURRENT_TIMESTAMP OR release_date IS NULL) /* Trigger para mudar de Member <-> Blocked */
);

CREATE TABLE "notification" (
    id SERIAL PRIMARY KEY,
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    description TEXT NOT NULL,
    motive TYPES NOT NULL /* Not null?? type é uma keyword*/
)

CREATE TABLE "user_notification" (
    PRIMARY KEY (user, notification),
    user INTEGER REFERENCES "user" (id) ON UPDATE DELETE, /* Delete or cascade? */
    notification INTEGER REFERENCES "notification" (id) ON UPDATE DELETE 
)

CREATE TABLE "category" (
    id SERIAL PRIMARY KEY,
    title TEXT NOT NULL CONSTRAINT CATEGORY_TITLE_UK UNIQUE, /* name é uma keyword*/
    num_posts DEFAULT 0 CONSTRAINT NEGATIVE_POSTS CHECK (num_posts >= 0) /* Restrição?? */
    last_activity DEFAULT CURRENT_TIMESTAMP
)

CREATE TABLE "post_category" (
    PRIMARY KEY (post, category),
    post INTEGER REFERENCES "post" (id) ON UPDATE DELETE,
    category INTEGER REFERENCES "category" (id) ON UPDATE DELETE
)

CREATE TABLE "assigned_category" (
    PRIMARY KEY (user, category),
    user INTEGER REFERENCES "user" (id) ON UPDATE DELETE CONSTRAINT MOD_PERMISSION CHECK (user.role == 'Moderator'),
    category INTEGER REFERENCES "category" (id) ON UPDATE DELETE
)

CREATE TABLE "category_glory" (
    PRIMARY KEY (user, category),
    user INTEGER REFERENCES "user" (id) ON UPDATE DELETE,
    category INTEGER REFERENCES "category" (id) ON UPDATE DELETE,
    points INTEGER DEFAULT 0
)

CREATE TABLE "star_post" (
    PRIMARY KEY (user, post),
    user INTEGER REFERENCES "user" (id) ON UPDATE DELETE,
    post INTEGER REFERENCES "post" (id) ON UPDATE DELETE
)

CREATE TABLE "star_category" (
    PRIMARY KEY (user, category),
    user INTEGER REFERENCES "user" (id) ON UPDATE DELETE,
    category INTEGER REFERENCES "category" (id) ON UPDATE DELETE
)

CREATE TABLE "rating" (
    PRIMARY KEY (user, content),
    user INTEGER REFERENCES "user" (id) ON UPDATE DELETE,
    content INTEGER REFERENCES "content" (id) ON UPDATE DELETE,
    rating RATINGS NOT NULL
)
