<? 
//header('Content-Type: application/json');
echo "[";
include 'config.php'; 

$today = date("Y-m-d"); 
$sql="SELECT * FROM $tbl_name WHERE enable=1 ";
$response = array();
$events = array();
$result=mysql_query($sql);

while($row=mysql_fetch_array($result)) 
{ 
/*
$id=$row['id'];
$image=$row['image']; 
$title=$row['title'];
$category=$row['category'];	
$location=$row['location']; 
$location_addr=$row['location_addr']; 
$lat=$row['lat'];
$lng=$row['lng'];
$dates=$row['dates']; 
$tickets=$row['tickets']; 
$tickets_link=$row['tickets_link'];
$web=$row['web']; 
$email=$row['email']; 
$phone=$row['phone'];
$description=$row['description'];
$enable=$row['enable'];
*/
	
	$event_img = str_replace('"', '', json_encode($row['image']));
        
        //json single event
        $events[] = '
    	{
    	"id": "'.$row['id'].'",
            "image": "data\/posters\/'.$event_img.'",
            "title": '.json_encode($row['title']).',
            "category": "'.$row['category'].'",
            "description": '.json_encode($row['description']).',
            "dates": ['.$row['dates'].'],
            "tickets": '.json_encode($row['tickets']).',
            "tickets_link": '.json_encode($row['tickets_link']).',
            "location": '.json_encode($row['location']).',
            "location_addr": '.json_encode($row['location_addr']).',
            "lat": "'.$row['lat'].'",
            "lng": "'.$row['lng'].'",
            "web": "'.$row['web'].'",
            "email": "'.$row['email'].'",
            "phone": "'.$row['phone'].'",
            "enable": "'.$row['enable'].'"
    	}
    	';
	
} 
$response['events'] = $events;
$arr = $events;
$copy = $arr;
foreach ($arr as $val) {
    echo $val;
    if (next($copy )) {
        echo ','; // Add comma for all elements instead of last
    }
}

//echo $response['events'] = $events;
//echo json_encode($events,JSON_PRETTY_PRINT);

// close connection
mysql_close();
echo "]";
?>
