<?php
/* add event form */

/************ sql
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
	include ('config.php');


  $image = $_FILES['file']['name'];
  // collect post data
  //$image = $_POST['event_image'];
  $title = $_POST['username'];
  /*$category = $_POST['event_category'];
  $location = $_POST['event_location'];
  $location_addr = $_POST['event_location_addr'];
  $lat = $_POST['lat'];
  $lng = $_POST['lng'];
  $dates = $_POST['event_dates'];
  $tickets = $_POST['event_tickets'];
  $web = $_POST['event_web'];
  $email = $_POST['event_email'];
  $phone = $_POST['event_phone'];
  $description = $_POST['event_description'];
  //$description = preg_replace("/\r\n|\r/", "<br />", $_POST["event_description"]);
  $description = trim($description);
  */

  //$destination = '../data/posters/'.$newImgNameame;
  //move_uploaded_file( $_FILES['file']['tmp_name'] , $destination );

  $tempImgName = explode(".", $_FILES["file"]["name"]);
  $newImgName = round(microtime(true)) . '.' . end($tempImgName);
  $destination = '../data/posters/'.$newImgName;
  move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
  $image = $newImgName;

// store to database
$query = mysql_query("INSERT INTO events(image, title, category, location, location_addr, lat, lng, dates, tickets,  web, email, phone, description) VALUES ('$image', '$title', '$category', '$location', '$location_addr', '$lat', '$lng', '$dates', '$tickets', '$web', '$email', '$phone', '$description')");

mysql_close(); // Closing Connection with Server



?>