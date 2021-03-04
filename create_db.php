<!Doctype html>
<html lang="en"  oncontextmenu="return false;">

<?php

include('connection/connection.php');

?>

<!--HEAD start-->
<head>

<title>Create Database</title>

<!--ICON-->
<link rel="icon" type="image/png" href="image/icon.png">
      
</head>
<!--HEAD end here-->

<body>

<!--header-->
<div id="header">

<h1 style="background-color:rgba(0,0,255,1);text-align:center;">
<a href="index.php" style="text-decoration:none;color:rgba(255,255,255,1);">Students Data Entry System</a></h1>

</div>

<!--body-->
<div id="body">

<?php

if($connection==true)
	
	{
		
	
	if(isset($_POST['db_name'])&&mysqli_select_db($connection,'SDES')!=true)
		
		{
		
			
			if(mysqli_query($connection,'create database SDES'))
			{
			
echo "<center><h2>Database Created Successfully</h2></center>";	

		header('refresh:5;url=index.php');
			}
			
			else { echo ' <center><h2>Error on creating database, check connection and other factors !</h2></center>';
header('refresh:5;url=index.php');
			}
			
		}
		
	else {
		
		header('refresh:1;url=index.php');
		
	}
	
	
	}
	else{
		
		echo "<center><h2>Error on connecting to server ! Check connection file !</h2></center>";
		header('refresh:5;url=index.php');
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