<?php
	$host="db7.unlim.com"; // Host name
	$username="h3u111_mapadmin"; // Mysql username
	$password="43204320map"; // Mysql password
	$db_name="h3u111_map"; // Database name
	$tbl_name="events"; // Table name

	// Connect to server and select database.
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_query("SET NAMES utf8");
	mysql_select_db("$db_name")or die("cannot select DB");


if(isset($_POST['submit'])){ // Fetching variables of the form which travels in URL
	$image = $_POST['event_image'];
	$title = $_POST['event-title'];
	$category = $_POST['event-category'];
	$startdate = $_POST['event-startdate'];
	$enddate = $_POST['event-enddate'];
	$tickets = $_POST['event-tickets'];
	$location = $_POST['event-location'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$web = $_POST['event-web'];
	$email = $_POST['event-email'];
	$phone = $_POST['event-phone'];
	$description = $_POST['event-description'];
	$file_upload="true";
	$file_up_size=$_FILES['event_image'][size];
	echo $_FILES[event_image][name];
	if ($_FILES[event_image][size]>250000){$msg=$msg."Your uploaded file size is more than 250KB
	 so please reduce the file size and then upload.<BR>";
	$file_upload="false";}

	if (!($_FILES[event_image][type] =="image/jpeg" OR $_FILES[event_image][type] =="image/jpg" OR $_FILES[event_image][type] =="image/gif" OR $_FILES[event_image][type] =="image/png"))
	{$msg=$msg."Your uploaded file must be of JPG or GIF. Other file types are not allowed<BR>";
	$file_upload="false";}

	$file_name=$_FILES[event_image][name];
	$add="data/posters/$file_name"; // the path with the file name where the file will be stored

	if($file_upload=="true"){

	if(move_uploaded_file ($_FILES[event_image][tmp_name], $add)){
	// do your coding here to give a thanks message or any other thing.
	}else{echo "Failed to upload file Contact Site admin to fix the problem";}

	}else{
	echo $msg;
	}
if($title !=''||$startdate !=''||$enddate !=''||$location !=''||$description !=''){
	//Insert Query of SQL
	$query = mysql_query("insert into events(image, title, category, startdate, enddate, tickets, location, lat, lng, web, email, phone, description) values ('$file_name', '$title', '$category', '$startdate', '$enddate', '$tickets', '$location', '$lat', '$lng', '$web', '$email', '$phone', '$description')");
	echo "<br/><br/><span>Data Inserted successfully...!!</span>";
}
else{
	echo "<p>Insertion Failed <br/> Some Fields are Blank....!!</p>";
	}
}
mysql_close(); // Closing Connection with Server
?>

