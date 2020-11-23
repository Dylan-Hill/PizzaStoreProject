/* Commands:
*/
/*  use pizza_store
*/
/*  source script.sql 
*/

DROP TABLE IF EXISTS customers;
CREATE TABLE customers (
    cust_id int NOT NULL AUTO_INCREMENT,
    cust_email varchar(255),
    cust_address varchar(255), 
    province varchar(100),
    city varchar(150),
    postal varchar(10),

    PRIMARY KEY(cust_id)
);

DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
	orderID int NOT NULL AUTO_INCREMENT,
	cust_ID int,
	order_date DATE,

	PRIMARY KEY(orderID)
);

DROP TABLE IF EXISTS pizza;
CREATE TABLE pizza (
	pizzaID int NOT NULL AUTO_INCREMENT,
	dough VARCHAR(50) NOT NULL,
	cheese VARCHAR(50) NOT NULL,
	sauce VARCHAR(20) NOT NULL,
	toppings json,

	PRIMARY KEY(pizzaID)
);


DROP TABLE IF EXISTS pizzaOrders;
CREATE TABLE pizzaOrders (
	poID int NOT NULL AUTO_INCREMENT,
	orderID INT NOT NULL,
	pizzaID INT NOT NULL,	

	PRIMARY KEY(poID),
	FOREIGN KEY (orderID) REFERENCES orders (orderID),
	FOREIGN KEY (pizzaID) REFERENCES pizza (pizzaID)
);