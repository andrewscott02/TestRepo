//Modifying Data With SQL
//  https://teamtreehouse.com/library/modifying-data-with-sql

//#region Intro to CRUD

//Create, read, update and delete

//Operations    ||      KeyWords
Create          ||      INSERT
Read            ||      SELECT
Update          ||      UPDATE
Delete          ||      DELETE

//#region INSERT

//#region Insert Basics

//Order of values must follow the how the schema is defined
INSERT INTO <table> VALUES (<value 1>, <value 2>, ...);

//Inserts a new row into the books table
INSERT INTO books VALUES (16, "1984", "George Orwell", "Fiction", 1949);

//Use NULL for the id column to auto increment it
INSERT INTO books VALUES (NULL, "1984", "George Orwell", "Fiction", 1949);

//Can specify your own order so you don't have to follow the schema
INSERT INTO loans (id, book_id, patron_id, loaned_on, return_by, returned_on)
VALUES (NULL, 2, 4, "2015-12-14", "2015-12-21", NULL);

//Changed order of inputs
INSERT INTO loans (book_id, patron_id, loaned_on, return_by, id, returned_on)
VALUES (2, 4, "2015-12-14", "2015-12-21", NULL, NULL);

//If input is null, you can exclude them, still specify them in the order
INSERT INTO loans (book_id, patron_id, loaned_on, return_by, id, returned_on)
VALUES (2, 4, "2015-12-14", "2015-12-21");

//Some columns may need values, so inputting NULL may return an error
//id column will most likely auto-increment, so it can be NULL

//#endregion

//#region Inserting Multiple Values

INSERT INTO books VALUES (NULL, "1984", "George Orwell", "Fiction", 1949);
INSERT INTO books VALUES (NULL, "Contact", "Carl Sagan", "Fiction", 1985);

//Can insert multiple entris at once by separating them with commas
INSERT INTO books
VALUES  (NULL, "1984", "George Orwell", "Fiction", 1949),
        (NULL, "Contact", "Carl Sagan", "Fiction", 1985);

//Can even do this with custom input orders
INSERT INTO loans (book_id, patron_id, loaned_on, return_by, id, returned_on)
VALUES  (2, 4, "2015-12-14", "2015-12-21"),
        (3, 4, "2015-12-14", "2015-12-21"),
        (3, 6, "2015-12-15", "2015-12-22");

//#endregion

//#endregion

//#region UPDATE

//#region Update Basics

// UPDATE <table> SET <column> = <value>;

//Could use this to redact sensitive data
UPDATE patrons SET last_name = "Redacted", email = "Redacted", zip_code = "Redacted";

//#endregion

//#region Updating Specific Rows

// UPDATE <table> SET <column> = <value> WHERE <condition>;

SELECT * FROM books WHERE id = 20;

UPDATE books SET genre = "Classic" WHERE id = 20;

UPDATE loans SET returned_on = "2015-12-18" WHERE patron_id = 1 AND returned_on IS NULL;

//#endregion

//#endregion

//#region DELETE

//Deletes all rows in table, keep a backup as this cannot be reversed
DELETE FROM <table>;

DELETE FROM <table> WHERE <condition>;

DELETE FROM books WHERE title LIKE "harry potter%";

DELETE FROM patrons WHERE id = 4;
DELETE FROM loans WHERE patron_id = 4;

//#endregion

//#endregion

//#region Intro to Transactions

//Commands autocommit by default, which saves to disc after every command
//This means if there is an error partway through,
//you'll need to know where it failed and only run
//the needed commands or you'll get duplicate data

//When executing multiple commands, use BEGIN to execute them in one go
//So data isn't saved to disc until after all are completed (in case of crashing)
BEGIN TRANSACTION;

INSERT INTO books VALUES (NULL, "1984", "George Orwell", "Fiction", 1949);
INSERT INTO loans (id, book_id, patron_id, loaned_on, return_by, returned_on)
VALUES (NULL, 2, 4, "2015-12-14", "2015-12-21", NULL);
DELETE FROM patrons WHERE id = 4;
DELETE FROM loans WHERE patron_id = 4;

COMMIT;

//Can shorten to BEGIN
BEGIN;
//Code here
COMMIT;

BEGIN;
//Code here
ROLLBACK; //Cancels changes

//#endregion

//#region ORMS

//Libraries that allow you to use other programming languages to interact with databases
/**
 * Hibernate for Java - http://hibernate.org/
 * CoreData for Objective-C or Swift - https://developer.apple.com/library/mac/documentation/Cocoa/Conceptual/CoreData/index.html
 * Django ORM for Python - https://www.djangoproject.com/start/overview/
 * ActiveRecord for Ruby - http://api.rubyonrails.org/classes/ActiveRecord/Base.html
 */

//#endregion