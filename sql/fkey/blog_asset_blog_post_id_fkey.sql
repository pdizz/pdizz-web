ALTER TABLE `pdizz`.`blog_asset`
ADD CONSTRAINT blog_asset_blog_post_id_fkey
FOREIGN KEY (blog_post_id) REFERENCES blog_post(blog_post_id);