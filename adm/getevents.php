<?php

	include 'config.php';

	//$sql="SELECT * FROM $tbl_name WHERE enable=1 AND startdate>DATE_FORMAT(NOW(),'%m-%d-%Y ') AND enddate>DATE_FORMAT(NOW(),'%m-%d-%Y ')"; 
	$sql="SELECT * FROM $tbl_name WHERE enable=1 "; 

	$response = array();
	$events = array();
	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result)) 
	
	{ 

	$id=$row['id'];
	$image=$row['image']; 
	$title=$row['title'];
	$category=$row['category'];	
	$location=$row['location']; 
	$location_addr=$row['location_addr']; 
	$lat=$row['lat'];
	$lng=$row['lng'];
	$startdate=$row['startdate']; 
	$tickets=$row['tickets']; 
	$tickets_link=$row['tickets_link'];
	$web=$row['web']; 
	$email=$row['email']; 
	$phone=$row['phone'];
	$description=$row['description'];
	$enable=$row['enable'];
	
		$events[] = array('id'=>$id,'image'=>'data/posters/'.$image,'title'=>$title,'category'=>$category,'description'=>$description,'startdate'=>$startdate,'tickets'=>$tickets,'tickets_link'=>$tickets_link,'location'=>$location, 'location_addr'=>$location_addr,'lat'=>$lat,'lng'=>$lng,'web'=>$web,'email'=>$email,'phone'=>$phone,'enable'=>$enable);
		
	} 
	
	$response['events'] = $events;
	
	$fp = fopen('../data/events.json', 'w');
	fwrite($fp, json_encode($events,JSON_PRETTY_PRINT));//nice JSON
	//fwrite($fp, json_encode($events));//small JSON
	fclose($fp);
	mysql_close();
?>