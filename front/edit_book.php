<? $current='m';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php"); ?>
<div id="left">
<?php 
//检查是否登录
if(!isset($discuz_uid) or !$discuz_uid){
	echo "<script type='text/javascript'>location.href='myshop.php';</script>"; 
	exit();
}

$bookid=$_GET["id"];
$act=$_GET["act"];
if($act=='edit')
{

	$query=query("book","bookid='$bookid'");
	$book = mysql_fetch_array($query);
	if($book["tag"]==2)
			$status='已被预定';
	elseif($book["tag"]==3)
			$status='已经售出';
	elseif($book["tag"]=='-1')
			$status='已经删除';
	else 
		  $status='正待出售';
?>
<div class="left_articles">
	<h3>修改书籍信息</h3>
        <form id="form2" method="post" action="edit_book.php?act=update&id=<?=$book["bookid"]?>">
                  <table width="100%">
                    <tr>
                      <td colspan="4"  class="highlight">**必填信息：</td>
                    </tr>
                    <tr>
                      <td width="7%">书名：</td>
                      <td width="38%"><label>
                        <input name="title" type="text" id="title" value="<?=$book["title"]?>"/>
                      </label></td>
                      <td width="10%">原价：</td>
                      <td width="45%"><input name="price0" type="text" id="price0" size="5" value="<?=$book["price0"]?>"/>
                        元</td>
                    </tr>
                    <tr>
                      <td>作者：</td>
                      <td><input name="author" type="text" id="author" value="<?=$book["author"]?>"/></td>
                      <td>现价：</td>
                      <td><input name="price1" type="text" id="price1" size="5" value="<?=$book["price1"]?>"/>
                        元</td>
                    </tr>
                    <tr>
                      <td colspan="4"><span class="highlight">**补充信息：</span></td>
                    </tr>
                    <tr>
                      <td>出版社</td>
                      <td><input name="public" type="text" id="public" value="<?=$book["public"]?>"/></td>
                      <td>新旧程度</td>
                      <td><select name="old_degree" id="old_degree">
                          <option value="<?=$book["old_degree"]?>" selected="selected">
                            <?=$book["old_degree"]?>
                            成新</option>
                          <option value="10">10成新</option>
                          <option value="9">9成新</option>
                          <option value="8">8成新</option>
                          <option value="7">7成新</option>
                          <option value="6">6成新</option>
                          <option value="5">5成新</option>
                          <option value="4">4成新</option>
                          <option value="3">3成新</option>
                          <option value="2">2成新</option>
                          <option value="1">1成新</option>
                      </select></td>
                    </tr>
                    <tr>
                      <td>分类</td>
                      <td><select name="sort" id="sort">
                          <option value="A" <? if($book["sort"]=='A') { ?> selected="selected" <? }?>>A：马列、毛邓</option>
                          <option value="B" <? if($book["sort"]=='B') { ?> selected="selected" <? }?>>B：哲学、宗教</option>
                          <option value="C" <? if($book["sort"]=='C') { ?> selected="selected" <? }?>>C：社会科学</option>
                          <option id="color" value="D" <? if($book["sort"]=='D') { ?> selected="selected" <? }?>>D：政治、法律</option>
                          <option value="E"  <? if($book["sort"]=='E') { ?> selected="selected" <? }?>>E：军事</option>
                          <option id="color"  value="F" <? if($book["sort"]=='F') { ?> selected="selected" <? }?>>F：经济</option>
                          <option value="G" <? if($book["sort"]=='G') { ?> selected="selected" <? }?>>G：科教、文体</option>
                          <option id="color"  value="H" <? if($book["sort"]=='H') { ?> selected="selected" <? }?>>H：语言、文字</option>
                          <option  id="color" value="I" <? if($book["sort"]=='I') { ?> selected="selected" <? }?>>I：文学</option>
                          <option value="J" <? if($book["sort"]=='J') { ?> selected="selected" <? }?>>J：艺术</option>
                          <option value="K" <? if($book["sort"]=='K') { ?> selected="selected" <? }?>>K：历史、地理</option>
                          <option value="N" <? if($book["sort"]=='N') { ?> selected="selected" <? }?>>N：自然科学</option>
                          <option  id="color" value="O" <? if($book["sort"]=='O') { ?> selected="selected" <? }?>>O：数、理、化科学</option>
                          <option value="P" <? if($book["sort"]=='P') { ?> selected="selected" <? }?>>P：天文、地球科学</option>
                          <option value="Q" <? if($book["sort"]=='Q') { ?> selected="selected" <? }?>>Q：生物科学</option>
                          <option value="R" <? if($book["sort"]=='R') { ?> selected="selected" <? }?>>R：医学、卫生</option>
                          <option value="S" <? if($book["sort"]=='S') { ?> selected="selected" <? }?>>S：农业科学</option>
                          <option  id="color" value="T" <? if($book["sort"]=='T') { ?> selected="selected" <? }?>>T：工业、电脑技术</option>
                          <option value="U" <? if($book["sort"]=='U') { ?> selected="selected" <? }?>>U：交通运输</option>
                          <option value="V" <? if($book["sort"]=='V') { ?> selected="selected" <? }?>>V：航空航天</option>
                          <option value="X" <? if($book["sort"]=='X') { ?> selected="selected" <? }?>>X：环境科学</option>
                          <option value="Z" <? if($book["sort"]=='Z') { ?> selected="selected" <? }?>>Z：综合类、工具书</option>
                          <option value="0"  <? if($book["sort"]=='0') { ?> selected="selected" <? }?>>未分类</option>
                      </select></td>
                      <td>其他信息</td>
                      <td><label>
                        <input name="info" type="text" id="info" value="没啥多余信息" <?=$book["info"]?>/>
                      </label></td>
                    </tr>
                    <tr>
                      <td>状态</td>
                      <td colspan="3"><select name="tag" id="tag">
                        <option value="1">正待出售</option>
                        <option value="2">已被预定</option>
                        <option value="3">已经售出</option>
						<option value="-1">已经删除</option>
                        <option value="<?=$book["tag"]?>" selected="selected">
                          <?=$status?>
                        </option>
                      </select> 
                      请您务必在此更改该书现在的正确状态，以免造成误导信息。</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><div align="right">
                          <input type="submit" name="Submit22" value="更改"  class="button"/>
                      </div></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
  </form>
    <? 
	$query=mysql_query("select * from eke.order where bid='$bookid' and tag=2 order by date DESC");
	$order = mysql_fetch_array($query);
	?>
	  <div class="clear_height" ></div>
	  <div class="left_box">
        <h3><a name="reserved" id="mybooks"></a><a href="mybook.php?tag=1">该书的预订信息</a></h3>
          <div class="notes">以下为预定该书的信息列表，请及时联系。</div>
      </div>
		  <table width="100%" style="border:#FFCC66 dotted 1px; border-top:none;">
            <tr>
              <td width="28%" bgcolor="#FFFFCC">预订者</td>
              <td width="34%" bgcolor="#FFFFCC">联系方式</td>
              <td width="38%" bgcolor="#FFFFCC">预定时间</td>
            </tr>
            <? while($order){?>
			<tr>
              <td><?=$order["user"]?></td>
              <td><?=$order["tele"]?></td>
              <td><?=$order["date"]?></td>
            </tr>
			<?
			$order = mysql_fetch_array($query);
			 }?>
      </table>
        
      <p>&nbsp;</p>
</div>
<?
}
else if($act!='edit')
{
	$query=query("book","bookid='$bookid'");
	$book = mysql_fetch_array($query);
	$shopid=$book["shopid"];
	if($act=='tag')
	{	
		$tag=$_POST["tag"];
		$sql="update eke.book set tag='$tag' where bookid='$bookid'";
		$update_order="update eke.order set tag='$tag' where bid='$bookid'";
		mysql_query($update_order);
	}
	else if($act=='dele'){
		$update_order="update eke.order set tag='-1' where bid='$bookid'";
		mysql_query($update_order);
		$sql="update eke.book set tag='-1' where bookid='$bookid'";
	}
	else if($act=='update')
	{
		$title=$_POST["title"];
		$author=$_POST["author"];
		$price0=$_POST["price0"];
		$price1=$_POST["price1"];
		$public=$_POST["public"];
		$old_degree=$_POST["old_degree"];
		$sort=$_POST["sort"];
		$info=$_POST["info"];
		$tag=$_POST["tag"];
		$update_order="update eke.order set tag='$tag' where bid='$bookid'";
		mysql_query($update_order);
		$sql="update eke.book set title='$title',author='$author',price0='$price0',price1='$price1',public='$public',old_degree='$old_degree',sort='$sort',info='$info',tag='$tag' where bookid='$bookid'";
		//echo $sql;
		}
	
	if (mysql_query($sql)){
	$query_booknum=query("book","shopid=$shopid and tag>0 and tag<3");
	$query_soldnum=query("book","shopid=$shopid and tag=3");
	$booknum = mysql_num_rows($query_booknum);
	$soldnum = mysql_num_rows($query_soldnum);
	$update_shop="update shop set booknum='$booknum', soldnum='$soldnum' where shopid='$shopid'";
	if (mysql_query($update_shop))
	echo ("<script type='text/javascript'> alert('OK!');location.href='myshop.php';</script>");
	else{
	echo ("<script type='text/javascript'> alert('系统有问题，稍后再试！');history.go(-1);</script>");
	exit;
	}
	}
	else{
	echo ("<script type='text/javascript'> alert('系统有问题，稍后再试！');history.go(-1);</script>");
	exit;
	}
}
?>
</div>
	<? include("right-bar.php");?>
	<? include("footer.php");?>		