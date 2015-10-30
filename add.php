<?php
/* add event form */

/*

*********** sql
--
-- Структура таблиці `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text,
  `title` text NOT NULL,
  `category` text NOT NULL,
  `location` text NOT NULL,
  `location_addr` text NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `dates` varchar(255) NOT NULL,
  `tickets` varchar(255) DEFAULT NULL,
  `tickets_link` varchar(255) DEFAULT NULL,
  `web` text,
  `email` text,
  `phone` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `enable` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

*/

	$host="db7.unlim.com"; // Host name
	$username="h3u111_mapadmin"; // Mysql username
	$password="43204320map"; // Mysql password
	$db_name="h3u111_map"; // Database name
	//$tbl_name="events"; // Table name

	// Connect to server and select database.
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_query("SET NAMES utf8");
	mysql_select_db("$db_name")or die("cannot select DB");
/*
	// collect post data
	$image = $_POST['event_image'];
	$title = $_POST['event_title'];
	$category = $_POST['event_category'];
	$location = $_POST['event_location'];
	$location_addr = $_POST['event_location_addr'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$dates = $_POST['event_dates'];
	$tickets = $_POST['event_tickets'];
	//$tickets_link = $_POST['event_tickets_link']; //event_tickets_link ??? admin
	$web = $_POST['event_web'];
	$email = $_POST['event_email'];
	$phone = $_POST['event_phone'];
	$description = preg_replace("/\r\n|\r/", "<br />", $_POST["event_description"]);
	$description = trim($description);

	$file_upload="true";
	$file_up_size=$_FILES['event_image'][size];
	echo $_FILES[event_image][name];
	if ($_FILES[event_image][size]>250000){$msg=$msg."Your uploaded file size is more than 250KB
	 so please reduce the file size and then upload.<BR>";
	$file_upload="false";}

	if (!($_FILES[event_image][type] =="image/jpeg" OR $_FILES[event_image][type] =="image/jpg" OR $_FILES[event_image][type] =="image/gif" OR $_FILES[event_image][type] =="image/png"))
	{$msg=$msg."Your uploaded file must be of JPG or GIF. Other file types are not allowed<BR>";
	$file_upload="false";}

	$image=$_FILES[event_image][name];
	$add="data/posters/$image"; // the path with the file name where the file will be stored

	if($file_upload=="true"){

	if(move_uploaded_file ($_FILES[event_image][tmp_name], $add)){
	// do your coding here to give a thanks message or any other thing.
	}else{echo "Failed to upload file Contact Site admin to fix the problem";}

	}else{
	echo $msg;
	}


	// store to database
	$query = mysql_query("INSERT INTO events(image, title, category, location, location_addr, lat, lng, dates, tickets,  web, email, phone, description) VALUES ('$image', '$title', '$category', '$location', '$location_addr', '$lat', '$lng', '$dates', '$tickets', '$web', '$email', '$phone', '$description')");
	
	echo "<br/><br/><span>Data Inserted successfully...!!</span>";
	echo "<p>data insert</p>";

	mysql_close(); // Closing Connection with Server
*/
$event = $_POST;// you will get an array of all the values
print_r ($event);

// collect post data
$image = $event['event_image'];
$title = $event['event_title'];
$category = $event['event_category'];
$location = $event['event_location'];
$location_addr = $event['event_location_addr'];
$lat = $event['lat'];
$lng = $event['lng'];
$dates = $event['event_dates'];
$tickets = $event['event_tickets'];
//$tickets_link = $_POST['event_tickets_link']; //event_tickets_link ??? admin
$web = $event['event_web'];
$email = $event['event_email'];
$phone = $event['event_phone'];
$description = preg_replace("/\r\n|\r/", "<br />", $event["event_description"]);
$description = trim($description);

// store to database
$query = mysql_query("INSERT INTO events(image, title, category, location, location_addr, lat, lng, dates, tickets,  web, email, phone, description) VALUES ('$image', '$title', '$category', '$location', '$location_addr', '$lat', '$lng', '$dates', '$tickets', '$web', '$email', '$phone', '$description')");

mysql_close(); // Closing Connection with Server

?>