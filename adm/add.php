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
	include( 'resize.php');
// settings
$max_file_size = 1024*200; // 200kb
$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
// thumbnail sizes
$sizes = array(100 => 100, 150 => 150, 250 => 250);

if (isset($_FILES['image'])) {
	if( $_FILES['image']['size'] < $max_file_size ){
		// get file extension
		$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
		if (in_array($ext, $valid_exts)) {
			/* resize image */
			foreach ($sizes as $w => $h) {
				$files[] = resize($w, $h);
			}

		} else {
			$msg = 'Unsupported file';
		}
	} else{
		$msg = 'Please upload image smaller than 200KB';
	}
}
	

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
$web = $event['event_web'];
$email = $event['event_email'];
$phone = $event['event_phone'];
$description = preg_replace("/\r\n|\r/", "<br />", $event["event_description"]);
$description = trim($description);

// store to database
$query = mysql_query("INSERT INTO events(image, title, category, location, location_addr, lat, lng, dates, tickets,  web, email, phone, description) VALUES ('$image', '$title', '$category', '$location', '$location_addr', '$lat', '$lng', '$dates', '$tickets', '$web', '$email', '$phone', '$description')");

mysql_close(); // Closing Connection with Server



?>