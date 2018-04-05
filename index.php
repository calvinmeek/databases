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
	  exit;
	} else {
	    echo "CONNECTED\n";
	}



	// ############################################################# CREATING TABLES #############################################################

	// $drop = pg_query($conn, "DROP SCHEMA public CASCADE");

	$rater = pg_query($conn, "CREATE TABLE IF NOT EXISTS rater(id SERIAL PRIMARY KEY, email VARCHAR(30) NOT NULL, name VARCHAR(15) NOT NULL, join_date VARCHAR(30) NOT NULL, type VARCHAR(15) NOT NULL, rep INT NOT NULL)");

	// if (!$rater) {
	//   echo "Creating rater is not working. \n";
	//   exit;
	// }
	// else{
	//   echo "Rater Table exists\n";
	// }



	$restaraunt = pg_query($conn, "CREATE TABLE IF NOT EXISTS restaraunt(restarauntID INT PRIMARY KEY, name VARCHAR(25) NOT NULL, type VARCHAR(25) NOT NULL, url VARCHAR(255) NOT NULL)");

	// if (!$restaraunt) {
	//   echo "Creating restaraunt is not working. \n";
	//   exit;
	// }
	// else{
	//   echo "restaraunt Table exists\n";
	// }



	$rating = pg_query($conn, "CREATE TABLE IF NOT EXISTS rating(id INT REFERENCES rater(id), rating_date DATE PRIMARY KEY, price INT, food VARCHAR(25), 			mood VARCHAR(25), commments VARCHAR(255), restarauntID INT REFERENCES restaraunt(restarauntID))");

	// if (!$rating) {
	//   echo "Creating rating is not working. \n";
	//   exit;
	// }
	// else{
	//   echo "Rating Table exists\n";
	// }


	


	$location = pg_query($conn, "CREATE TABLE IF NOT EXISTS location(locationID SERIAL PRIMARY KEY, first_open_date DATE NOT NULL, manager_name VARCHAR(25) NOT NULL,	phoneNumber VARCHAR(15) NOT NULL, address VARCHAR(255) NOT NULL, open_hour INT NOT NULL, close_hour INT NOT NULL, restarauntID INT REFERENCES restaraunt(restarauntID))");

	// if (!$location) {
	//   echo "Creating location is not working. \n";
	//   exit;
	// }
	// else{
	//   echo "location Table exists\n";
	// }


	$menuItem = pg_query($conn, "CREATE TABLE IF NOT EXISTS menuItem(itemID INT PRIMARY KEY NOT NULL, name VARCHAR(25) NOT NULL, type VARCHAR(25) NOT NULL, category VARCHAR(25) NOT NULL, description VARCHAR(255) NOT NULL, price INT NOT NULL, restarauntID INT REFERENCES restaraunt(restarauntID))");

	// if (!$menuItem) {
	//   echo "Creating menuItem is not working. \n";
	//   exit;
	// }
	// else{
	//   echo "menuItem Table exists\n";
	// }


	$ratingItem = pg_query($conn, "CREATE TABLE IF NOT EXISTS ratingItem(id INT REFERENCES rater(id), date_stamp VARCHAR(25) NOT NULL, itemID INT REFERENCES menuItem(itemID) NOT NULL, rating INT NOT NULL, comment VARCHAR(255), PRIMARY KEY(id,date_stamp,itemID))");

	if (!$ratingItem && !$menuItem && !$location && !$rating && !$restaraunt && !$rater) {
	  echo "TABLE_GENERATION_FAILED\n";
	  exit;
	}
	else{
	  echo "TABLE_ GENERATION_SUCCESSFUL\n";
	}




	// ############################################################# POPULATING TABLES #############################################################



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
	$rater11= pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('noahman@email.ca','Noah','12-22-12','Blog',3)");
	$rater12 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('baseball123@email.ca','Ryan','10-20-30','Critic',4)");
	$rater13 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('gamerguy1@email.ca','David','05-30-12','Critic',4)");
	$rater14 = pg_query($conn, "INSERT INTO rater(email,name,join_date,type,rep) VALUES ('biker1234578@email.ca','Jake','11-12-23','Online',5)");
	



	
	$result = pg_query($conn, "SELECT * FROM rater");

	print "<pre>\n";

	if ($row = pg_fetch_row($result)) {
	  echo "$row[0] $row[1] $row[2] $row[3] $row[4] $row[5]";

	  echo "<br />\n";
	} else {
	  echo "No records in food";
	}

	// if (!pg_num_rows($result)) {
	//   print("Connection is working, but database is empty.\n");
	// } else {
	//   print "Tables in your database:\n";
	//   while ($row = pg_fetch_row($result)) { print("- $row[0]\n"); }
	// }


?>