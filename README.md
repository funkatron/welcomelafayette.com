WelcomeLafayette.com
===========

## Setup

- Install vendor packages with `composer update`
- ***copy*** `app/config/base.SAMPLE.php` to `app/config/base.php` and fill in your values
- create an empty sqlite3 database with the command `sqlite3 ./data/welcomelafayette.sqlite3 "select ''"`
- run the DB migrations with `php vendor/bin/phinx migrate`

## Running dev server

1. `cd` to the base directory of the project (the one that contains `app`, `www`, etc).
2. run the dev server with `./dev-server.sh`.
3. Open [`http://0.0.0.0:9909`](http://0.0.0.0:9909) in a web browser.

## Running tests

1. `cd` to the base directory of the project (the one that contains `app`, `www`, etc).
2. run the test suite with `./run-tests.sh`.
