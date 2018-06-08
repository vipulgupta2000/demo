<?php
require_once("auth.php");
require_once("lib/utils.php");



$action = $_POST['var_action'];

if ($action == "insert") {

  //----------------------- logic to get field edite array and field show array ------------
  $table_name = $_POST['var_table_name'];
  $parent_table_name = $_POST['var_parent_table_name'];
  $parid = $_POST['var_parid'];
  $field_edit =  $_POST['var_field_edit'];
  $field_value_array  =  $_POST['field_value_str'];

  $sqli = insert($table_name,$field_edit,$field_value_array  );
  if (!mysql_query($sqli)) {
    die . mysql_error();    
  } else {
   
    $qry_srcid="SELECT id FROM formrel WHERE parent='$parent_table_name'and child='$table_name' limit 1";          
    $rs_srcid=mysql_query($qry_srcid);   
    
    while($rows = mysql_fetch_array($rs_srcid))
    {
      $recid=$rows[0];                
    }
              //------------- get childRecid---------------
    $qry_childRecid="select max(id) as id from ".$table_name;
    $rs_childRecid=mysql_query($qry_childRecid);
    while($rows1 = mysql_fetch_array($rs_childRecid))
    {
      $chlid=$rows1[0];               
    }          
              //----------- insert rec in reldata--------
    $qry_insReldata="INSERT INTO reldata(relid, parentrecid, childrecid) VALUES ('$recid','$parid','$chlid')";
    $rs_insReldata=mysql_query($qry_insReldata);
    if($rs_insReldata)
    {
                  //echo 'Data Saved';
    }     
    
  }
}
else if($action =="update"){


  $table_name = $_POST['var_child_tbl_name'];
  $parent_table_name = $_POST['var_parent_table_name'];
  $ch_id = $_POST['var_childid'];
  $field_edit =  $_POST['var_field_edit'];
  $field_value_array  =  $_POST['field_value_str'];
 // echo "in update";
  update($table_name,$field_edit,$field_value_array,$ch_id );




}


//-----------------------function for inset record --------------------

function insert($tbl,$field_edit,$field_value_array  ) {
    //echo 'in insert function table:'.$tbl;
  $sql1 = dbsql($tbl);
    //echo $sql1; // ---------------------- comment by dip------------
  $result1 = mysql_query($sql1);

  $fname = "";
  $fval = "";
  $i = 0;
  while ($row = mysql_fetch_array($result1)) {
    	//echo  $row['2']."<br/>";


    if (!$row['dbindex'] == 'primary') {
     $field_name ="";
     $field_name = $row['2'];
				//echo $field_name;
        	// --------------------- logic to get field value -----------
     $k = array_search($field_name ,array_values($field_edit));
     $char = $field_value_array[$k];
     $values =explode("@", $char);
     $fname = $fname . $row['name'] . ",";
     if ($row['type'] == 'idate'){
                //$fval = $fval . "" . setmydate($_POST[$row['name'] . $i]) . ",";
      $fval = $fval . "" . setmydate( $values[1]) . ",";
    }
    elseif ($row['type'] == 'password'){
      $fval = $fval . "'" . sha1( $values[1]) . "',";
    }
    else {
      $fval = $fval . "'" . $values[1]  . "',";
      
    }


  }
}
$fname = chop($fname, ",");
$fval = chop($fval, ",");
$sqli = "INSERT INTO " . $tbl . " ( " . $fname . " ) VALUES (" . $fval . ")";
     //echo 'insert call after addrow Q:'.$sqli;//---------------------- dip Echo
return $sqli;
}

//------------------------ lib function for update---------------
function update($tbl,$field_edit,$field_value_array,$id ) {
  $sqlu = dbsql($tbl);
  //echo  $sqlu ;
  $fname = "";
  $fval = "";
  $i = 0;

  $cnt = 1;

  $field_list = $field_edit;
  

  while ($i < $cnt) {

    $result1 = mysql_query($sqlu);
    $valcnt =0;
    while ($row = mysql_fetch_array($result1)) {

      

      if ( in_array($row['name'], $field_edit)) {


  // --------------------- logic to get field value -----------
       $k = array_search($row['name'],array_values($field_edit));
       

       
       
       if($k >= 0 ){

         
         $char = $field_value_array[$k];
         $values =explode("@", $char);
         //echo "this is index".$values[1];

         
         $fname = $fname . $row['name'] . "=";

         if ($row['type'] == "idate") {
          $fname = $fname . "'" . setmydate($values[1]) . "',";
        } 
        elseif ($row['type'] == 'password') {
          $fname = $fname . "'" . sha1($values[1]) . "',";
        } 
        else {
          $fname = $fname . "'" . mysql_real_escape_string($values[1]) . "',";
        }
        
      }
      
    }
  }

  $fname = chop($fname, ",");
  $fval = chop($fval, ",");
  $sqli = "UPDATE " . $tbl . " set " . $fname . " Where id='" .trim($id)."'" ;

  $fname = "";
  $fval = "";
  if (isset($sqli) && !mysql_query($sqli)) {
    die . mysql_error();
  }

  $i++;
}
}


function dbsql($tbl) {
  $sql = "select tblid from config where name='$tbl'";
  $result = mysql_query($sql);
  $myvar = mysql_result($result, 0);
  $sql1 = "select * from field where tblid=$myvar";
  return $sql1;
}



?>