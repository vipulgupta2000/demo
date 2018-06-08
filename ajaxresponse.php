
<div class="col-md-10">
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$page='payroll';
$tbl='payroll';
require_once("auth.php");
include('lib/display.php');
include('lib/utils.php');
include('lib/update.php');

//$tbl=$_POST['page'];
$qual_orig=" 1=1";
$qual=isset($_POST['qual'])?$_POST['qual']:$qual_orig;
//echo $qual;
$qual='id=1';
$field_show=array();
$field_edit=array();
//$field_edit1=array('id','empid','name');
$field_edit1=array('empid','name','days','month','laptop_allowance','medical_reimbursement','arrear_income','on_call_allowance','status');
//echo display($tbl,$qual,1,$field_show);
//echo input($tbl,"id=2",$field_edit,$field_show,3); 

echo input_new($tbl,$qual,$field_edit1,$field_show,3);  

?>
    <button id="btnsubmit">pushthings</button>
</div>
<script>
    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    
    $("#btnsubmit").click(function() {
        alert('happy');
    }
//$.post( "home.php?page=payroll", {qual: 'id=2',page: 'payroll'},function( data ) {
 
   //$("#getCodeModal").modal("toggle");
     //   $("#getCode").html(data);
  //alert(updated);
});
    </script>