<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
			<td width="68%" class="tr" style="padding-top:6px;">
			<a href="<? echo $path;?>?page=1">HOME</a>
		&nbsp;&nbsp;
		<? if($page!=1) echo "<a href=".$path."?page=".($page-1).">Prev</a>";
		else echo "Prev";?>
		&nbsp;&nbsp;
		<? if($page!=$pagecount) echo "<a href=".$path."?page=".($page+1).">NEXT</a>";else echo "NEXT";    ?>&nbsp;&nbsp;
		<a href="<? echo $path;?>?page=<? echo $pagecount?>">END</a>&nbsp;&nbsp;
<span class="fontr"><?=$page?></span>/<span class="fontr"><?=$pagecount?></span> </td>
			<form id="form1" name="form1" method="post" action="<? echo $path;?>">
			<td width="24%" class="tr">
			  Goto
			  
			  page                          
		      <input name="page" type="text" style="width:20px"/></td>
			<td width="8%" class="tr"><input type="image" src="../images/go.gif" name="Submit332" value="" class="input_go"/></td>
			</form> 
    </tr>
</table>
<? if($_POST) {
	$path=$_SERVER["PHP_SELF"]; 
	$page=$_POST["page"];
	if(empty($_POST["page"]))
	echo ("<script type='text/javascript'> alert('Please input the page you want to go!');history.go(-1);</script>");
	else{
	$page=$_POST["page"];
	echo ("<script type='text/javascript'>location.href='$path?page=$page';</script>");
	}
	}
?>