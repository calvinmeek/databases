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




	$restaraunt = pg_query($conn, "CREATE TABLE IF NOT EXISTS restaraunt(restarauntID SERIAL PRIMARY KEY, name VARCHAR(25) NOT NULL, type VARCHAR(25) NOT NULL, url VARCHAR(255) NOT NULL)");



	$rating = pg_query($conn, "CREATE TABLE IF NOT EXISTS rating(id INT REFERENCES rater(id), rating_date DATE PRIMARY KEY, price INT, food VARCHAR(25), 			mood VARCHAR(25), commments VARCHAR(255), restarauntID INT REFERENCES restaraunt(restarauntID))");



	$location = pg_query($conn, "CREATE TABLE IF NOT EXISTS location(locationID SERIAL PRIMARY KEY, first_open_date DATE NOT NULL, manager_name VARCHAR(25) NOT NULL,	phoneNumber VARCHAR(15) NOT NULL, address VARCHAR(255) NOT NULL, open_hour INT NOT NULL, close_hour INT NOT NULL, restarauntID INT REFERENCES restaraunt(restarauntID))");



	$menuItem = pg_query($conn, "CREATE TABLE IF NOT EXISTS menuItem(itemID INT PRIMARY KEY NOT NULL, name VARCHAR(25) NOT NULL, type VARCHAR(25) NOT NULL, category VARCHAR(25) NOT NULL, description VARCHAR(255) NOT NULL, price INT NOT NULL, restarauntID INT REFERENCES restaraunt(restarauntID))");



	$ratingItem = pg_query($conn, "CREATE TABLE IF NOT EXISTS ratingItem(id INT REFERENCES rater(id), date_stamp VARCHAR(25) NOT NULL, itemID INT REFERENCES menuItem(itemID) NOT NULL, rating INT NOT NULL, comment VARCHAR(255), PRIMARY KEY(id,date_stamp,itemID))");


	if (!$ratingItem && !$menuItem && !$location && !$rating && !$restaraunt && !$rater) {
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
	$rater3 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('sz23@email.ca','Suzan','12-22-06','Online',1)");
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
	

	// $$$$$$$$$$$$$$$$$$$$$$ ADDING RESTRAUNTS $$$$$$$$$$$$$$$$$$$$$$

	$restraunt0 = pg_query($conn, "INSERT INTO restaraunt(name,type,url) VALUES ('Best Food Ever','American','www.bestfood.com')");
	$restraunt1 = pg_query($conn, "INSERT INTO restaraunt(name,type,url) VALUES ('Pizza Lovers','American','www.pizzalovers.com')");
	$restraunt2 = pg_query($conn, "INSERT INTO restaraunt(name,type,url) VALUES ('Sushi Palace','Sushi','www.sushipalace.com')");
	$restraunt3 = pg_query($conn, "INSERT INTO restaraunt(name,type,url) VALUES ('Italian Pasta','Italian','www.ipasta.com')");
	$restraunt4 = pg_query($conn, "INSERT INTO restaraunt(name,type,url) VALUES ('Burger Master','American','www.burgermaster.com')");
	$restraunt5 = pg_query($conn, "INSERT INTO restaraunt(name,type,url) VALUES ('Icecream Delight','Dessert','www.id.com')");
	$restraunt6 = pg_query($conn, "INSERT INTO restaraunt(name,type,url) VALUES ('Taste of Asia','Asian','www.toa.com')");
	$restraunt7 = pg_query($conn, "INSERT INTO restaraunt(name,type,url) VALUES ('Steak House','American','www.steakhouse.com')");
	$restraunt8 = pg_query($conn, "INSERT INTO restaraunt(name,type,url) VALUES ('Shawarma Palooza','Middle Eastern','www.spalooza.com')");
	$restraunt9 = pg_query($conn, "INSERT INTO restaraunt(name,type,url) VALUES ('Eat 'n Play,'American','www.eatnplay.com')");
	$restraunt10 = pg_query($conn, "INSERT INTO restaraunt(name,type,url) VALUES ('Ballin Burgers','American','www.ballinburgers.com')");
	$restraunt11 = pg_query($conn, "INSERT INTO restaraunt(name,type,url) VALUES ('French Cuisine','French','www.fc.com')");










	
	// $result = pg_query($conn, "SELECT * FROM rater");

	// print "<pre>\n";

	// if ($fetch = pg_fetch_all($result)) {

	// 	echo '<table>
 //        <tr>
 //         <td>ID</td>
 //         <td>Email</td>
 //         <td>Name</td>
 //        </tr>';

	// 	foreach($fetch as $array)
	// 	{
	// 	    echo '<tr>
	// 	    		<td>'. $array['id'].'</td>
	// 	            <td>'. $array['email'].'</td>
	// 	            <td>'. $array['name'].'</td>
	// 	          </tr>';
	// 	}
	// 	echo '</table>';

	//   	echo "<br />\n";
	// } else {
	//   echo "NO RECORDS FOUND";
	// }






	$result = pg_query($conn, "SELECT * FROM restaraunt");

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
		    		<td>'. $array['restrauntID'].'</td>
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








































?>