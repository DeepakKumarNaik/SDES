<!Doctype html>
<html lang="en"  oncontextmenu="return false;">

<?php

include('connection/connection.php');

?>

<!--HEAD start-->
<head>

<title>Update</title>
<!--ICON-->
<link rel="icon" type="image/png" href="image/icon.png">
     
<!--link style sheet-->
<link href="style/style.css" rel="stylesheet"/>
</head>
<!--HEAD end here-->

<body>

<!--header-->
<div id="header">

<h1 id="header_h1"><a href="index.php" id="header_h1_a">Students Data Entry System</a></h1>

<table id="header_table">
<tr id="header_table_tr">

<td id="header_table_tr_td_sql">
<a href="modify_table.php" id="header_table_tr_td_sql_a">Modify Table</a>
</td>

<td id="header_table_tr_td_view">
<a href="view.php" id="header_table_tr_td_view_a">View Data</a>
</td>

</tr>
</table>

</div>

<!--body-->
<div id="body">

<?php

if($connection==true)
	
	{
		
	if(mysqli_select_db($connection,"SDES"))
	{
	
if(mysqli_query($connection,"select * from student")==true)
{
//////////////////////////////////////////////////////////	
 $data=mysqli_query($connection,"select * from student");
$column=mysqli_num_fields($data);


///////////
while($column>0){
	
$fieldinfo=mysqli_fetch_field($data);  
  
$attribute_name[$column]=$fieldinfo->name;
$attribute_type[$column]=$fieldinfo->type;
$attribute_length[$column]=$fieldinfo->length;
   
   $column=$column-1;	
}

if(isset($_POST['primary_key'])){
	
	$primary_key=$_POST['primary_key'];
	$data_name=$_POST['data'];
	$attribute=$_POST['column'];
	$pk_name=$_POST['pk_name'];
	$query="select ".$attribute." from student where ".$primary_key."='".$pk_name."'";
	 $result=mysqli_query($connection,$query);
	
	//refill
	$column=mysqli_num_fields($data);
	$info=mysqli_fetch_field($result);
$attribute_type=$info->type;
$attribute_length=$info->length;

 $sql="update student set ".$attribute."='".$data_name."' where ".$primary_key."='".$pk_name."'";

if(mysqli_query($connection,$sql)){

echo '<center><h2>Successfully Update !</h2></center>';	
	header('refresh:5,url=view.php');
}

else{
echo '<center><h2>Problem with updating !</h2></center>';		
}




	
}

else{
echo '<center><h2>You can not access directly this page !</h2></center>';
	header('refresh:3,url=sdes.php');
	}
/////////

	echo '</br><hr><hr><center><a href="sdes.php" style="text-decoration:none;"><h2>Go to Home</h2></a></center>';
	/////////////////////////////////////////////////////////////////////
}
else{
		echo "<center><h2>Error on connecting to table ! Check connection file and create table !</h2></center>";	
}

}
	
	else{
		
			echo "<center><h2>Error on connecting to database ! Check connection file and create database !</h2></center>";
		
		
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
<center><h2 id="footer_h2">Designed and developed by Deepak</h2></center>
</div>


</body>
<!--BODY end-->
</html>