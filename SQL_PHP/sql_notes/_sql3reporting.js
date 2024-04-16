//Reporting with SQL
//      https://teamtreehouse.com/library/reporting-with-sql

//Ordering, limiting, manipulating text, aggregation, data

//#region Ordering Data

//Sort contacts, data by date, data by price

SELECT <columns> FROM <table> ORDER BY <column>; //Defaults to Ascending order
SELECT <columns> FROM <table> ORDER BY <column> ASC; //Specifies Ascending order
SELECT <columns> FROM <table> ORDER BY <column> DESC; //Specifies Descending order

SELECT * FROM products ORDER BY stock_count DESC;

//Order by multiple columns by separating with ,
SELECT * FROM customers ORDER BY last_name ASC, first_name ASC;

//#endregion

//#region Limiting Data

//Only displays the top 3 campaigns with the highest sales
SELECT * FROM campaigns ORDER BY sales DESC LIMIT 3;

//Other sql databases might use different commands
SELECT TOP 3 <columns> FROM <table>; //MS SQL
SELECT <columns> FROM <table> WHERE ROWNUM <= 3; //Oracle

//Gets the 3 most recent fantasy books
SELECT * FROM books WHERE genre = "Fantasy" ORDER BY first_published DESC LIMIT 3;

//#endregion

//#region Paging through Data

//View second page of results with OFFSET
SELECT * FROM orders LIMIT 50 OFFSET 50;
//View third page of results with OFFSET
SELECT * FROM orders LIMIT 50 OFFSET 100;

//Shorthand: write offset first, then the number of rows
SELECT * FROM orders LIMIT 100, 50;

//#endregion

//#region Text Functions

UPPER("Text"); //Presents the data in uppercase eg. TEXT

//#region Join Columns

SELECT first_name AS "First Name", last_name AS "Last Name", email AS "Email", Phone AS "Phone" FROM customers;

//Use the || operator to join columns together, does not add a space
SELECT first_name || last_name AS "Full Name", email AS "Email", Phone AS "Phone" FROM customers;

//Joins a space between
SELECT first_name || " " || last_name AS "Full Name", email AS "Email", Phone AS "Phone" FROM customers;

//Does not modify the data, just how it's presented, so you can still order by last name, then first name

/** Single vs Double Quotes
 * In SQL there's a difference between using single quotes (') and double quotes ("). Single quotes should be used for String literals (e.g. 'lbs'), and double quotes should be used for identifiers like column aliases (e.g. "Max Weight"):
 *
 * SELECT maximum_weight || 'lbs' AS "Max Weight" FROM ELEVATOR_DATA;
 * 
 * Also, in this course, there's a few instances where we get this wrong and use double quotes with a String literal. Some versions of SQL will let you get away with that. So while you may be able to use them interchangeably here, just know that's not always the case.
 */

//#endregion

//#region Length

//Makes a new column based on the lengths of the usernames 
SELECT username, LEGNTH(username) AS "Length" FROM CUSTOMERS;

//Can still order and limit data in this way
SELECT username, LEGNTH(username) AS "Length" FROM CUSTOMERS ORDER BY length DESC LIMIT 1;

//Only shows usernames with a length greater than 7
SELECT username FROM CUSTOMERS WHERE LENGTH(username) < 7;

//#endregion

//#region Changing Case

Upper("Text"); //TEXT
Lower("Text"); //text

select first_name || " " || upper(last_name) as full_name, library_id from patrons;

//#endregion

//#region Creating Excerpts

SUBSTR(/*<value or column>, <start>, <length>*/);
substr(description, 1, 30)

//Generates a short description
select name, (substr(description, 1, 30) || "...") AS short_description, price from products

//#endregion

//#region Replacing Text

REPLACE(/* <value or column>, <target>, <replacement> */);

//Replaces california with ca and then only shows where results are in ca
//Still shows data as california
select * from addresses where replace(state, "California", "CA") = "CA";

//Replaces @ with <a> to obfuscate email
select replace(email, "@", "<at>") as obfuscated_email from customers;

//#endregion

//#endregion

//#region Maths Functions

//#region Counting Results

COUNT();

//Displays the number of rows in customers, null values are ignored
select COUNT(*) from customers;

//Displays how many rows have the first name of Andrew
select COUNT(*) from customers WHERE first_name = "Andrew";

//DISTINCT keyword Displays unique results
select distinct genre from books;

//Counts the number of genres in the database
select COUNT(distinct genre) as total_genres from books;

select genre from books order by genre;

//Groups the books by genre and displays how many books are in that genre
select genre, count(*) as genre_count from books group by genre;

//#endregion

//#region SUM

SUM();

//Gets the total spend of the top spending user
select sum(cost) as total_spend, user_id from orders
            group by user_id
            order by total_spend desc
            limit 1;

//Selects all customers that have spent more than 250
//This does not work
select sum(cost) as total_spend, user_id from orders
            where total_spend > 250
            group by user_id
            order by total_spend desc;

//Use the HAVING keyword to fix this
select sum(cost) as total_spend, user_id from orders
            HAVING total_spend > 250
            group by user_id
            order by total_spend desc;

//#endregion

//#region Aggregate

AVG();

//Selects the average cost of orders in total
select avg(cost) as average from orders;

//Selects the average cost for each user
select avg(cost) as average, user_id from orders group by user_id;

//#endregion

//#region Getting Min and Max Values

MIN();
MAX();

//Selects the average, min and max costs for each user
select avg(cost) as average, MAX(cost) as maximum, MIN(cost) as minimum, user_id
        from orders group by user_id;

select Min(rating) as star_min, max(rating) as star_max
        from reviews
        where movie_id = 6
        group by movie_id;

//#endregion

//#region Maths Operations and the ROUND functions

//Can use common operators (+ - * /)

//Creates a row that performs the calculations
SELECT 1 + 4; //5
SELECT 3 - 2; //1

SELECT 5/2; //2 - INT Rounds Down
SELECT 5/2.0; //2.5 - FLOAT Does not Round
SELECT 5.0/2; //2.5 - FLOAT Does not Round

ROUND(/* <value>, <decimal places> */);

//Increases the price and rounds it to 2 dp
select name, round(price * 1.06, 2) as "Price in Florida" from products;

//#endregion

//#endregion

//#region Differences Between Database

/*Writing Dates
*  "2015-11-02", "01-NOV-15"
*/

/*Functions
*  DATE("now"), NOW()
*/

/*Formatting Output
*  STRFTIME(), DATE_FORMAT()
*/

//#endregion

//#region Getting Current Date

//Use the now string to get today's date
Date("now");

select count(*) from orders
            where shipped_on = date("now");

//Can modify dates
date("now", /* <modifier>, <modifier>, ... */);

date("now", "+7 days"); //Goes forward 7 days
date("now", "+1 day"); //Goes forward 1 day
date("now", "-2 months"); //Goes back 2 months

select count(*) from orders
            where ordered_on
            between date("now", "-7 days")
            and date("now", "-1 day");

//Equivalent to -14 and -8 days, but breaks it up to be more readable
select count(*) from orders
            where ordered_on
            between date("now", "-7 days", "-7 days")
            and date("now", "-1 day", "-7 days");

//#endregion

//#region Date Formatting

//date time format is in yyyy--mm--dd hh:mm:ss

//Gets only the date or time part
"2015-04-01 23:12:01"
date("2015-04-01 23:12:01"); //returns "2015-04-01"
time("2015-04-01 23:12:01"); //returns "23:12:01"

STRFTIME(/* <format string>, <time string>, <modifier> */)

//Days and Months must be d and m in lowercase
//Years must be Y in uppercase
STRFTIME("%d/%m/%Y", "2015-04-01 23:12:01"); //Outputs as 01/04/2015
STRFTIME("%d*%m*%Y", "2015-04-01 23:12:01"); //Outputs as 01*04*2015
STRFTIME("%d-%m-%Y", "2015-04-01 23:12:01"); //Outputs as 01-04-2015

//Can use modifiers to change the date
STRFTIME("%d/%m/%Y", "2015-04-01 23:12:01", "+1 year"); //Outputs as 01/04/2016

select *, STRFTIME("%d/%m/%Y", ordered_on) as UK_date from orders;

select title, strftime("%m/%y", date_released) as month_year_released from movies;

//#endregion

