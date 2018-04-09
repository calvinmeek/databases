<?php

	function pg_connection_string_from_database_url() {
		extract(parse_url($_ENV["postgres://tjrozlqitsogrw:de6a796df81bdd6d5cd454fc3beb3ed8d4d6147d34217c3830b4fa62e2100b7d@ec2-107-21-126-193.compute-1.amazonaws.com:5432/d86rjlemkr1qc8"]));

		return "user=tjrozlqitsogrw

	 	password=de6a796df81bdd6d5cd454fc3beb3ed8d4d6147d34217c3830b4fa62e2100b7d host=ec2-107-21-126-193.compute-1.amazonaws.com dbname=d86rjlemkr1qc8
		" . substr($path, 1);
	}
	
	$conn = pg_connect(pg_connection_string_from_database_url());

	if (!$conn) {
	  echo "NOT_CONNECTED\n";
	  echo "<br />\n";
	  exit;
	} else {
	    echo "CONNECTED\n";
	    echo "<br />\n";
	}



	// ############################################################# CREATING TABLES #############################################################

	// $drop = pg_query($conn, "DROP SCHEMA public CASCADE");

	$rater = pg_query($conn, "CREATE TABLE IF NOT EXISTS rater(id SERIAL PRIMARY KEY, email VARCHAR(30) NOT NULL, usrName VARCHAR(15) NOT NULL, join_date VARCHAR(30) NOT NULL, type VARCHAR(15) NOT NULL, rep INT NOT NULL)");




	$restaurant = pg_query($conn, "CREATE TABLE IF NOT EXISTS restaurant(restaurantID SERIAL PRIMARY KEY, name VARCHAR(25) NOT NULL, type VARCHAR(25) NOT NULL, url VARCHAR(255) NOT NULL)");



	$rating = pg_query($conn, "CREATE TABLE IF NOT EXISTS rating(id INT REFERENCES rater(id) ON DELETE CASCADE, rating_date VARCHAR(10), price INT, food INT, mood INT, staff INT, comments VARCHAR(255), restaurantID INT REFERENCES restaurant(restaurantID), PRIMARY KEY(id,rating_date))");



	$location = pg_query($conn, "CREATE TABLE IF NOT EXISTS location(locationID SERIAL PRIMARY KEY, first_open_date VARCHAR(25) NOT NULL, manager_name VARCHAR(25) NOT NULL, phoneNumber VARCHAR(15) NOT NULL, address VARCHAR(255) NOT NULL, open_hour INT NOT NULL, close_hour INT NOT NULL, restaurantID INT REFERENCES restaurant(restaurantID) ON DELETE CASCADE)");



	$menuItem = pg_query($conn, "CREATE TABLE IF NOT EXISTS menuItem(itemID SERIAL PRIMARY KEY, itemName VARCHAR(25) NOT NULL, type VARCHAR(25) NOT NULL, category VARCHAR(25) NOT NULL, description VARCHAR(255), price INT NOT NULL, restaurantID INT REFERENCES restaurant(restaurantID) ON DELETE CASCADE)");



	$ratingItem = pg_query($conn, "CREATE TABLE IF NOT EXISTS ratingItem(id INT REFERENCES rater(id) ON DELETE CASCADE, date_stamp VARCHAR(25) NOT NULL, itemID INT REFERENCES menuItem(itemID) ON DELETE CASCADE, rating INT NOT NULL, comment VARCHAR(255), PRIMARY KEY(id,date_stamp,itemID))");


	if (!$ratingItem && !$menuItem && !$location && !$rating && !$restaurant && !$rater) {
	  echo "TABLE_GENERATION_FAILED\n";
	  echo "<br />\n";
	  exit;
	}
	else{
	  echo "TABLE_ GENERATION_SUCCESSFUL\n";
	  echo "<br />\n";
	}




	// ############################################################# POPULATING TABLES #############################################################

	$check = pg_query($conn, "SELECT * FROM rater");

	if (!$fetch = pg_fetch_all($check)) {

		

		// $$$$$$$$$$$$$$$$$$$$$$ ADDING RATERS $$$$$$$$$$$$$$$$$$$$$$

		$rater0 = pg_query($conn, "INSERT INTO rater(email,usrName,join_date,type,rep) VALUES ('cmeek070@email.ca','Calvin','05-06-99','Blog',5)");
		$rater1 = pg_query($conn, "INSERT INTO rater(email,usrName,join_date,type,rep) VALUES ('aabbb@email.ca','Alvin','05-07-17','Online',3)");
		$rater2 = pg_query($conn, "INSERT INTO rater(email,usrName,join_date,type,rep) VALUES ('rr234@email.ca','Rick','01-26-34','Critic',3)");
		$rater3 = pg_query($conn, "INSERT INTO rater(email,usrName,join_date,type,rep) VALUES ('sz23@email.ca','John','12-22-06','Online',1)");
		$rater4 = pg_query($conn, "INSERT INTO rater(email,usrName,join_date,type,rep) VALUES ('jiimm01@email.ca','Jim','01-02-01','Critic',3)");
		$rater5 = pg_query($conn, "INSERT INTO rater(email,usrName,join_date,type,rep) VALUES ('mortyiscool@email.ca','Morty','05-26-19','Critic',2)");
		$rater6 = pg_query($conn, "INSERT INTO rater(email,usrName,join_date,type,rep) VALUES ('sk234@email.ca','Shrek','02-16-39','Online',4)");
		$rater7 = pg_query($conn, "INSERT INTO rater(email,usrName,join_date,type,rep) VALUES ('rog123@email.ca','Roger','10-16-12','Blog',3)");
		$rater8 = pg_query($conn, "INSERT INTO rater(email,usrName,join_date,type,rep) VALUES ('m1234566@email.ca','Mike','11-17-99','Blog',1)");
		$rater9 = pg_query($conn, "INSERT INTO rater(email,usrName,join_date,type,rep) VALUES ('kyle123@email.ca','Kyle','09-21-96','Blog',1)");
		$rater10 = pg_query($conn, "INSERT INTO rater(email,usrName,join_date,type,rep) VALUES ('oaddddddd@email.ca','Owen','08-12-95','Online',4)");
		$rater11 = pg_query($conn, "INSERT INTO rater(email,usrName,join_date,type,rep) VALUES ('noahman@email.ca','Noah','12-22-12','Blog',3)");
		$rater12 = pg_query($conn, "INSERT INTO rater(email,usrName,join_date,type,rep) VALUES ('baseball123@email.ca','Ryan','10-20-30','Critic',4)");
		$rater13 = pg_query($conn, "INSERT INTO rater(email,usrName,join_date,type,rep) VALUES ('gamerguy1@email.ca','David','05-30-12','Critic',4)");
		$rater14 = pg_query($conn, "INSERT INTO rater(email,usrName,join_date,type,rep) VALUES ('biker1234578@email.ca','Jake','11-12-23','Online',5)");


					
		

		// $$$$$$$$$$$$$$$$$$$$$$ ADDING RESTAURANTS $$$$$$$$$$$$$$$$$$$$$$

		$restaurant0 = pg_query($conn, "INSERT INTO restaurant(name,type,url) VALUES ('Best Food Ever','American','www.bestfood.com')");
		$restaurant1 = pg_query($conn, "INSERT INTO restaurant(name,type,url) VALUES ('Pizza Lovers','American','www.pizzalovers.com')");
		$restaurant2 = pg_query($conn, "INSERT INTO restaurant(name,type,url) VALUES ('Sushi Palace','Sushi','www.sushipalace.com')");
		$restaurant3 = pg_query($conn, "INSERT INTO restaurant(name,type,url) VALUES ('Italian Pasta','Italian','www.ipasta.com')");
		$restaurant4 = pg_query($conn, "INSERT INTO restaurant(name,type,url) VALUES ('Burger Master','American','www.burgermaster.com')");
		$restaurant5 = pg_query($conn, "INSERT INTO restaurant(name,type,url) VALUES ('Icecream Delight','Dessert','www.id.com')");
		$restaurant6 = pg_query($conn, "INSERT INTO restaurant(name,type,url) VALUES ('Taste of Asia','Asian','www.toa.com')");
		$restaurant7 = pg_query($conn, "INSERT INTO restaurant(name,type,url) VALUES ('Steak House','American','www.steakhouse.com')");
		$restaurant8 = pg_query($conn, "INSERT INTO restaurant(name,type,url) VALUES ('Shawarma Palooza','Middle Eastern','www.spalooza.com')");
		$restaurant9 = pg_query($conn, "INSERT INTO restaurant(name,type,url) VALUES ('Eat n Play','American','www.eatnplay.com')");
		$restaurant10 = pg_query($conn, "INSERT INTO restaurant(name,type,url) VALUES ('Ballin Burgers','American','www.ballinburgers.com')");
		$restaurant11 = pg_query($conn, "INSERT INTO restaurant(name,type,url) VALUES ('French Cuisine','French','www.fc.com')");

		// $$$$$$$$$$$$$$$$$$$$$$ ADDING LOCATIONS $$$$$$$$$$$$$$$$$$$$$$

		$location = pg_query($conn, "INSERT INTO location(first_open_date,manager_name,phoneNumber,address,open_hour,close_hour,restaurantID) 
			VALUES ('9-17-16','Jimi','129-345-8888','123 Road St',1000,2000,1)");		
		$location = pg_query($conn, "INSERT INTO location(first_open_date,manager_name,phoneNumber,address,open_hour,close_hour,restaurantID) 
			VALUES ('9-17-16','Paul','399-345-2888','234 Road St',800,2100,2)");
		$location = pg_query($conn, "INSERT INTO location(first_open_date,manager_name,phoneNumber,address,open_hour,close_hour,restaurantID) 
			VALUES ('9-17-16','Rob','234-345-5888','1333 Road St',830,2000,3)");
		$location = pg_query($conn, "INSERT INTO location(first_open_date,manager_name,phoneNumber,address,open_hour,close_hour,restaurantID) 
			VALUES ('9-17-16','Sally','956-345-8888','133 Road St',900,2000,4)");
		$location = pg_query($conn, "INSERT INTO location(first_open_date,manager_name,phoneNumber,address,open_hour,close_hour,restaurantID) 
			VALUES ('9-17-16','Wallace','349-345-8888','121 Road St',1100,1300,5)");
		$location = pg_query($conn, "INSERT INTO location(first_open_date,manager_name,phoneNumber,address,open_hour,close_hour,restaurantID) 
			VALUES ('9-17-16','Shaggy','399-315-1188','1 Road St',900,1900,6)");
		$location = pg_query($conn, "INSERT INTO location(first_open_date,manager_name,phoneNumber,address,open_hour,close_hour,restaurantID) 
			VALUES ('9-17-16','Steve','399-375-2888','3 Road St',800,2000,7)");
		$location = pg_query($conn, "INSERT INTO location(first_open_date,manager_name,phoneNumber,address,open_hour,close_hour,restaurantID) 
			VALUES ('9-17-16','Fred','399-349-8888','1234 Road St',1000,2000,8)");
		$location = pg_query($conn, "INSERT INTO location(first_open_date,manager_name,phoneNumber,address,open_hour,close_hour,restaurantID) 
			VALUES ('9-17-16','Franky','392-345-8888','123333 Road St',700,2000,9)");
		$location = pg_query($conn, "INSERT INTO location(first_open_date,manager_name,phoneNumber,address,open_hour,close_hour,restaurantID) 
			VALUES ('9-17-16','Velma','391-345-8288','12322 Road St',500,1700,10)");
		$location = pg_query($conn, "INSERT INTO location(first_open_date,manager_name,phoneNumber,address,open_hour,close_hour,restaurantID) 
			VALUES ('9-17-16','Pete','233-345-8118','123456 Road St',900,2000,11)");
		$location = pg_query($conn, "INSERT INTO location(first_open_date,manager_name,phoneNumber,address,open_hour,close_hour,restaurantID) 
			VALUES ('9-17-16','Jeff','398-345-8833','1231 Road St',800,1200,12)");

					

		// $$$$$$$$$$$$$$$$$$$$$$ ADDING MENU ITEMS $$$$$$$$$$$$$$$$$$$$$$

		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Cheese Pizza','F','Main','',9.99,1)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Milk Shake','D','Drink','',7.99,1)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Ceaser Salad','F','Starter','',4.99,1)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Cheese Pizza','F','Main','',5.99,2)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Meat Lovers Pizza','F','Main','',5.99,2)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Veggie Pizza','F','Main','',5.99,2)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Pepperoni Pizza','F','Main','',5.99,2)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('BBQ Chicken Pizza','F','Main','',5.99,2)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Hawian Pizza','F','Main','',5.99,2)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Margherita Pizza','F','Main','',5.99,2)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('5pc Sushi','F','Main','',5.99,3)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('10pc Sushi','F','Main','',10.99,3)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('15pc Sushi','F','Main','',15.99,3)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('30pc Sushi','F','Main','',20.99,3)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Pop','D','Drink','',2.99,3)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Water','D','Drink','',0,3)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Spaghetti','F','Main','',12.99,4)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Spring Salad','F','Starter','',3.99,4)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Lasagne','F','Main','',11.99,4)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Chocolate Cake','F','Desert','',5.99,4)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Apple Pie','F','Desert','',4.99,4)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Build a Burger','F','Main','',7.99,5)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Sundae','F','Desert','',2.99,6)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Banana Split','F','Desert','',4.99,6)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Icecream Cone','F','Desert','',1.99,6)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Noodle Bowl','F','Main','',7.99,7)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('8oz Steak','F','Main','',19.99,8)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Shrimp','F','Starter','',7.99,8)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Baked Potato','F','Side','',5.99,8)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Chocolate Fondue','F','Desert','',13.99,8)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Shawarma','F','Main','',7.99,9)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Grilled Cheese','F','Main','',4.99,10)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Kids Pizza','F','Main','',5.99,10)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Build a Burger','F','Main','',8.99,11)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Poutine','F','Main','',7.99,12)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('French Bread','F','Starter','',1.99,12)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('French Pastries','F','Desert','',4.99,12)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Hot Chocolate','D','Drink','',2.99,12)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('French Fries','F','Starter','',2.99,12)");
		$menuItem0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('Tea','D','Drink','',2.99,12)");




					



		// $$$$$$$$$$$$$$$$$$$$$$ ADDING RATINGS $$$$$$$$$$$$$$$$$$$$$$

		$rating1 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (1,'03-12-18',4,1,5,2,'',1)");
		$rating2 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (1,'01-03-12',1,4,2,2,'',1)");
		$rating3 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (2,'12-05-18',3,5,3,4,'',1)");
		$rating4 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (3,'11-16-18',5,2,5,5,'',1)");
		$rating5 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (11,'10-2-18',5,2,5,1,'',1)");
		$rating6 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (14,'05-2-18',1,3,2,2,'',1)");
		$rating7 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (12,'08-2-18',2,1,1,3,'',1)");

		$rating8 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (13,'09-5-11',3,4,2,4,'',2)");
		$rating9 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (14,'06-6-18',4,2,4,4,'',2)");
		$rating10 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (3,'04-6-18',3,1,4,4,'',2)");
		$rating11 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (5,'03-10-18',2,5,2,4,'',2)");
		$rating12 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (3,'01-11-14',1,2,5,4,'',2)");

		$rating13 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (6,'02-14-15',1,4,3,2,'',3)");
		$rating14 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (7,'03-01-18',3,1,5,2,'',3)");
		$rating15 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (8,'05-13-18',4,3,5,2,'',3)");
		$rating16 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (9,'05-10-48',4,3,4,2,'',3)");
		$rating17 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (10,'05-19-18',4,3,2,2,'',3)");
		$rating18 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (11,'05-12-18',5,1,2,2,'',3)");
		$rating19 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (11,'12-16-12',2,3,5,2,'',3)");

		$rating20 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (12,'12-26-18',1,5,5,3,'',4)");
		$rating21 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (13,'02-12-11',4,3,3,3,'',4)");
		$rating22 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (15,'09-06-18',3,2,2,3,'',4)");
		$rating23 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (4,'02-06-18',3,3,5,3,'',4)");
		$rating1 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (1,'03-11-18',4,1,5,3,'',4)");
		$rating2 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (1,'11-03-12',1,4,2,3,'',4)");
		$rating3 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (1,'10-15-18',3,5,3,3,'',4)");
		$rating4 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (1,'1-6-18',5,2,5,3,'',4)");
		$rating5 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (1,'1-2-18',5,2,5,3,'',4)");

		$rating6 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (7,'12-22-18',1,3,2,5,'',5)");
		$rating7 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (8,'08-22-18',2,1,1,5,'',5)");
		$rating8 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (9,'09-15-11',3,4,2,5,'',5)");
		$rating9 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (1,'06-6-19',4,2,4,5,'',5)");
		$rating10 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (3,'04-6-67',3,1,4,5,'',5)");
		$rating11 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (5,'03-10-98',2,5,2,5,'',5)");
		$rating12 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (3,'01-12-94',1,2,5,5,'',5)");
		$rating13 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (6,'02-13-15',1,4,3,5,'',5)");
		$rating14 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (7,'03-11-18',3,1,5,5,'',5)");

		$rating15 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (8,'05-12-18',4,3,5,4,'',6)");
		$rating16 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (9,'05-13-48',4,3,4,4,'',6)");
		$rating17 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (10,'05-9-18',4,3,2,4,'',6)");
		$rating18 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (11,'05-22-18',5,1,2,4,'',6)");
		$rating19 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (11,'12-1-12',2,3,5,4,'',6)");
		$rating20 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (12,'12-6-18',1,5,5,4,'',6)");

		$rating21 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (13,'02-1-22',4,3,3,2,'',7)");
		$rating22 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (15,'09-6-18',3,2,2,2,'',7)");
		$rating23 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (4,'12-06-18',3,3,5,2,'',7)");
		$rating1 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (1,'03-15-18',4,1,5,2,'',7)");
		$rating2 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (1,'01-12-12',1,4,2,2,'',7)");
		$rating3 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (2,'12-25-18',3,5,3,2,'',7)");
		$rating4 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (3,'10-16-18',5,2,5,2,'',7)");
		$rating5 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (11,'9-2-18',5,2,5,2,'',7)");
		$rating6 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (14,'1-22-18',1,3,2,2,'',7)");
		$rating7 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (12,'08-22-18',2,1,1,2,'',7)");

		$rating8 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (13,'09-15-11',3,4,2,3,'',8)");
		$rating9 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (14,'09-6-18',4,2,4,3,'',8)");
		$rating10 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (3,'02-6-18',3,1,4,3,'',8)");
		$rating11 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (5,'02-10-18',2,5,2,3,'',8)");
		$rating12 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (3,'02-14-14',1,2,5,3,'',8)");
		$rating13 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (6,'01-14-15',1,4,3,3,'',8)");

		$rating14 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (7,'03-05-18',3,1,5,5,'',9)");
		$rating15 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (8,'05-23-18',4,3,5,5,'',9)");
		$rating16 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (9,'05-18-48',4,3,4,5,'',9)");
		$rating17 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (10,'05-18-18',4,3,2,5,'',9)");
		$rating18 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (11,'05-12-15',5,1,2,5,'',9)");
		$rating19 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (11,'12-16-15',2,3,5,5,'',9)");
		$rating20 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (12,'12-26-17',1,5,5,5,'',9)");
		$rating21 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (13,'02-12-99',4,3,3,5,'',9)");
		$rating22 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (15,'09-06-00',3,2,2,5,'',9)");
		$rating23 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (4,'02-30-22',3,3,5,5,'',9)");

		$rating1 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (1,'07-12-18',4,1,5,4,'',10)");
		$rating2 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (1,'11-13-12',1,4,2,4,'',10)");
		$rating3 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (1,'10-5-18',3,5,3,4,'',10)");
		$rating4 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (1,'1-23-18',5,2,5,4,'',10)");
		$rating5 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (1,'1-25-18',5,2,5,4,'',10)");
		$rating6 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (7,'12-12-18',1,3,2,4,'',10)");
		$rating7 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (8,'08-12-18',2,1,1,4,'',10)");
		$rating8 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (9,'09-25-11',3,4,2,4,'',10)");
		$rating9 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (1,'6-14-19',4,2,4,4,'',10)");

		$rating10 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (3,'11-6-67',3,1,4,1,'',11)");
		$rating11 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (5,'11-10-98',2,5,2,1,'',11)");
		$rating12 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (3,'1-12-94',1,2,5,1,'',11)");
		$rating13 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (6,'4-13-15',1,4,3,1,'',11)");
		$rating14 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (7,'7-11-18',3,1,5,1,'',11)");
		$rating15 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (8,'07-12-18',4,3,5,1,'',11)");
		$rating16 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (9,'03-13-48',4,3,4,1,'',11)");

		$rating17 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (10,'08-9-18',4,3,2,3,'',12)");
		$rating18 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (11,'08-22-18',5,1,2,3,'',12)");
		$rating19 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (11,'1-16-12',2,3,5,3,'',12)");
		$rating20 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (12,'1-16-18',1,5,5,3,'',12)");
		$rating21 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (11,'02-21-22',4,3,3,3,'',12)");
		$rating22 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (15,'09-16-18',3,2,2,3,'',12)");
		$rating23 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,comments,restaurantID) VALUES (4,'12-6-18',3,3,5,3,'',12)");




	  	echo "<br />\n";
	} else {
	  echo "DEFAULT_TABLE_INFO_ALREADY_GENERATED!";
	}

?>

	<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% UI SECTION %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->


	<html>

		<head>
			<link rel="stylesheet" type="text/css" href="style.css">
		</head>

		<div>

			<div class="functionBox">

				<p class="functionTitle">REGISTER AS A RATER:</p>

				<form method="post" action="">
					
					<input type="text" name="rtrEmail" placeholder="Email">
					<br>
					<input type="text" name="rtrName" placeholder="User Name">
					<br>
					<input type="text" name="rtrJDate" placeholder="Date">
					<br>
					<input type="text" name="rtrType" placeholder="Type">
					<br>
					<input type="text" name="rtrRep" placeholder="Reputation">
					<br>
					<input type="submit" name="Submit2">
				</form>

			</div>

			<div class="functionBox">
				
				<p class="functionTitle">REMOVE A RATER:</p>

				<form method="post" action="">
					
					<input type="text" name="ratName" placeholder="Name">
					<br>
					<input type="text" name="ratID" placeholder="ID">
					<br>
					<input type="submit" name="Submit">
				</form>

			</div>


			<div class="functionBox">
				
				<p class="functionTitle">ADD A RESTAURANT:</p>

				<form method="post" action="">
					
					<input type="text" name="rName" placeholder="Name">
					<br>
					<input type="text" name="rType" placeholder="Type">
					<br>
					<input type="text" name="rURL" placeholder="URL">
					<br>
					<input type="submit" name="Submit">
				</form>

			</div>


			<div class="functionBox">
				
				<p class="functionTitle">REMOVE A RESTAURANT:</p>

				<form method="post" action="">
					
					<input type="text" name="dRName" placeholder="Name">
					<br>
					<input type="text" name="dRID" placeholder="ID">
					<br>
					<input type="submit" name="Submit">
				</form>

			</div>

			<div class="functionBox">
				
				<p class="functionTitle">ADD AN ITEM:</p>

				<form method="post" action="">
					
					<input type="text" name="iName" placeholder="Name">
					<br>
					<input type="text" name="iType" placeholder="Type">
					<br>
					<input type="text" name="iCate" placeholder="Category">
					<br>
					<input type="text" name="iDesc" placeholder="Description">
					<br>
					<input type="text" name="iPrice" placeholder="Price">
					<br>
					<input type="text" name="iRID" placeholder="Restaurant ID">
					<br>
					<input type="submit" name="Submit">
				</form>

			</div>


			<div class="functionBox">
				
				<p class="functionTitle">REMOVE AN ITEM:</p>

				<form method="post" action="">
					
					<input type="text" name="rIName" placeholder="Name">
					<br>
					<input type="text" name="rIID" placeholder="ID">
					<br>
					<input type="submit" name="Submit">
				</form>

			</div>
			

			<?php

				$rstN = $_POST["rName"];
				$rstT = $_POST["rType"];
				$rstU = $_POST["rURL"];

				$dRN = $_POST["dRName"];
				$dRI = $_POST["dRID"];
				$bb = (int)$dRI;

				$rtrEmail = $_POST["rtrEmail"];
				$rtrName = $_POST["rtrName"];
				$rtrTDate = $_POST["rtrJDate"];
				$rtrType = $_POST["rtrType"];
				$rtrRep = $_POST["rtrRep"];

				$ratName = $_POST["ratName"];
				$ratID = $_POST["ratID"];
				$rr = (int)$ratID;

				$miName = $_POST["iName"];
				$miType = $_POST["iType"];
				$miCate = $_POST["iCate"];
				$miDesc = $_POST["iDesc"];
				$miPrice = $_POST["iPrice"];
				$miRID = $_POST['iRID'];
				$m = (int)$miRID;

				$miRN = $_POST["rIName"];
				$miRID = $_POST["rIID"];
				$mm = (int)$miRID;

				if($rstN){
					$addRestaurant = pg_query($conn, "INSERT INTO restaurant(name,type,url) VALUES ('$rstN','$rstT','$rstU')");
				}

				if($dRN){
					$removeRestaurant = pg_query($conn, "DELETE FROM restaurant WHERE restaurant.name = '$dRN' AND restaurant.restaurantID = '$dRI'");
				}

				if($rtrEmail){
					$rater0 = pg_query($conn, "INSERT INTO rater(email,usrName,join_date,type,rep) VALUES ('$rtrEmail','$rtrName','$rtrJDate','$rtrType','$rtrRep')");
				}

				if($ratName){
					$removeRater = pg_query($conn, "DELETE FROM rater WHERE rater.usrName = '$ratName' AND rater.id = '$rr'");
				}

				if($miName){
					$rater0 = pg_query($conn, "INSERT INTO menuItem(itemName,type,category,description,price,restaurantID) VALUES ('$miName','$miType','$miCate','$miDesc','$miPrice','$m')");
				}

				if($miRN){
					$removeRater = pg_query($conn, "DELETE FROM menuItem WHERE menuItem.itemName = '$miRN' AND menuItem.itemID = '$mm'");
				}

				


			?>

		</div>

	</html>

<?php


	// ############################################################# PRINTING TABLES #############################################################



	// %%%%%%%%%%%%%%%%% PRINT RATER TABLE %%%%%%%%%%%%%%%%%

					$result = pg_query($conn, "SELECT * FROM rater");

					print "<pre>\n";
					print "RATER TABLE\n\n";

					if ($fetch = pg_fetch_all($result)) {

						echo '<table>
				        <tr>
				         <td>ID</td>
				         <td>Email</td>
				         <td>Name</td>
				        </tr>';

						foreach($fetch as $array)
						{
						    echo '<tr>
						    		<td>'. $array['id'].'</td>
						            <td>'. $array['email'].'</td>
						            <td>'. $array['usrname'].'</td>
						          </tr>';
						}
						echo '</table>';

					  	echo "<br />\n";
					} else {
					  echo "NO RECORDS FOUND";
					}

	
	// %%%%%%%%%%%%%%%%% PRINT RESTAURANT TABLE %%%%%%%%%%%%%%%%%

					$result = pg_query($conn, "SELECT * FROM restaurant");

					print "<pre>\n";
					print "RESTAURANT TABLE\n\n";

					if ($fetch = pg_fetch_all($result)) {

						echo '<table>
				        <tr>
				         <td>ID</td>
				         <td>Name</td>
				         <td>Type</td>
				         <td>URL</td>
				        </tr>';

						foreach($fetch as $array)
						{
						    echo '<tr>
						    		<td>'. $array['restaurantid'].'</td>
						            <td>'. $array['name'].'</td>
						            <td>'. $array['type'].'</td>
						            <td>'. $array['url'].'</td>
						          </tr>';
						}
						echo '</table>';

					  	echo "<br />\n";
					} else {
					  echo "NO RECORDS FOUND";
					}

	// %%%%%%%%%%%%%%%%% PRINT RESTAURANT LOCATION TABLE %%%%%%%%%%%%%%%%%

					$result = pg_query($conn, "SELECT * FROM location");

					print "<pre>\n";
					print "RESTAURANT LOCATION TABLE\n\n";

					if ($fetch = pg_fetch_all($result)) {

						echo '<table>
				        <tr>
				         <td>ID</td>
				         <td>OpenDate</td>
				         <td>M_name</td>
				         <td>phone #</td>
				         <td>address</td>
				         <td>open</td>
				         <td>close</td>
				         <td>R_ID</td>
				        </tr>';

						foreach($fetch as $array)
						{
						    echo '<tr>
						    		<td>'. $array['locationid'].'</td>
						    		<td>'. $array['first_open_date'].'</td>
						            <td>'. $array['manager_name'].'</td>
						            <td>'. $array['phonenumber'].'</td>
						            <td>'. $array['address'].'</td>
						            <td>'. $array['open_hour'].'</td>
						            <td>'. $array['close_hour'].'</td>
						            <td>'. $array['restaurantid'].'</td>
						          </tr>';
						}
						echo '</table>';

					  	echo "<br />\n";
					} else {
					  echo "NO RECORDS FOUND";
					}


	// %%%%%%%%%%%%%%%%% PRINT MENU ITEM TABLE %%%%%%%%%%%%%%%%%


					$result = pg_query($conn, "SELECT * FROM menuItem");

					print "<pre>\n";
					print "MENU ITEM TABLE\n\n";

					if ($fetch = pg_fetch_all($result)) {

						echo '<table>
				        <tr>
				         <td>ID</td>
				         <td>Name</td>
				         <td>Type</td>
				         <td>Category</td>
				         <td>Price</td>
				         <td>R_ID</td>
				        </tr>';

						foreach($fetch as $array)
						{
						    echo '<tr>
						    		<td>'. $array['itemid'].'</td>
						            <td>'. $array['itemname'].'</td>
						            <td>'. $array['type'].'</td>
						            <td>'. $array['category'].'</td>
						            <td>'. $array['price'].'</td>
						            <td>'. $array['restaurantid'].'</td>
						          </tr>';
						}
						echo '</table>';

					  	echo "<br />\n";
					} else {
					  echo "NO RECORDS FOUND";
					}


	// %%%%%%%%%%%%%%%%% PRINT RATINGS TABLE %%%%%%%%%%%%%%%%%


					$result = pg_query($conn, "SELECT * FROM rating");

					print "<pre>\n";
					print "RATINGS TABLE\n\n";

					if ($fetch = pg_fetch_all($result)) {

						echo '<table>
				        <tr>
				         <td>ID</td>
				         <td>Date</td>
				         <td>Price</td>
				         <td>Food</td>
				         <td>Mood</td>
				         <td>Staff</td>
				         <td>R_ID</td>
				        </tr>';

						foreach($fetch as $array)
						{
						    echo '<tr>
						    		<td>'. $array['id'].'</td>
						    		<td>'. $array['rating_date'].'</td>
						            <td>'. $array['price'].'</td>
						            <td>'. $array['food'].'</td>
						            <td>'. $array['mood'].'</td>
						            <td>'. $array['staff'].'</td>
						            <td>'. $array['restaurantid'].'</td>
						          </tr>';
						}
						echo '</table>';

					  	echo "<br />\n";
					} else {
					  echo "NO RECORDS FOUND";
					}


	// ############################################################# QUERY QUESTIONS #############################################################


	// %%%%%%%%%%%%%%%%% QUERY A %%%%%%%%%%%%%%%%%

	$testString2 = "Ballin Burgers";				

	$queryA = pg_query($conn, "SELECT * from restaurant R, location L WHERE R.restaurantID = l.restaurantID AND R.name = '$testString2'");

	print "<pre>\n";
	print "QUERY A\n\n";

	if ($fetch = pg_fetch_all($queryA)) {

		echo '<table>
        <tr>
         <td>ID</td>
         <td>Name</td>
         <td>Type</td>
         <td>URL</td>
         <td>R_ID</td>
         <td>OpenDate</td>
         <td>M_name</td>
         <td>phone #</td>
         <td>address</td>
         <td>open</td>
         <td>close</td>
        </tr>';

		foreach($fetch as $array)
		{
		    echo '<tr>
		    		<td>'. $array['restaurantid'].'</td>
		            <td>'. $array['name'].'</td>
		            <td>'. $array['type'].'</td>
		            <td>'. $array['url'].'</td>
		            <td>'. $array['locationid'].'</td>
		    		<td>'. $array['first_open_date'].'</td>
		            <td>'. $array['manager_name'].'</td>
		            <td>'. $array['phonenumber'].'</td>
		            <td>'. $array['address'].'</td>
		            <td>'. $array['open_hour'].'</td>
		            <td>'. $array['close_hour'].'</td>
		          </tr>';
		}
		echo '</table>';

	  	echo "<br />\n";
	} else {
	  echo "NO RECORDS FOUND";
	}


	// %%%%%%%%%%%%%%%%% QUERY B %%%%%%%%%%%%%%%%%

	$testString = "Ballin Burgers";

	$queryB = pg_query($conn, "SELECT * FROM menuItem, restaurant WHERE menuItem.restaurantID = restaurant.restaurantID AND restaurant.name = '$testString'");


	print "<pre>\n";
	print "QUERY B\n\n";

	if ($fetch = pg_fetch_all($queryB)) {

		echo '<table>
        <tr>
         <td>ID</td>
         <td>Name</td>
         <td>Type</td>
         <td>Price</td>
         <td>R_ID</td>
        </tr>';

		foreach($fetch as $array)
		{
		    echo '<tr>
		    		<td>'. $array['itemid'].'</td>
		            <td>'. $array['itemname'].'</td>
		            <td>'. $array['type'].'</td>
		            <td>'. $array['price'].'</td>
		            <td>'. $array['restaurantid'].'</td>
		          </tr>';
		}
		echo '</table>';

	  	echo "<br />\n";
	} else {
	  echo "NO RECORDS FOUND";
	}


	// %%%%%%%%%%%%%%%%% QUERY C %%%%%%%%%%%%%%%%%

	$testString3 = "American";

	$queryC = pg_query($conn, "SELECT name, manager_name, first_open_date FROM restaurant R, location L WHERE R.type = '$testString3' AND R.restaurantID = L.restaurantID");


	print "<pre>\n";
	print "QUERY C\n\n";

	if ($fetch = pg_fetch_all($queryC)) {

		echo '<table>
        <tr>
         <td>R_Name</td>
         <td>M_Name</td>
         <td>Open Date</td>
        </tr>';

		foreach($fetch as $array)
		{
		    echo '<tr>
		    		<td>'. $array['name'].'</td>
		            <td>'. $array['manager_name'].'</td>
		            <td>'. $array['first_open_date'].'</td>
		          </tr>';
		}
		echo '</table>';

	  	echo "<br />\n";
	} else {
	  echo "NO RECORDS FOUND";
	}


	// %%%%%%%%%%%%%%%%% QUERY D %%%%%%%%%%%%%%%%%

	$testString4 = "Sushi Palace";

	$queryD = pg_query($conn, "SELECT R.restaurantID, name, manager_name, open_hour, close_hour, url, price, itemName FROM restaurant R, location L, menuItem M, (SELECT restaurantID, MAX(price) AS maxPrice FROM menuItem GROUP BY restaurantID) maxresults WHERE R.name = '$testString4' AND R.restaurantID = L.restaurantID AND R.restaurantID = maxresults.restaurantID AND M.price = maxresults.maxPrice");


	print "<pre>\n";
	print "QUERY D\n\n";

	if ($fetch = pg_fetch_all($queryD)) {

		echo '<table>
        <tr>
         <td>I_Name</td>
         <td>Price</td>
         <td>M_Name</td>
         <td>Open</td>
         <td>Close</td>
         <td>url</td>

        </tr>';

		foreach($fetch as $array)
		{
		    echo '<tr>
		    		<td>'. $array['itemname'].'</td>
		    		<td>'. $array['price'].'</td>
		            <td>'. $array['manager_name'].'</td>
		            <td>'. $array['open_hour'].'</td>
		            <td>'. $array['close_hour'].'</td>
		            <td>'. $array['url'].'</td>

		          </tr>';
		}
		echo '</table>';

	  	echo "<br />\n";
	} else {
	  echo "NO RECORDS FOUND";
	}




	// %%%%%%%%%%%%%%%%% QUERY E %%%%%%%%%%%%%%%%%


	$queryE = pg_query($conn, "SELECT R.type, Mi.category, AVG(Mi.price) AS avgp FROM menuItem Mi, restaurant R WHERE Mi.restaurantID IN (SELECT r1.restaurantID FROM restaurant r1 WHERE r1.type = R.type) AND Mi.restaurantID = R.restaurantID GROUP BY R.type, Mi.category ORDER BY R.type, Mi.category");


	print "<pre>\n";
	print "QUERY E\n\n";

	if ($fetch = pg_fetch_all($queryE)) {

		echo '<table>
        <tr>
         <td>R_Type</td>
         <td>Category</td>
         <td>AVG Price</td>

        </tr>';

		foreach($fetch as $array)
		{
		    echo '<tr>
		    		<td>'. $array['type'].'</td>
		    		<td>'. $array['category'].'</td>
		            <td>'. $array['avgp'].'</td>

		          </tr>';
		}
		echo '</table>';

	  	echo "<br />\n";
	} else {
	  echo "NO RECORDS FOUND";
	}


	// %%%%%%%%%%%%%%%%% QUERY F %%%%%%%%%%%%%%%%%


	$queryF = pg_query($conn, "SELECT R.name, Rtr.usrName, Rt.price, Rt.food, Rt.mood FROM restaurant R, rating Rt, rater Rtr WHERE Rt.restaurantID = R.restaurantID AND Rt.id = Rtr.id GROUP BY R.name, Rtr.usrName,Rt.price,Rt.food,Rt.mood");


	print "<pre>\n";
	print "QUERY F\n\n";

	if ($fetch = pg_fetch_all($queryF)) {

		echo '<table>
        <tr>
         <td>R_Name</td>
         <td>Rtr_Name</td>
         <td>Price</td>
         <td>Food</td>
         <td>Mood</td>

        </tr>';

		foreach($fetch as $array)
		{
		    echo '<tr>
		    		<td>'. $array['name'].'</td>
		    		<td>'. $array['usrname'].'</td>
		            <td>'. $array['price'].'</td>
		            <td>'. $array['food'].'</td>
		            <td>'. $array['mood'].'</td>

		          </tr>';
		}
		echo '</table>';

	  	echo "<br />\n";
	} else {
	  echo "NO RECORDS FOUND";
	}



	// %%%%%%%%%%%%%%%%% QUERY G %%%%%%%%%%%%%%%%%

	$queryG = pg_query($conn, "SELECT * FROM restaurant LEFT JOIN rating ON restaurant.restaurantID = rating.restaurantID WHERE rating.rating_date NOT LIKE '01-%-15'");

	print "<pre>\n";
	print "QUERY G\n\n";

	if ($fetch = pg_fetch_all($queryG)) {

		echo '<table>
        <tr>
         <td>NAME</td>
         <td>JOIN_DATE</td>
        </tr>';

		foreach($fetch as $array)
		{
		    echo '<tr>
		    		<td>'. $array['name'].'</td>
		    		<td>'. $array['rating_date'].'</td>
		          </tr>';
		}
		echo '</table>';

	  	echo "<br />\n";
	} else {
	  echo "NO RECORDS FOUND";
	}

	// %%%%%%%%%%%%%%%%% QUERY H %%%%%%%%%%%%%%%%%

	$testString5 = 5;

	$queryH = pg_query($conn, "SELECT R.name, L.first_open_date FROM restaurant R, location L WHERE R.restaurantID IN (SELECT Rt.restaurantID FROM rating Rt WHERE Rt.staff < ANY (SELECT Rt.staff FROM rating Rt WHERE Rt.id = '$testString5')) AND R.restaurantID = L.restaurantID");

	print "<pre>\n";
	print "QUERY H\n\n";

	if ($fetch = pg_fetch_all($queryH)) {

		echo '<table>
        <tr>
         <td>R_name</td>
         <td>open_date</td>
        </tr>';

		foreach($fetch as $array)
		{
		    echo '<tr>
		    		<td>'. $array['name'].'</td>
		    		<td>'. $array['first_open_date'].'</td>
		          </tr>';
		}
		echo '</table>';

	  	echo "<br />\n";
	} else {
	  echo "NO RECORDS FOUND";
	}



	// %%%%%%%%%%%%%%%%% QUERY I %%%%%%%%%%%%%%%%%

	$testString6 = "Asian";

	$queryI = pg_query($conn, "SELECT R.name, Rtr.usrName, MAX(Rt.food) AS maxfood FROM restaurant R, Rater Rtr, rating Rt WHERE R.type = '$testString6' AND R.restaurantID = Rt.restaurantID GROUP BY R.name,Rtr.usrName");

	print "<pre>\n";
	print "QUERY I\n\n";

	if ($fetch = pg_fetch_all($queryI)) {

		echo '<table>
        <tr>
         <td>R_name</td>
         <td>usr_name</td>
        </tr>';

		foreach($fetch as $array)
		{
		    echo '<tr>
		    		<td>'. $array['name'].'</td>
		    		<td>'. $array['usrname'].'</td>
		          </tr>';
		}
		echo '</table>';

	  	echo "<br />\n";
	} else {
	  echo "NO RECORDS FOUND";
	}


	// %%%%%%%%%%%%%%%%% QUERY J %%%%%%%%%%%%%%%%%

	$testString62 = "Asian";

	$queryJ = pg_query($conn, "SELECT R.name, R.restaurantID, Rt.price, Rt.food, Rt.mood, Rt.staff FROM restaurant R, rating Rt WHERE R.type = '$testString62' GROUP BY R.restaurantID, R.name, Rt.price, Rt.food, Rt.mood, Rt.staff HAVING (Rt.price + Rt.food + Rt.mood + Rt.staff) > 16");

	print "<pre>\n";
	print "QUERY J\n\n";

	if ($fetch = pg_fetch_all($queryJ)) {

		echo '<table>
        <tr>
         <td>R_name</td>
         <td>R_ID</td>
         <td>Price</td>
         <td>Food</td>
         <td>Mood</td>
         <td>Staff</td>

        </tr>';

		foreach($fetch as $array)
		{
		    echo '<tr>
		    		<td>'. $array['name'].'</td>
		    		<td>'. $array['restaurantid'].'</td>
		    		<td>'. $array['price'].'</td>
		    		<td>'. $array['food'].'</td>
		    		<td>'. $array['mood'].'</td>
		    		<td>'. $array['staff'].'</td>
		          </tr>';
		}
		echo '</table>';

	  	echo "<br />\n";
	} else {
	  echo "NO RECORDS FOUND";
	}



	// %%%%%%%%%%%%%%%%% QUERY K %%%%%%%%%%%%%%%%%


	$queryK = pg_query($conn, "SELECT R.usrName, R.join_date, R.rep, Rt.rating_date, Rst.name FROM rater R, rating Rt, restaurant Rst WHERE R.id IN (SELECT r1.id FROM rater r1 GROUP BY r1.id HAVING (SELECT AVG(Rt.mood + Rt.food) FROM rating Rt WHERE Rt.id = r1.id) >= ALL (SELECT AVG(Rt1.mood + Rt1.food) FROM rating Rt1, rater r2 WHERE Rt1.id = r2.id GROUP BY r2.id)) AND Rt.id = R.id AND Rt.restaurantID = Rst.restaurantID");

	print "<pre>\n";
	print "QUERY K\n\n";

	if ($fetch = pg_fetch_all($queryK)) {

		echo '<table>
        <tr>
         <td>NAME</td>
         <td>JOIN_DATE</td>
         <td>rep</td>
         <td>rating date</td>
         <td>R_name</td>
        </tr>';

		foreach($fetch as $array)
		{
		    echo '<tr>
		    		<td>'. $array['usrname'].'</td>
		    		<td>'. $array['join_date'].'</td>
		    		<td>'. $array['rep'].'</td>
		    		<td>'. $array['rating_date'].'</td>
		    		<td>'. $array['name'].'</td>
		          </tr>';
		}
		echo '</table>';

	  	echo "<br />\n";
	} else {
	  echo "NO RECORDS FOUND";
	}



	


	// %%%%%%%%%%%%%%%%% QUERY L %%%%%%%%%%%%%%%%%

	// $testString12 = "Asian";

	$queryL = pg_query($conn, "SELECT R.usrName, R.rep, Rst.name, R8ng.rating_date FROM rater R, rating R8ng, restaurant Rst WHERE R.id IN (SELECT r1.id FROM rater r1 WHERE (SELECT AVG(mood) FROM rating rt1 WHERE rt1.id = r1.id) >= ALL (SELECT AVG(mood) FROM rating rt1 GROUP BY rt1.id) OR (SELECT AVG(mood) FROM rating rt1 WHERE rt1.id = r1.id) >= ALL (SELECT AVG(mood) FROM rating rt1 GROUP BY rt1.id)) AND R8ng.id = R.id AND R8ng.restaurantID = Rst.restaurantID");

	print "<pre>\n";
	print "QUERY L\n\n";

	if ($fetch = pg_fetch_all($queryL)) {

		echo '<table>
        <tr>
         <td>NAME</td>
         <td>rep</td>
         <td>R_NAME</td>
         <td>R_DATE</td>
        </tr>';

		foreach($fetch as $array)
		{
		    echo '<tr>
		    		<td>'. $array['usrname'].'</td>
		    		<td>'. $array['rep'].'</td>
		    		<td>'. $array['name'].'</td>
		    		<td>'. $array['rating_date'].'</td>
		          </tr>';
		}
		echo '</table>';

	  	echo "<br />\n";
	} else {
	  echo "NO RECORDS FOUND";
	}




	// %%%%%%%%%%%%%%%%% QUERY M %%%%%%%%%%%%%%%%%

	$testString122 = "Shawarma Palooza";

	$queryM = pg_query($conn, "SELECT R.usrName, R.rep, Rt.comments FROM rater R, rating Rt WHERE R.id IN (SELECT r1.id FROM rater r1 WHERE (SELECT COUNT(*) FROM rating Rt WHERE Rt.id = r1.id AND Rt.restaurantID IN (SELECT Rst.restaurantID FROM restaurant Rst WHERE Rst.name = '$testString122')) >= ALL (SELECT COUNT(*) FROM rating rt1 WHERE rt1.restaurantID IN (SELECT Rst.restaurantID FROM restaurant Rst WHERE Rst.name = '$testString122') GROUP BY rt1.id)) AND Rt.id = R.id AND Rt.restaurantID IN (SELECT R.restaurantID FROM restaurant R WHERE R.name = '$testString122')");

	print "<pre>\n";
	print "QUERY M\n\n";

	if ($fetch = pg_fetch_all($queryM)) {

		echo '<table>
        <tr>
         <td>rep</td>
         <td>usrname</td>
         <td>comments</td>
        </tr>';

		foreach($fetch as $array)
		{
		    echo '<tr>
		    		<td>'. $array['rep'].'</td>
		    		<td>'. $array['usrname'].'</td>
		    		<td>'. $array['comments'].'</td>
		    		
		          </tr>';
		}
		echo '</table>';

	  	echo "<br />\n";
	} else {
	  echo "NO RECORDS FOUND";
	}


	// %%%%%%%%%%%%%%%%% QUERY N %%%%%%%%%%%%%%%%%

	$testString122 = "Shawarma Palooza";

	$queryN = pg_query($conn, "SELECT Rtr.usrName, Rtr.email FROM rater Rtr WHERE Rtr.id IN (SELECT R.id FROM rating R WHERE (R.price + R.food + R.mood + R.staff) < ANY (SELECT (R.price + R.food + R.mood + R.staff) FROM rating R WHERE R.id IN (SELECT Rtr.id FROM rater Rtr WHERE Rtr.usrName = 'John')))");

	print "<pre>\n";
	print "QUERY N\n\n";

	if ($fetch = pg_fetch_all($queryN)) {

		echo '<table>
        <tr>
         <td>usrname</td>
         <td>email</td>
        </tr>';

		foreach($fetch as $array)
		{
		    echo '<tr>
		    		
		    		<td>'. $array['usrname'].'</td>
		    		<td>'. $array['email'].'</td>
		    		
		          </tr>';
		}
		echo '</table>';

	  	echo "<br />\n";
	} else {
	  echo "NO RECORDS FOUND";
	}



	// %%%%%%%%%%%%%%%%% QUERY O %%%%%%%%%%%%%%%%%

	$queryO = pg_query($conn, "SELECT Rtr.usrName, Rtr.type, Rtr.email, R.name, Rt.food, Rt.price, Rt.mood, Rt.staff, Rt.comments FROM rater Rtr, rating Rt, restaurant R WHERE Rtr.id IN (SELECT Rtr.id FROM rater Rtr GROUP BY Rtr.id HAVING (SELECT MAX(stddev) FROM (SELECT stddev(Rt.mood + Rt.staff + Rt.food + Rt.price) AS stddev FROM rating Rt WHERE Rt.id = Rtr.id GROUP BY Rt.restaurantID) temp1) >= ALL((SELECT MAX(stddev) FROM (SELECT stddev(Rt1.mood + Rt1.food + Rt1.staff + Rt1.price) FROM rating Rt1 GROUP BY Rt1.id, Rt1.restaurantID) AS stddev))) AND Rt.id = Rtr.id AND Rt.restaurantID = R.restaurantID AND R.restaurantID IN (SELECT r1.restaurantID FROM restaurant r1 GROUP BY r1.restaurantID HAVING (SELECT MAX(stddev) FROM (SELECT stddev(Rt2.mood + Rt2.food + Rt2.price + Rt2.staff) as stddev FROM rating Rt2 WHERE Rt2.restaurantID = r1.restaurantID GROUP BY Rt2.restaurantID,Rt2.id) AS temp1) >= ALL ((SELECT MAX(stddev) FROM (SELECT stddev(Rt3.food + Rt3.mood + Rt3.price + Rt3.staff) FROM rating Rt3 GROUP BY Rt3.id,Rt3.restaurantID) AS temp1)))");

	print "<pre>\n";
	print "QUERY O\n\n";

	if ($fetch = pg_fetch_all($queryO)) {

		echo '<table>
        <tr>
         <td>usrname</td>
         <td>type</td>
         <td>email</td>
         <td>name</td>
         <td>food</td>
         <td>price</td>
         <td>mood</td>
         <td>staff</td>
         <td>comment</td>
        </tr>';

		foreach($fetch as $array)
		{
		    echo '<tr>
		    		
		    		<td>'. $array['usrname'].'</td>
		    		<td>'. $array['type'].'</td>
		    		<td>'. $array['email'].'</td>
		    		<td>'. $array['name'].'</td>
		    		<td>'. $array['food'].'</td>
		    		<td>'. $array['price'].'</td>
		    		<td>'. $array['mood'].'</td>
		    		<td>'. $array['staff'].'</td>
		    		<td>'. $array['comment'].'</td>
		          </tr>';
		}
		echo '</table>';

	  	echo "<br />\n";
	} else {
	  echo "NO RECORDS FOUND";
	}





























?>