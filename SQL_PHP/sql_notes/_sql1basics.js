//#region Basics

Comment SQL with --

eg

--This is a comment

schema: How data should be stored
data: The actual data to be stored

Stored in tables, like a spreadsheet

//#endregion

//#region Data Types

Common Types: Text, numeric, dates

//#endregion

//#region Tools

Treehouse SQL Playground

Mode Analytics - used for businesses to get insights from their database.

pgAdmin - for PostgreSQL

phpMyAdmin and MySQL Workbench - for MySQL

//#endregion

//#region Basic Statements

//Selects all the information from the books table
// * selects all the information from the table
SELECT * FROM books;

//Selects only the emails from the patrons table
SELECT email FROM patrons;

//Select multiple columns by separating them with ,
SELECT first_name, email FROM patrons;

//Use AS keyword to rename columns to be easier to read
//Use quotes if spaces are needed
//Beware using quites, some require single ' but some require "
SELECT first_name AS "First Name", email AS Email FROM patrons;

//Shorthand, do not need as keyword
SELECT first_name "First Name", email Email FROM patrons;

//#endregion

//#region Where Keyword

//Uses a condition to only select specific rows
SELECT <columns> FROM <title> WHERE <condition>;

//Selects all books published in 1997
SELECT title FROM books WHERE first_published = 1997;

//Select all books by J.K. Rowling, remember this is case sensitive
SELECT title FROM books WHERE author = "J.K. Rowling";

//Selects all books not by J.K. Rowling
SELECT title FROM books WHERE author != "J.K. Rowling";

//Selects using date, dates must be in quotes
SELECT title FROM books WHERE loaned = "2015-5-6";

//#endregion

//#region Operators

//Can use operators like other programmng languages
SELECT title FROM books WHERE first_published > 1997;
SELECT title FROM books WHERE first_published <= 1997;

SELECT title FROM books WHERE author = "J.K. Rowling" AND first_published < 2000;
SELECT title FROM books WHERE author = "Ernest Cline" OR author = "Andy Weir";

//#endregion

//#region Dates

SELECT title FROM books WHERE loaned_on < "2015-12-13";

SELECT title FROM books WHERE return_by > "2015-12-18";

//#endregion

//#region Searching a Range of Values

SELECT title FROM books WHERE author = "Ernest Cline" OR author = "Andy Weir";

//Simplify the above statement using the IN keyword
SELECT title FROM books WHERE author IN ("Ernest Cline", "Andy Weir");

//Selects the inverse
SELECT title FROM books WHERE author NOT IN ("Ernest Cline", "Andy Weir");

//Use the BETWEEN keyword to select a range of results
SELECT title FROM books WHERE first_published > 1990 AND first_published < 2000;
SELECT title FROM books WHERE first_published BETWEEN 1990 AND 2000;

//Can also use with dates
SELECT title FROM books WHERE loaned_on BETWEEN "2015-12-13" AND "2015-12-19";

//#endregion

//#region LIKE Keyword

//Will only return exact values
SELECT title FROM books WHERE title = "Harry Potter";

//Type a wildcard (%) at the end to return something that starts with Harry Potter
SELECT title FROM books WHERE title LIKE "Harry Potter%";

//Some books might start with The, so put the % first to get these values
SELECT title FROM books WHERE title LIKE "%Martian";

//Can use to get names that start with a specific letter
SELECT title FROM books WHERE title LIKE "%l";

//Can use wildcards at the start and end, and these are not case sensitive
SELECT title FROM books WHERE title LIKE "%martian%";

//#endregion

//#region Filtering out Missing Information

SELECT title FROM books WHERE return_by > "2015-12-18" AND returned_on IS NULL;
SELECT title FROM books WHERE return_by > "2015-12-18" AND returned_on IS NOT NULL;

//#endregion

//#region Getting Data from Multiple Tables

//Select multiple tables by separating them with commas
SELECT * FROM <table 1>, <table 2>;

//Can access columns in these tables as children
SELECT * FROM loans, books
WHERE loans.book_id = books.id;

//#endregion