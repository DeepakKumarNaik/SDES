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
     
<!--link style sheet-->
<link href="style/style.css" rel="stylesheet"/>
</head>
<!--HEAD end here-->

<body>

<!--header-->
<div id="header">

<h1 id="header_h1"><a href="index.php"id="header_h1_a">Students Data Entry System</a></h1>

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
$name=mysqli_query($connection,"select column_name from student");


while($column>0){
	
$fieldinfo=mysqli_fetch_field($data);  
  
$attribute_name[$column]=$fieldinfo->name;
   
   $column=$column-1;	
}
//refiled column
$column=mysqli_num_fields($data);
	echo '</br><hr><table style="border:2px solid rgba(0,0,255,1);width:100%;"><tr>';
while($column>0){

	echo '<td style="border:2px solid rgba(0,0,255,1);text-align:center;">'.$attribute_name[$column].'</td>';

	$column=$column-1;
}
	echo '</tr></table>';
	
	
	//create form
echo '
<hr></br><hr></br>
<form method="post" action="sdes_insert.php">

<center><h2>Enter number of rows : </h2>
<input type="number"
 placeholder="Enter number of rows, in where you want to enter data" name="row_number" style="width:50%;" required="required"/> </br>
<hr><input type="submit" value="Go" name="go" style="width:20%;"/>
</center>
</form>
';
	
	
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