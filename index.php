<?php

	function pg_connection_string_from_database_url() {
		extract(parse_url($_ENV["postgres://tjrozlqitsogrw:de6a796df81bdd6d5cd454fc3beb3ed8d4d6147d34217c3830b4fa62e2100b7d@ec2-107-21-126-193.compute-1.amazonaws.com:5432/d86rjlemkr1qc8"]));

		return "user=tjrozlqitsogrw

	 	password=de6a796df81bdd6d5cd454fc3beb3ed8d4d6147d34217c3830b4fa62e2100b7d host=ec2-107-21-126-193.compute-1.amazonaws.com dbname=d86rjlemkr1qc8
		" . substr($path, 1);
	}
	
	$conn = pg_connect(pg_connection_string_from_database_url());

	if (!$conn) {
	  echo "An error occurred.\n";
	  exit;
	} else {
	    echo 'Connected';
	}

	$sql = "CREATE TABLE rater ( INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY, fname VARCHAR(15) NOT NULL, lname VARCHAR(20) NOT NULL, email VARCHAR(30) NOT NULL, joinDate DATE NOT NULL, type VARCHAR(15) NOT NULL, rep INT(4) NOT NULL)";
	
	$result = pg_query($conn, "SELECT relname FROM pg_stat_user_tables WHERE schemaname='public'");

	print "<pre>\n";

	if (!pg_num_rows($result)) {
	  print("Connection is working, but database is empty.\n");
	} else {
	  print "Tables in your database:\n";
	  while ($row = pg_fetch_row($result)) { print("- $row[0]\n"); }
	}


?>