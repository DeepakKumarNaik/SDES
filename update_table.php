<!Doctype html>
<html lang="en"  oncontextmenu="return false;">

<?php

include('connection/connection.php');

?>

<!--HEAD start-->
<head>

<title>Update Table</title>
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

if(isset($_POST['column_name'])){
	
	$attribute_size=$_POST['attribute_size'];
	$column_name=$_POST['column_name'];
	$after=$_POST['after'];
	$data_type=$_POST['data_type'];
	
	
	if($attribute_size<=0||$attribute_size==''){
$query="ALTER TABLE student  ADD ".$column_name." ".$data_type." AFTER ".$after."";
			
if(mysqli_query($connection,$query)){
	//insert data into new field
		//refill
		$data=mysqli_query($connection,"select * from student");
$column=mysqli_num_fields($data);
while($column>0){
	$fieldinfo=mysqli_fetch_field($data);  
  $attribute_name[$column]=$fieldinfo->name;
$attribute_type[$column]=$fieldinfo->type;
$attribute_length[$column]=$fieldinfo->length;
   
 if ($attribute_flags[$column]=$fieldinfo->flags &MYSQLI_PRI_KEY_FLAG) { 
        $primary_key = $attribute_name[$column]; 
    }
	 $column=$column-1;	
}

	if($data_type=='varchar'||$data_type=='char'||$data_type=='int'||$data_type=='float'){
		$virtual_data="'0'";  }
	else if($data_type=='time')
	{ $virtual_data="'00:00:00'"; }
		else if($data_type=='date')
		{ $virtual_data="'1998-10-03'";  }
			else
			{$virtual_data="'0'";}		
	$result=mysqli_query($connection,"select ".$primary_key." from student");
while($row=mysqli_fetch_array($result)){

	$sql="update student set ".$column_name."=".$virtual_data." where ".$primary_key."='".$row[$primary_key]."'";
mysqli_query($connection,$sql);
	
}

echo '<center><h2>Successfully add column !</h2></center>';
	header('refresh:5,url=sdes.php');
	
}
	else{
		echo '<center><h2>Problem with adding column ! Avoid adding column with existing name !</h2></center>';
	}
	}
	////
	
	
	else{
	$query="ALTER TABLE student  ADD ".$column_name." ".$data_type."(".$attribute_size.") NOT NULL  AFTER ".$after."";
		
		if(mysqli_query($connection,$query)){
			
				//insert data into new field
		//refill
		$data=mysqli_query($connection,"select * from student");
$column=mysqli_num_fields($data);
while($column>0){
	$fieldinfo=mysqli_fetch_field($data);  
  $attribute_name[$column]=$fieldinfo->name;
$attribute_type[$column]=$fieldinfo->type;
$attribute_length[$column]=$fieldinfo->length;
   
 if ($attribute_flags[$column]=$fieldinfo->flags &MYSQLI_PRI_KEY_FLAG) { 
        $primary_key = $attribute_name[$column]; 
    }
	 $column=$column-1;	
}

	if($data_type=='varchar'||$data_type=='char'||$data_type=='int'||$data_type=='float'){
		$virtual_data="'0'";  }
	else if($data_type=='time')
	{ $virtual_data="'00:00:00'"; }
		else if($data_type=='date')
		{ $virtual_data="'1998-10-03'";  }
			else
			{$virtual_data="'0'";}		
	$result=mysqli_query($connection,"select ".$primary_key." from student");
while($row=mysqli_fetch_array($result)){

	$sql="update student set ".$column_name."=".$virtual_data." where ".$primary_key."='".$row[$primary_key]."'";
mysqli_query($connection,$sql);
	
}
			
echo '<center><h2>Successfully add column !</h2></center>';
header('refresh:5,url=sdes.php');
}
	else{
		echo '<center><h2>Problem with adding column ! Avoid adding column with existing name !</h2></center>';
	}
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