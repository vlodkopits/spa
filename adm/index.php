<!DOCTYPE html>
<html >
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Events On Map - admin</title>
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/jquery.datetimepicker.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	</head>

	<body>
		<header>
			<div class="container">
				<nav>
					<span><img src="../images/logo.png" class="img-respons" alt="EventsOnMap"/></span>
					<span>
						<a href=""><i class="fa fa-map-marker"></i> <span>go to site</span></a>
					</span>
					<div class="clr"></div>
				</nav>
			</div>
		</header>

		<section>
			<div class="container">
				
				<? include 'config.php'; ?>

				<div>
					<br/>
						<a href="getevents.php" target="_blank" class="btn bg-green">generate .json</a>
						<a href="" target="_blank" class="btn bg-red">show disable</a>
						<a href="" target="_blank" class="btn bg-grey">show out of date</a>
					<br/>
				</div>
				<div class="clr mb10"></div>

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

				$sql="SELECT * FROM $tbl_name ";
				$result=mysql_query($sql);

				// Start looping rows in mysql database.
				while($rows=mysql_fetch_array($result)){
				?>

				<div class="event-list-item <?if ($rows['enable'] == 0) {?>bg-red<?}?>" >
					<div class="mb10 p10 col-1">
						<div >
							<img src="../data/posters/<? echo $rows['image']; ?>" class="img-respons" style="max-height: 100px;" />
						</div>
						<br />
						<b>Start Date:</b><? echo $rows['startdate']; ?><br />
						<b>End Date:</b><? echo $rows['enddate']; ?><br />
						<b>Events Category:</b> <? echo $rows['categoty']; ?><br />
						<b>Tickets cost:</b><? echo $rows['tickets']; ?>
						<div class="clr mb10"></div>
						
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
					</div>
					
					<div class="mb10 col-2">
						<h2><? echo $rows['title']; ?></h2>
						<div class="clr"></div>
						<br />
						<? echo $rows['description']; ?>
					</div>				
					
					<div class="mb10 col-1">
						<div class="events-add-location  mb10">
							<b>Location:</b>
							<? echo $rows['location']; ?>
						</div>
						<div class="events-add-location-address  mb10">
							<b>Location address:</b>
							<div class="clr"></div>
							<a href="https://www.google.com/maps/place/<? echo $rows['lat']; ?>,<? echo $rows['lng']; ?>/" target="_blank">
							<img src="http://maps.googleapis.com/maps/api/staticmap?center=<? echo $rows['lat']; ?>,<? echo $rows['lng']; ?>&zoom=15&scale=false&size=400x200&maptype=roadmap&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0xff0000%7Clabel:1%7C<? echo $rows['lat']; ?>,<? echo $rows['lng']; ?>" class="img-respons" alt="Google Map">
							</a>
							<br/>
							lat:<? echo $rows['lat']; ?> - lng:<? echo $rows['lng']; ?>
							
						</div>
						<div class="mb10 ">
							<b>website:</b> <? echo $rows['web']; ?> | <b>e-mail:</b> <? echo $rows['email']; ?> | <b>phone:</b> <? echo $rows['phone']; ?>
						</div>
					</div>
					<div class="clr"></div>
				</div>
				<?
				// close while loop
				}

				// close connection
				mysql_close();
				?>
			</div>
		</section>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDcQ7O6FhwFVRX-C91mc0SqX9s4XcFS9lM"></script>			
	</body>
</html> 