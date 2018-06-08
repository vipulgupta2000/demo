
<?php  	
require_once("lib/testlib.php"); 		
require_once("lib/display.php"); 
require_once("lib/update.php");
require_once("lib/utils.php");
require_once("auth.php");
include("lib/modal_lib.php");

$var_action = $_POST['var_action'];

if($var_action == "load"){
	$table_name = $_POST['var_child_tbl_name'];
	$parent_table_name = $_POST['var_parent_table_name'];
	$qry_getarray = "SELECT field_edit, field_show ,mode FROM formrel WHERE parent ='$parent_table_name' and child ='$table_name'";
	$rs_getarray  = mysql_query($qry_getarray);

	if (mysql_num_rows($rs_getarray) > 0) {
		while ($row_getarray = mysql_fetch_array($rs_getarray)) {
			$field_edit_final = explode(',', trim($row_getarray['field_edit']));
			$field_show_final = explode(',', trim($row_getarray['field_show']));
			$mode = trim($row_getarray['mode']);

		}

		if (count($field_edit_final) <= 0 || $field_edit_final[0] == "") {

			$field_edit_final = array();       
		}
		if (count($field_show_final) <= 0 || $field_show_final[0] == "") {

			$field_show_final = array();

		}
		if ($mode > 3 || $mode =="" || $mode == 0 ) {
			$mode = 1;
		}
	} else {
		$field_show_final = array();
		$field_edit_final = array();
		$mode = 1;
	}		     

	addrow_modal($table_name,$field_edit_final,$field_show_final,$mode);

	

}
//----------------------- load page for update --------------------------
else if($var_action == "load_update"){
	
	$table_name = $_POST['var_child_tbl_name'];
	$parent_table_name = $_POST['var_parent_table_name'];
	$recid =$_POST['var_rec_id'];
	$sel = $_POST['var_sel'];
	$qry_getarray = "SELECT field_edit, field_show ,mode FROM formrel WHERE parent ='$parent_table_name' and child ='$table_name'";
	$rs_getarray  = mysql_query($qry_getarray);

	if (mysql_num_rows($rs_getarray) > 0) {
		while ($row_getarray = mysql_fetch_array($rs_getarray)) {
			$field_edit_final = explode(',', trim($row_getarray['field_edit']));
			$field_show_final = explode(',', trim($row_getarray['field_show']));
			$mode = trim($row_getarray['mode']);

		}

		if (count($field_edit_final) <= 0 || $field_edit_final[0] == "") {

			$field_edit_final = array();       
		}
		if (count($field_show_final) <= 0 || $field_show_final[0] == "") {

			$field_show_final = array();

		}
		if ($mode > 3 || $mode =="" || $mode == 0 ) {
			$mode = 1;
		}
	} else {
		$field_show_final = array();
		$field_edit_final = array();
		$mode = 1;
	}
	//echo $field_show_final[1];
	//echo $table_name.":".$field_edit_final[0].":".$field_show_final[0].":".$mode."sel:".$sel;
	//echo $sel;
	echo input_new_modal($table_name, $sel, $field_edit_final, $field_show_final, $mode);

}

if($var_action == "get_array"){
	
	//echo 'in array';
	$table_name = $_POST['var_child_tbl_name'];
	$parent_table_name = $_POST['var_parent_table_name'];
	
	echo get_edit_array($table_name,$parent_table_name);
}
function get_edit_array($table_name,$parent_table_name){
	

	$qry_getarray = "SELECT field_edit FROM formrel WHERE parent ='$parent_table_name' and child ='$table_name'";
	$rs_getarray  = mysql_query($qry_getarray);

	if (mysql_num_rows($rs_getarray) > 0) {
		while ($row_getarray = mysql_fetch_array($rs_getarray)) {

			$field_edit_final = explode(',', trim($row_getarray['field_edit']));

		}

		if (count($field_edit_final) <= 0 || $field_edit_final[0] == "") {

			$field_edit_final = array();       
		}

	} else {

		$field_edit_final = array();
	}		     
	
	return json_encode($field_edit_final);
	//echo json_encode($field_show_modal); 
}


