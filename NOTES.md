# Zend Framework 2

### Create project

```
composer.phar create-project --stability="dev" zendframework/skeleton-application path/to/install

# Copy apache virtualhost
cp zf2blog.sample.conf /etc/apache2/vhosts/zf2blog.conf

# Add entry to /etc/hosts
127.0.0.1 zf2blog.local
```

Config database

```mysql
CREATE USER 'development'@'localhost' IDENTIFIED BY 'development';
GRANT ALL PRIVILEGES ON * . * TO 'development'@'localhost';

CREATE TABLE thing (
  id int(11) NOT NULL auto_increment,
  artist varchar(100) NOT NULL,
  title varchar(100) NOT NULL,
  PRIMARY KEY (id)
);
INSERT INTO thing (artist, title)
    VALUES  ('The  Military  Wives',  'In  My  Dreams');
INSERT INTO thing (artist, title)
    VALUES  ('Adele',  '21');
INSERT INTO thing (artist, title)
    VALUES  ('Bruce  Springsteen',  'Wrecking Ball (Deluxe)');
INSERT INTO thing (artist, title)
    VALUES  ('Lana  Del  Rey',  'Born  To  Die');
INSERT INTO thing (artist, title)
    VALUES  ('Gotye',  'Making  Mirrors');
```
