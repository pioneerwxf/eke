<? $current='h';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php"); ?>
<div id="left">
<? 
$act=$_GET["act"];
if(!$act)
{?>
<form id="form1" name="form1" method="post" action="link_apply.php?act=apply">
  <table width="100%" border="0" >
    <tr>
      <td width="24%">链接网站名称</td>
      <td width="76%"><label>
        <input name="title" type="text" id="title" />
      </label></td>
    </tr>
    <tr>
      <td>链接网站地址</td>
      <td><input name="address" type="text" id="address" value="http://" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="Submit" value="提交" class="button"/>
      </label></td>
    </tr>
  </table>
</form>
<? } else if($act) {
$title=$_POST["title"];
$address=$_POST["address"];
$value=0;
$type="frd_link";
$addtime=date("Y-m-d");
$sql="insert into t_ads (title,link,value,type,addtime) values ('$title','$address','$value','$type','$addtime')";
		//echo $sql;
		if(mysql_query($sql))
		echo "<script type='text/javascript'>alert('申请完毕，等待管理员审批中...');location.href='index.php';</script>";
		else echo ("<script type='text/javascript'> alert('数据库操作失败！');history.go(-1);</script>");
}?>
</div>