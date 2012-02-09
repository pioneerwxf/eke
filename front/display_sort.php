<? $current='l';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php"); ?>
<?
$sort=$_GET["sort"];
switch ($sort)
{
	case 'A':$title='A:毛邓、马列主义';break;
	case 'B':$title='B：哲学、宗教';break;
	case 'C':$title='C：社会科学';break;
	case 'D':$title='D：政治、法律';break;
	case 'E':$title='E：军事';break;
	case 'F':$title='F：经济';break;
	case 'G':$title='G：科教、文体';break;
	case 'H':$title='H：语言、文字';break;
	case 'I':$title='I：文学';break;
	case 'J':$title='J：艺术';break;
	case 'K':$title='K：历史、地理';break;
	case 'N':$title='N：自然可学';break;
	case 'O':$title='O：数、理、化科学';break;
	case 'P':$title='P：天文、地球科学';break;
	case 'Q':$title='Q：生物科学';break;
	case 'R':$title='R：医学、卫生';break;
	case 'S':$title='S：农业科学';break;
	case 'T':$title='T：工业技术';break;
	case 'U':$title='U：交通运输';break;
	case 'V':$title='V：航空航天';break;
	case 'X':$title='X：环境科学';break;
	case 'Z':$title='Z：综合类、工具书';break;
	case '0':$title='未分类图书';break;
}
$query=query("book","tag>0 and sort='$sort' ORDER BY date DESC,level DESC");
$booknum=mysql_num_rows($query);
?>
<div id="left">
  <div class="left_box">
<h3><?=$title?></h3>
</div>
  <table width="100%" border="0">
    <tr>
      <td colspan="2"><?php if ($booknum == 0) { // Show if recordset empty ?>
          <span class="highlight">对不起!还没有该类图书，欢迎您来</span><a href="myshop.php">添加</a>
          <?php } // Show if recordset empty 
		else {
		//分页设置
		$i=0;
		$path=$_SERVER["PHP_SELF"]; 
		$page=$_GET["page"];
		if($page=="") $page=1;
		$pagesize=30; //每页显示的条数
		$pagecount=ceil($booknum/$pagesize);
		if($page>$pagecount) $page=$pagecount;
		mysql_data_seek($query,($page-1)*$pagesize);
		?>
          <? 
			while(($book = mysql_fetch_array($query))&&$i<$pagesize){
			if($book["tag"]==2)
			{?>
          <div class="order_book_frame">
            <? }else {?>
            <div class="book_frame" >
              <? }?>
			<? include("book_frame.php");?>
            </div>
            <? $i++;
		} ?>
          </div></td>
      </tr>
    <tr>
      <td height="35">
	  <? if($booknum){?><a href="<? echo $path;?>?page=1&amp;sort=<?=$sort?>">首页</a>
        <? if($page!=1) echo "<a href=".$path."?page=".($page-1)."&sort=".$sort.">上一页</a>";
    else echo "上一页";?>
        <? if($page!=$pagecount) echo "<a href=".$path."?page=".($page+1)."&sort=".$sort.">下一页</a>";else echo "下一页";    ?>
        <a href="<? echo $path;?>?page=<? echo $pagecount?>&amp;sort=<?=$sort?>">末页</a>
        <!--分页结束--></td>
      <td>当前第
        <?=$page?>
        页/共
        <?=$pagecount?>
页。【共计有
<?=$booknum?>
本 &quot;
<?=$sort?>
&quot; 类藏书】
<? }
}?></td>
    </tr>
  </table>

</div>
	<? include("right-bar.php");?>
	<? include("footer.php");?>		