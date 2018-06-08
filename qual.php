

<div padding=10>
<?php
//$tbl='leavetable';
//$qual_orig=" 1=1";
//$field_edit=array();
//$field_show=array('empname','day','type','fromdate','todate','ndays','comments','status');

$s = mysql_query("select name, alias from field where tblid = (select tblid from config where name = '$tbl') and dbindex != 'primary'");
echo "<select style='height: 26px;' name='fields'>
<option value='' >--None--</option>";
while($row = mysql_fetch_array($s)){
	echo "<option value = $row[name]>$row[alias]</option>";
}
echo "</select>&nbsp;";
echo "<select style='height: 26px;' name='operator'>
<option value='' >--None--</option>
<option value='='>   =	</option>
<option value='>'>   >	</option>
<option value='>='>  >=	</option>
<option value='<'>   <	</option>
<option value='<='>  <=	</option>
<option value='!='>  !=	</option>
<option value='<>'>  <>	</option>
</select>&nbsp;";

echo "<input type = 'text' name = 'data' placeholder = 'Enter Value'  value = ''>&nbsp;";

echo "<input class='btn btn-default' type='button' id = 'and' name='and' value='AND'>&nbsp;";
echo "<input class='btn btn-default' type='button' id = 'or' name='or' value='OR'><br>&nbsp;";
echo "<p style='color:red' id='demo'></p>";
echo "<input type = 'text' id = 'helo' name = 'qual_field' style='width:100%'><br>";

echo "<br><input class='btn btn-success' type='submit' name='submit' value='Search Leaves'><br><br>";

/*if(isset($_POST['submit'])){
	$qual = $_POST['qual_field'];
	echo display($tbl,$qual,1,$field_show);
}*/

/* if(isset($_POST['data'])){
	
	if($_POST['fields'] == 'fromdate' || $_POST['fields'] == 'todate' || $_POST['fields'] == 'doj'){
		$date = $_POST['data'];
		$date_time = setmydate($date);
		$qual=isset($_POST['data'])?$_POST['fields']." ".$_POST['operator']." '".$date_time."' and ".$qual_orig:$qual_orig;
	}
	else{
	$qual=isset($_POST['data'])?$_POST['fields']." ".$_POST['operator']." '".$_POST['data']."' and ".$qual_orig:$qual_orig;
	}
	echo 'qual'.$qual."<br>";
}
 */
 
?>
<script>

document.getElementsByName("fields")[0].onchange = function() {
	var t = document.getElementsByName("qual_field")[0].value;
	var field = document.getElementsByName("fields")[0].value;
	if(field == 'fromdate' || field == 'todate' || field == 'doj'){
		document.getElementById("demo").innerHTML = 'Date Format Should be MM-DD-YYYY';
	}
	else{document.getElementById("demo").innerHTML = '';}
	document.getElementsByName("qual_field")[0].value = t + " "+field;
}

document.getElementsByName("operator")[0].onchange = function() {
	var t = document.getElementsByName("qual_field")[0].value;
	var field = document.getElementsByName("operator")[0].value;
	document.getElementsByName("qual_field")[0].value = t + field;
}

document.getElementsByName("data")[0].onblur = function() {
	var field = document.getElementsByName("fields")[0].value;
	if(field == 'fromdate' || field == 'todate' || field == 'doj'){
		
		var data = document.getElementsByName("data")[0].value;
		var data = data + " 03:30:00";
		var datum = Date.parse(data).toString();
		datum = datum.slice(0, -3);
		var t = document.getElementsByName("qual_field")[0].value;
		document.getElementsByName("qual_field")[0].value = t + "'"+ datum + "'";
		
	}
	else{
		var data = document.getElementsByName("data")[0].value;
		var t = document.getElementsByName("qual_field")[0].value;
		document.getElementsByName("qual_field")[0].value = t + "'"+ data + "'";
	}
}

document.getElementById("and").onclick = function() {
	
	var t = document.getElementsByName("qual_field")[0].value;
	document.getElementsByName("fields")[0].value = '';
	document.getElementsByName("operator")[0].value = '';
	document.getElementsByName("data")[0].value = '';
	if(t != ''){
		var res = t.slice(-3);
		if(res != "and"){			
			document.getElementsByName("qual_field")[0].value = t + " and";
		}
	}	
}

document.getElementById("or").onclick = function() {
	
	var t = document.getElementsByName("qual_field")[0].value;
	document.getElementsByName("fields")[0].value = '';
	document.getElementsByName("operator")[0].value = '';
	document.getElementsByName("data")[0].value = '';
	if(t != ''){
		var res = t.slice(-2);
		if(res != "or"){
			document.getElementsByName("qual_field")[0].value = t + " or";
		}
	}	
}

</script>
</div>