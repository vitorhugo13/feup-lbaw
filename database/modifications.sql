--register user--
INSERT INTO "user"(username, email, password, release_date) 
    VALUES($username, $email, $password, NULL);

--delete user--
DELETE FROM "user"
    WHERE id = $id;

--unblock user--
UPDATE "user" 
    SET release_date = NULL
    where id = $id;

--block user--
UPDATE "user"
    SET release_date = $release_date
    where id = $id;

--update user information--
UPDATE "user" 
    SET username = $username, email = $email, password = $password
    WHERE id = $id;

--update user photo--
UPDATE "user" 
    SET photo_path = $photo_path
    WHERE id = $id;

--update user bio--
UPDATE "user"
    SET bio = $bio
    WHERE id = $id;

--change a user's type--
UPDATE "user" 
    SET role = $role
    WHERE id = $id;

--new content--
INSERT INTO content(author, body)
    VALUES ($author, $body);

--new post--
INSERT INTO post(id, title)
    VALUES ($id, $title);

--new comment--
INSERT INTO comment(id)
    VALUES ($id);

--delete content--
DELETE FROM content
    WHERE id = $id;

--new report--
INSERT INTO report(report_file, author, reason) 
    VALUES($report_file, $author, $reason);

--star post--
INSERT INTO star_post(user_id, post_id)
    VALUES($user_id, $post_id);

--star category--
INSERT INTO star_post(user_id, category_id)
    VALUES($user_id, $category_id);

--unstar post--
DELETE FROM star_post
    WHERE user_id = $user_id AND post_id = $post_id;

--unstar category--
DELETE FROM star_categoy
    WHERE user_id = $user_id AND category_id = $category_id;

--insert rating--
INSERT INTO rating(user_id, content_id, rating)
    VALUES($user_id, $content_id, $rating);
    
--update rating--
UPDATE rating
    SET rating = $rating
    WHERE user_id = $user_id AND content_id = $content_id;

--delete rating--
DELETE FROM rating
    WHERE user_id = $user_id AND content_id = $content_id;

--update report file--
UPDATE report_file
    SET reviewer = $reviewer
    WHERE id = $id;

--delete post--
DELETE FROM post 
    WHERE id = $id;

--delete comment--
DELETE FROM comment 
    WHERE id = $id;