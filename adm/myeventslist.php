<? 

include 'config.php'; 

$today = date("Y-m-d"); 
$my_event_id = mysql_query("SELECT * FROM users WHERE user_id=777 ");
$response = array();
$my_events = array();

while($row=mysql_fetch_array($my_event_id)) 
{ 
    $my_events[] = '
        {
            "user_events": ['.$row['user_events'].']
        }
        ';
}

$response['events'] = $my_events;
$arr = $my_events;
$copy = $arr;
foreach ($arr as $val) {
    echo $val;
    if (next($copy )) {
        echo ','; // Add comma for all elements instead of last
    }
}
mysql_close();

?>
