﻿<!DOCTYPE html>
<html >
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Events On Map - admin</title>
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.5/custom/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	</head>

	<body>
		<header>
			<div class="container">
				<nav>
					<span><img src="../images/logo.png" class="img-respons" alt="EventsOnMap"/></span>
					<span>
						<a href="/map"><i class="fa fa-map-marker"></i> <span>go to site</span></a>
					</span>
					<div class="clr"></div>
				</nav>
			</div>
		</header>
		<div class="h45p"></div>
		<section>
			<div class="">
				
				<? include 'config.php'; ?>
				<? $today = date("Y-m-d") ?>
				<?
				if(isset($_POST['delete'])){
			       $id = $_POST['delete_rec_id'];  
			       $query = "DELETE FROM $tbl_name WHERE id=$id"; 
			       $result = mysql_query($query);
			    }
			    if(isset($_POST['enable'])){
			       $id = $_POST['enable_rec_id'];  
			       $query = "UPDATE $tbl_name SET enable=1 WHERE id=$id"; 
			       $result = mysql_query($query);
			    }
			    if(isset($_POST['disable'])){
			       $id = $_POST['disable_rec_id'];  
			       $query = "UPDATE $tbl_name SET enable=0 WHERE id=$id"; 
			       $result = mysql_query($query);
			    }
			    ?>
			    <div class="container">
					<br/>
						<a href="getevents.php" target="_blank" class="btn bg-green">generate .json</a>
						<span target="_blank" class="btn bg-red show_disable">show disable</span>
						<span target="_blank" class="btn bg-blue show_all">show all</span>
						<span target="_blank" class="btn bg-grey show_out">show out of date</span>
					<br/>
				</div>
				<div class="clr mb10"><br/></div>

				<table class="table">
					<tr>
						<td>image</td>
						<td>start date</td>
						<td>category</td>
						<td>description</td>
						<td>location</td>
						<td></td>
						<td></td>

					</tr>
				    <?
					$sql="SELECT * FROM $tbl_name ";
					$result=mysql_query($sql);

					// Start looping rows in mysql database.
					while($rows=mysql_fetch_array($result)){
					?>
					<tr class="event-list-item <?if ($rows['enable'] == 0) {?>bg-red<?}?> <?if ($rows['startdate'] < $today) {?>bg-grey<?}?>" >
						<td>
							<img src="../data/posters/<? echo $rows['image']; ?>" class="img-respons" style="max-height: 100px;" /></td>
						<td><? echo $rows['startdate']; ?></td>
						<td><? echo $rows['category']; ?></td>
						<td>
							<h2><? echo $rows['title']; ?></h2>
							<? echo $rows['description']; ?>
						</td>
						<td>
							<? echo $rows['location']; ?>
							<div class="clr"></div>
							<a href="https://www.google.com/maps/place/<? echo $rows['lat']; ?>,<? echo $rows['lng']; ?>/" target="_blank">
							<img src="http://maps.googleapis.com/maps/api/staticmap?center=<? echo $rows['lat']; ?>,<? echo $rows['lng']; ?>&zoom=15&scale=false&size=200x200&maptype=roadmap&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0xff0000%7Clabel:1%7C<? echo $rows['lat']; ?>,<? echo $rows['lng']; ?>" class="img-respons" alt="Google Map">
							</a>
							<br/>
							lat:<? echo $rows['lat']; ?> - lng:<? echo $rows['lng']; ?>
						</td>
						<td>
							<b>Tickets cost:</b><? echo $rows['tickets']; ?><br/>	
							<b>website:</b> <? echo $rows['web']; ?><br/>
							<b>e-mail:</b> <? echo $rows['email']; ?><br/>
							<b>phone:</b> <? echo $rows['phone']; ?>
						</td>
						<td>
							<?if ($rows['enable'] == 0) {?>
								<form id="enable" method="post" action="">
									<input type="hidden" name="enable_rec_id" value="<? echo $rows['id']; ?>" />
							        <button type="submit" name="enable" class="btn bg-green mb10 mr10 fl "><i class="fa fa-check"></i> enable</button>
						        </form>
						    <?}?>
						    <?if ($rows['enable'] == 1) {?>
								<form id="disable" method="post" action="">
									<input type="hidden" name="disable_rec_id" value="<? echo $rows['id']; ?>" />
							        <button type="submit" name="disable" class="btn bg-red mb10 mr10 fl "><i class="fa fa-check"></i> disable</button>
						        </form>
						    <?}?>

						    <button type="submit" name="enable" class="btn bg-green mb10 mr10 fl"><i class="fa fa-pencil-square-o"></i> edit</button>
							
							<form id="delete" method="post" action="">
								<input type="hidden" name="delete_rec_id" value="<? echo $rows['id']; ?>" />
						        <button type="submit" name="delete" class="btn bg-red fl"><i class="fa fa-trash"></i> delete</button>
					        </form>
						</td>
					</tr>
					<?
				// close while loop
				}

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
			    echo json_encode($events);

				// close connection
				mysql_close();
				?>
				</table>
				
			</div>
		</section>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDcQ7O6FhwFVRX-C91mc0SqX9s4XcFS9lM"></script>	
		<script>
		$(function(){

			$(".show_all").click(function(){    	
	        	$(".event-list-item").show();
		    });

		    $(".show_disable").click(function(){    	
		        $(".event-list-item").hide();
	        	$(".event-list-item.bg-red").show();
		    });

		    $(".show_out").click(function(){    	
		        $(".event-list-item").hide();
	        	$(".event-list-item.bg-grey").show();
		    });

		    
		});
		</script>		
	</body>
</html> 