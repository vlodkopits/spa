<? 
//header('Content-Type: application/json');

include 'config.php'; 

$today = date("Y-m-d"); 
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
$dates=$row['startdate']; 
$tickets=$row['tickets']; 
$tickets_link=$row['tickets_link'];
$web=$row['web']; 
$email=$row['email']; 
$phone=$row['phone'];
$description=$row['description'];
$enable=$row['enable'];
	
	$events[] = array('id'=>$id,'image'=>'data/posters/'.$image,'title'=>$title,'category'=>$category,'description'=>$description,'tickets'=>$tickets,'tickets_link'=>$tickets_link,'location'=>$location, 'location_addr'=>$location_addr,'lat'=>$lat,'lng'=>$lng,'web'=>$web,'email'=>$email,'phone'=>$phone,'enable'=>$enable, 'dates'=>$dates);
} 

$response['events'] = $events;
echo json_encode($events,JSON_PRETTY_PRINT);

// close connection
mysql_close();
?>
