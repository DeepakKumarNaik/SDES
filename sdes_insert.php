<!Doctype html>
<html lang="en"  oncontextmenu="return false;">

<?php

include('connection/connection.php');

?>

<!--HEAD start-->
<head>

<title>SDES Insert</title>
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
//////	
	 if(isset($_POST['go'])&&((($_POST['row_number']>0)==true)&&($_POST['row_number']==0)==false))
	 {
		
	$rows_no=$rows=$row=$_POST['row_number'];	

	echo '</br><hr><form  method="post" action="sdes_inserting.php">
	<table style="width:100%;border:2px solid rgba(255,0,0,1);text-align:center;">';	
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
		while($row>0){ //////////////////
			$ro=$row;
			$r=$rows;
				//refiled column
$column=mysqli_num_fields($data);	

echo'<tr>';
echo '<td>'.($r=$r-($ro-1)).'</td>';
while($column>0){
	
	if($attribute_type[$column]==3/*for int*/||$attribute_type[$column]==4/*for float*/)
{ $type="number"; }
else if($attribute_type[$column]==253/*for varchar*/||$attribute_type[$column]==254/*for char*/)
{ $type="text"; }
else if($attribute_type[$column]==10/*for date*/)
{ $type="date"; }
else if($attribute_type[$column]==11/*for time*/)
{ $type="time"; }
else{
	$type= "text";
}
if($attribute_type[$column]==3/*for int*/)
{ $length=$attribute_length[$column];  }
else if($attribute_type[$column]==253/*for varchar*/)
{ $length=$attribute_length[$column]; }
else if($attribute_type[$column]==4/*for float*/)
{ $length=$virtual_length=5; }
else if($attribute_type[$column]==254/*for char*/)
{ $length=$attribute_length[$column];}
else if($attribute_type[$column]==10/*for date*/)
{ $length=$attribute_length[$column]; } 
else if($attribute_type[$column]==11/*for time*/)
{ $length=$attribute_length[$column]; }
else{
	$length='';
}
////

echo '<td>'.$attribute_name[$column].' : '.'<input maxlength="'.$length.'" ';
 if($attribute_type[$column]==3/*for int*/){
	 
	$length=$attribute_length[$column];
	$len=$n=9;
while($length>1){
$len=$len.''.$n;
$length=$length-1;		
}
echo 'max="'.$len.'"';

$length=$attribute_length[$column];
$len=$n=9;
while($length>1){
$len=$len.''.$n;
$length=$length-1;	
}
echo 'min="'.'-'.$len.'"';
$length=$attribute_length[$column];
} 
if($attribute_type[$column]==4/*for float*/
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
 echo 'type="'.$type.'" name="'.$attribute_name[$column].$row.$column.'" 
placeholder="(max:'.$length.')'.' : row no '.$r.'" required="required"/></td>';
////
$column=$column-1;
}	

		echo '</tr>';
			$row=$row-1;
		}  //////////////
		
		echo '<tr><td><input type="hidden" value="'.$rows_no.'" name="row"/> </td></tr>'; //transfer row no to other page
		echo '</table>';
		echo '</br><hr><center><input type="submit" name="insert" value="Insert" style="width:80%"/></center>
	</form>';	
}
////
   else{
	   echo '</br></br><center><h2>You entered wrong input !</h2></center>';
	   header('refresh:2,url=sdes.php');
	   
   }
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