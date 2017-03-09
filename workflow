<div id="middle_right_top">
<h2>Configure Workflow</h2>
</div>

<?php
$tbl=$_GET['page'];
$qual_orig=" 1=1";
$qual=isset($_POST['qual'])?$_POST['qual']." and ".$qual_orig:$qual_orig;
echo "Qual:<input type=\"text\" name=\"qual\" value=\"$qual\" />";
//$tbl='appraisal_master';
$field_edit=array('id','name','status','formname','fieldlist','permission');
$field_show=array();
$qual= " 1=1";
$sel=isset($_POST['sel'])?$_POST['sel']:NULL;
$act=isset($_POST['act'])?$_POST['act']:NULL;
$back=isset($_POST['back'])?$_POST['back']:'';
echo "<input type=\"text\" name=\"sel\" value=\"$sel\" />";
   
if ($act=='click' ) {	
	echo input_new($tbl,$sel,$field_edit,$field_show,2); 
        $act="";
}
elseif(isset($_POST['modify']) || isset($_POST['update']))
{
echo input($tbl,$qual,$field_edit,$field_show);
}else
{
echo display($tbl,$qual,1,$field_show);
addrow($tbl);
}
echo "<input type=\"hidden\" name=\"act\" value=\"$act\"  />";
?>