<? $current='m';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php"); ?>
<div id="left">

<? 
	if(isset($discuz_uid) and $discuz_uid )
	{
		$array=select("shop","userid=$discuz_uid");
		$user=select("eke_members","uid=$discuz_uid");
		$shopid=$array['shopid'];//提取当前用户的书店id
	}
	if($array['level']=='-1'){//检查书店是否被删除
		echo "<script type='text/javascript'>alert('您的书店不符合要求已被管理员删除,如要恢复请联系我们!');location.href='contact.php';</script>";
		exit();
	}
?>

  <? //书店基本信息
if(isset($discuz_uid) and $discuz_uid)
{
?>
<div align="center">
<? if($array["poster"])	{ ?><img src="./banner/<?=$array["poster"]?>" height="120" width="635" alt="" align="middle" /> 
<? }else {?><img src="../images/banner.jpg" height="120" width="635" alt="" align="middle" /><? }?>
</div>
  <div class="left_box">
<h3><a name="basic" id="basic"></a><?=$array["shopname"]?> 店基本信息</h3>
<span class="float_right"><a href="shop_setup.php">点此修改本店信息</a></span>
<div class="notes">点击右侧修改本店信息--></div></div>
<table width="100%"  style="border:#FFCC66 dotted 1px; border-top:none;">
  <tr>
    <td colspan="4">这是属于您的书店地址，您可以在论坛里为自己广告：<a href="<?
		$sys_query=query("t_sys_config","name='webaddress'");
		$sys_array = mysql_fetch_array($sys_query);
		if($sys_array) echo $sys_array["value"];
		?>/front/bookshop.php?shop_id=<?=$shopid?>" class="highlight"> <?=$sys_array["value"]?>/front/bookshop.php?shop_id=<?=$shopid?>
    </a></td>
    </tr>
  <tr>
    <td width="9%">店名：</td>
    <td width="36%"><?=$array["shopname"]?></td>
    <td width="10%">店长：</td>
    <td width="45%"><?=$array["owner"]?></td>
  </tr>
  <tr>
    <td>藏书：</td>
    <td><?=$array["booknum"]?>本</td>
    <td>成交：</td>
    <td><?=$array["soldnum"]?>本</td>
  </tr>
  <tr>
    <td>口号：</td>
    <td><?=$array["adv"]?></td>
    <td>联系方式：</td>
    <td><?=$array["phone"]?></td>
  </tr>
  <tr>
    <td>学院：</td>
    <td><?=$array["college"]?></td>
    <td>E-mail：</td>
    <td><?=$array["email"]?></td>
  </tr>
  <tr>
    <td>创建人：</td>
    <td><?=$discuz_userss?></td>
    <td>创建日期：</td>
    <td><?=$array['date']?></td>
  </tr>
</table>
<div class="clear_height" ></div>

<? //添加藏书?>
<div class="left_box">
<h3><a name="adb" id="adb"></a>添加藏书</h3>
<div class="notes">快快添书吧，藏书越多，书店排位越高</div></div>
<form action="post.php?action=adb&amp;shopid=<?=$array["shopid"]?>" method="post" enctype="multipart/form-data" id="addbook">
  <table width="100%" style="border:#FFCC66 dotted 1px; border-top:none;">
    <tr>
      <td colspan="4"  class="highlight">**必填信息：</td>
      </tr>
    <tr>
      <td width="7%">书名：</td>
      <td width="38%"><label>
        <input name="title" type="text" id="title" />
      </label></td>
      <td width="10%">原价：</td>
      <td width="45%"><input name="price0" type="text" id="price0" size="5" />
        元</td>
    </tr>
    <tr>
      <td>作者：</td>
      <td><input name="author" type="text" id="author" /></td>
      <td>现价：</td>
      <td><input name="price1" type="text" id="price1" size="5" />
        元</td>
    </tr>
    <tr>
      <td colspan="4"><span class="highlight">**补充信息：</span></td>
    </tr>
    <tr>
      <td>出版社</td>
      <td><input name="public" type="text" id="public" /></td>
      <td>新旧程度</td>
      <td><select name="old_degree" id="old_degree">
        <option value="10" selected="selected">全新</option>
        <option value="9">九成新</option>
        <option value="8">八成新</option>
        <option value="7">七成新</option>
        <option value="6">六成新</option>
        <option value="5">五成新</option>
        <option value="4">四成新</option>
        <option value="3">三成新</option>
        <option value="2">两成新</option>
        <option value="1">一成新</option>
        <option value="0">请选择</option>
      </select></td>
    </tr>
    <tr>
      <td>分类</td>
      <td><select name="sort" id="sort">
          <option value="A">A：马列、毛邓</option>
          <option value="B">B：哲学、宗教</option>
          <option value="C">C：社会科学</option>
          <option id="color" value="D">D：政治、法律</option>
          <option value="E">E：军事</option>
          <option id="color"  value="F">F：经济</option>
          <option value="G">G：科教、文体</option>
          <option id="color"  value="H">H：语言、文字</option>
          <option  id="color" value="I">I：文学</option>
          <option value="J">J：艺术</option>
          <option value="K">K：历史、地理</option>
          <option value="N">N：自然科学</option>
          <option  id="color" value="O">O：数、理、化科学</option>
          <option value="P">P：天文、地球科学</option>
          <option value="Q">Q：生物科学</option>
          <option value="R">R：医学、卫生</option>
          <option value="S">S：农业科学</option>
          <option  id="color" value="T">T：工业、电脑技术</option>
          <option value="U">U：交通运输</option>
          <option value="V">V：航空航天</option>
          <option value="X">X：环境科学</option>
          <option value="Z">Z：综合类、工具书</option>
          <option value="0" selected="selected">未分类</option>
      </select></td>
      <td>其他信息</td>
      <td><label>
        <input name="info" type="text" id="info" value="没啥多余信息" />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="center">
          <input type="submit" name="Submit22" value="添加"  class="button"/>
      </div></td>
      <td>&nbsp;</td>
      <td><div align="center">
          <input type="reset" name="Submit2" value="重填" class="button"/>
      </div></td>
    </tr>
  </table>
</form>
<div class="clear_height" ></div>
<? //预定图书的显示?>
<div class="left_box">
<h3><a name="allbooks" id="mybooks"></a><a href="mybook.php?tag=1">我的最新藏书</a></h3>
<span class="float_right"><a href="mybook.php?tag=1">更多more>></a></span>
<div class="notes">说明：红色书皮为已经被预定的书籍，请及时处理。</div>
</div>
  <table width="100%" border="0">
    <tr>
      <td bgcolor="#FFFF66">&nbsp;
        <div class="notes">郑重说明：为了不产生误导信息，请及时将已经成交的被预定书籍状态修改为“已售”，否则系统会在书籍被预定后一段时间内自动转为“已售”状态。作为店长，这是您的权利也是您的责任，谢谢您的配合。</div></td>
      </tr>
    <tr>
      <td><?
$query=query("book","tag>0 and tag<3 and shopid='$shopid' order by bookid DESC");
$book = mysql_fetch_array($query);
$rsnum=mysql_num_rows($query);
if ($rsnum==0){
echo "该书店暂时没有藏书";
//exit;
}
?>
          <? 
			$query=query("book","tag>0 and tag<3 and shopid='$shopid' ORDER BY tag DESC,bookid DESC limit 30");
			$book = mysql_fetch_array($query);
			while($book){
			?>
	<div class="book_frame_large" >
	<?
			if($book["tag"]==2)
			{ $status='预定';
			?>
          <div class="order_book_frame">
		  <? }else { 
		  $status='待售'; ?>
		  <div class="book_frame" >
            <? }?>
			<? include("book_frame.php");?>
	      </div>
		  <div class="book_note" >
		    <form id="form2" method="post" action="edit_book.php?act=tag&id=<?=$book["bookid"]?>">
		      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><select name="tag" id="tag">
					<option value="1" <? if ($book["tag"]==1) {?> selected="selected" <? }?>>待售</option>
					<option value="2" <? if ($book["tag"]==2) {?> selected="selected" <? }?>>预定</option>
					<option value="3" <? if ($book["tag"]==3) {?> selected="selected" <? }?>>已售</option>
                  </select></td>
                  <td style="padding-top:5px;">
                    <input type="image" src="../images/go.gif" name="Submit3" value="更改" />                  </td>
                </tr>
              </table>
              </form>
		    <a href="edit_book.php?act=dele&id=<?=$book["bookid"]?>" onclick="{if(confirm('确定要删除该书？')){return true;}return false;}">删除</a>| <a href="edit_book.php?act=edit&id=<?=$book["bookid"]?>">编辑</a>|<a href="edit_book.php?act=edit&id=<?=$book["bookid"]?>#reserved"> 查看</a> </div>
		  </div>
		  <? $book = mysql_fetch_array($query);
		} ?>      </td>
    </tr>
  </table>
  <p>&nbsp;</p>
<? //已售图书的显示?>
  <div class="left_box">
    <h3><a name="soldbooks" id="mybooks"></a><a href="mybook.php?tag=0">我的最新已售</a></h3>
    <span class="float_right"><a href="mybook.php?tag=0">更多more>></a></span></div>
  <table width="100%" border="0">
    <tr>
      <td width="30%">本店现有藏书 
        <?=$array["booknum"]?>
        本</td>
      <td width="35%">本店一共售出
        <?=$array["soldnum"]?> 
        本 </td>
      <td width="35%">本店的成交率为
        <? 
		if(($array["booknum"]+$array["soldnum"])>0)
		 echo number_format($array["soldnum"]*100/($array["booknum"]+$array["soldnum"]),2)."%";
		else echo "0.00%";?></td>
    </tr>
    <tr>
      <td colspan="3"><?
$query=query("book","tag>0 and tag<3 and shopid='$shopid' ORDER BY date DESC");
$book = mysql_fetch_array($query);
$rsnum=mysql_num_rows($query);
if ($rsnum==0){
echo "该书店暂时没有藏书";
//exit;
}
?>
          <? 
			$query=query("book","tag=3 and shopid='$shopid' ORDER BY date DESC limit 30");
			$book = mysql_fetch_array($query);
			while($book){
			?>
	<div class="book_frame_large" >
          <div class="sold_book_frame">
           <div class="book_author" >
              <?=$book["author"]?>
              著 </div>
		    <div class="book_text" > <a href="reserve.php?bookid=<?=$book["bookid"]?>"> <img style="float:right; margin-bottom:20px;" src="../images/head_06.gif" alt="点击预定，放入我的购物框" width="16" height="11" /></a> </div>
		    <div class="book_title"><a class="info" href="reserve.php?bookid=<?=$book["bookid"]?>" title="" target="subheaderFrame">
		      <?=$book["title"]?>
              <span class="infobox">
              <table width="100%" border="0">
                <tr>
                  <td colspan="2">书名：
                      <?=$book["title"]?></td>
                </tr>
                <tr>
                  <td colspan="2">出版社：
                      <?=$book["public"]?></td>
                </tr>
                <tr>
                  <td width="65%" >作者：
                      <?=$book["author"]?></td>
                 <td width="35%" rowspan="2" ><div align="left"><strong class="highlight">
                 ：已售：                 </strong></div></td>
                </tr>
                <tr>
                  <td>新旧程度：
                      <?=$book["old_degree"]?></td>
                </tr>
              </table>
              </span> </a> </div>
		    <div class="book_price" >
              <div class="before">
                <?=$book["price0"]?>
                元</div>
		      <div class="now">
		        <?=$book["price1"]?>
		        元</div>
	        </div>
          </div>
		  <div class="book_note" >
		    <form id="form2" method="post" action="edit_book.php?act=tag&amp;id=<?=$book["bookid"]?>">
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><select name="tag" id="tag">
                      <option value="1">待售</option>
                      <option value="2">预定</option>
                      <option value="3" selected="selected">已售</option>
                  </select></td>
                  <td style="padding-top:5px;"><input type="image" src="../images/go.gif" name="Submit32" value="更改" />
                  </td>
                </tr>
              </table>
		      </form>
		  </div>
		  </div>
        <? $book = mysql_fetch_array($query);
		} ?>      </td>
    </tr>
  </table>
  <p>&nbsp;</p>

    <? }
else if(!isset($discuz_uid) or !$discuz_uid)
{?>
<div class="left_articles">
				<h3>进入我的书店</h3>
  <table width="100%" border="0">
    <tr>
      <td width="47%"><div class="shop_1">
	 <form action="../bbs/logging.php?action=login&amp;loginsubmit=true" method="post">
	  <div class="shop_content">
	  <table width="100%" height="71%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="93"><label></label>              <label>您还没有登录自己的书店,请在下方登录、注册或逛逛</label></td>
            <td height="93">&nbsp;</td>
          </tr>

          <tr>
            <td width="70%" height="30" bgcolor="#FFFFD0">帐户
              <label>
              <input name="username" type="text" id="username" size="8" />
              </label></td>
            <td width="30%" rowspan="2" bgcolor="#FFFFD0"><label>
              <input name="Submit4" type="image" value="提交" src="../images/lvshe_08.gif" align="middle" />
            </label></td>
          </tr>
          <tr>
            <td height="36" bgcolor="#FFFFD0">密码
              <input name="password" type="password" id="password" size="8" /></td>
            </tr>
        </table>
	 </div>
	<div class="shop_name"><a href="bookshop.php?shop_id=<?=$shop_1["shopid"]?>">
	  </a>
	  <label></label>
	  <a href="../bbs/register.php" target="_blank"><img src="../images/reg.jpg" alt="" width="77" height="27" /></a><a href="bookshop.php"><img src="../images/gg.jpg" alt="" width="77" height="27" /></a></div> 
	  </form>
	  </div>	  </td>
      <td width="53%" valign="top"><p align="center"><img src="../images/HeinH17.jpg" alt="" width="128" height="128" /></p>
        <p>别害怕，你只不过还没登录书店而已，<= 左边进 哈哈</p>
        <p>还没有书店？ 还没有？ 现在就去<a href="../bbs/register.php" target="_blank">开店</a>吧
          &gt;&gt;&gt;&gt;</p>
        <p>开店后您将拥有一个eke靓店，您只要将自己不用的书简单的登记在自己的书店里，就等着eker们去联系你吧，再也不用顶贴，再也不用摆地摊就能处理掉您大量的旧书，利己利人，何乐不为。</p>
        <p><a href="../bbs/register.php" target="_blank"><strong>&gt;&gt;现在就去开店&gt;&gt;</strong></a></p></td>
    </tr>
  </table>
 </div>
    <? }
?> 
</p>
  </div>
	<? include("right-bar.php");?>
	<? include("footer.php");?>		