<? $current='h';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php"); ?>

<div id="left">

<? 
	$key=$_POST["key"];
	$num=$_POST["num"];
	//$level=$_GET["level"];
	$tag=$_GET["tag"];
?>
<? //搜索结果的显示
if($key){?>
<div class="left_box">
<h3><a name="mybooks" id="mybooks"></a>搜索结果</h3>
<span class="float_right"><img src="../images/back.gif" alt="" /><a href="search.php">返回高级搜索</a></span>
<div class="notes">说明：其中红色书皮的均为已被预定的图书，您<strong class="highlight">点击预定</strong>后就可以看到<strong class="highlight">书主的联系方式</strong></div>
</div>
  <?
if($key!='high' and !$num and $tag==0)
{
	//echo "执行第一部分";
	$title=$key;
	$query=query("book","tag>0 and title like '%$title%' ORDER BY level DESC,date DESC");
	
}
else if($key=='high' and !$num and $tag==0)
{
	//echo $key,$num;
		//echo "执行第2部分";//and (price1 between '$price0' and '$price1')
	$title=$_POST["title"];
	$author=$_POST["author"];
	$public=$_POST["public"];
	$price0=$_POST["price0"];
	$price1=$_POST["price1"];
	$old_degree0=$_POST["old_degree0"];
	$old_degree1=$_POST["old_degree1"];
	$mark=$_POST["mark"];
	$query=query("book","tag>0 and tag!='$mark' and (title like '%$title%') and (author like '%$author%') and (public like '%$public%') and (old_degree between '$old_degree0' and '$old_degree1') ORDER BY level DESC,date DESC");
}
else if($key=='high' and $num and $tag!=0){
	//echo "执行第3部分";
	
	if($tag==1)
	$query=mysql_query("select *,count(*) as number from eke.book group by title having tag>0 order by number DESC limit $num");
	else if($tag==2)
	$query=mysql_query("select *,count(*) as number from eke.book group by title having tag=2 order by number DESC limit $num");
	else if($tag==3)
	$query=mysql_query("select *,count(*) as number from eke.book group by title having tag=0 order by number DESC limit $num");
}
$book = mysql_fetch_array($query);
$rsnum=mysql_num_rows($query);
$i=0;

//记录搜索日志
include("SrcLog.php");
?>
  <table width="100%" border="0">
    <tr>
      
	  <td colspan="2"><? if ($rsnum==0){?>暂时没有符合您搜索条件的书籍，建议您试试<a href="search.php">高级搜索</a>
<? } else { ?>
人品不错，以下是搜到符合您搜索条件的全部书籍,共<?=$rsnum?>本藏书：
<? }?> </td>
   </tr>
    <tr>
      <td width="100%" colspan="2">
<? 
	while($book and $i<100){
	?>
	<div class="book_frame_large" >
	<?
	if($book["tag"]==2)
	{?>
  <div class="order_book_frame">
  <? } else if($book["tag"]==3)
	{?>
  <div class="sold_book_frame">
  <? } else {?>
		  
		  <div class="book_frame" >
            <? }?>
            <? include("book_frame.php");?>
	      </div>
		  <? if($num){?><div class="book_note" >共<?=$book["number"]?>本</div><? }?>
		  </div>
	<? 
	$i++;
	$book = mysql_fetch_array($query);
	} ?>      </td>
    </tr>
    <tr>
      <td></td>
    </tr>
</table>
<? } else if(!$key){?>
<div class="left_box">
  <h3>eke高级搜索</h3>
  <div class="notes">说明：左边搜索书籍，右边搜索书店</div>
</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="98%" style="border:#FFCC66 dotted 1px; border-top:none;">
      <form action="search.php?tag=0" method="post">
        <tr>
          <td width="30%"><div align="left">书名关键字：</div></td>
          <td width="70%"><label>
            <input name="title" type="text" id="title" value=""/>
          </label></td>
        </tr>
        <tr>
          <td><div align="left">作者关键字：</div></td>
          <td><input name="author" type="text" id="author" value=""/></td>
        </tr>
        <tr>
          <td><div align="left">出版社关键字：</div></td>
          <td><input name="public" type="text" id="public" value=""/></td>
        </tr>
        <!--<tr>
    <td><div align="left">价格区间：</div></td>
    <td><input name="price0" type="text" id="price0" value="0" size="5" />
      ~
      <input name="price1" type="text" id="price1" value="1000" size="5" />
      元</td>
  </tr>
  -->
        <tr>
          <td>新旧程度：</td>
          <td><label>
            <select name="old_degree0" id="old_degree0">
              <option value="10">全新</option>
              <option value="9">九成新</option>
              <option value="8">八成新</option>
              <option value="7">七成新</option>
              <option value="6">六成新</option>
              <option value="5">五成新</option>
              <option value="4">四成新</option>
              <option value="3">三成新</option>
              <option value="2">两成新</option>
              <option value="1" selected="selected">一成新</option>
              <option value="0">请选择</option>
            </select>
            ~
            <select name="old_degree1" id="old_degree1">
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
            </select>
          </label></td>
        </tr>
        <tr>
          <td>控制条件：</td>
          <td><label>
            <select name="mark" id="mark">
              <option value="0" selected="selected">搜索全部书籍</option>
              <option value="2">滤除已被预定的</option>
            </select>
          </label></td>
        </tr>
        <tr>
          <td><input name="key" type="hidden" value="high" /></td>
          <td><label>
            <input type="submit" name="Submit2" value="给我搜" class="button"/>
          </label></td>
        </tr>
      </form>
    </table>
      </td>
    <td>
	<table width="100%" style="border:#FFCC66 dotted 1px; border-top:none;  border-left:none;">
      <form action="src_shop.php" method="post">
        <tr>
          <td colspan="2"><label></label>
            <div align="center" class="highlight">*搜索书店在这里*</div></td>
          </tr>
        <tr>
          <td width="30%"><div align="left">店名关键字：</div></td>
          <td width="70%"><input name="shopname" type="text" id="shopname" value=""/></td>
        </tr>
        <tr>
          <td><div align="left">店主关键字：</div></td>
          <td><input name="owner" type="text" id="owner" value=""/></td>
        </tr>
        <!--<tr>
    <td><div align="left">价格区间：</div></td>
    <td><input name="price0" type="text" id="price0" value="0" size="5" />
      ~
      <input name="price1" type="text" id="price1" value="1000" size="5" />
      元</td>
  </tr>
  -->
        <tr>
          <td>店面说明文字：</td>
          <td><label>
            <input name="info" type="text" id="info" value=""/>
          </label></td>
        </tr>
        <tr>
          <td>学院关键字：</td>
          <td><label>
          <select name="college" id="college1">
            <option value=""  selected="selected">-全部学院-</option>
            <option value="竺可桢学院">竺可桢学院</option>
            <option value="人文学院">人文学院</option>
            <option value="法学院 ">法学院 </option>
            <option value="理学院 ">理学院 </option>
            <option value="医学院 ">医学院 </option>
            <option value="教育学院 ">教育学院 </option>
            <option value="管理学院 ">管理学院 </option>
            <option value="公共管理学院 ">公管学院 </option>
            <option value="药学院">药学院</option>
            <option value="经济学院">经济学院</option>
            <option value="外国语学院">外国语学院</option>
            <option value="动物科学学院">动科学院</option>
            <option value="电气工程学院">电气学院</option>
            <option value="生命科学学院 ">生科学院 </option>
            <option value="建筑工程学院 ">建工学院 </option>
            <option value="环境与资源学院 ">环资学院 </option>
            <option value="材料与化工学院 ">材化学院 </option>
            <option value="机械与能源工程学">机能学院</option>
            <option value="信息工程与科学学院">信息学院</option>
            <option value="生物系统工程与食品科学学院 ">生工食品学院 </option>
            <option value="计算机科学与技术学院(软件学院)">计算机、软件学院</option>
            <option value="生物医学工程与仪器科学学院 ">生仪学院 </option>
            <option value="农业与生物技术学院">农生学院</option>
          </select>
          </label></td>
        </tr>
        <tr>
          <td><input name="key" type="hidden" value="high" /></td>
          <td><label>
            <input type="submit" name="Submit22" value="给我搜" class="button"/>
          </label></td>
        </tr>
      </form>
    </table></td>
  </tr>
</table>

<br />

<div class="left_box">
  <h3>eke统计式搜索</h3>
  <div class="notes">说明：提供本站的交易统计量</div>
</div>

<form id="form2" method="post" action="search.php?tag=1">
  <table width="100%" border="0">
    <tr>
      <td width="50%">1、单本藏书最多的
        <label>
        <input name="num" type="text" id="num" value="10" size="5" />
        </label>
        本书 
        <input name="key" type="hidden" id="key" value="high" /></td>
      <td width="64%"><label>
        <input type="submit" name="Submit3" value="搜索" class="button" />
      大家都想卖的书</label></td>
    </tr>
  </table>
</form>

<form id="form2" method="post" action="search.php?tag=2">
  <table width="100%" border="0">
    <tr>
      <td width="50%">2、被预定最多的
        <label>
          <input name="num" type="text" id="num" value="10" size="5" />
          </label>
        本书 
        <input name="key" type="hidden" id="key" value="high" /></td>
      <td width="64%"><label>
        <input type="submit" name="Submit32" value="搜索" class="button" />
      大家都想买的书</label></td>
    </tr>
  </table>
</form>
<form id="form2" method="post" action="search.php?tag=3">
  <table width="100%" border="0">
    <tr>
      <td width="50%">3、成交量最多的
        <label>
        <input name="num" type="text" id="num" value="10" size="5" />
        </label>
        本书 
        <input name="key" type="hidden" id="key" value="high" /></td>
      <td width="64%"><label>
        <input type="submit" name="Submit33" value="搜索" class="button" />
      最炙手可热的书</label></td>
    </tr>
  </table>
</form>
<form id="form2" method="post" action="search.php?tag=4">
</form>
<? }?>
</div>
<? include("right-bar.php");?>
	<? include("footer.php");?>		