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

	$rater = pg_query($conn, "CREATE TABLE IF NOT EXISTS rater(id SERIAL PRIMARY KEY, email VARCHAR(30) NOT NULL, name VARCHAR(15) NOT NULL, join_date VARCHAR(30) NOT NULL, type VARCHAR(15) NOT NULL, rep INT NOT NULL)");




	$restaurant = pg_query($conn, "CREATE TABLE IF NOT EXISTS restaurant(restaurantID SERIAL PRIMARY KEY, name VARCHAR(25) NOT NULL, type VARCHAR(25) NOT NULL, url VARCHAR(255) NOT NULL)");



	$rating = pg_query($conn, "CREATE TABLE IF NOT EXISTS rating(id INT REFERENCES rater(id), rating_date VARCHAR(10), price INT, food INT, 			mood INT, staff INT, commments VARCHAR(255), restaurantID INT REFERENCES restaurant(restaurantID), PRIMARY KEY(id,rating_date))");



	$location = pg_query($conn, "CREATE TABLE IF NOT EXISTS location(locationID SERIAL PRIMARY KEY, first_open_date VARCHAR(25) NOT NULL, manager_name VARCHAR(25) NOT NULL,	phoneNumber VARCHAR(15) NOT NULL, address VARCHAR(255) NOT NULL, open_hour INT NOT NULL, close_hour INT NOT NULL, restaurantID INT REFERENCES restaurant(restaurantID))");



	$menuItem = pg_query($conn, "CREATE TABLE IF NOT EXISTS menuItem(itemID SERIAL PRIMARY KEY, name VARCHAR(25) NOT NULL, type VARCHAR(25) NOT NULL, category VARCHAR(25) NOT NULL, description VARCHAR(255), price INT NOT NULL, restaurantID INT REFERENCES restaurant(restaurantID))");



	$ratingItem = pg_query($conn, "CREATE TABLE IF NOT EXISTS ratingItem(id INT REFERENCES rater(id), date_stamp VARCHAR(25) NOT NULL, itemID INT REFERENCES menuItem(itemID) NOT NULL, rating INT NOT NULL, comment VARCHAR(255), PRIMARY KEY(id,date_stamp,itemID))");


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


	// $$$$$$$$$$$$$$$$$$$$$$ ADDING RATERS $$$$$$$$$$$$$$$$$$$$$$

	$rater0 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('cmeek070@email.ca','Calvin','05-06-99','Blog',5)");
	$rater1 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('aabbb@email.ca','Alvin','05-07-17','Online',3)");
	$rater2 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('rr234@email.ca','Rick','01-26-34','Critic',3)");
	$rater3 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('sz23@email.ca','John','12-22-06','Online',1)");
	$rater4 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('jiimm01@email.ca','Jim','01-02-01','Critic',3)");
	$rater5 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('mortyiscool@email.ca','Morty','05-26-19','Critic',2)");
	$rater6 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('sk234@email.ca','Shrek','02-16-39','Online',4)");
	$rater7 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('rog123@email.ca','Roger','10-16-12','Blog',3)");
	$rater8 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('m1234566@email.ca','Mike','11-17-99','Blog',1)");
	$rater9 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('kyle123@email.ca','Kyle','09-21-96','Blog',1)");
	$rater10 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('oaddddddd@email.ca','Owen','08-12-95','Online',4)");
	$rater11 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('noahman@email.ca','Noah','12-22-12','Blog',3)");
	$rater12 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('baseball123@email.ca','Ryan','10-20-30','Critic',4)");
	$rater13 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('gamerguy1@email.ca','David','05-30-12','Critic',4)");
	$rater14 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('biker1234578@email.ca','Jake','11-12-23','Online',5)");


				// %%%%%%%%%%%%%%%%% PRINT RATER TABLE %%%%%%%%%%%%%%%%%

				$result = pg_query($conn, "SELECT * FROM rater");

				print "<pre>\n";

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
					            <td>'. $array['name'].'</td>
					          </tr>';
					}
					echo '</table>';

				  	echo "<br />\n";
				} else {
				  echo "NO RECORDS FOUND";
				}
	

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

				


				// %%%%%%%%%%%%%%%%% PRINT RESTAURANT TABLE %%%%%%%%%%%%%%%%%

				$result = pg_query($conn, "SELECT * FROM restaurant");

				print "<pre>\n";

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

	// $$$$$$$$$$$$$$$$$$$$$$ ADDING MENU ITEMS $$$$$$$$$$$$$$$$$$$$$$

	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Cheese Pizza','F','Main','',9.99,1)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Milk Shake','D','Drink','',7.99,1)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Ceaser Salad','F','Starter','',4.99,1)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Cheese Pizza','F','Main','',5.99,2)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Meat Lovers Pizza','F','Main','',5.99,2)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Veggie Pizza','F','Main','',5.99,2)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Pepperoni Pizza','F','Main','',5.99,2)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('BBQ Chicken Pizza','F','Main','',5.99,2)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Hawian Pizza','F','Main','',5.99,2)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Margherita Pizza','F','Main','',5.99,2)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('5pc Sushi','F','Main','',5.99,3)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('10pc Sushi','F','Main','',10.99,3)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('15pc Sushi','F','Main','',15.99,3)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('30pc Sushi','F','Main','',20.99,3)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Pop','D','Drink','',2.99,3)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Water','D','Drink','',0,3)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Spaghetti','F','Main','',12.99,4)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Spring Salad','F','Starter','',3.99,4)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Lasagne','F','Main','',11.99,4)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Chocolate Cake','F','Desert','',5.99,4)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Apple Pie','F','Desert','',4.99,4)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Build a Burger','F','Main','',7.99,5)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Sundae','F','Desert','',2.99,6)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Banana Split','F','Desert','',4.99,6)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Icecream Cone','F','Desert','',1.99,6)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Noodle Bowl','F','Main','',7.99,7)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('8oz Steak','F','Main','',19.99,8)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Shrimp','F','Starter','',7.99,8)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Baked Potato','F','Side','',5.99,8)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Chocolate Fondue','F','Desert','',13.99,8)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Shawarma','F','Main','',7.99,9)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Grilled Cheese','F','Main','',4.99,10)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Kids Pizza','F','Main','',5.99,10)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Build a Burger','F','Main','',8.99,11)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Poutine','F','Main','',7.99,12)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('French Bread','F','Starter','',1.99,12)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('French Pastries','F','Desert','',4.99,12)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Hot Chocolate','D','Drink','',2.99,12)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('French Fries','F','Starter','',2.99,12)");
	$menuItem0 = pg_query($conn, "INSERT INTO menuItem(name,type,category,description,price,restaurantID) VALUES ('Tea','D','Drink','',2.99,12)");




				// %%%%%%%%%%%%%%%%% PRINT MENU ITEM TABLE %%%%%%%%%%%%%%%%%


				$result = pg_query($conn, "SELECT * FROM menuItem");

				print "<pre>\n";

				if ($fetch = pg_fetch_all($result)) {

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
					            <td>'. $array['name'].'</td>
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



	// $$$$$$$$$$$$$$$$$$$$$$ ADDING RATINGS $$$$$$$$$$$$$$$$$$$$$$

	$rating1 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (1,'03-12-18',4,1,5,2,'',1)");
	$rating2 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (1,'01-03-12',1,4,2,2,'',1)");
	$rating3 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (2,'12-05-18',3,5,3,4,'',1)");
	$rating4 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (3,'11-16-18',5,2,5,5,'',1)");
	$rating5 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (11,'10-2-18',5,2,5,1,'',1)");
	$rating6 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (14,'05-2-18',1,3,2,2,'',1)");
	$rating7 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (12,'08-2-18',2,1,1,3,'',1)");

	$rating8 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (13,'09-5-11',3,4,2,4,'',2)");
	$rating9 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (14,'06-6-18',4,2,4,4,'',2)");
	$rating10 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (3,'04-6-18',3,1,4,4,'',2)");
	$rating11 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (5,'03-10-18',2,5,2,4,'',2)");
	$rating12 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (3,'01-11-14',1,2,5,4,'',2)");

	$rating13 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (6,'02-14-15',1,4,3,2,'',3)");
	$rating14 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (7,'03-01-18',3,1,5,2,'',3)");
	$rating15 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (8,'05-13-18',4,3,5,2,'',3)");
	$rating16 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (9,'05-10-48',4,3,4,2,'',3)");
	$rating17 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (10,'05-19-18',4,3,2,2,'',3)");
	$rating18 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (11,'05-12-18',5,1,2,2,'',3)");
	$rating19 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (11,'12-16-12',2,3,5,2,'',3)");

	$rating20 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (12,'12-26-18',1,5,5,3,'',4)");
	$rating21 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (13,'02-12-11',4,3,3,3,'',4)");
	$rating22 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (15,'09-06-18',3,2,2,3,'',4)");
	$rating23 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (4,'02-06-18',3,3,5,3,'',4)");
	$rating1 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (1,'03-11-18',4,1,5,3,'',4)");
	$rating2 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (1,'11-03-12',1,4,2,3,'',4)");
	$rating3 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (1,'10-15-18',3,5,3,3,'',4)");
	$rating4 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (1,'1-6-18',5,2,5,3,'',4)");
	$rating5 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (1,'1-2-18',5,2,5,3,'',4)");

	$rating6 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (7,'12-22-18',1,3,2,5,'',5)");
	$rating7 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (8,'08-22-18',2,1,1,5,'',5)");
	$rating8 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (9,'09-15-11',3,4,2,5,'',5)");
	$rating9 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (1,'06-6-19',4,2,4,5,'',5)");
	$rating10 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (3,'04-6-67',3,1,4,5,'',5)");
	$rating11 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (5,'03-10-98',2,5,2,5,'',5)");
	$rating12 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (3,'01-12-94',1,2,5,5,'',5)");
	$rating13 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (6,'02-13-15',1,4,3,5,'',5)");
	$rating14 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (7,'03-11-18',3,1,5,5,'',5)");

	$rating15 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (8,'05-12-18',4,3,5,4,'',6)");
	$rating16 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (9,'05-13-48',4,3,4,4,'',6)");
	$rating17 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (10,'05-9-18',4,3,2,4,'',6)");
	$rating18 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (11,'05-22-18',5,1,2,4,'',6)");
	$rating19 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (11,'12-1-12',2,3,5,4,'',6)");
	$rating20 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (12,'12-6-18',1,5,5,4,'',6)");

	$rating21 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (13,'02-1-22',4,3,3,2,'',7)");
	$rating22 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (15,'09-6-18',3,2,2,2,'',7)");
	$rating23 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (4,'12-06-18',3,3,5,2,'',7)");
	$rating1 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (1,'03-15-18',4,1,5,2,'',7)");
	$rating2 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (1,'01-12-12',1,4,2,2,'',7)");
	$rating3 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (2,'12-25-18',3,5,3,2,'',7)");
	$rating4 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (3,'10-16-18',5,2,5,2,'',7)");
	$rating5 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (11,'9-2-18',5,2,5,2,'',7)");
	$rating6 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (14,'1-22-18',1,3,2,2,'',7)");
	$rating7 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (12,'08-22-18',2,1,1,2,'',7)");

	$rating8 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (13,'09-15-11',3,4,2,3,'',8)");
	$rating9 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (14,'09-6-18',4,2,4,3,'',8)");
	$rating10 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (3,'02-6-18',3,1,4,3,'',8)");
	$rating11 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (5,'02-10-18',2,5,2,3,'',8)");
	$rating12 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (3,'02-14-14',1,2,5,3,'',8)");
	$rating13 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (6,'01-14-15',1,4,3,3,'',8)");

	$rating14 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (7,'03-05-18',3,1,5,5,'',9)");
	$rating15 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (8,'05-23-18',4,3,5,5,'',9)");
	$rating16 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (9,'05-18-48',4,3,4,5,'',9)");
	$rating17 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (10,'05-18-18',4,3,2,5,'',9)");
	$rating18 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (11,'05-12-15',5,1,2,5,'',9)");
	$rating19 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (11,'12-16-15',2,3,5,5,'',9)");
	$rating20 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (12,'12-26-17',1,5,5,5,'',9)");
	$rating21 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (13,'02-12-99',4,3,3,5,'',9)");
	$rating22 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (15,'09-06-00',3,2,2,5,'',9)");
	$rating23 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (4,'02-30-22',3,3,5,5,'',9)");

	$rating1 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (1,'07-12-18',4,1,5,4,'',10)");
	$rating2 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (1,'11-13-12',1,4,2,4,'',10)");
	$rating3 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (1,'10-5-18',3,5,3,4,'',10)");
	$rating4 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (1,'1-23-18',5,2,5,4,'',10)");
	$rating5 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (1,'1-25-18',5,2,5,4,'',10)");
	$rating6 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (7,'12-12-18',1,3,2,4,'',10)");
	$rating7 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (8,'08-12-18',2,1,1,4,'',10)");
	$rating8 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (9,'09-25-11',3,4,2,4,'',10)");
	$rating9 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (1,'6-14-19',4,2,4,4,'',10)");

	$rating10 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (3,'11-6-67',3,1,4,1,'',11)");
	$rating11 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (5,'11-10-98',2,5,2,1,'',11)");
	$rating12 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (3,'1-12-94',1,2,5,1,'',11)");
	$rating13 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (6,'4-13-15',1,4,3,1,'',11)");
	$rating14 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (7,'7-11-18',3,1,5,1,'',11)");
	$rating15 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (8,'07-12-18',4,3,5,1,'',11)");
	$rating16 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (9,'03-13-48',4,3,4,1,'',11)");

	$rating17 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (10,'08-9-18',4,3,2,3,'',12)");
	$rating18 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (11,'08-22-18',5,1,2,3,'',12)");
	$rating19 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (11,'1-16-12',2,3,5,3,'',12)");
	$rating20 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (12,'1-16-18',1,5,5,3,'',12)");
	$rating21 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (11,'02-21-22',4,3,3,3,'',12)");
	$rating22 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (15,'09-16-18',3,2,2,3,'',12)");
	$rating23 = pg_query($conn, "INSERT INTO rating(id,rating_date,price,food,mood,staff,commments,restaurantID) VALUES (4,'12-6-18',3,3,5,3,'',12)");


				// %%%%%%%%%%%%%%%%% PRINT RATINGS TABLE %%%%%%%%%%%%%%%%%


				$result = pg_query($conn, "SELECT * FROM rating");

				print "<pre>\n";

				if ($fetch = pg_fetch_all($result)) {

					echo '<table>
			        <tr>
			         <td>ID</td>
			         <td>Date</td>
			         <td>Price</td>
			         <td>Food</td>
			         <td>Mood</td>
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
					            <td>'. $array['restaurantid'].'</td>
					          </tr>';
					}
					echo '</table>';

				  	echo "<br />\n";
				} else {
				  echo "NO RECORDS FOUND";
				}





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
		            <td>'. $array['name'].'</td>
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












	$queryK = pg_query($conn, "SELECT name, join_date FROM rater r INNER JOIN (SELECT id, MAX(food) AS Max_Food, MAX(mood) AS Max_Mood FROM rating) rtng ON r.id = rtng.id AND rtng.food = Max_Food AND rtng.mood = Max_Mood");

	print "<pre>\n";

	if ($fetch = pg_fetch_all($queryK)) {

		echo '<table>
        <tr>
         <td>NAME</td>
         <td>JOIN_DATE</td>
        </tr>';

		foreach($fetch as $array)
		{
		    echo '<tr>
		    		<td>'. $array['name'].'</td>
		    		<td>'. $array['join_date'].'</td>
		          </tr>';
		}
		echo '</table>';

	  	echo "<br />\n";
	} else {
	  echo "NO RECORDS FOUND";
	}





	// $queryN = pg_query($conn, "SELECT name, email FROM rater , rating WHERE rater.price + rater.mood + rater.food < )");

	// print "<pre>\n";

	// if ($fetch = pg_fetch_all($queryK)) {

	// 	echo '<table>
 //        <tr>
 //         <td>NAME</td>
 //         <td>JOIN_DATE</td>
 //        </tr>';

	// 	foreach($fetch as $array)
	// 	{
	// 	    echo '<tr>
	// 	    		<td>'. $array['name'].'</td>
	// 	    		<td>'. $array['join_date'].'</td>
	// 	          </tr>';
	// 	}
	// 	echo '</table>';

	//   	echo "<br />\n";
	// } else {
	//   echo "NO RECORDS FOUND";
	// }

	$queryG = pg_query($conn, "SELECT * FROM restaurant LEFT JOIN rating ON restaurant.restaurantID = rating.restaurantID WHERE rating.rating_date NOT LIKE '01-%-15'");

	print "<pre>\n";

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
































?>