<? $current='ct';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php"); ?>

<div id="left">
  <div class="left_articles">
    <h3>联系我们</h3>
	<div class="notes">
	    您对eKe有什么意见、建议或问题，欢迎向我们提出
	</div>
<div class="clear_height" ></div>
<form id="contact" name="contact" method="post" action="post_msg.php">
  <table width="100%" border="0" align="center" style="border-bottom:#999999 1px solid;">
	<tr>
	  <td width="49%" rowspan="5" valign="top" style="border-right:1px #CCCCCC dashed;">
	  <?
		$query=query("t_basicdata","type='contact'");
		$data = mysql_fetch_array($query);
		if($data) echo $data["content"];
		?></td>
	  <td width="8%"><div align="right"> 昵称: </div></td>
	  <td width="43%" height="25"><label>
		<input name="name" type="text" id="name" size="25" />
		<span style="font-weight: bold; color: #FF6600">*</span></label></td>
	</tr>
	<tr>
	  <td><div align="right">Email:</div></td>
	  <td height="25"><input name="email" type="text" id="email" size="25" />
		  <span style="font-weight: bold; color: #FF6600">*</span></td>
	</tr>
	<tr>
	  <td><div align="right">电话:</div></td>
	  <td height="25"><input name="tele" type="text" id="tele" size="25" /></td>
	</tr>
	<tr>
	  <td valign="middle"><div align="right">留言: </div></td>
	  <td><label>
		  <textarea name="content" cols="21" rows="3"></textarea>
	  <span style="font-weight: bold; color: #FF6600">* </span>
		<br />
	  请勿在留言中输入 &quot; ' &quot;
		</label></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>
		<input onclick="return validForm();" type="image" src="../images/en_submit.gif" name="Submit" value="Submit" />
		&nbsp;&nbsp;
		<a href="javascript: document.contact.reset();"><img src="../images/en_reset.gif" name="bt_rest" width="54" height="18" style="border:0px; margin:0; padding:0;" /></a>                  </td>
	</tr>
  </table>
</form>
</div>
  <div class="left_box">
			<h3 align="center" style="background:none;">最近留言</h3>
</div>
            <table width="100%" style="border-left:1px #CCCCCC solid; border-left:1px #CCCCCC solid; border-right:1px #CCCCCC solid; border-bottom:1px #CCCCCC solid;" align="center">
	<tr>
		<td>
			<?
			$query=query("t_qalist","tag>0 ORDER BY date DESC");
			$qalist = mysql_fetch_array($query);
			$rsnum=mysql_num_rows($query);
			if ($rsnum==0){
			echo "暂时没有留言";
			exit;
			}
			//分页设置
			$i=0;
			$pagesize=3; //每页显示的条数
			include("../include/page_num.php");
			while(($qalist = mysql_fetch_array($query))&&$i<$pagesize){
		?>        	
		<div class="mgt10">
          	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="padding:0px 20px;">
				<tr>
    				<td width="13%" style="font-size:9px;"><span style="color:#009933; font-weight:bold;"><a name="<?=$qalist["id"]?>" id="1"></a>NO.</span><?=$i+1?></td>
    				<td width="59%"><?=$qalist["name"]?></td>
			      	<td width="28%" align="left" style="font-size:9px;"><?=$qalist["date"]?></td>
				</tr>
  				<tr>
    				<td colspan="3"><?=$qalist["content"]?></td>
    			</tr>
  				<tr>
    				<td class="fontr">回复：</td>
    				<td colspan="2"><?=$qalist["reply"]?></td>
  				</tr>
			</table>
<img style="border:none" src="../images/feedback_bt1.jpg" width="450" height="7" align="middle"/>       	  </div>
		<? 
			$i++;
			} 
		 ?>
		</td>
	</tr>
	<tr>
		<td><? include("../include/page.php");?></td>
	</tr>
</table>
<div class="clear_height" ></div>
</div>
	<? include("right-bar.php");?>
	<? include("footer.php");?>		
<SCRIPT language=javascript>
function validForm( ) {
	myform = window.document.contact;
		if(myform.name.value==''){
			window.alert('Please input your name!');
			myform.name.focus();
			return false;
		}
		if(!isEmail(myform.email.value)){
			window.alert('Please input valid Email');
			myform.email.focus();
			return false;
		}
		if(myform.content.value==''){
			window.alert('Please input you content!');
			myform.content.focus();
			return false;
		}
	return true;
}
function isEmail(Strings)
{
	if ((Strings=="")||(Strings.indexOf ("@")==-1)||(Strings.indexOf (".")==-1)){
		return false;
	}
	else {
		return true;
	}


}
</SCRIPT>