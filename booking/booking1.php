<?php
	session_start();
	$mysql_host='localhost';
		$mysql_user='root';
		$mysql_pass='';
		$mysql_db='event_management';
		if($conn=mysql_connect($mysql_host,$mysql_user,$mysql_pass)&&mysql_select_db($mysql_db))
			$faltu=0;
		else
			die(mysql_error());
		
		if($_SERVER['REQUEST_METHOD']=="POST")
		{
			$name=$_POST['name'];			
			$events=$_POST['events'];
			$people=$_POST['people'];
			$_SESSION['name']= $name;
			$_SESSION['events'] = $events;
				$f="SELECT s.userid, e.eventid, b.userid, b.eventid FROM signup s, event e, booking b";
				if($j=mysql_query($f))
				{
					$k=mysql_fetch_assoc($j);
					$userid=$k['userid'];
					$eventid=$k['eventid'];
						$sh="INSERT INTO booking(userid,eventid,eventname,people) VALUES ($userid,$eventid,'$events',$people)";
						if($pp=mysql_query($sh))
						{	
							header('location:http://localhost/blog/evento/bill1.php');
						}						
					
				}
				else
				{
					echo "not submited";
				}
			
		}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	<title>Booking</title>
</head>

<body>
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<div class="form-header">
							<h1>Make your reservation</h1>
						</div>
						
						
						<form action="booking1.php" method="post">
							<div class="form-group">
								<input class="form-control" type="text" placeholder="Name" name="name">
								<span class="form-label">Name</span>
							</div>
							
							<div class="form-group">
								<select name="events" class="form-control" required >
											<option value="" selected hidden>Event</option>
											<option value="wine">1. Wine Tour Event</option>
											<option value="horse">2. Horse  Ride</option>
											<option value="sante">3. Sunday Soul Sante</option>
											<option value="cycle">4. Cycling Trail</option>
											<option value="sunburn">5. Sunburn Festival</option>
											<option value="trek">6. Antharganage Trek And Cave Exploration</option>
											<option value="movie">7. Movie Screenings</option>
											<option value="pencil">8. Pencil Jam</option>
											<option value="sky">9. Sky Lamp Music Festival</option>
											<option value="bbq">10. BBQ and Movie Meet</option>
											<option value="graffiti">11. Graffiti GamiFYI'd</option>
											<option value="walk">12. British Bangalore Walk</option>
											<option value="chocolate">13. Weekday Chocolate Tour at Jus Trufs</option>
											<option value="arts">14. Hand Painted Leather Lampshades</option>
											<option value="salsa">15. Bangalore Salsa Talkies</option>
								</select>
								<span class="select-arrow"></span>
								<span class="form-label">Events</span>
							</div>
							
							
							<div class="form-group">
								<select name="people" class="form-control" required >
											<option value="" selected hidden>Number of people</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10">10</option>
								</select>
								<span class="select-arrow"></span>
								<span class="form-label">Number of people</span>
							</div>
									
							
							<div class="form-btn">
								<button name="submit" class="submit-btn">Book Now</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script>
		$('.form-control').each(function () {
			floatedLabel($(this));
		});

		$('.form-control').on('input', function () {
			floatedLabel($(this));
		});

		function floatedLabel(input) {
			var $field = input.closest('.form-group');
			if (input.val()) {
				$field.addClass('input-not-empty');
			} else {
				$field.removeClass('input-not-empty');
			}
		}
	</script>
</body>
</html>