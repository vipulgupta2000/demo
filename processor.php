<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'auth.php';
include 'mail_function.php';

//processor(66);
function processor($tbl)
{
$sql="select * from dbrule where tbl='$tbl'";
echo $sql;
$result=  mysql_query($sql);
//operarr=array("="=>"==",">"=>">");
while ($row = mysql_fetch_array($result)) {
       echo "<br/>";
       echo "<br/>";
       echo "'$row[fld]' rule on".$row['runon'];
    echo "<br/>";
    echo "the qual is ".$row['qual'];
  $i=0;  
 //if($tblid=$row['tblid'])
    //if($row['oper']=="=")
       //$vr="$_POST[$row['fld'].$i]==$row['val']";
  //if(operaarr($row['oper'])


  if(strstr($row['val'],"$")){
      $vl=substr($row['val'],1);
      $cmp=$_POST[$vl.$i];}else{ $cmp=$row['val'];}
      
    //if($_POST[$row['fld'].$i]==$cmp)  
      if($row['qual']=='datetype')
      {
      if(processdate($row['oper'],$_POST[$row['fld'].$i],$cmp))     
 {echo "<h5>The '$row[fld]' rule is passed</h5>";
    $to=array('vipulgupta2000@icloud.com','amit.singh@inputzero.com');
$to_name=array("Vipul");
$subject=array("from lappie");
$message=array("<h5>all is well</h5>");
$seconds=20;
 send_mail($to, $to_name, $subject, $message, $seconds);
 
}
      }else{
          if(operate($row['oper'],$_POST[$row['fld'].$i],$cmp))     
 {echo "<h5>The '$row[fld]' rule is passed</h5>";//$_POST['description0']="45";
}
      }

}
}

function operate($oper,$fld,$val)
{
    switch ($oper) {
    case "equal":
        if($fld==$val){ return true;}else{return  false;}
    case "notequal":
        if($fld<>$val){ return true;}else{return  false;}
    case "greaterthan":
        if($fld>$val){ return true;}else{return  false;}
    case "lessthan":
        if($fld<$val){ return true;}else{return  false;}
    default:
        return  false;
}
    

    
}
function processdate($oper,$fld1,$val)
{
    $dt=$fld1;
   
$currdate1=new DateTime();

//echo "date is ".$currdate ->format('d/m/Y H:i:s');       
//echo "valis ".$val;
 
 //$fld1=new DateTime($dt);
 //$dt1 -> modify(+$num." ".$ch);

 $num=strstr($val," ",true);
 $ch=strstr($val," ");
 
//$fld=setmydate($fld1 -> format('d/m/Y');
 $fld=setmydate($dt);
 //$currdate -> modify(+$num.$ch);
//$currdate=getmydate($currdate1 -> format('d/m/Y'));
 //$fld=$currdate; 
    switch ($oper) {
    case "equal":
        if($fld==$currdate){ return true;}else{return  false;}
    case "notequal":
        if($fld<>$currdate){ return true;}else{return  false;}
    case "greaterthan":
        $currdate1 -> modify(-$num.$ch);$currdate=setmydate($currdate1 -> format('m/d/Y'));
        if($currdate>$fld){ return true;}else{return  false;}
    case "lessthan":
        $currdate1 -> modify(+$num.$ch);$currdate=setmydate($currdate1 -> format('m/d/Y'));
        echo "<br/>currdateis".$currdate;echo "<br/>fldis".$fld;
        if($currdate>$fld){ echo "123";return true; }else{;return  false;}
    default:
        return  false;
}
}

function action($actid)
{
    $sql="select * from action where id=$actid";
    
    $result=mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        if($row['type']=="notify"){
           $to=explode(",",$row['mailto']);
            $to=array('vipulgupta2000@icloud.com','amit.singh@inputzero.com');
$to_name=array("Vipul");
$subject=array("from lappie");
$message=array("<h5>all is well</h5>");
$seconds=20;
 send_mail($to, $to_name, $subject, $message, $seconds);
        }
        
    }
}
?>