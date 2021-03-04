<!Doctype html>
<html lang="en"  oncontextmenu="return false;">

<?php

include('connection/connection.php');

?>

<!--HEAD start-->
<head>

<title>SDES</title>
<!--ICON-->
<link rel="icon" type="image/png" href="image/icon.png">
      
</head>
<!--HEAD end here-->

<body>

<!--header-->
<div id="header">

<h1 style="background-color:rgba(0,0,255,1);color:rgba(255,255,255,1);text-align:center;">Students Data Entry System</h1>

</div>

<!--body-->
<div id="body">

<?php

if($connection==true)
	
	{
		
	if(mysqli_select_db($connection,"SDES"))
	{
		
	$con=mysqli_select_db($connection,'SDES');
		echo '<center><h2>Database name is : SDES</h2></center><hr>';
		
		if($con==true&&mysqli_query($connection,'select * from student'))
		{
			echo '<center><h2>Table name is : Student</h2></center><hr>';
		echo '<center><h2>Please Wait..... !</h2></center>';
			header('refresh:3,url=sdes.php');
			
		}
		
		else{
			echo '
			<center><h2>Table not exist, Click on create table to create table ! Default table name is (you can not change it) : Student</h2></center>
	<form method="post" action="create_table.php">
	<hr>
	<hr>
	<center><p>Enter number of columns : </p><input required="required" type="number" name="number"
	 placeholder="Enter number of column"  style="width:20%; background-color:rgba(255,255,255,1);color:rgba(0,0,255,1);"/></center>
	<hr>
	<center><input type="submit" name="table_name" value="Create Table"  
	style="width:20%; background-color:rgba(0,0,0,1);color:rgba(255,255,255,1);"/></center>
	<hr>
	<hr>
	</form>
	';
		}
		
	}
	
	else{
	
	echo '
	
	<center><h2>Database not exist, Click on create database to create database ! Default database name is (you can not change it) : SDES</h2></center>
	<form method="post" action="create_db.php">
	<hr>
	<hr>
	<center><input type="submit" name="db_name" value="Create Database"  style="width:20%; background-color:rgba(0,0,0,1);color:rgba(255,255,255,1);"/></center>
	<hr>
	<hr>
	</form>
	
	';
		
	}
	
	
	
	}
	else{
		
		echo "<center><h2>Error on connecting to server ! Check connection file !</h2></center>";
		
	}


?>




</div>

<!--footer-->
<div id="footer">
</br></br></br></br>
<hr><hr><hr><hr>
</br></br></br>
<center><h2 style="background-color:rgba(0,0,0,1);color:rgba(0,255,0,1);">Designed and developed by Deepak</h2></center>
</div>


</body>
<!--BODY end-->
</html>