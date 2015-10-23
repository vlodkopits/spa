<?php
/* add event form */

/*
event_image
event_title
event_category
event_location
event_location_formatted_address
event_lat
event_lng
event_startdate ????
event_tickets
event_tickets_link ??? admin
event_web
event_email
event_phone
event_description

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
  `startdate` varchar(255) NOT NULL,
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


	echo "<p>I in add.php</p>";

	$image = $_POST['event_image'];
	$title = $_POST['event_title'];
	$category = $_POST['event_category'];
	$location = $_POST['event_location'];
	$location_addr = $_POST['event_location_addr'];
	$lat = $_POST['event_lat'];
	$lng = $_POST['event_lng'];
	$startdate = $_POST['event_startdate'];
	$tickets = $_POST['event_tickets'];
	$tickets_link = $_POST['event_tickets_link']; //event_tickets_link ??? admin
	$web = $_POST['event_web'];
	$email = $_POST['event_email'];
	$phone = $_POST['event_phone'];
	$description = $_POST['event_description'];

	echo $title;

	//$insert_event = "INSERT INTO events('image', 'title', 'category', 'location', 'location_formatted_address', 'lat', 'lng', 'startdate', 'tickets', 'tickets_link', 'web', 'email', 'phone', 'description') VALUES ('$image', '$title', '$category', '$location', '$location_formatted_address', '$lat', '$lng', '$startdate', '$tickets', '$tickets_link', '$web', '$email', '$phone', '$description')";
	//$insert_event = "INSERT INTO events('title') VALUES ('$title')" ;
	$query = mysql_query("INSERT INTO events(image, title, category, location, location_addr, lat, lng, startdate, tickets, tickets_link, web, email, phone, description) VALUES ('$image', '$title', '$category', '$location', '$location_addr', '$lat', '$lng', '$startdate', '$tickets', '$tickets_link', '$web', '$email', '$phone', '$description')");
	echo "<br/><br/><span>Data Inserted successfully...!!</span>";

	//mysql_query($insert_event);
	echo "<p>data insert</p>";
	
	mysql_close(); // Closing Connection with Server


?>