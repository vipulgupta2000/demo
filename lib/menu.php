<ul class="nav nav-tabs nav-stacked">
    <div class="panel-group" id="panel-396820" >
        <li class="panel-heading loc">
<a class="panel-title collapsed" 
data-toggle="collapse" data-parent="#panel-396820" 
href="#panel-element-852349">Sysadmin</a>
</li>
    <li id="panel-element-852349" class="panel-collapse collapse locchild"><a href="home.php?page=formrel">formrel</a></li>
    </div>
    <li><a class="menu_left" href="home.php?page=payroll">Payroll</a></li>
</ul>
<ul class="nav nav-tabs nav-stacked">
<?php 
$a='';
$b='';
$sql="select tblid,name,alias,style from config";
if(!$result=mysql_query($sql))
{die(mysql_error());
}else
{
while($row = mysql_fetch_array($result))
{
if(($row['tblid']<15) && $_SESSION['SESS_perm']=='sys_admin')
{
 
$b = $b."<li><a class=\"menu_left\" href=\"home.php?page=".$row['name']."\">".$row['alias']."</a></li>";
}elseif($_SESSION['SESS_perm']=='sys_admin')
   if($row['name']==$_GET['page'])
     $a = $a."<li class=\"sel\"><a class=\"menu_left\" href=\"home.php?page=".$row['name']."\">".$row['alias']."</a></li>";
        else
    $a = $a."<li><a class=\"menu_left\" href=\"home.php?page=".$row['name']."\">".$row['alias']."</a></li>";
}
}
$sql1="select tblid,name,alias,groupname from config c,access a where c.name=a.page_name";
if(!$result1=mysql_query($sql1))
{die(mysql_error());
}else
{
while($row1 = mysql_fetch_array($result1))
{
if(($row1['groupname']==$_SESSION['SESS_perm']))
$a = $a."<li><a class=\"menu_left\" href=\"home.php?page=".$row1['name']."\">".$row1['alias']."</a></li>";
}
}
echo "<li class=\"dropdown\">";
if($_SESSION['SESS_perm']=='sys_admin'){
echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Administration<b class=\"caret\"></b></a>";
echo "<ul class=\"dropdown-menu\">";
echo $b;
echo "</ul></li>";
}

echo $a;
//echo "<li class=\"dropdown\">";
//echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Wiki<b class=\"caret\"></b></a>";
//echo "<ul class=\"dropdown-menu\">";

//echo "</ul></li>";


?>
</ul>
