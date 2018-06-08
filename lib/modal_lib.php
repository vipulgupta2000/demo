



<?php 



function addrow_modal($tbl,$arr,$arr_show,$mode=1)
{
	//echo $tbl."mode".$mode;//------------------- comment by dip------------
	$sql1=dbsql($tbl);
	$col_wid=0;$col_space=0;
	if($mode==2)
	{$col_wid=4;$col_space=2;}
	if($mode==3)
	{$col_wid=3;$col_space=1;}
	$span=($col_wid*$mode)+(($mode-1)*$col_space);
	$tg_row="<div class=\"row\">";
	$tg_col1="<div class=\"col-md-1\">";
	$tg_span="<div class=\"col-md-$span\">";
	$tg_colspace="<div class=\"col-md-$col_space\"></div>";
	$tg_col="<div class=\"col-md-$col_wid\">";
	$tg_ip_gp="<div class=\"form-group\"><label for=\"";
	$tg_ip_gp_cl="</label>";
	$tg_static="<div class=\"col-sm-10\"><p class=\"form-control-static\">";
	$tg_static_cl="</p>";
	$tg_div_cl="</div>";
	$tg_ip_class="\" class=\"form-control";

	$tg_top="<div class=\"table-responsive\"><table class=\"table table-striped\" id=\"".$tbl."\" width=auto border=1 cellpadding=2 cellspacing=2>";
	$tg_hdr="<th>";
	$tg_hdr_cl="</th>";
	$tg_ro="<tr>";
	$tg_ro_cl="</tr>";
	$tg_td="<td>";
	$tg_td_cl="</td>";
	$tg_top_cl="</table></div>";
	$tg_ip="<input";
	$tg_ip_type=" type=\"";
	$tg_ip_name="\" name=\"";
	$tg_ip_value="\" value=\"";
	$tg_ip_size="\" size=\"";
	$tg_ip_id="\" id=\"";
	$tg_class="\" class=\"ro";
	$tg_ip_cl="\" />";
	$tg_chk="<input type=\"checkbox\" name=\"chb";
	$tg_chk_val="";
	$tg_dat="<a href=\"javascript:NewCal('";
	$tg_dat_cl="','ddmmyyyy')\"><img src=datetimepick/cal.gif width=16 height=16 border=0 alt=Pick a date></a>";
	$tg_sel="<select class=\"form-control\" id=\"";
	$tg_cl="\" >";
	$tg_sel_cl="</select>";
	$tg_opt="<option value=\"";
	$tg_opt_cl="</option>";
	$tg_hidden="hidden";
	$tg_readonly="\" readonly ";
	$tg_text="<textarea rows=\"4\" cols=\"15\" ";
	$tg_text_cl="</textarea>";

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
	if(isset($_POST['fname']))
	{
	//echo $fname;
	$array=array($_POST['fname']);
	print_r($array);
	}
        //mode is horizontal row style
        if($mode==1)
        {
//Open Table
        echo $tg_top;

//Print Header row
		$a= $tg_ro;
		//blank cell for checkbox
		//$a=$a.$tg_hdr.$tg_hdr_cl;
		while($row = mysql_fetch_array($result1))
		{
		if(!$row['dbindex']=='primary')
		$a=$a.$tg_hdr.$row['alias'].$tg_hdr_cl;
		}
		$a=$a.$tg_ro_cl;

//Print Data rows
		$cnt=0;
		{
		$j=1;

		$a=$a.$tg_ro;

		//Input for checkbox
		//$a=$a.$tg_td.$tg_chk.$cnt.$tg_chk_val;
		//$a=$a.$tg_ip_cl.$tg_td_cl;

		$result1=mysql_query($sql1);
		while($row = mysql_fetch_array($result1))
		{
		if($row['type']=="option")
				{
				$a=$a.$tg_td.$tg_sel.$row['name'].$cnt.$tg_ip_name.$row['name'].$cnt.$tg_cl;
				if($cnt==0)
				{
				$sql_opt="select * from field_option where tblid=".$row['tblid']." and fieldid=".$row['fieldid'];
				$result_opt=mysql_query($sql_opt);
				$opt[$j]="";
				while($row_opt = mysql_fetch_array($result_opt))
					{
					$opt[$j]=$opt[$j].$tg_opt.$row_opt['value'].$tg_cl.$row_opt['alias'].$tg_opt_cl;
					}

				}

				$a=$a.$opt[$j].$tg_sel_cl.$tg_td_cl;
				$j++;
				}
				elseif($row['type']=="list")
					{
								$a=$a.$tg_td.$tg_sel.$row['name'].$cnt.$tg_ip_name.$row['name'].$cnt.$tg_cl;
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
												}
											}
										//}
										//below handles code if no value is set and also instead of value shows alias

										//introducing for clear value option
										$a=$a.$tg_opt."".$tg_cl."--clear--".$tg_opt_cl;
										$a=$a.$opt[$j].$tg_sel_cl.$tg_td_cl;
					$j++;
					}
				elseif(!$row['dbindex']=='primary')
				{
				$a=$a.$tg_td.$tg_ip.$tg_ip_type.$row['type'].$tg_ip_name.$row['name'].$cnt.$tg_ip_size.$row['size'].$tg_ip_value;
					if($row['type']=="idate")
					{
					$a=$a.$tg_ip_id.$row['name'].$cnt.$tg_class;
					$a=$a.$tg_ip_cl.$tg_dat.$row['name'].$cnt.$tg_dat_cl.$tg_td_cl;
					}
					else {
					$a=$a.$tg_ip_cl.$tg_td_cl;
					}
				}
		}
				//Store variables for insert query
				if(!$row['dbindex']=='primary')
							{$fname=$fname.$row['name'].",";
							if($row['type']=='idate')
							$fval=$fval."'\"".setmydate($_POST[$row['name']])."\"',";
							else
							$fval=$fval."'\".$"."_"."POST['".$row['name']."'].\"',";
					}
		$cnt++;
		$a=$a.$tg_ro_cl."\n";
		}
//Close Table
		echo $a.$tg_top_cl;
        }
        if($mode>=2)
        {
          {
	//Open Table
	//echo $tg_top;
	//Print Header column
	$nfield=0;
	$split=0;
	$a=$tg_row.$tg_col1.$tg_div_cl;
	//echo $tg_col;
	$a=$a.$tg_col;$b=$tg_col;
	if($mode==3)
	$c=$tg_col;
	$d=$tg_div_cl.$tg_row.$tg_col1.$tg_div_cl.$tg_span;
	$cnt=0;
		while($row = mysql_fetch_array($result1))
		{
		if($row['span']==2)
		{$d=$d.$tg_ip_gp.$row['name'].$tg_cl.$row['alias'].$tg_ip_gp_cl;$split=1;}
		else{
		if($row['col']==2)
		$b=$b.$tg_ip_gp.$row['name'].$tg_cl.$row['alias'].$tg_ip_gp_cl;
		elseif($row['col']==3)
		$c=$c.$tg_ip_gp.$row['name'].$tg_cl.$row['alias'].$tg_ip_gp_cl;
		else
		$a=$a.$tg_ip_gp.$row['name'].$tg_cl.$row['alias'].$tg_ip_gp_cl;
		}

	//Print data columns
		$j=1;
		//while($datarow=mysql_fetch_array($result_data))

		if(empty($arr_show) || in_array($row['name'],$arr_show))
		{
		if($row['dbindex']=='primary' || !in_array($row['name'], $arr))
		//if($row['dbindex']=='primary')
		{//$tg_text
		//$x=$tg_ip.$tg_ip_type.$tg_hidden.$tg_ip_class.$tg_ip_name.$row['name'].$cnt.$tg_ip_size.$row['size'].$tg_ip_value;
		$x=$tg_ip.$tg_ip_type.$tg_text.$tg_readonly.$tg_ip_class.$tg_ip_name.$row['name'].$cnt.$tg_ip_size.$row['size'].$tg_ip_value; // change by dip to make ID readonly and display

		//if($row['type']=="idate")
			//			{
				//		$x=$x.getmydate($datarow[$row['name']]).$tg_ip_cl;
			//			$x=$x.$tg_static.getmydate($datarow[$row['name']]).$tg_static_cl.$tg_div_cl.$tg_div_cl;
				//		}else
					//	{
						$x=$x.$tg_ip_cl;
						//$x=$x.$tg_static.$datarow[$row['name']].$tg_static_cl.$tg_div_cl.$tg_div_cl;
						//}

		$x=$x.$tg_static.$tg_static_cl.$tg_div_cl.$tg_div_cl;
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
										$x=$x.$opt[$j].$tg_sel_cl.$tg_div_cl;
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
										//echo "alias is".$alias;
										$x=$x.$tg_opt.$tg_cl.$alias.$tg_opt_cl;
										//introducing for clear value option
										$x=$x.$tg_opt."".$tg_cl."--clear--".$tg_opt_cl;
										$x=$x.$opt[$j].$tg_sel_cl.$tg_div_cl;
					$j++;
					}
		else
		{
		$x=$tg_ip.$tg_ip_type.$row['type'].$tg_ip_class.$tg_ip_name.$row['name'].$cnt.$tg_ip_size.$row['size'].$tg_ip_value;
							if($row['type']=="idate")
							{

							$x=$x.$tg_ip_id.$row['name'].$cnt.$tg_ip_class.$tg_class;
							$x=$x.$tg_ip_cl.$tg_dat.$row['name'].$cnt.$tg_dat_cl.$tg_div_cl;
							}
							else
							{$x=$x.$tg_ip_cl.$tg_div_cl;}
			}

		if($row['span']==2)
		{$d=$d.$x;}
		else{
		if($row['col']==2)
		$b=$b.$x;
		elseif($row['col']==3)
		$c=$c.$x;
		else
		$a=$a.$x;
		}

		}



		}$cnt++;
		$a=$a.$tg_div_cl.$tg_colspace.$b.$tg_div_cl;
		if($mode==3)
		$a=$a.$tg_colspace.$c.$tg_div_cl;
		if($split==1)
		$a=$a.$d.$tg_div_cl;
		$a=$a.$tg_col1.$tg_div_cl.$tg_div_cl;
	//Close Table
		//echo $tg_top_cl;
			$a=$a."<input type=\"number\" name=\"icnt\" value=$cnt style=\"display:none\">";
		$a=$a."<input type=\"hidden\" name=\"field_edit\" value=\"".implode(",",$arr)."\" >";
	echo $a;
	}
        }
$fname=chop($fname,",");
$fval=chop($fval,",");
$sqli = "INSERT INTO ".$tbl." ( ".$fname." ) VALUES (".$fval.")";
//echo $sqli;
//$sqla= "Alter table
if($tbl == 'categorization'){}
else if($tbl == 'datesystem'){}
else{
//echo "<input class=\"btn btn-primary\" id=\"btn\" type=\"submit\" name=\"addrow_modal\" value=\"New\">";
//echo "<input class=\"btn btn-warning\" id=\"btn\" type=\"submit\" name=\"modify\" value=\"modify\">";
return $sqli;
}
}

//------------------------ modified for modal -----------------------------------------
// written to show fields in arranged format in input mode
function input_new_modal($tbl, $qual, $arr, $arr_show, $mode)
{
    
    $sql1      = dbsql($tbl);
    //echo $sql1;
	 
    $col_wid   = 0;
    $col_space = 0;
    if ($mode == 2) {
        $col_wid   = 4;
        $col_space = 2;
    }
    if ($mode == 3) {
        $col_wid   = 3;
        $col_space = 1;
    }
    $span         = ($col_wid * $mode) + (($mode - 1) * $col_space);
    $tg_row       = "<div class=\"row\">";
    $tg_col1      = "<div class=\"col-md-1\">";
    $tg_span      = "<div class=\"col-md-$span\">";
    $tg_colspace  = "<div class=\"col-md-$col_space\"></div>";
    $tg_col       = "<div class=\"col-md-$col_wid\">";
    $tg_ip_gp     = "<div class=\"form-group\"><label for=\"";
    $tg_ip_gp_cl  = "</label>";
    $tg_static    = "<div class=\"col-sm-10\"><p class=\"form-control-static\">";
    $tg_static_cl = "</p>";
    $tg_div_cl    = "</div>";
    $tg_ip_class  = "\" class=\"form-control";
    
    $tg_top      = "<div class=\"table-responsive\"><table class=\"table table-striped\" id=\"" . $tbl . "\" width=auto border=1 cellpadding=2 cellspacing=2>";
    $tg_hdr      = "<th>";
    $tg_hdr_cl   = "</th>";
    $tg_ro       = "<tr>";
    $tg_ro_cl    = "</tr>";
    $tg_td       = "<td>";
    $tg_td_cl    = "</td>";
    $tg_top_cl   = "</table></div>";
    $tg_ip       = "<input";
    $tg_ip_type  = " type=\"";
    $tg_ip_name  = "\" name=\"";
    $tg_ip_value = "\" value=\"";
    $tg_ip_size  = "\" size=\"";
    $tg_ip_id    = "\" id=\"";
    $tg_class    = "\" class=\"ro";
    $tg_ip_cl    = "\" />";
    $tg_chk      = "<input type=\"checkbox\" name=\"chb";
    $tg_chk_val  = "";
    $tg_dat      = "<a href=\"javascript:NewCal('";
    $tg_dat_cl   = "','ddmmyyyy')\"><img src=datetimepick/cal.gif width=16 height=16 border=0 alt=Pick a date></a>";
    $tg_sel      = "<select class=\"form-control\" id=\"";
    $tg_cl       = "\" >";
    $tg_sel_cl   = "</select>";
    $tg_opt      = "<option value=\"";
    $tg_opt_cl   = "</option>";
    $tg_hidden   = "hidden";
    $tg_readonly = "\" readonly ";
    $tg_text     = "<textarea rows=\"4\" cols=\"15\" ";
    $tg_text_cl  = "</textarea>";
    
    $result1  = mysql_query($sql1);
    $data_sql = "select * from " . $tbl;
	//return $qual;
    if (isset($qual)) {
        $qual     = " where " . $qual;
        $data_sql = $data_sql . $qual;
        //echo $data_sql;
    }
    //$data_sql=getPagesql($data_sql,7);
    //echo $data_sql;
    //mode 0 is columnar and mode 1 for row-wise printing
    $a   = "";
    $opt = array(
        1 => "k"
    );
    //$mode=1;
    $j   = 0;
    
    if ($mode == 0) {
        //Open Table
        echo $tg_top;
        //Print Header column
        while ($row = mysql_fetch_array($result1)) {
            
            echo $tg_ro;
            
            echo $tg_hdr . $row['alias'] . $tg_hdr_cl;
            
            //Print data columns
            $result_data = mysql_query($data_sql);
            while ($datarow = mysql_fetch_array($result_data)) {
                if ($row['dbindex'] == 'primary') {
                    echo $tg_td . $datarow[$row['name']] . $tg_td_cl;
                } else {
                    echo $tg_td . $tg_ip . $tg_ip_type . $row['type'] . $tg_ip_name . $row['name'] . $tg_ip_size . $row['size'] . $tg_ip_value;
                    echo $datarow[$row['name']];
                    echo $tg_ip_cl . $tg_td_cl;
                }
            }
            
            echo $tg_ro_cl;
        }
        //Close Table
        echo $tg_top_cl;
    }
    if ($mode == 1) {
        //Open Table
        echo $tg_top;
        
        //Print Header row
        $a   = $tg_ro;
        // adding for display only temporary fields
        $tmp = '';
        //blank cell for checkbox
        $a   = $a . $tg_hdr . $tg_chk . $tg_chk_val . $tg_ip_cl . $tg_hdr_cl;
        while ($row = mysql_fetch_array($result1)) {
            $tmp = $tmp . $row['name'] . ',';
            if (empty($arr_show) || in_array($row['name'], $arr_show))
                $a = $a . $tg_hdr . $row['alias'] . $tg_hdr_cl;
            // adding for display only temporary fields
        }
        for ($i = 0; $i < sizeof($arr_show); $i++) {
            $k = is_array($arr_show[$i]) ? $arr_show[$i][0] : $arr_show[$i];
            $j = explode(',', $tmp);
            if (!in_array($k, explode(',', $tmp)))
                $a = $a . $tg_hdr . $k . $tg_hdr_cl;
        }
        $a = $a . $tg_ro_cl;
        
        //Print Data rows
        $result_data = mysql_query($data_sql);
        $cnt         = 0;
        while ($datarow = mysql_fetch_array($result_data)) {
            $j = 1;
            
            $a = $a . $tg_ro;
            
            //Input for checkbox
            $a = $a . $tg_td . $tg_chk . $cnt . $tg_chk_val;
            $a = $a . $tg_ip_cl . $tg_td_cl;
            
            $result1 = mysql_query($sql1);
            while ($row = mysql_fetch_array($result1)) {
                if (empty($arr_show) || in_array($row['name'], $arr_show)) {
                    if ($row['dbindex'] == "primary" || !in_array($row['name'], $arr))
                    //if($row['dbindex']=="primary")
                        {
                        //$a=$a.$tg_td.$tg_ip.$tg_ip_type.$row['type'].$tg_ip_name.$row['name'].$cnt.$tg_readonly.$tg_ip_size.$row['size'].$tg_ip_value;
                        $a = $a . $tg_td . $tg_ip . $tg_ip_type . $tg_hidden . $tg_ip_name . $row['name'] . $cnt . $tg_ip_size . $row['size'] . $tg_ip_value;
                        //$a=$a.$datarow[$row['name']].$tg_ip_cl.$tg_td_cl;
                        
                        if ($row['type'] == "idate") {
                            $a = $a . getmydate($datarow[$row['name']]) . $tg_ip_cl;
                            $a = $a . getmydate($datarow[$row['name']]) . $tg_td_cl;
                        } else {
                            $a = $a . $datarow[$row['name']] . $tg_ip_cl;
                            $a = $a . $datarow[$row['name']] . $tg_td_cl;
                        }
                    } elseif ($row['type'] == "textarea") {
                        $a = $a . $tg_td . $tg_text . $tg_ip_name . $row['name'] . $cnt . $tg_ip_cl;
                        $a = $a . $datarow[$row['name']] . $tg_text_cl . $tg_td_cl;
                    } elseif ($row['type'] == "option") {
                        $a       = $a . $tg_td . $tg_sel . $row['name'] . $cnt . $tg_ip_name . $row['name'] . $cnt . $tg_cl;
                        //$a=$a.$tg_opt.$datarow[$row['name']].$tg_cl.$datarow[$row['name']].$tg_opt_cl;
                        //if($cnt==0)
                        //{
                        $sql_opt = "select * from field_option where tblid=" . $row['tblid'] . " and fieldid=" . $row['fieldid'];
                        
                        $result_opt = mysql_query($sql_opt);
                        $opt[$j]    = "";
                        while ($row_opt = mysql_fetch_array($result_opt)) {
                            $opt[$j] = $opt[$j] . $tg_opt . $row_opt['value'] . $tg_cl . $row_opt['alias'] . $tg_opt_cl;
                            if ($row_opt['value'] == $datarow[$row['name']]) {
                                $alias = '';
                                $alias = $row_opt['alias'];
                            }
                        }
                        //}
                        //below handles code if no value is set and also instead of value shows alias
                        $alias = isset($alias) ? $alias : NULL;
                        $a     = $a . $tg_opt . $datarow[$row['name']] . $tg_cl . $alias . $tg_opt_cl;
                        //introducing for clear value option
                        $a     = $a . $tg_opt . $datarow[$row['name']] . $tg_cl . $tg_opt_cl;
                        $a     = $a . $opt[$j] . $tg_sel_cl . $tg_td_cl;
                        $j++;
                    } elseif ($row['type'] == "list") {
                        $a             = $a . $tg_td . $tg_sel . $row['name'] . $cnt . $tg_ip_name . $row['name'] . $cnt . $tg_cl;
                        //adding new on13/12/2014.can be deleted
                        $sql_filter    = "select source,filter,id,value,alias from valuelist where id in (select optid from field_option where tblid=" . $row['tblid'] . " and fieldid=" . $row['fieldid'] . ")";
                        //echo $sql_filter;
                        $result_filter = mysql_query($sql_filter);
                        $vsource       = mysql_result($result_filter, 0, 0);
                        $vfilter       = mysql_result($result_filter, 0, 1);
                        $vid           = mysql_result($result_filter, 0, 2);
                        $vvalue        = mysql_result($result_filter, 0, 3);
                        $valias        = mysql_result($result_filter, 0, 4);
                        $vfilter       = $vfilter == null ? "" : " where " . $vfilter;
                        $sql_opt       = "select " . $vvalue . " 'value'," . $valias . " 'alias' from " . $vsource . $vfilter;
                        //echo $sql_opt;
                        //Completion of change
                        $result_opt    = mysql_query($sql_opt);
                        $opt[$j]       = "";
                        $alias         = '';
                        if ($result_opt) {
                            while ($row_opt = mysql_fetch_array($result_opt)) {
                                $opt[$j] = $opt[$j] . $tg_opt . $row_opt['value'] . $tg_cl . $row_opt['alias'] . $tg_opt_cl;
                                if ($row_opt['value'] == $datarow[$row['name']]) {
                                    $alias = $row_opt['alias'];
                                }
                            }
                        }
                        //}
                        //below handles code if no value is set and also instead of value shows alias
                        $alias = (isset($alias) && ($alias != null)) ? $alias : "--clear--";
                        echo "alias is" . $alias;
                        $a = $a . $tg_opt . $datarow[$row['name']] . $tg_cl . $alias . $tg_opt_cl;
                        //introducing for clear value option
                        $a = $a . $tg_opt . "" . $tg_cl . "--clear--" . $tg_opt_cl;
                        $a = $a . $opt[$j] . $tg_sel_cl . $tg_td_cl;
                        $j++;
                    } else {
                        $a = $a . $tg_td . $tg_ip . $tg_ip_type . $row['type'] . $tg_ip_name . $row['name'] . $cnt . $tg_ip_size . $row['size'] . $tg_ip_value;
                        if ($row['type'] == "idate") {
                            $a = $a . getmydate($datarow[$row['name']]);
                            $a = $a . $tg_ip_id . $row['name'] . $cnt . $tg_class;
                            $a = $a . $tg_ip_cl . $tg_dat . $row['name'] . $cnt . $tg_dat_cl . $tg_td_cl;
                        } else {
                            $a = $a . $datarow[$row['name']] . $tg_ip_cl . $tg_td_cl;
                        }
                    }
                    //close if condition
                }
                //close inner while
            }
            for ($i = 0; $i < sizeof($arr_show); $i++) {
                $k   = is_array($arr_show[$i]) ? $arr_show[$i][0] : $arr_show[$i];
                $val = is_array($arr_show[$i]) ? $arr_show[$i][1] : NULL;
                $j   = explode(',', $tmp);
                if (!in_array($k, explode(',', $tmp)))
                    $a = $a . $tg_td . $tg_ip . $tg_ip_type . 'text' . $tg_ip_name . $k . $cnt . $tg_ip_size . '10' . $tg_ip_value . $val . $tg_ip_cl . $tg_td_cl;
            }
            $cnt++;
            $a = $a . $tg_ro_cl . "\n";
        }
        //Close Table
        $a = $a . $tg_top_cl;
        $a = $a . "<input type=\"number\" name=\"icnt\" value=$cnt style=\"display:none\">";
        $a = $a . "<input type=\"hidden\" name=\"field_edit\" value=\"" . implode(",", $arr) . "\" >";
        //Close Mode
    }
    if ($mode >= 2) {
        //Open Table
        //echo $tg_top;
        //Print Header column
		
        $nfield = 0;
        $split  = 0;
        $a      = $tg_row . $tg_col1 . $tg_div_cl;
        //echo $tg_col;
        $a      = $a . $tg_col;
        $b      = $tg_col;
        if ($mode == 3)
            $c = $tg_col;
        $d   = $tg_div_cl . $tg_row . $tg_col1 . $tg_div_cl . $tg_span;
        $cnt = 0;
        while ($row = mysql_fetch_array($result1)) {
			
            if ($row['span'] == 2) {
                $d     = $d . $tg_ip_gp . $row['name'] . $tg_cl . $row['alias'] . $tg_ip_gp_cl;
                $split = 1;
            } else {
                if ($row['col'] == 2)
                    $b = $b . $tg_ip_gp . $row['name'] . $tg_cl . $row['alias'] . $tg_ip_gp_cl;
                elseif ($row['col'] == 3)
                    $c = $c . $tg_ip_gp . $row['name'] . $tg_cl . $row['alias'] . $tg_ip_gp_cl;
                else
                    $a = $a . $tg_ip_gp . $row['name'] . $tg_cl . $row['alias'] . $tg_ip_gp_cl;
            }
            
            //Print data columns
            $result_data = mysql_query($data_sql);
			
            $j           = 1;
            while ($datarow = mysql_fetch_array($result_data)) {
                if (empty($arr_show) || in_array($row['name'], $arr_show)) {
                    if ($row['dbindex'] == 'primary' || !in_array($row['name'], $arr))
                    //if($row['dbindex']=='primary')
                        {
                        $x = $tg_ip . $tg_ip_type . $row['type'] . $tg_ip_class . $tg_ip_name . $row['name'] . $cnt . $tg_ip_size . $row['size'] . $tg_ip_value;
                        //if($row['type']=="idate")
                        //			{
                        //		$x=$x.getmydate($datarow[$row['name']]).$tg_ip_cl;
                        //			$x=$x.$tg_static.getmydate($datarow[$row['name']]).$tg_static_cl.$tg_div_cl.$tg_div_cl;
                        //		}else
                        //	{
                        $x = $x . $datarow[$row['name']] . "\" readonly \"" . $tg_ip_cl;
                        //$x=$x.$tg_static.$datarow[$row['name']].$tg_static_cl.$tg_div_cl.$tg_div_cl;
                        //}
                        
                        //$x=$x.$tg_static.$datarow[$row['name']].$tg_static_cl.$tg_div_cl;
                        $x = $x . $tg_div_cl;
                    } elseif ($row['type'] == "textarea") {
                        $x = $x . $tg_text . $tg_ip_name . $row['name'] . $cnt . $tg_ip_cl;
                        $x = $x . $datarow[$row['name']] . $tg_text_cl;
                    } elseif ($row['type'] == "option") {
                        $x          = $tg_sel . $row['name'] . $cnt . $tg_ip_name . $row['name'] . $cnt . $tg_cl;
                        //$a=$a.$tg_opt.$datarow[$row['name']].$tg_cl.$datarow[$row['name']].$tg_opt_cl;
                        //if($cnt==0)
                        //{
                        $sql_opt    = "select * from field_option where tblid=" . $row['tblid'] . " and fieldid=" . $row['fieldid'];
                        $result_opt = mysql_query($sql_opt);
                        $opt[$j]    = "";
                        $alias      = ''; //Added by Anshul to set alias to blank to aviod the last value
                        while ($row_opt = mysql_fetch_array($result_opt)) {
                            //echo $row['name'].$datarow[$row['name']]."<br>";
                            $opt[$j] = $opt[$j] . $tg_opt . $row_opt['value'] . $tg_cl . $row_opt['alias'] . $tg_opt_cl;
                            if ($row_opt['value'] == $datarow[$row['name']]) {
                                //echo $row_opt['alias']."<br>";
                                $alias = '';
                                $alias = $row_opt['alias'];
                                
                            }
                        }
                        //}
                        //below handles code if no value is set and also instead of value shows alias
                        $alias = isset($alias) ? $alias : Null;
                        $x     = $x . $tg_opt . $datarow[$row['name']] . $tg_cl . $alias . $tg_opt_cl;
                        //introducing for clear value option
                        
                        /*Commented by anshul to remove blank value from field option */
                        //$x=$x.$tg_opt.$datarow[$row['name']].$tg_cl.$tg_opt_cl;
                        
                        $x = $x . $opt[$j] . $tg_sel_cl . $tg_div_cl;
                        $j++;
                    } elseif ($row['type'] == "list") {
                        $x             = $tg_sel . $row['name'] . $cnt . $tg_ip_name . $row['name'] . $cnt . $tg_cl;
                        //adding new on13/12/2014.can be deleted
                        $sql_filter    = "select source,filter,id,value,alias from valuelist where id in (select optid from field_option where tblid=" . $row['tblid'] . " and fieldid=" . $row['fieldid'] . ")";
                        //echo $sql_filter;
                        $result_filter = mysql_query($sql_filter);
                        $vsource       = mysql_result($result_filter, 0, 0);
                        $vfilter       = mysql_result($result_filter, 0, 1);
                        $vid           = mysql_result($result_filter, 0, 2);
                        $vvalue        = mysql_result($result_filter, 0, 3);
                        $valias        = mysql_result($result_filter, 0, 4);
                        $vfilter       = $vfilter == null ? "" : " where " . $vfilter;
                        $sql_opt       = "select " . $vvalue . " 'value'," . $valias . " 'alias' from " . $vsource . $vfilter;
                       // echo $sql_opt;
                        //Completion of change
                        $result_opt    = mysql_query($sql_opt);
                        $opt[$j]       = "";
                        $alias         = '';
                        if ($result_opt) {
                            while ($row_opt = mysql_fetch_array($result_opt)) {
                                $opt[$j] = $opt[$j] . $tg_opt . $row_opt['value'] . $tg_cl . $row_opt['alias'] . $tg_opt_cl;
                                if ($row_opt['value'] == $datarow[$row['name']]) {
                                    $alias = $row_opt['alias'];
                                }
                            }
                        }
                        //}
                        //below handles code if no value is set and also instead of value shows alias
                        $alias = (isset($alias) && ($alias != null)) ? $alias : "--clear--";
                        $x     = $x . $tg_opt . $datarow[$row['name']] . $tg_cl . $alias . $tg_opt_cl;
                        //introducing for clear value option
                        
                        /*Commented by anshul to remove --clear-- value from list */
                        
                        //$x=$x.$tg_opt."".$tg_cl."--clear--".$tg_opt_cl;
                        $x = $x . $opt[$j] . $tg_sel_cl . $tg_div_cl;
                        $j++;
                    } else {
                        $x = $tg_ip . $tg_ip_type . $row['type'] . $tg_ip_class . $tg_ip_name . $row['name'] . $cnt . $tg_ip_size . $row['size'] . $tg_ip_value;
                        if ($row['type'] == "idate") {
                            $x = $x . getmydate($datarow[$row['name']]);
                            $x = $x . $tg_ip_id . $row['name'] . $cnt . $tg_ip_class . $tg_class;
                            $x = $x . $tg_ip_cl . $tg_dat . $row['name'] . $cnt . $tg_dat_cl . $tg_div_cl;
                        } else {
                            $x = $x . $datarow[$row['name']] . $tg_ip_cl . $tg_div_cl;
                        }
                    }
                    
                    if ($row['span'] == 2) {
                        $d = $d . $x;
                    } else {
                        if ($row['col'] == 2)
                            $b = $b . $x;
                        elseif ($row['col'] == 3)
                            $c = $c . $x;
                        else
                            $a = $a . $x;
                        
                        
                    }
                    
                }
                
            }
            
        }
        $cnt++;
        $x = $tg_td . $tg_chk . "0" . $tg_chk_val . "\" hidden checked=\"checked";
        $x = $x . $tg_ip_cl . $tg_td_cl;
        echo $x;
        $a = $a . $tg_div_cl . $tg_colspace . $b . $tg_div_cl;
        if ($mode == 3)
            $a = $a . $tg_colspace . $c . $tg_div_cl;
        if ($split == 1)
            $a = $a . $d . $tg_div_cl;
        $a = $a . $tg_col1 . $tg_div_cl . $tg_div_cl;
        //Close Table
        //echo $tg_top_cl;
        $a = $a . "<input type=\"number\" name=\"icnt\" value=$cnt style=\"display:none\">";
        $a = $a . "<input type=\"hidden\" name=\"field_edit\" value=\"" . implode(",", $arr) . "\" >";
        
    }
    
    //$a=$a."&nbsp<input class=\"btn btn-danger\" id=\"btn\" type=\"submit\" name=\"update\" value=\"Update\">";
    return $a;
	
}
//------------- change by dip for poup logic in system ----------------
function display_ref1($tbl, $qual, $md, $arr) {
	//echo'hi';
    $tg_top = "<div class=\"table-responsive\"><table class=\"table table-hover\" id=\"" . $tbl . "\" width=auto >";
    $tg_hdr = "<th>";
    $tg_hdr_cl = "</th>";
    //$tg_ro="<tr class=\"clickableRow\" href=\"".$link."constant\">";
    $tg_ro = "<tr class=\"clickableRow\" href=\"\" onclick=\"openUser(constant);\">";
    $tg_ro_cl = "</tr>";
    $tg_td = "<td>";
    $tg_td_cl = "</td>";
    $tg_top_cl = "</table></div>";
    //$tg_top="<div><ul class=\"nav nav-tabs nav-stacked\" id=\"".$tbl."\" >";
    $tg_hdr = "<th>";
    $tg_hdr_cl = "</th>";
    $tg_al = "<a href=\"#\" onclick=\"openPage(";
    $tg_alo = ");\" >";
    $tg_alc = "</a>";
    $tg_ip = "<input";
    $tg_ip_type = " type=\"";
    $tg_ip_name = "\" name=\"";
    $tg_ip_value = "\" value=\"";
    $tg_ip_size = "\" size=\"";
    $tg_ip_id = "\" id=\"";
    $tg_class = "\" class=\"ro";
    $tg_ip_cl = "\" />";
    $tg_chk = "<input type=\"checkbox\" name=\"chb";
    $tg_chk_val = "";
    $tg_dat = "<a href=\"javascript:NewCal('";
    $tg_dat_cl = "','yyyymmdd')\"><img src=datetimepick/cal.gif width=16 height=16 border=0 alt=Pick a date></a>";
    $tg_sel = "<select name=\"";
    $tg_cl = "\" >";
    $tg_sel_cl = "</select>";
    $tg_opt = "<option value=\"";
    $tg_opt_cl = "</option>";
    $tg_hidden = "hidden";
    $tg_readonly = "\" readonly ";
    $tg_text = "<textarea rows=\"4\" cols=\"15\" ";
    $tg_text_cl = "</textarea>";

    $data_sql = "select * from " . $tbl;
    $data_sql = "select id,child from formrel where parent='$tbl'";
//echo $data_sql;
    $result = mysql_query($data_sql) or die("Error while selecting formrel " . mysql_error());
    $a = "";
    $tb = "<div class=\"tabbable\" id=\"tabs-344382\"><ul class=\"nav nav-tabs\" role=\"tablist\">";
    $tbc = "";
    $k = 0;


    while ($row = mysql_fetch_array($result)) {
        $a = "";
        $v = $row['id'];
        $tbl = $row['child'];
        $sql1 = dbsql($tbl);
        $data_sql = "select * from " . $tbl . " where id in (select childrecid from reldata where relid=" . $v . " and " . $qual . ")";
        $btn_new = "<button class='btn btn-danger'  id='new_$tbl' name='new_modal' data-toggle='modal'>New</button>";
        //$btn_new = "<input type = 'button' id='new_modal' name='new_$tbl' value='New'/>";   
//$btn_new="<br /><button class=\"btn btn-danger\" type=\"submit\" name=\"new_$tbl\" value=\"new\" />New</button>";
//<button class="btn btn-success"  id='addnewRec' data-toggle="modal">Add New Record</button>
        if ($k == 0) {
            $ad = " class=\"active\"";
            $adc = " active";
        }
        $tb = $tb . "<li role=\"$tbl\"" . $ad . ">"
                . "<a href=\"#" . $tbl . "\" aria-controls=\"$tbl\" role=\"tab\" data-toggle=\"tab\">"
                . $tbl . "</a></li>";
        $tbc = $tbc . "<div class=\"tab-pane" . $adc . "\" id=\"$tbl\">.$btn_new";
        $k++;
        $ad = "";
        $adc = "";
        /* if(isset($qual))
          {
          $qual=" where ".$qual;
          $data_sql=$data_sql.$qual;
          } */
        //only get pages if this is main table
        //if($_GET['page']==$tbl)
        //$data_sql=getPagesql($data_sql,5);
        //echo $data_sql;
        $result1 = mysql_query($sql1);
//mode 0 is columnar and mode 1 for row-wise printing

        $opt = array(1 => "k");
        $mode = 1;
        $j = 0;

        $mode = $md;
        if ($mode == 1) {
//Open Table
            $a = $tg_top;

//Print Header row
            $a = $a . "<tr>";
            while ($row = mysql_fetch_array($result1)) {
                if ((empty($arr) || in_array($row['name'], $arr)))
                    $a = $a . $tg_hdr . $row['alias'] . $tg_hdr_cl;
            }
            $a = $a . "</tr>";

//Print Data rows
            $result_data = mysql_query($data_sql);
            while ($datarow = mysql_fetch_array($result_data)) {
                $a = $a . $tg_ro;
                $result1 = mysql_query($sql1);
                while ($row = mysql_fetch_array($result1)) {
                    if (empty($arr) || in_array($row['name'], $arr)) {
                        if ($row['type'] == "idate")
                            $a = $a . $tg_td . getmydate($datarow[$row['name']]) . $tg_td_cl;
                        //$a=$a.$tg_td.$datarow[$row['name']].$tg_td_cl;
                        elseif ($row['type'] == "password") {
                            $a = $a . $tg_td . $tg_td_cl;
                        } elseif ($row['type'] == "option") {
                            $j = 1;
                            $a = $a . $tg_td;
                            $sql_opt = "select * from field_option where tblid=" . $row['tblid'] . " and fieldid=" . $row['fieldid'] . " and value='" . $datarow[$row['name']]."'";
							
							//echo $sql_opt;//--------------------------------------- dip comments----------------------------------------------
                            $result_opt = mysql_query($sql_opt);
                            while ($row_opt = mysql_fetch_array($result_opt)) {
                                $alias = '';
                                $alias = $row_opt['alias'];
                            }
                            $alias = isset($alias) ? $alias : NULL;
                            $a = $a . $alias . $tg_td_cl;
                            $j++;
                        } elseif ($row['type'] == "list") {
                            $a = $a . $tg_td;
                            //adding new on13/12/2014.can be deleted
                            $sql_filter = "select source,filter,id,value,alias from valuelist where id in (select optid from field_option where tblid=" . $row['tblid'] . " and fieldid=" . $row['fieldid'] . ")";
                            //echo $sql_filter;
                            $result_filter = mysql_query($sql_filter);
                            $vsource = mysql_result($result_filter, 0, 0);
                            $vfilter = mysql_result($result_filter, 0, 1);
                            $vid = mysql_result($result_filter, 0, 2);
                            $vvalue = mysql_result($result_filter, 0, 3);
                            $valias = mysql_result($result_filter, 0, 4);
                            $vfilter = $vfilter == null ? "" : " where " . $vfilter;
                            $sql_opt = "select " . $vvalue . " 'value'," . $valias . " 'alias' from " . $vsource . $vfilter . " and " . $vvalue . "='" . $datarow[$row['name']]."'";
                            //echo $sql_opt;	
                            //Completion of change
                            $result_opt = mysql_query($sql_opt);
                            $opt[$j] = "";
                            $alias = '';
                            if ($result_opt) {
                                while ($row_opt = mysql_fetch_array($result_opt)) {
                                    $opt[$j] = $opt[$j] . $tg_opt . $row_opt['value'] . $tg_cl . $row_opt['alias'] . $tg_opt_cl;
                                    if ($row_opt['value'] == $datarow[$row['name']]) {
                                        $alias = $row_opt['alias'];
                                    }
                                }
                            }
                            //}
                            //below handles code if no value is set and also instead of value shows alias
                            $alias = (isset($alias) && ($alias != null)) ? $alias : "";
                            //echo "alias is".$alias;
                            $a = $a . $alias . $tg_td_cl;
                            $j++;
                        } elseif ($row['dbindex'] == "primary") {
                            $a = str_replace('constant', $datarow[$row['name']], $a);
                            $a = $a . $tg_td . "<a onclick=updateRec(" . $datarow[$row['name']] . ",'" . $tbl . "'" . ") href=\"#\"" . ">" . $datarow[$row['name']] . "</a>" . $tg_td_cl;
                            $a = $a . $tg_ip . $tg_ip_type . $tg_hidden . $tg_ip_name . $row['name'] . $tg_ip_size . $row['size'] . $tg_ip_value;
                            $a = $a . $datarow[$row['name']] . $tg_ip_cl;
                        } else
                            $a = $a . $tg_td . $datarow[$row['name']] . $tg_td_cl;
                    }elseif ($row['dbindex'] == "primary" && !in_array($row['name'], $arr)) {
                        $a = str_replace('constant', $datarow[$row['name']], $a);
                        $a = $a . $tg_ip . $tg_ip_type . $tg_hidden . $tg_ip_name . $row['name'] . $tg_ip_size . $row['size'] . $tg_ip_value;
                        $a = $a . $datarow[$row['name']] . $tg_ip_cl;
                    }

                    //close while loop
                }
                $a = $a . $tg_ro_cl;
                //echo "ais".$a;
            }
//Close Table
            $a = $a . $tg_top_cl;
        }
        $tbc = $tbc . "<p>" . $a . "</p></div>";
    }
//echo "tbcis".$tbc."this";
    $tbc = $tb . "</ul>" . "<div class=\"tab-content\">" . $tbc . "</div></div>";
    return $tbc;
}