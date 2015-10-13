<?php

	include 'config.php';
	$sql="select * from $tbl_name where enable=1"; 

	$response = array();
	$events = array();
	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result)) 
	
	{ 
	$id=$row['id'];
	$image=$row['image']; 
	$title=$row['title'];
	$category=$row['category'];
	$description=$row['description'];
	$startdate=$row['startdate']; 
	$enddate=$row['enddate']; 
	$tickets=$row['tickets']; 
	$buy_tick=$row['buy_tick'];
	$location=$row['location']; 
	$lat=$row['lat'];
	$lng=$row['lng'];
	$web=$row['web']; 
	$email=$row['email']; 
	$phone=$row['phone'];
	$enable=$row['enable'];
	
		$events[] = array('id'=>$id,'image'=>'data/posters/'.$image,'title'=>$title,'category'=>$category,'description'=>$description,'startdate'=>$startdate,'enddate'=>$enddate,'tickets'=>$tickets,'buy_tick'=>$buy_tick,'location'=>$location,'lat'=>$lat,'lng'=>$lng,'web'=>$web,'email'=>$email,'phone'=>$phone,'enable'=>$enable);
		
	} 
	
	$response['events'] = $events;
	
	$fp = fopen('../data/events.json', 'w');
	fwrite($fp, json_encode($events,JSON_PRETTY_PRINT));
	fclose($fp);
	mysql_close();
?>