<?php
	session_start();
	$name=$_SESSION['name'];
	$mysql_host='localhost';
		$mysql_user='root';
		$mysql_pass='';
		$mysql_db='event_management';
		if($conn=mysql_connect($mysql_host,$mysql_user,$mysql_pass)&& mysql_select_db($mysql_db))
			$faltu=0;
		else
			die(mysql_error());
		
			
			$b="SELECT *
				FROM booking b, event e, signup s
				WHERE s.username='$name' AND e.eventid=b.eventid AND s.userid=b.userid
				ORDER BY b.bookingid
				DESC LIMIT 1";
				
			$c="SELECT s.userid, s.username, e.eventid, e.eventname, e.price, b.userid, b.eventid, b.bookingid, b.people
				FROM booking b, event e, signup s
				WHERE s.username='$name' AND e.eventid=b.eventid
				";
				
			if($j=mysql_query($c))
			{
				$k=mysql_fetch_assoc($j);
				$userid=$k['userid'];
				$username=$k['username'];
				$eventid=$k['eventid'];
				$eventname=$k['eventname'];
				$price=$k['price'];
				$bookingid=$k['bookingid'];
				$people=$k['people'];
				$total=$price*$people;
			}
			else
				echo "query fails";
		
		if($_SERVER['REQUEST_METHOD']=="POST")
		{
			if(isset($_POST['confirm']))
			{
				
				$last="INSERT INTO bill(userid,bookingid,eventid,totalprice) values ($userid,$bookingid,$eventid,$total)";
				if(mysql_query($last))
				{
					header('location:http://localhost/blog/ratings/ratings.php');
				}
			
			}
			else if(isset($_POST['cancel']))
			{
				header('location:http://localhost/blog/ratings/ratings.php');
			}
		
		}

?> 


<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
	body,html{
		height:100%;
		margin:0;
		
		text-align:center;
		align:center;
	}
	.bg{
		background-image:url("assets/img/bg/5.jpg");
		height:100%;
		background-position:center;
		background-repeat:no-repeat;
		background-size:cover;
	}
	
	table,tr,td{
		
		font-size:25px;
		text-align:center;
		align:center;
		
		margin:auto;
		border:1px solid black;
	}
	</style>
	<title> Bill </title>
</head>

<body>

<div class="bg">
	<font size="5">
		<h3 style="color:white" align="center">Your booking is successful!</h3>
	</font>
	<div class="bill">
		
		<table>
			<tr>	
			<td>
			<label style="color:red" align="center">Name:-</label>
			<b style="color:#ffff00"> 
			<?php echo $username;?>
			</b>
			</td>
			</tr>
			
			<br>
			<br>
			
			<tr>	
			<td>
			<label style="color:red" align="center">Event-ID:-</label>
			<b style="color:#ffff00">
			<?php echo $eventid;?>
			</b>
			</tr>	
			</td>
			
			<br>
			<br>
			
			<tr>	
			<td>
			<label style="color:red" align="center">Booking-ID:-</label>
			<b style="color:#ffff00">
			<?php echo $bookingid;?>
			</b>
			</tr>	
			</td>
			
			<br>
			<br>
			
			<tr>	
			<td>
			<label style="color:red" align="center">Event Name:-</label>
			<b style="color:#ffff00">
			<?php echo $eventname;?>
			</b>
			</tr>	
			</td>
			
			<br>
			<br>
			
			<tr>	
			<td>			
			<label style="color:red" align="center">Number Of People:-</label>
			<b style="color:#ffff00">
			<?php echo $people;?>
			</b>
			</tr>	
			</td>
			
			<br>
			<br>
			
			<tr>	
			<td>
			<label style="color:red" align="center">Cost Per Person:-</label>
			<b style="color:#ffff00">
			<?php echo $price;?>
			</b>
			</tr>	
			</td>
			
			<br>
			<br>
			
			<tr>	
			<td>
			<label style="color:red" align="center">TOTAL COST:-</label>
			<p> 
				<b style="color:#ffff00">
				RS. <?php echo $total;?>
				</b> 
			</p>
			</tr>	
			</td>
			
			<br>
			<br>
		</table>
		
		
		<form action="bill1.php" method="post">
		
			<input class="btn"   type="submit" name='confirm' value="confirm">
			<input class="btn"   type="submit" name='cancel'  value="cancel">
		
		
		</form>			
	</div>
</div>

</body>
</html>