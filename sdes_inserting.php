<!Doctype html>
<html lang="en"  oncontextmenu="return false;">

<?php

include('connection/connection.php');

?>

<!--HEAD start-->
<head>

<title>SDES Inserting</title>
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
//////	
	 if(isset($_POST['insert']))
	 {
		$ro=$row=$_POST['row'];
//create data for insert
	while($row>0){
		//refiled column
$col=$column=mysqli_num_fields($data);
		while($column>0)
		{ 
	
			if($col==$column){
			
				if($attribute_type[$column]==10){ $date = strtotime($_POST[$attribute_name[$column].$row.$column]);
				
				$data_name[$row]= date('Y-m-d',$date); }
					
				else	if($attribute_type[$column]==11){ $time = strtotime($_POST[$attribute_name[$column].$row.$column]);
				
				$data_name[$row]= date('h:i A',$time); }
				
				else if($attribute_type[$column]==253/*for varchar*/||$attribute_type[$column]==254/*for char*/)
{ 
$data_name[$row]="'".$_POST[$attribute_name[$column].$row.$column]."'";
 }
				
				else{ $data_name[$row]=$_POST[$attribute_name[$column].$row.$column]; 
				}
			}////////
else{
	if($attribute_type[$column]==10){  $date = strtotime($_POST[$attribute_name[$column].$row.$column]);
				$data_n[$row]= "'".date('Y-m-d',$date)."'";
				$data_name[$row]=$data_name[$row].','.$data_n[$row];
			
	}
	
	else if($attribute_type[$column]==11){  $time = strtotime($_POST[$attribute_name[$column].$row.$column]);
				$data_n[$row]= "'".date('h:i A',$time)."'";
				$data_name[$row]=$data_name[$row].','.$data_n[$row];
			
	}
	else if($attribute_type[$column]==253/*for varchar*/||$attribute_type[$column]==254/*for char*/)
{ 
$data_name[$row]=$data_name[$row].','."'".$_POST[$attribute_name[$column].$row.$column]."'";
 }
	else{
	$data_name[$row]=$data_name[$row].','.$_POST[$attribute_name[$column].$row.$column];
	}
}			/////
$column=$column-1;		
		}
		
		$row=$row-1;
	}
	//crate field list
		//refiled column
$col=$column=mysqli_num_fields($data);
		while($column>0)
		{
			if($col==$column){
	$column_name=$attribute_name[$column];
			}
			else{
				
					$column_name=$column_name.','.$attribute_name[$column];
			}
$column=$column-1;		
		}
	
//insert into database
$r=$ro;
	while($ro>0){	

if(mysqli_query($connection,'insert into student('.$column_name.') values('.$data_name[$ro].')'))
{
	echo '<center><h4>Successfully inserted row no : '.($r-($ro-1)).'</h4></center>';
}
else{
echo '<center><h2>(May be primary key repeated)Error on inserting row no : '.($r-($ro-1)).'</h2></center>';
}	
	$ro=$ro-1;
	}
	echo '</br><hr><hr><center><a href="sdes.php" style="text-decoration:none;"><h2>Go to Home</h2></a></center>';
}
		
////
   else{
	   echo '</br></br><center><h2>You entered wrong input ! Try again !</h2></center>';
	   header('refresh:2,url=sdes.php');
	   
   }
	
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