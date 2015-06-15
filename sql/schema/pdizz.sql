CREATE DATABASE IF NOT EXISTS pdizz;

CREATE USER 'pdizz'@'localhost' IDENTIFIED BY 'password';
CREATE USER 'pdizz'@'%' IDENTIFIED BY 'password';

GRANT ALL PRIVILEGES ON pdizz.* TO 'pdizz'@'localhost';
GRANT ALL PRIVILEGES ON pdizz.* TO 'pdizz'@'%';