-- mysql -u username -p < sql/schema/pdizz.sql

CREATE DATABASE IF NOT EXISTS pdizz;

CREATE USER 'pdizz'@'%' IDENTIFIED BY 'password';

GRANT ALL PRIVILEGES ON pdizz.* TO 'pdizz'@'%';