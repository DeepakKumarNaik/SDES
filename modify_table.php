<!Doctype html>
<html lang="en"  oncontextmenu="return false;">

<?php

include('connection/connection.php');

?>

<!--HEAD start-->
<head>

<title>Modify Table</title>
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
 if ($attribute_flags[$column]=$fieldinfo->flags &MYSQLI_PRI_KEY_FLAG) { 
        $primary_key = $attribute_name[$column]; 
    }
   $column=$column-1;	
}
//refill
$column=mysqli_num_fields($data);

echo '</br></br><hr>
<center><h2>Add column :</h2></center>
<center><form method="post" action="update_table.php">

Column name : <input type="text" name="column_name" placeholder="Enter attribute name" required="required"/>

Select data type : <select id="data_type" name="data_type">
  <option value="varchar">VARCHAR</option>
    <option value="char">CHAR</option>
  <option value="int">INT</option>
  <option value="float">FLOAT(length=5)</option>
  <option value="date">DATE</option>
    <option value="time">TIME</option>
</select>

Size of data (Leave it blank for DATE/TIME/FLOAT) : <input type="text" name="attribute_size" placeholder="Enter size in byte"/> 
	
Add column after : <select name="after">';
while($column>0){
	if ($attribute_name[$column]==$primary_key) { 
        echo '<option value="'.$attribute_name[$column].'">'.$attribute_name[$column].' (primary key)</option>';
    }
	else{
echo '<option value="'.$attribute_name[$column].'">'.$attribute_name[$column].'</option>';
	}
$column=$column-1;
}
echo '
</select>
</br></br></br>
<input type="submit" value="Create Column" name="create"/>
</form>
<p>Repeating of attribute/column name not allow !</p>
<hr>
</center>
';
/////delete column
//refill
$column=mysqli_num_fields($data);

echo '<center><h2>Delete column :</h2>
<form method="post" action="delete_column.php">
Select column : <select name="column_name">';
while($column>0){
if ($attribute_name[$column]==$primary_key) { 
        echo '<option value="'.$attribute_name[$column].'">'.$attribute_name[$column].' (primary key)</option>';
    }
	else{
echo '<option value="'.$attribute_name[$column].'">'.$attribute_name[$column].'</option>';
	}
$column=$column-1;
}
echo '</select>
<input type="submit" value="delete this selected column" name="delete"/>
<p>If you will delete primary key then complete table with all data will be deleted !</p>
</form>
</center>';

////delete table
echo '</br></br><hr></br>
<center>
<h2><a href="delete_table.php?delete=delete" style="text-decoration:none;color:rgba(255,0,0,1);" ><table style="border:2px solid rgba(255,0,0,1);">
<tr><td>Delete Table</td></tr></table></a></h2>
<p>If you delete table then all data related to this table will be deleted !</p>
</center>
';

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