-- mysql -u username -p databasename < deploy.sql
-- run from <project>/sql for relative paths to work

-- Create tables

source table/blog_post.table
source table/blog_asset.table
source table/contact_request.table

-- Foreign keys

source fkey/blog_asset_blog_post_id_fkey.sql