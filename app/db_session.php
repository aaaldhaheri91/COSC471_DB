<?php

  class DB_Session {

    function __construct(){
    }

    /**
		 * makes a databse connection
		 * @return Mysqli
		 */
		 function OpenCon(){
			 $dbhost = "localhost";
			 $dbuser = "201709_471_g02";
			 $dbpass = "zNueptTgd6Kokzk1Vtia";
			 $db = "201709_471_g02";

			 $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connection failed: %s\n" . $conn->connect_error);
			 return $conn;
		 }

		 /**
		  * closes database Connection
			* @param $conn the database connection
			*/
		 function CloseCon($conn){
			 $conn->close();
		 }


  }



 ?>
