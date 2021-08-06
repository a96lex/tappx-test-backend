# Tappx test backend

Simple php CRUD backend repository to handle bundle information.

## Local usage

### mysql

launch and login to mysql

update `database.php` and type your mysql username and pasword on the corresponding variables

create database `CREATE DATABASE tappx;`

go to database `use tappx;`

create table

```
CREATE TABLE bundles(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    username VARCHAR(40) NOT NULL,
    bundle VARCHAR(60) NOT NULL,
    company VARCHAR(60) NOT NULL,
    email VARCHAR(40) NOT NULL,
    active BOOL NOT NULL default 0,
    category varchar(10) NOT NULL
    );
```

### Serve php:

- clone this repo
- run `php -S localhost:8000`

Ready to go!

To use with the frontend, see [frontend local usage](https://github.com/a96lex/tappx-test-frontend)

# Structure

- database.php: contains information on how to do queries and what are post/get calls. Also manages database connection
- index.php: gets data from request body and type and sends it to the correspondant calls
