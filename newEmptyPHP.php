<?php 
if($_SESSION['SESS_perm']=='admin' || $_SESSION['SESS_perm']=='sys_admin'){
?>
<div id="middle_right_top">
<h2>Master</h2>
</div>

<div class="col-md-10">
<?php
$tbl=$_GET['page'];
//$qual_orig=" 1=1";
//$qual=isset($_POST['qual'])?$_POST['qual']:$qual_orig;
//echo $qual;
$field_edit=array('id','monthly_gross','sdate','edate','valid','ptax','lwf','status');
$field_edit_modify = array('pf_accno','doj','emptype','tax_slab_exemption','basic','hra','special_allowance','conveyance','other','child_education','medical_reimbursement','performance_linked_incentives','monthly_gross','sdate','edate','valid','ptax','lwf','dob','father_name','husband_name','dol','bank_acc_name','bank_name','acc_number','ifsc_code','branch_add');
$field_edit1=array('pf_accno','doj','sdate','edate');
//$field_show=array('id','empid','name','monthly_gross','sdate','edate','valid','ptax','lwf','status');
$field_show=array();
//$qual=NULL;
$qual_orig=" 1=1";
$qual=isset($_POST['qual'])?$_POST['qual']:$qual_orig;
echo "Qual:<input type=\"text\" id=\"qual\" name=\"qual\" value=\"$qual\" />";

$sel=isset($_POST['sel'])?$_POST['sel']:NULL;
$act=isset($_POST['act'])?$_POST['act']:NULL;
$back=isset($_POST['back'])?$_POST['back']:'';
echo "sel<input type=\"text\" name=\"sel\" value=\"$sel\" />";
echo "action<input type=\"text\" name=\"act\" value=\"$act\" />";
echo "back<input type=\"text\" name=\"back\" value=\"$back\" />";

    
if ($act=='click' ) {	
	echo input_new($tbl,$sel,$field_edit1,$field_show,3);   
}
elseif (isset($_POST['update'])) {  
     echo display($tbl,$qual,1,$field_show);
}
elseif (isset($_POST['modify'])) {  
 echo input($tbl,$qual,$field_edit_modify,$field_show,1); 
}
elseif(isset($_POST['bk']))
{  }
elseif(isset($_POST['New'])){
addrow1($tbl,$field_edit,$field_show,3);
}
else{
echo display($tbl,$qual,1,$field_show);
}

}
else{echo "<h3><center>Sorry You don't have Admin Access</center></h3>";}
?>
    </div>
