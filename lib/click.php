<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author vipulgupta
 */
function click($tbl2,$field_edit,$field_show){
    $tbl=$tbl2;
    //for data access
    //$qual_orig=" 1=1 and access REGEXP '[".$_SESSION['SESS_access']."]'";
    //without data access
    $qual_orig=" 1=1 ";
$qual=isset($_POST['qual'])?$_POST['qual']:$qual_orig;
echo "<input type=\"hidden\" id=\"qual\" name=\"qual\" value=\"$qual\" />";
echo $qual.$tbl;
$sel=isset($_POST['sel'])?$_POST['sel']:NULL;
$act=isset($_POST['act'])?$_POST['act']:NULL;
$back=isset($_POST['back'])?$_POST['back']:'';
$uid=isset($_POST['uid'])?$_POST['uid']:0;
echo "<input type=\"hidden\" name=\"sel\" value=\"$sel\" />";
echo "<input type=\"text\" name=\"uid\" value=\"$uid\" />";
    
if ($act=='click' ) {	
 echo input_new($tbl,$sel,$field_edit,$field_show,2); 
        $act="";
       
}
elseif(isset($_POST['new'])){   
addrow1($tbl,$field_edit,$field_show,3);
}
elseif (isset($_POST['updates'])) {  
     echo input_new($tbl,$sel,$field_edit,$field_show,2); 
      // rowaccess($sel,$tbl);
//include("processor.php");
//processor(66);
}
elseif (isset($_POST['update'])) {    
     echo display($tbl,$qual,1,$field_show);
}
elseif(isset($_POST['back']))
{ 
echo "<br /><button class=\"btn btn-danger\" type=\"submit\" name=\"new\" value=\"new\" />New</button>";
echo display_link($tbl,$qual,1,$field_show); 
}elseif (isset($_POST['modify'])) { 
 echo input($tbl,$qual,$field_edit,$field_show,1); 
 echo "22";
}
else{
echo "<br /><button class=\"btn btn-danger\" type=\"submit\" name=\"new\" value=\"new\" />New</button>";
echo display_link($tbl,$qual,1,$field_show);
// echo input($tbl,'severity=1',$field_edit,$field_show,1); 
//addrow($tbl);
echo "<button class=\"btn btn-danger\" onclick=\"myFunction()\">Try it</button>";
}
echo "<input type=\"hidden\" name=\"act\" value=\"$act\"  />";
}