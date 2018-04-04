<?php

	function pg_connection_string_from_database_url() {
		extract(parse_url($_ENV["postgres://tjrozlqitsogrw:de6a796df81bdd6d5cd454fc3beb3ed8d4d6147d34217c3830b4fa62e2100b7d@ec2-107-21-126-193.compute-1.amazonaws.com:5432/d86rjlemkr1qc8"]));

		return "user=tjrozlqitsogrw

	 	password=de6a796df81bdd6d5cd454fc3beb3ed8d4d6147d34217c3830b4fa62e2100b7d host=ec2-107-21-126-193.compute-1.amazonaws.com dbname=d86rjlemkr1qc8
		" . substr($path, 1);
	}
	
	$conn = pg_connect(pg_connection_string_from_database_url());

	if (!$conn) {
	  echo "NOT CONNECTED\n";
	  exit;
	} else {
	    echo 'CONNECTED';
	}



	// ############################################################# CREATING TABLES #############################################################

	// $drop = pg_query($conn, "DROP TABLE rater");

	$rater = pg_query($conn, "CREATE TABLE rater(id SERIAL PRIMARY KEY, email VARCHAR(30) NOT NULL, name VARCHAR(15) NOT NULL, join_date CURRENT_DATE			NOT NULL, type VARCHAR(15) NOT NULL, rep INT NOT NULL)");



	$rating = pg_query($conn, "CREATE TABLE rating(id INT FOREIGN KEY REFERENCES rater(id), rating_date CURRENT_DATE PRIMARY KEY, price INT, food VARCHAR(25), 			mood VARCHAR(25), commments VARCHAR(255), restarauntID INT FOREIGN KEY REFERENCES restaraunt(restarauntID))");


	$restaraunt = pg_query($conn, "CREATE TABLE restaraunt(restarauntID INT PRIMARY KEY, name VARCHAR(25) NOT NULL, type VARCHAR(25) NOT NULL,
				url VARCHAR(255) NOT NULL)");


	$location = pg_query($conn, "CREATE TABLE location(locationID SERIAL PRIMARY KEY, first_open_date CURRENT_DATE NOT NULL, manager_name VARCHAR(25) NOT NULL,	phoneNumber VARCHAR(15) NOT NULL, address VARCHAR(255) NOT NULL, open_hour INT NOT NULL, close_hour INT NOT NULL, restarauntID INT FOREIGN KEY REFERENCES restaraunt(restarauntID))");


	$menuItem = pg_query($conn, "CREATE TABLE menuItem(itemID INT PRIMARY KEY NOT NULL, name VARCHAR(25) NOT NULL, type VARCHAR(25) NOT NULL, category VARCHAR(25) NOT NULL, description VARCHAR(255) NOT NULL, price INT NOT NULL, restarauntID INT FOREIGN KEY REFERENCES restaraunt(restarauntID))");


	$ratingItem = pg_query($conn, "CREATE TABLE ratingItem(id INT FOREIGN KEY REFERENCES rater(id), date_stamp CURRENT_DATE NOT NULL, itemID INT FOREIGN KEY REFERENCES menuItem(itemID) NOT NULL, rating INT NOT NULL, comment VARCHAR(255), PRIMARY KEY(id,date_stamp,itemID))");




	// ############################################################# POPULATING TABLES #############################################################




	$rater1 = pg_query($conn, "INSERT INTO rater(email,name,type,rep) VALUES ('cmeek070@uottawa.ca','Calvin','Student',7)");



	
	$result = pg_query($conn, "SELECT id, name FROM Rater");

	print "<pre>\n";

	if ($row = pg_fetch_row($result)) {
	  echo "$row[0] $row[1] $row[2] $row[3] $row[4] $row[5]";

	  echo "<br />\n";
	} else {
	  echo 'No records in food';
	}

	// if (!pg_num_rows($result)) {
	//   print("Connection is working, but database is empty.\n");
	// } else {
	//   print "Tables in your database:\n";
	//   while ($row = pg_fetch_row($result)) { print("- $row[0]\n"); }
	// }


?>