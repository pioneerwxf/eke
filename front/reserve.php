<? $current='h';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php"); ?>
<div id="left">

<? 	if(isset($_GET["bookid"]))
		$bookid=$_GET["bookid"];
	else if(isset($_POST["bid"]))
		$bookid=$_POST["bid"];
	$book=select("book","bookid='$bookid'");//找到该书
	$shopid=$book["shopid"];//找到该书的书店id
	$userid=$book["userid"];//找到该书的书主id
	$owner=select("eke_members","uid='$userid'");//找到该书的书主
	$shop=select("shop","shopid='$shopid'");//找到该书的书店
?>

<? //预定图书?>
<div class="left_box">
<h3><a name="adb" id="adb"></a>详细信息</h3>
<span class="float_right"><img src="../images/back.gif" alt="" /><a href="index.php">返回首页</a></span></div>
  <table style="border:#FFCC66 dotted 1px; border-top:none;" width="100%">
    <tr>
      <td width="11%">书名：</td>
      <td width="43%"><?=$book["title"]?></td>
      <td width="7%">原价：</td>
      <td width="18%"><?=$book["price0"]?>
        元</td>
      <td width="21%" rowspan="5"><? 
			if($book["tag"]==2)
			{?>
          <div class="order_book_frame">
          <? }else {?>
          <div class="book_frame" >
            <? }?>
            <? include("book_frame.php");?>
        </div></td>
    </tr>
    <tr>
      <td>作者：</td>
      <td><?=$book["author"]?></td>
      <td>现价：</td>
      <td><?=$book["price1"]?>
        元</td>
    </tr>
    <tr>
      <td>出版社：</td>
      <td><?=$book["public"]?></td>
      <td>新旧：</td>
      <td><?=$book["old_degree"]?>
        成新</td>
    </tr>
    <tr>
      <td>该书来自：</td>
      <td><a href="bookshop.php?shop_id=<?=$shopid?>">【
        <?=$shop["shopname"]?>
        】店，去看看其他书</a></td>
      <td>书主：</td>
      <td><a href="../bbs/space.php?username=<?=$owner["username"]?>" title="点击看<?=$owner["username"]?>本站博客">
        <?=$owner["username"]?>
      </a></td>
    </tr>
    <tr>
      <td>附加信息：</td>
      <td colspan="3"><?=$book["info"]?></td>
    </tr>
  </table><div class="clear_height" ></div>
<? if($book["tag"]!=3) {?>
<form action="reserve.php?action=rsv" method="post">
  <div class="left_box">
  <h3><a name="adb" id="adb"></a>预定该书</h3>
  <span class="float_right"><img src="../images/sendmail.gif" alt="" /><a href="../bbs/pm.php?action=send&uid=<?=$userid?>">向书主发站内消息</a></span>
  <div class="notes">如果您有意要购买该书，您只要点击<strong class="highlight">确认预定</strong>就可以看到书主<strong class="highlight"> <a href="../bbs/space.php?username=<?=$owner["username"]?>" title="点击看<?=$owner["username"]?>本站博客">
    <?=$owner["username"]?>
  </a>的联系方式</strong>了</div>
  </div>
<table width="100%" border="0">
  <tr>
    <td width="10%">预订者</td>
    <td width="33%"><label>
      <input name="user" type="text" id="user" value="<?
	  if(isset($discuz_userss))
	  echo $discuz_userss;
	  else echo "易客"; ?>" />
    </label></td>
    <td width="11%">联系方式</td>
    <td width="46%"><input name="tele" type="text" id="tele" />
      建议填写手机长号</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label>
      <input type="hidden" name="msgtoid" value="<?=$book["userid"]?>" />
      <input type="hidden" name="bid" value="<?=$book["bookid"]?>" />
    </label></td>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit22" value="确认预定" /></td>
  </tr>
</table>
<p>&nbsp;</p>
</form>
<? }
else echo "&nbsp;&nbsp;该书已经售出，不能再预定了";?>
<div class="clear_height" ></div>
</div>
	<? include("right-bar.php");?>
	<? include("footer.php");?>		
<?
	if(isset($_GET["action"]) and $_GET["action"]=='rsv' )
	{
	$bookid=$_POST["bid"];
	$book=select("book","bookid='$bookid'");//找到该书
	$shopid=$book["shopid"];//找到该书的书店id
	//$userid=$book["userid"];//找到该书的书主id
	//$owner=select("eke_members","uid='$userid'");//找到该书的书主
	$shop=select("shop","shopid='$shopid'");//找到该书的书店
$msgfrom=$discuz_userss;
$msgfromid=$discuz_uid;
$msgtoid=$_POST["msgtoid"];
$date=date("Y-m-d H:i:s");
//$fold="inbox";
$user=$_POST["user"];
$tele=$_POST["tele"];
$bid=$_POST["bid"];

if(empty($user) or empty($tele))
{echo ("<script type='text/javascript'> alert('您忘记填写预订信息了！');history.go(-1);</script>");
exit;}
//插入数据库
//两封站内信的主题和内容
$subject="来自".$user."的书籍预订信息";
$message="【".$user."】有意购买您的《".$book["title"]."》一书，Ta的联系方式：【".$tele."】。请您在书籍成交后及时登录本站将您出售的这本书的状态改为“已售”，这将会提高您的书店排位，谢谢您的合作！";
//给书主发送消息
$sql="INSERT INTO eke_pms (
				msgfrom, msgfromid, msgtoid, folder, new, subject, dateline, message )VALUES(
				'$msgfrom', '$msgfromid', '$msgtoid', 'inbox', '1', '$subject', '$timestamp', '$message')";
//给预订者发送书主的联系方式
$msgfrom1=$user;
$msgfromid1=$msgtoid;
$msgtoid1=$msgfromid;

$subject1="《".$book["title"]."》书主的联系方式";
$message1="您订购的《".$book["title"]."》一书的书主的手机是:【".$shop["phone"]."】。Email为：【".$shop["email"]."】，eke欢迎并感谢您的使用，请及时联系书主吧~";
$sql1="INSERT INTO eke_pms (
				msgfrom, msgfromid, msgtoid, folder, new, subject, dateline, message )VALUES(
				'$msgfrom1', '$msgfromid1', '$msgtoid1', 'inbox', '1', '$subject1', '$timestamp', '$message1')";
//将该信息写入预定信息表order里
$order="INSERT INTO eke.order (bid,user,tele,date,tag)VALUES('$bid','$user','$tele','$date','2')";
//同时更改book表的该书的状态
$book="update eke.book set tag=2 where bookid='$bid'";
$send_msg=mysql_query($sql);
$send_order=mysql_query($order);
$update_book=mysql_query($book);
$send_msg1=mysql_query($sql1);
$phone=$shop["phone"];
if ($send_msg and $send_order and $update_book and $send_msg1)
echo ("<script type='text/javascript'> alert('已成功预定并向”书主“和”您“都发送了站内消息！书主的手机为:$phone');location.href='myshop.php';</script>");

else{
echo ("<script type='text/javascript'> alert('数据库操作失败！');history.go(-1);</script>");
}
}
?>