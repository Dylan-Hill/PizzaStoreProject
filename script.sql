CREATE TABLE customers (
	cust_id int NOT NULL AUTO_INCREMENT,
	cust_email varchar(255),
	cust_address varchar(255), 
	PRIMARY KEY(cust_id)
);

CREATE TABLE orders (
	orderID int NOT NULL AUTO_INCREMENT,
	cust_ID int,
	order_date DATE,

	PRIMARY KEY(orderID)
);

CREATE TABLE pizza (
	pizzaID int NOT NULL AUTO_INCREMENT,
	dough VARCHAR(50) NOT NULL,
	cheese VARCHAR(50) NOT NULL,
	toppings json,

	PRIMARY KEY(pizzaID)
);

CREATE TABLE pizzaOrders (
	poID int NOT NULL AUTO_INCREMENT,
	orderID INT NOT NULL,
	pizzaID INT NOT NULL,	

	PRIMARY KEY(poID),
	FOREIGN KEY (orderID) REFERENCES orders (orderID),
	FOREIGN KEY (pizzaID) REFERENCES pizza (pizzaID)
);