<!Doctype html>
<html lang="en"  oncontextmenu="return true;">

<?php

include('connection/connection.php');

?>

<!--HEAD start-->
<head>

<title>View</title>
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
$attribute_flags[$column]=$fieldinfo->flags;

 if ($attribute_flags[$column]=$fieldinfo->flags &MYSQLI_PRI_KEY_FLAG) { 
        $primary_key = $attribute_name[$column]; 
    }
  
   $column=$column-1;	
}


echo '<hr><h3 style="text-align:center;color:rgba(0,0,255,1);">Click on data for update operation and click on primary key for delete that row !</h3><hr>';

$query=mysqli_query($connection,'select * from student');

echo '<table style="border:2px solid rgba(0,0,255,1);width:100%;text-align:center;">';

//for th
	$col=mysqli_num_fields($data);
	echo '<th>Sl No.</th>';
	while($col>0){
		$pk='';
		if($attribute_name[$col]==$primary_key)
		{ $pk='(Primary Key)';}
echo '<th>'.$attribute_name[$col].' '.$pk.'</th>';
$col=$col-1;
}
//count rows number
$rows=1;

while($row=mysqli_fetch_array($query)){
echo '<tr>';
	echo '<td>'.$rows.'</td>';
	//refill
$column=mysqli_num_fields($data);
while($column>0){
	//get data at primary_key field name
	if($primary_key==$attribute_name[$column])
	{  $pk_name=$row[$attribute_name[$column]]; }
	$column=$column-1;
}
//refill
$column=mysqli_num_fields($data);
while($column>0){

echo '<td style="border:2px solid rgba(0,0,255,1);">'.'<a href="view_operation.php?
primary_key='.$primary_key.'&data='.$row[$attribute_name[$column]].'&column='.$attribute_name[$column].'&pk_name='.$pk_name.'"
 style="text-decoration:none;color:rgba(0,0,0,1);">'.$row[/*filed name*/$attribute_name[$column]].'</a>'.'</td>';
$column=$column-1;		}	
echo '</tr>';

$rows=$rows+1;
}

echo '</table>';

echo '<hr><h3 style="text-align:center;color:rgba(0,0,255,1);">Click on data for update operation and click on primary key for delete that row !</h3><hr>';

	echo '</br><hr><hr><center><a href="sdes.php" style="text-decoration:none;"><h2>Go to Home</h2></a></center>';
	/////////////////////////////////////////////////////////////////////
	
echo'	
<button onclick="myFunction()" style="color:rgba(0,255,0,1);background-color:rgba(0,0,0,1);
border:2px solid rgba(0,255,0,1);">Print this page</button>

<script>
function myFunction() {
  window.print();
}
</script>';
	
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