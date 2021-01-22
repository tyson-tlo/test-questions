-- -----------------------------------------------------------------------------
-- 4. SQL Database
-- -----------------------------------------------------------------------------
-- Zoro has an online store where he sells CDs, t-shirts and other merchandise 
-- for his band. Zoro has the legal obligation of keeping track of each of his 
-- customers and all of their transactions with his business for auditing 
-- purposes. He has decided to store this information in a MySQL relational 
-- database. 

-- Each customer has a name and email address. Users sign up using their email 
-- address so no two customers can have the same email address. Zoro's site 
-- isn't that popular here, but it's super popular in Japan and he has 
-- customers from all over the world.

-- Each customer may have multiple transactions which we  need to store. Each 
-- transaction has the date and time it occurred, some brief text describing 
-- the transaction, and the debit or credit dollar amount. (a credit could occur
-- if there happened to be a refund or if the customer received a credit as a 
-- result of a non financial action). 

-- (1) Design a relational database schema that could be used to store this 
-- data. Please justify your design choices. Please provide your answer in 
-- CREATE TABLE format, or something reasonably close. Again, doesn't need to 
-- actually compile, we are more interested in your ideas and reasoning than 
-- your syntax.

-- (2) When we delete a customer we also want to delete all of their 
-- transactions. This needs to be treated as a single operation. What 
-- methodology would you employ to accomplish this?

-- My Explanations
-- 1)
-- A simple table schema where the email has to be unique so there can be no two emails/customers
-- Decimal in customer_transactions table as amount to allow up to transactions of $9999.99, though likely wouldn't need more than $1000
-- for the transaction types, but hey, If you've been to a concert you realize how expensive things can be ;)
-- customer transactions is set to datetime instead of automatically generating a timestamp, incase updating the database is set 
-- in some kind of queue and we need it to match the actual transaction time. We have that option here.

CREATE TABLE customers (
    id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    UNIQUE (email)
);
-- 2) Deleting customers in a single transaction using mysql.
-- Default innoDB engine allows for relationship constraints and delting of child records.
-- This would take care of deleting it in one fell swoop and be most efficient instead 
-- of doing this with multiple queries to the mysql api  (PHP, NodeJS, whichever..)

CREATE TABLE customer_transactions (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_id INT(9) UNSIGNED NOT NULL,
    amount DECIMAL(6, 2) NOT NULL,
    description VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL,
    FOREIGN KEY (customer_id)
        REFERENCES customers (id),
        ON DELETE CASCADE
);