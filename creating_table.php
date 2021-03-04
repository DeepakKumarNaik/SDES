<!Doctype html>
<html lang="en"  oncontextmenu="return false;">

<?php

include('connection/connection.php');

?>

<!--HEAD start-->
<head>

<title>Creating Table</title>

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
	
if(mysqli_select_db($connection,'SDES'))
{	
	
	if(isset($_POST['create_table'])&&mysqli_query($connection,'select * from student')==false)
		
		{
	// number is no of row	
		$number=$_POST['number'];	
			if($number>0)
			{

echo '<center><h2>Database name is : SDES</h2></center><hr>';			
echo '<center><h2>Table name is : Student</h2></center><hr>';			

$primary_key=$_POST['primary_key'];
	$data='';
$num=$number;
while($number>0)
{
	
$attribute_name[$number]=$_POST['attribute_name'.$number.''];

$data_type[$number]=$_POST['data_type'.$number.''];

$attribute_size[$number]=$_POST['attribute_size'.$number.''];

///////////////////////////////////////////////////////////////////////////////////////////

	
if($attribute_size[$number]==''||$attribute_size[$number]<=0){
//for 1st time to avoid , comma
if($number==$num)
{ 
 $data=$attribute_name[$number].' '.$data_type[$number];
}
else{
 $data=$data.','.$attribute_name[$number].' '.$data_type[$number];
}
	
}	
//////////////////
else{


if($number==$num)
{ 
 $data=$attribute_name[$number].' '.$data_type[$number].'('.$attribute_size[$number].')';
}
else{
	 $data=$data.','.$attribute_name[$number].' '.$data_type[$number].'('.$attribute_size[$number].')';
}
	
}
//////////////////////////////////////////////////////////////////////////////////////////
$number=$number-1;	
}
//loop end here
	

echo '</br>';
$query='create table student('.$data.',primary key('.$attribute_name[$primary_key].'))';
//execute query
if(mysqli_query($connection,$query))
{
echo ' <center><h2>Table is created successfully</h2></center>';	

header('refresh:5;url=index.php');
}

else{
	echo ' <center><h2>Error on creating table, you may entered wrong input (May be attribute name repeated), try again !</br>
	Please check that, you may use white space/blank space between column name, which is not allow !</h2></center>';
	header('refresh:8;url=index.php');
}






			}
			
			else { echo ' <center><h2>You entered invalid number !</h2></center>';
header('refresh:5;url=index.php');
			}
			
		}
		
	else {
		
		header('refresh:1;url=index.php');
		
	}
	
}

else{
	echo "<center><h2>Database not exist !</h2></center>";
header('refresh:3;url=index.php');	
	
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