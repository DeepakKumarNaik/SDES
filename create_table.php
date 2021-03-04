<!Doctype html>
<html lang="en"  oncontextmenu="return false;">

<?php

include('connection/connection.php');

?>

<!--HEAD start-->
<head>

<title>Create Table</title>

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
	
	if(isset($_POST['table_name']))
		
		{
		// number is no of row
		$number=$_POST['number'];	
			if($number>0)
			{

echo '<center><h2>Database name is : SDES</h2></center><hr>';			
echo '<center><h2>Table name is : Student</h2></center><hr>';			
echo '	<form action="creating_table.php" method="post"> 
<input type="hidden" name="number"  value="'.$number.'"/>
';
while($number>0)
{
	
	echo '
	<center>Attribute/column name : <input type="text" name="attribute_name'.$number.'" placeholder="Enter attribute name" required="required"/>
	
	
	Select data type : <select id="data_type" name="data_type'.$number.'">
  <option value="varchar">VARCHAR</option>
    <option value="char">CHAR</option>
  <option value="int">INT</option>
  <option value="float">FLOAT(length=5)</option>
  <option value="date">DATE</option>
    <option value="time">TIME</option>
</select>


	Size of data (Leave it blank for DATE/TIME/FLOAT) : <input type="text" name="attribute_size'.$number.'" placeholder="Enter size in byte"/> 
	
	
	Make it primary key : <input type="radio" name="primary_key" placeholder="Enter size in byte" value="'.$number.'" required="required"/> 
	</center>
	</br>
	<hr>
	';
	$number=$number-1;
}

echo '
<center><h3><input type="submit" value="Submit" name="create_table" style="width:50%;"/></h3></center>
</form> ';


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