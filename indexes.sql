CREATE INDEX user_username ON "user" USING hash(username);

CREATE INDEX rating_time ON "rating" USING btree("time");

CREATE INDEX report_time ON "report" USING btree("time");

CREATE INDEX content_upload ON "content" USING btree("creation_time");

CREATE INDEX glory_category ON "category_glory" USING btree("glory");

CREATE INDEX title_search ON post USING gist (setweight(to_tsvector('english', title), 'A'));

CREATE INDEX username_search ON user USING gist (setweight(to_tsvector('simple', "user".username), 'C'));

CREATE INDEX category_search ON category USING gist (setweight(to_tsvector('english', category.title), 'B'));
