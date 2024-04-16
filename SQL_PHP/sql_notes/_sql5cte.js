//Common Table Expressions Using WITH
// https://teamtreehouse.com/library/common-table-expressions-using-with

//Use CTEs to replace subqueries

select ProductName, CategoryName, UnitPrice, UnitsInStock
from Products
join Categories on PRODUCTS.CategoryId = Categories.Id
where Products.Discontinued = 0;

WITH product_details as (
select ProductName, CategoryName, UnitPrice, UnitsInStock
from Products
join Categories on PRODUCTS.CategoryId = Categories.Id
where Products.Discontinued = 0;
)

select * from product_details
order by CategoryName, ProductName;

SELECT CategoryName, COUNT(*) AS unique_product_count, SUM(UnitsInStock) AS stock_count
FROM product_details
GROUP BY CategoryName
ORDER BY unique_product_count;

//Subquery
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

//Refactored as CTE
with stLouis as (
    select SalesRepID, SUM(SaleAmount) as StLouisAmount
    from Sale as s where s.LocationID = 1
    group by SalesRepID
),
columbia(
    select SalesRepID, SUM(SaleAmount) as ColumbiaAmount
    from Sale as s where s.LocationID = 2
    group by SalesRepID
)

select SalesRep.LastName, stLouis.StLouisAmount, columbia.ColumbiaAmount
from SalesRep
join stLouis on sr.SalesRepID = Loc1.SalesRepID
join columbia on sr.SalesRepID = Loc2.SalesRepID;