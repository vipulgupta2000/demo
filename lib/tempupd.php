<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function get_template($tbl){
             $templat=$tbl;
$sql_templ="Select content from templates where tname='$templat'";
$result_templ=mysql_query($sql_templ);
$a='';
while($row=mysql_fetch_array($result_templ))
{        $a=$row['content'];
} 
return $a;
}


function tempupd($tbl,$qual,$arr,$arr_show,$mode)
{
        include "tags.php";
	 $col_wid=0;$col_space=0; 
         if($mode==2)
	{$col_wid=4;$col_space=2;}
	if($mode==3)
	{$col_wid=3;$col_space=1;}
	$span=($col_wid*$mode)+(($mode-1)*$col_space);
        $tg_top="<div class=\"table-responsive\"><table class=\"table table-striped\" id=\"".$tbl."\" width=auto border=1 cellpadding=2 cellspacing=2>";
	$tg_span="<div class=\"col-md-$span\">";
	$tg_colspace="<div class=\"col-md-$col_space\"></div>";
	$tg_col="<div class=\"col-md-$col_wid\">";
        
	$sql1=dbsql($tbl);
	
        
	
	$result1=mysql_query($sql1);
	$data_sql="select * from ".$tbl;
	if(isset($qual))
		{
		$qual=" where ".$qual;
		$data_sql=$data_sql.$qual;
	}

	$a="";
	$opt=array(1 => "k");

	$j=0;

	//Print Header column

	$cnt=0;
        
$a=get_template($tbl);
$s='';

		while($row = mysql_fetch_array($result1))
		{

	//Print data columns
		$result_data=mysql_query($data_sql);
		$j=1;
		while($datarow=mysql_fetch_array($result_data))
		{
		if(empty($arr_show) || in_array($row['name'],$arr_show))
		{	
		if($row['dbindex']=='primary')
		{
		$s=$tg_ip.$tg_ip_type.$tg_hidden.$tg_ip_class.$tg_ip_name.$row['name'].$cnt.$tg_ip_size.$row['size'].$tg_ip_value;
						$s=$s.$datarow[$row['name']]."\" hidden readonly \"".$tg_ip_cl;

                $x=$datarow[$row['name']];
		}elseif($row['type']=="textarea")
					{
						$x=$tg_text.$tg_ip_name.$row['name'].$cnt.$tg_ip_cl;
						$x=$x.$datarow[$row['name']].$tg_text_cl;
					} 
                elseif($row['type']=="ihtml")
                {
                        $x=$tg_text.$tg_ip_name.$row['name'].$cnt.$tg_ip_cl;
                        $x=$x.$datarow[$row['name']].$tg_text_cl;
                } 
		elseif($row['type']=="option")
					{					$x=$tg_sel.$row['name'].$cnt.$tg_ip_name.$row['name'].$cnt.$tg_cl;
										//$a=$a.$tg_opt.$datarow[$row['name']].$tg_cl.$datarow[$row['name']].$tg_opt_cl;
										//if($cnt==0)
										//{
											$sql_opt="select * from field_option where tblid=".$row['tblid']." and fieldid=".$row['fieldid'];
											$result_opt=mysql_query($sql_opt);
											$opt[$j]="";
											while($row_opt = mysql_fetch_array($result_opt))
												{
												$opt[$j]=$opt[$j].$tg_opt.$row_opt['value'].$tg_cl.$row_opt['alias'].$tg_opt_cl;
												if($row_opt['value']==$datarow[$row['name']]) 
													{$alias='';$alias=$row_opt['alias'];}
												}
										//}
										//below handles code if no value is set and also instead of value shows alias
										$alias=isset($alias)?$alias:NULL;
										$x=$x.$tg_opt.$datarow[$row['name']].$tg_cl.$alias.$tg_opt_cl;
										//introducing for clear value option
										$x=$x.$tg_opt.$datarow[$row['name']].$tg_cl.$tg_opt_cl;
										$x=$x.$opt[$j].$tg_sel_cl;
					$j++;
					}
		elseif($row['type']=="list")
					{
								$x=$tg_sel.$row['name'].$cnt.$tg_ip_name.$row['name'].$cnt.$tg_cl;
											//adding new on13/12/2014.can be deleted
											$sql_filter="select source,filter,id,value,alias from valuelist where id in (select optid from field_option where tblid=".$row['tblid']." and fieldid=".$row['fieldid'].")";
											//echo $sql_filter;
											$result_filter=mysql_query($sql_filter);
											$vsource=mysql_result($result_filter,0,0);
											$vfilter=mysql_result($result_filter,0,1);
											$vid=mysql_result($result_filter,0,2);
											$vvalue=mysql_result($result_filter,0,3);
											$valias=mysql_result($result_filter,0,4);
											$vfilter=$vfilter==null?"":" where ".$vfilter;
											$sql_opt="select ".$vvalue." 'value',".$valias." 'alias' from ".$vsource.$vfilter;
											//echo $sql_opt;	
											//Completion of change
											$result_opt=mysql_query($sql_opt);
											$opt[$j]="";
											$alias='';
											if($result_opt)
											{
											while($row_opt = mysql_fetch_array($result_opt))
												{
												$opt[$j]=$opt[$j].$tg_opt.$row_opt['value'].$tg_cl.$row_opt['alias'].$tg_opt_cl;
												if($row_opt['value']==$datarow[$row['name']]) 
													{$alias=$row_opt['alias'];}
												}
											}
										//}
										//below handles code if no value is set and also instead of value shows alias
										$alias=(isset($alias)&&($alias!=null))?$alias:"--clear--";
										$x=$x.$tg_opt.$datarow[$row['name']].$tg_cl.$alias.$tg_opt_cl;
										//introducing for clear value option
										$x=$x.$tg_opt."".$tg_cl."--clear--".$tg_opt_cl;
										$x=$x.$opt[$j].$tg_sel_cl;
					$j++;
					}			
		else
		{
		$x=$tg_ip.$tg_ip_type.$row['type'].$tg_ip_class.$tg_ip_name.$row['name'].$cnt.$tg_ip_size.$row['size'].$tg_ip_value;
							if($row['type']=="idate")
							{
							$x=$x.getmydate($datarow[$row['name']]);
							$x=$x.$tg_ip_id.$row['name'].$cnt.$tg_ip_class.$tg_class;
							$x=$x.$tg_ip_cl.$tg_dat.$row['name'].$cnt.$tg_dat_cl;
							}
							else
							{$x=$x.$datarow[$row['name']].$tg_ip_cl;}
			}
                        //echo "{{".$tbl.".".$row['name']."}}";
		$a=str_replace("{{".$tbl.".".$row['name']."}}",$x,$a);
		
		}
		
		}
		
		}$cnt++;
                  $x=$tg_chk."0".$tg_chk_val."\" hidden checked=\"checked";
		$x=$x.$tg_ip_cl;
                echo $x.$s;
		
	//Close Table
		//echo $tg_top_cl;
			$a=$a."<input type=\"number\" name=\"icnt\" value=$cnt style=\"display:none\">";
		$a=$a."<input type=\"hidden\" name=\"field_edit\" value=\"".implode(",",$arr)."\" >";
	
	
	//only get pages if this is main table
	if($_GET['page']==$tbl)
        {
            $del='';$bk='';
            $nav="<div class=\"navbar navbar-default\" role=\"navigation\"><div class=\"col-md-8\">";
            $bk="<div class=\"col-md-4\"><button class=\"btn btn-default\" id=\"btn_back\" type=\"submit\" name=\"back\" value=\"back\"><span class=\"glyphicon glyphicon-chevron-left\"></span></button></div>"; 
            $upd="<div class=\"col-md-4\"><button class=\"btn btn-default\" id=\"btn_update\" type=\"submit\" name=\"updates\" value=\"update\" >Update</button></div>";
        if($_SESSION['SESS_perm']=='user')
//$del="<div class=\"col-md-4\"><button class=\"btn btn-danger\" id=\"btn_del\" type=\"submit\" value=\"delete\">Delete</button></div>";
//$a=$z."</div>".$a.$z."</div>";
        $bk='';
$nav=$nav.$bk.$upd."</div></div>";
$a=$nav.$a.$nav;
        }

//$a=$a."&nbsp<input class=\"btn btn-danger\" id=\"btn\" type=\"submit\" name=\"update\" value=\"Update\">";
return $a;
}

function tempaddrow($tbl,$arr,$arr_show,$mode=1)
{
	$sql1=dbsql($tbl);
	include "tags.php";
	 $col_wid=0;$col_space=0; 
         if($mode==2)
	{$col_wid=4;$col_space=2;}
	if($mode==3)
	{$col_wid=3;$col_space=1;}
	$span=($col_wid*$mode)+(($mode-1)*$col_space);
        $tg_top="<div class=\"table-responsive\"><table class=\"table table-striped\" id=\"".$tbl."\" width=auto border=1 cellpadding=2 cellspacing=2>";
	$tg_span="<div class=\"col-md-$span\">";
	$tg_colspace="<div class=\"col-md-$col_space\"></div>";
	$tg_col="<div class=\"col-md-$col_wid\">";

	//DB SQLs
	$sql="select tblid from config where name='$tbl'";
	$result=mysql_query($sql);
	$myvar=mysql_result($result,0);
	$sql1="select * from field where tblid=$myvar";
	$result1=mysql_query($sql1);
$fname="";
$fval="";
	$a="";
	$opt=array(1 => "k");
	//$mode=1;
	$j=0;

	/*if(isset($_POST['sqli']))
	{
	echo $_POST['sqli'];
	if (!mysql_query($_POST['sqli']))
			{
			die('Error: ' . mysql_error());
			}
	}
	*/
    $a=get_template($tbl);
    $s='';

	$cnt=0;
		while($row = mysql_fetch_array($result1))
		{

	//Print data columns
		
		$j=1;
		
		if(empty($arr_show) || in_array($row['name'],$arr_show))
		{		
		if($row['dbindex']=='primary')
		{
		$s=$tg_ip.$tg_ip_type.$tg_text.$tg_readonly.$tg_ip_class.$tg_ip_name.$row['name'].$cnt.$tg_ip_size.$row['size'].$tg_ip_value;
		//if($row['type']=="idate")
			//			{
				//		$x=$x.getmydate($datarow[$row['name']]).$tg_ip_cl;
			//			$x=$x.$tg_static.getmydate($datarow[$row['name']]).$tg_static_cl.$tg_div_cl.$tg_div_cl;
				//		}else
					//	{
						$s=$s.$tg_ip_cl;
						//$x=$x.$tg_static.$datarow[$row['name']].$tg_static_cl.$tg_div_cl.$tg_div_cl;
						//}
		
		//$x=$x.$tg_static.$tg_static_cl.$tg_div_cl.$tg_div_cl;
                                                $x='';
		}elseif($row['type']=="textarea")
					{
						$x=$x.$tg_text.$tg_ip_name.$row['name'].$cnt.$tg_ip_cl;
						$x=$x.$tg_text_cl;
					}	
		elseif($row['type']=="option")
					{					$x=$tg_sel.$row['name'].$cnt.$tg_ip_name.$row['name'].$cnt.$tg_cl;
										//$a=$a.$tg_opt.$datarow[$row['name']].$tg_cl.$datarow[$row['name']].$tg_opt_cl;
										//if($cnt==0)
										//{
											$sql_opt="select * from field_option where tblid=".$row['tblid']." and fieldid=".$row['fieldid'];
											$result_opt=mysql_query($sql_opt);
											$opt[$j]="";
											while($row_opt = mysql_fetch_array($result_opt))
												{
												$opt[$j]=$opt[$j].$tg_opt.$row_opt['value'].$tg_cl.$row_opt['alias'].$tg_opt_cl;
												
													{$alias='';$alias=$row_opt['alias'];}
												}
										//}
										//below handles code if no value is set and also instead of value shows alias
										$alias=isset($alias)?$alias:NULL;
										$x=$x.$tg_opt.$tg_cl.$alias.$tg_opt_cl;
										//introducing for clear value option
										$x=$x.$tg_opt.$tg_cl.$tg_opt_cl;
										$x=$x.$opt[$j].$tg_sel_cl;
					$j++;
					}
		elseif($row['type']=="list")
					{
								$x=$tg_sel.$row['name'].$cnt.$tg_ip_name.$row['name'].$cnt.$tg_cl;
											//adding new on13/12/2014.can be deleted
											$sql_filter="select source,filter,id,value,alias from valuelist where id in (select optid from field_option where tblid=".$row['tblid']." and fieldid=".$row['fieldid'].")";
											//echo $sql_filter;
											$result_filter=mysql_query($sql_filter);
											$vsource=mysql_result($result_filter,0,0);
											$vfilter=mysql_result($result_filter,0,1);
											$vid=mysql_result($result_filter,0,2);
											$vvalue=mysql_result($result_filter,0,3);
											$valias=mysql_result($result_filter,0,4);
											$vfilter=$vfilter==null?"":" where ".$vfilter;
											$sql_opt="select ".$vvalue." 'value',".$valias." 'alias' from ".$vsource.$vfilter;
											//echo $sql_opt;	
											//Completion of change
											$result_opt=mysql_query($sql_opt);
											$opt[$j]="";
											$alias='';
											if($result_opt)
											{
											while($row_opt = mysql_fetch_array($result_opt))
												{
												$opt[$j]=$opt[$j].$tg_opt.$row_opt['value'].$tg_cl.$row_opt['alias'].$tg_opt_cl;
												
													{$alias=$row_opt['alias'];}
												}
											}
										//}
										//below handles code if no value is set and also instead of value shows alias
										$alias=(isset($alias)&&($alias!=null))?$alias:"--clear--";
										echo "alias is".$alias;
										$x=$x.$tg_opt.$tg_cl.$alias.$tg_opt_cl;
										//introducing for clear value option
										$x=$x.$tg_opt."".$tg_cl."--clear--".$tg_opt_cl;
										$x=$x.$opt[$j].$tg_sel_cl;
					$j++;
					}			
		else
		{
		$x=$tg_ip.$tg_ip_type.$row['type'].$tg_ip_class.$tg_ip_name.$row['name'].$cnt.$tg_ip_size.$row['size'].$tg_ip_value;
							if($row['type']=="idate")
							{
							
							$x=$x.$tg_ip_id.$row['name'].$cnt.$tg_ip_class.$tg_class;
							$x=$x.$tg_ip_cl.$tg_dat.$row['name'].$cnt.$tg_dat_cl;
							}
							else
							{$x=$x.$tg_ip_cl;}
			}
		
	$a=str_replace("{{".$tbl.".".$row['name']."}}",$x,$a);
		$x='';
		}
		
		
		
		}$cnt++;
		
	//Close Table
		//echo $tg_top_cl;
			$a=$a."<input type=\"number\" name=\"icnt\" value=$cnt style=\"display:none\">";
		$a=$a."<input type=\"hidden\" name=\"field_edit\" value=\"".implode(",",$arr)."\" >";
	echo $s.$a;
	
        

echo "<input class=\"btn btn-primary\" id=\"btn\" type=\"submit\" name=\"addrow\" value=\"Add Row\">";

}


?>