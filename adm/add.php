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

  // collect post data
  $title = addslashes ($_POST['title']);
  $category = $_POST['category'];
  $location = addslashes ($_POST['elocation']);
  $locationaddr = $_POST['locationaddr'];
  $lat = $_POST['lat'];
  $lng = $_POST['lng'];
  $dates = $_POST['dates'];
  $tickets = $_POST['tickets'];
  $web = addslashes ($_POST['web']);
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $description = addslashes ($_POST['description']);
  $description = preg_replace("/\r\n|\r/", "<br />", $description);
  $description = trim($description);

  $tempImgName = explode(".", $_FILES["file"]["name"]);
  $newImgName = round(microtime(true)) . '.' . end($tempImgName);
  $destination = '../data/posters/'.$newImgName;
  move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
  $image = $newImgName;

// store to database
$query = mysql_query("INSERT INTO events(image, title, category, location, location_addr, lat, lng, dates, tickets,  web, email, phone, description) VALUES ('$image', '$title', '$category', '$location', '$locationaddr', '$lat', '$lng', '$dates', '$tickets', '$web', '$email', '$phone', '$description')");

mysql_close(); // Closing Connection with Server



?>