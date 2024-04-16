//Querying Relational Databases
//  https://teamtreehouse.com/library/querying-relational-databases

//Helps organise data
//Eliminates data modification anomalies and increases data integrity
//Saves disk space as much as possible

//The process of designing a relational database is Normalization

/** Set Operations with Venn Diagrams
 * 
 * Intersect - Both
 * Union - Or
 * Except - Xor
 * 
 */

//#region Database Keys

/**Unique Keys
 * Column that can only have unique keys (eg. emails, social security numbers and phone numbers)
 * Can be null
 * Multiple unique keys per table
 * Can be modified to a new value, as long as the new value is still unique
*/

/**Primary Keys
 * Column that can only have unique keys (eg. id)
 * Cannot be null
 * Only one primary key per table
 * Cannot be modified to a new value
 * 
 * Can be any data type, but is usually numeric
*/

/**Foreign Keys
 * Column that links to a column in another table (eg. link to id from other table)
 * Uses constraints to enforce rules as to what the data can be
 * Foreign keys must exist as a primary key value in the reference table
*/

//#endregion

//#region Table Relationships

/**One to Many or Many to One
 * Most common, used to avoid repetition and size of databases
 */

/**Many to Many
 * Use a third table (junction table) to manage relationships between 2 tables if they would need to reference multiple ids
*/

/**One to One
 * Rarely used
 * Used to separate a table if part is rarely used to reduce overhead
 * or for third party tables that is read-only should not be edited
 */

//#endregion

//#region Joining Tables

//#region Inner Join

// INNER JOIN keywords allow you to join multiple tables together, based on a specified key
//Inner join only joins values that match, picture as intersection of a venn diagram

select /*columns*/
    from /*table1*/
    inner join /*table2*/ on /*equality criteria*/
    inner join /*table3*/ on /*equality criteria*/
    where /*search criteria*/


select * from make
    INNER JOIN model ON make.MakeID = model.MakeID;

select MakeName, ModelName from make
    INNER JOIN model ON make.MakeID = model.MakeID;

select mk.MakeName, md.ModelName from make as mk
    INNER JOIN model as md ON mk.MakeID = md.MakeID;

select mk.MakeName, md.ModelName from make as mk
    INNER JOIN model as md ON mk.MakeID = md.MakeID
    where MakeName = "Chevy";

//#endregion

//#region Outer Join

// OUTER JOIN keywords allow you to join multiple tables together, based on a specified key
//Outer join joins all values, even if they aren't in both tables

//Can specify left or right to get data all data from selected and then only the data that matches on the other side
//Left gets all on left and only matching from right, right gets the opposite
//Full gets all data, even if they don't match

//Like the inner join, but gets all makes, even if they do not have a model associated with them
select mk.MakeName, md.ModelName from make as mk
    LEFT OUTER JOIN model as md ON mk.MakeID = md.MakeID;

//Gets number of models in each make
select mk.MakeName, count(md.ModelName) as NumberOfModels from make as mk
    LEFT OUTER JOIN model as md ON mk.MakeID = md.MakeID;

//#endregion

//#region Examples

//Gets name and email address of all patrons with outstanding books
select first_name || " " || upper(last_name) as Name, email as Email from patrons
  inner join loans on patrons.id = loans.patron_id
  where returned_on is null
  order by last_name ASC, first_name ASC;

//Gets name and email of patrons that have not loaned a book
select first_name || " " || upper(last_name) as Name, email as Email from patrons
  left outer join loans on patrons.id = loans.patron_id
  where loans.patron_id is null
  order by last_name ASC, first_name ASC

//Generates a report that shows the title of the book, first and last name of the patron, email and all date fields of the loan.
select title, first_name || " " || upper(last_name) as Name, email as Email,
  loaned_on as "Loaned On", return_by as "Return By", returned_on as "Returned On"
  from patrons
  inner join loans on patrons.id = loans.patron_id
  inner join books on loans.book_id = books.id
  order by last_name ASC, first_name ASC;

//Gets info from car and model tables
select ModelName, VIN, StickerPrice from car
	inner join model on car.ModelID = model.ModelID;

//Gets info from car, make and model tables
select MakeName, ModelName, VIN, StickerPrice from Car
    inner join Model on Car.ModelID = Model.ModelID
    inner join Make on Make.MakeID = Model.MakeID;

//Show the First and Last Name of each sales rep along with SaleAmount from both the SalesRep and Sale tables in one result set.
select FirstName, LastName, SaleAmount from Sale
    inner join SalesRep on Sale.SalesRepID = SalesRep.SalesRepID;

//#endregion

//#endregion

//#region Set Operations in SQL

//#region Union Operator

//Joins tables vertically, so columns must match, removes duplicates
select MakeID, MakeName from make UNION select ForeignMakeID, MakeName from ForeignMake;

//Easier to read like this
select MakeID, MakeName from make
UNION
select ForeignMakeID, MakeName from ForeignMake;
    order by MakeName;

//#endregion

//#region Union All Operator

//Joins tables vertically, so columns must match, and keeps duplicates
select MakeID, MakeName from make
UNION ALL
select ForeignMakeID, MakeName from ForeignMake
    order by MakeName;

//#endregion

//#region Intersect Operator

//Joins tables vertically, so columns must match
//Only returns values that exist in both tables
select MakeName from make
INTERSECT
select MakeName from ForeignMake
    order by MakeName;

//#endregion

//#region Except Operator

//Joins tables vertically, so columns must match
//Only returns values that exist in the first table, but not the second
select MakeName from make
EXCEPT
select MakeName from ForeignMake
    order by MakeName;

//#endregion

//#region Examples

select Name from Fruit
	where Name < "L"
union
select Name from Vegetable
	where Name < "L";

select Name from Fruit
intersect
select Name from Vegetable
order by Name;

//Gets fruit but not vegetables
select Name from Fruit
except
select Name from Vegetable
order by Name;

//Gets vegetables but not fruit
select Name from Vegetable
except
select Name from Fruit
order by Name;

//#endregion

//#endregion

//#region Subqueries

//#region Using IN to Filter Data

//Selects columns with a carid 1, 3 0r 5, but what if you don't know what id to use?
select * from Sale where CarID IN (1, 3, 5);

//Subquery we want to use
select CarID from Car where ModelYear = 2015;

select * from Sale where CarID IN (select CarID from Car where ModelYear = 2015);

select * from Sale where CarID IN (
    select CarID from Car where ModelYear = 2015
);

select * from Sale where CarID NOT IN (
    select CarID from Car where ModelYear = 2015
);

//#endregion

//#region Using a Subquery to Create a Temporary Table

select * from Sale AS s
    INNER JOIN (select CarID from Car where ModelYear = 2015) AS t
    ON s.CarID = t.CarID;

select sr.LastName, l.locationName, SUM(s.SaleAmount) as SaleAmount
    From Sale as s
    inner join SalesRep as sr on s.SalesRepID = sr.SalesRepID
    inner join Location as l on s.LocationID = l.LocationID
    group by sr.LastName, l.LocationName

select sr.LastName, Loc1.StLouisAmount, Loc2.ColumbiaAmount from SalesRep as sr
    left outer join (
        select SalesRepID, SUM(SaleAmount) as StLouisAmount
            from Sale as s where s.LocationID = 1
            group by SalesRepID
    ) as Loc1 on sr.SalesRepID = Loc1.SalesRepID
    left outer join (
        select SalesRepID, SUM(SaleAmount) as ColumbiaAmount
            from Sale as s where s.LocationID = 2
            group by SalesRepID
    ) as Loc2 on sr.SalesRepID = Loc2.SalesRepID;
    

select s.* from loans_north AS s
    INNER JOIN (select id from patrons where zip_code = 90210) AS c
    ON s.patron_id = c.id;

//#endregion

//#endregion