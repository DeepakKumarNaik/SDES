<!Doctype html>
<html lang="en"  oncontextmenu="return false;">

<?php

include('connection/connection.php');

?>

<!--HEAD start-->
<head>

<title>View Operation</title>
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

if(isset($_GET['primary_key'])){
	
	$primary_key=$_GET['primary_key'];
	$data_name=$_GET['data'];
	$attribute=$_GET['column'];
	$pk_name=$_GET['pk_name'];
	$query="select ".$attribute." from student where ".$primary_key."='".$pk_name."'";
	 $result=mysqli_query($connection,$query);
	
	//refill
	$column=mysqli_num_fields($data);
	$info=mysqli_fetch_field($result);
$attribute_type=$info->type;
$attribute_length=$info->length;

//create selected row 
$qu=mysqli_query($connection,'select * from student where '.$primary_key.'="'.$pk_name.'"');
while($ro=mysqli_fetch_array($qu))
{ echo '</br><hr><table style="text-align:center;width:100%;border: 2px solid rgba(0,0,255,1);">';
echo '<tr>'; //for field name
while($column>0){
		echo '<td style="border:2px solid rgba(0,0,255,1);"><b>';
	echo $attribute_name[$column];
	if($primary_key==$attribute_name[$column]){
	echo ' (primary key) ';
	}
	echo '<b></td>';
	$column=$column-1;}
	echo '</tr>';
	//refill
	$column=mysqli_num_fields($data);
	echo '<tr>';
	while($column>0){
		echo '<td style="border:2px solid rgba(0,0,255,1);">';
	echo $ro[$attribute_name[$column]];
	echo '</td>';
	$column=$column-1;}
echo '</tr></table>';
}
echo '</tr>';
	
if($attribute_type==3/*for int*/||$attribute_type==4/*for float*/)
{ $type="number"; }
else if($attribute_type==253/*for varchar*/||$attribute_type==254/*for char*/)
{ $type="text"; }
else if($attribute_type==10/*for date*/)
{ $type="date"; }
else if($attribute_type==11/*for time*/)
{ $type="time"; }
else{
	$type= "text";
}
if($attribute_type==3/*for int*/)
{ $length=$attribute_length;  }
else if($attribute_type==253/*for varchar*/)
{ $length=$attribute_length; }
else if($attribute_type==4/*for float*/)
{ $length=$virtual_length=5; }
else if($attribute_type==254/*for char*/)
{ $length=$attribute_length;}
else if($attribute_type==10/*for date*/)
{ $length=$attribute_length; } 
else if($attribute_type==11/*for time*/)
{ $length=$attribute_length; }
else{
	$length='';
}


while($row=mysqli_fetch_array($result)){
	
	echo '</br>
	</br>
	</br><hr><center>

	<form method="post" action="update.php">
	'.$attribute.' ';
	if($attribute==$primary_key){
		echo '(primary key) ';
	}
	echo '<input
';
 if($attribute_type==3/*for int*/){
	 
	$length=$attribute_length;
	$len=$n=9;
while($length>1){
$len=$len.''.$n;
$length=$length-1;		
}
echo 'max="'.$len.'"';

$length=$attribute_length;
$len=$n=9;
while($length>1){
$len=$len.''.$n;
$length=$length-1;	
}
echo 'min="'.'-'.$len.'"';
$length=$attribute_length;
} 
if($attribute_type==4/*for float*/
){echo 'step=0.001 ';
$length=$virtual_length;
	$len=$n=9;
while($length>1){
$len=$len.''.$n;
$length=$length-1;		
}
echo ' max="'.$len.'"';

$length=$virtual_length;
$len=$n=9;
while($length>1){
$len=$len.''.$n;
$length=$length-1;	
}
echo ' min="'.'-'.$len.'"';
$length=$virtual_length;

} 
echo '
type="'.$type.'" value="'.$row[$attribute].'" placeholder="max length:'.$length.'" name="data" required="required"/>
<input type="hidden" name="primary_key" value="'.$primary_key.'"/>
<input type="hidden" name="column" value="'.$attribute.'"/>
<input type="hidden" name="pk_name" value="'.$pk_name.'"/>
<input type="submit" value="Update"/>';

if($attribute==$primary_key){
		echo '</br></br>If you want to update primary key then it must be unique, if it is not unique then it will not be update !';
	}

echo '	</form>
	</br><hr>';
	if($attribute==$primary_key){
	echo '<a href="delete.php?data='.$row[$attribute].'&primary_key='.$primary_key.'&column='.$attribute.'&pk_name='.$pk_name.'" 
	style="text-decoration:none;"><h3><table style="border: 2px solid rgba(255,0,0,1);"><tr><td>Delete</td></tr></table></h3></a>';
	}
	
	echo '</br>
	</center>';
	if($attribute==$primary_key){
		echo '<center><p>If you delete primary key, then total row will deleted</p></center>';
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