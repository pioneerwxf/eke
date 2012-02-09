<? $current='h';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php"); ?>
<div class="clear"></div>
<div id="left">
<? include("subheader.php"); ?>			
<table width="80%" border="0" align="center">
  <tr>
	<td>
	<SCRIPT src="../css/slidePlayer.js" type=text/javascript></SCRIPT>
            <div class=SlideContainer  id=Slide>
              <div id=SlidePlayer1>
                <div class=SlideImages>
                  <div class=SlideImages>
                  <?
				$query=query("t_ads","type='top_pic' order by value DESC,id DESC limit 4");
				$ads = mysql_fetch_array($query);
				while ($ads) {
				?>
				  <a href="<?=$ads["link"]?>" target=_blank>
				  <img src="../admin/file/pic/<?=$ads["pic"]?>" width="580" height="130" /></a>
				<? 
				$ads = mysql_fetch_array($query);
				}
				?>
				  </div>
                  <div class=SlideNumContainer>
            		<div id=SlideNum1></div>
				  </div>
				</div>
			  </div>
		    </div>
	<SCRIPT type=text/javascript>initSlidePlayer(1);</SCRIPT><br />

	</td>
  </tr>
</table>
	<div class="left_articles">
			<h3><a name="allbooks" id="allbooks"></a>最新添加图书</h3>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="2">
<?
$query=query("book","tag>0 and tag<3 ORDER BY level DESC,bookid DESC");
$book = mysql_fetch_array($query);
$rsnum=mysql_num_rows($query);
if ($rsnum==0){
echo "该书店暂时没有藏书";
exit;
}
//分页设置
$i=0;
$path=$_SERVER["PHP_SELF"]; 
$page=$_GET["page"];
if($page=="") $page=1;
$pagesize=18; //每页显示的条数
$pagecount=ceil($rsnum/$pagesize);
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
		<? 
			$i++;
		} ?>			</td>
                  </tr>
                  <tr>
                    <td height="34">
					<a href="<? echo $path;?>?page=1#allbooks">首页</a>
	<? if($page!=1) echo "<a href=".$path."?page=".($page-1)."#allbooks".">上一页</a>";
    else echo "上一页";?>
	<? if($page!=$pagecount) echo "<a href=".$path."?page=".($page+1)."#allbooks".">下一页</a>";else echo "下一页";    ?>
	<a href="<? echo $path;?>?page=<? echo $pagecount?>#allbooks">末页</a>
                      <!--分页结束--></td>
                    <td>当前第
                      <?=$page?>
                      页/共
                      <?=$pagecount?>
页。【本站现有可售藏书共计
<?=$rsnum?>
本】</td>
        </tr>
      </table>
	</div>

<div class="left_articles">
  <h3>eke高级搜索</h3>
  <div class="notes">说明：左边搜索书籍，右边搜索书店</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="98%" style="border:#FFCC66 dotted 1px; border-top:none; border-left:none;">
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
	<table width="100%" style="border:#FFCC66 dotted 1px; border-top:none;  border-left:none; border-right:none;">
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
</div>
	
    <!--广告
    <div class="left_articles">
	<script type="text/javascript">
		google_ad_client = "pub-7574178975245170";
		/* 468x60, 创建于 10-3-25 */
		google_ad_slot = "8084420297";
		google_ad_width = 468;
		google_ad_height = 60;
		//
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
	</div>
    广告-->
    
    
    
	<div class="left_articles">
			<h3><a name="hotbook" id="hotbook"></a>最热门图书榜</h3>
		<?
			$query=mysql_query("select *,count(*) as number from eke.book group by title having tag>0 order by number DESC limit 18");
			$book = mysql_fetch_array($query);
		?>
		<table width="100%" border="0">
			<tr>
			  
			  <td colspan="2">看看下面的热销榜里是否也有您想要的图书？更多图书建议您试试<a href="search.php">高级搜索&gt;&gt;</a></td>
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
			  	<? } else {?>
				  <div class="book_frame" >
				<? }?>
					<? include("book_frame.php");?>
				  </div>
				  <div class="book_note" >共<?=$book["number"]?>本</div>
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
	</div>
<div class="left_articles">
  <h3>最新鲜的书店</h3>
<span class="float_right"><a href="bookshop.php?level=1">更多more>></a></span>
<div class="notes">刚刚注册哦，也许就有你想要的书~</div></div>
<? 
$query_2=query("shop","level>0 and booknum>1 ORDER BY date DESC,booknum DESC limit 6");
$shop_2 = mysql_fetch_array($query_2);
?>
<table width="100%" border="0">
  <tr>
    <td>
		<? if(!$shop_2) echo "该级别书店暂时还没有，等您来创造了^_^";
	else 
	while ($shop_2){?><div class="shop_2">
      <div class="shop_content">
        <table width="100%" height="100%" border="0">
          <tr>
            <td height="27" colspan="2"><span class="bluecolor">店主</span>：
                <?=$shop_2["owner"]?></td>
          </tr>
          <tr>
            <td width="45%" height="25"><span class="bluecolor">藏书</span>
                <?=$shop_2["booknum"]?>
                <span class="bluecolor">本</span> </td>
            <td width="55%"><span class="bluecolor">成交</span>
              <?=$shop_2["soldnum"]?>
                <span class="bluecolor">本</span></td>
          </tr>
          <tr>
            <td height="25" colspan="2"><span class="bluecolor">开店日</span>：
               <? echo cut_str($shop_2['date'],10);?></td>
          </tr>
          <tr>
            <td height="28" colspan="2"><span class="bluecolor">学院</span>： <a href="college.php?college=<?php echo urlencode($shop_2["college"]);?>" title="点击去<?=$shop_2["college"]?>的其他书店看看"><? echo cut_str($shop_2["college"],18);?></a></td>
          </tr>
          <tr>
            <td colspan="2"><p><span class="bluecolor">口号</span>： <? echo cut_str($shop_2["adv"],40);?> </p></td>
          </tr>
        </table>
      </div>
      <div class="shop_name"><a href="bookshop.php?shop_id=<?=$shop_2["shopid"]?>&college=<?php echo urlencode($shop_2["college"]);?>">【
          <? if($shop_2["shopname"]=="") {echo "eker的书";} else {echo cut_str($shop_2["shopname"],14);}?> 】店</a></div>
    </div>
		<? 
	$shop_2 = mysql_fetch_array($query_2);
	}
	?></td>
  </tr>
</table>
<p>&nbsp;</p>

<div class="left_articles">
  <h3>明星书店</h3>
<span class="float_right"><a href="bookshop.php?level=1">更多more>></a></span>
<div class="notes">藏书量大于30本</div></div>
<? 
$query_2=query("shop","level>0 and booknum>30 ORDER BY level DESC,booknum DESC,date DESC limit 3");
$shop_2 = mysql_fetch_array($query_2);
?>
<table width="100%" border="0">
  <tr>
    <td>
		<? if(!$shop_2) echo "该级别书店暂时还没有，等您来创造了^_^";
	else 
	while ($shop_2){?><div class="shop_2">
      <div class="shop_content">
        <table width="100%" height="100%" border="0">
          <tr>
            <td height="27" colspan="2"><span class="bluecolor">店主</span>：
                <?=$shop_2["owner"]?></td>
          </tr>
          <tr>
            <td width="45%" height="25"><span class="bluecolor">藏书</span>
                <?=$shop_2["booknum"]?>
                <span class="bluecolor">本</span> </td>
            <td width="55%"><span class="bluecolor">成交</span>
              <?=$shop_2["soldnum"]?>
                <span class="bluecolor">本</span></td>
          </tr>
          <tr>
            <td height="25" colspan="2"><span class="bluecolor">开店日</span>：
               <? echo cut_str($shop_2['date'],10);?></td>
          </tr>
          <tr>
            <td height="28" colspan="2"><span class="bluecolor">学院</span>： <a href="college.php?college=<?php echo urlencode($shop_2["college"]);?>" title="点击去<?=$shop_2["college"]?>的其他书店看看"><? echo cut_str($shop_2["college"],18);?></a></td>
          </tr>
          <tr>
            <td colspan="2"><p><span class="bluecolor">口号</span>： <? echo cut_str($shop_2["adv"],40);?> </p></td>
          </tr>
        </table>
      </div>
      <div class="shop_name"><a href="bookshop.php?shop_id=<?=$shop_2["shopid"]?>">【
          <? if($shop_2["shopname"]=="") {echo "eker的书";} else {echo cut_str($shop_2["shopname"],14);}?> 】店</a></div>
    </div>
		<? 
	$shop_2 = mysql_fetch_array($query_2);
	}
	?></td>
  </tr>
</table>
<p>&nbsp;</p>
<div class="clear_height" ></div>
<p></p>
</div>
<?
//计数设置
	$today=date("Y-m-d");
	//echo $today;
	$query=mysql_query("select sum(number) as sum from visit_number");
	$visit_sum = mysql_fetch_array($query);
	$query3=mysql_query("select * from visit_number where date='$today'");
	$visit = mysql_fetch_array($query3);
if(!$visit){
	$today_number=1;
	$total_number=$visit_sum["sum"]+1;
	$sql="insert into visit_number (number,total,date) values ('$today_number','$total_number','$today')";
	mysql_query($sql);
	//echo $sql;
	}
else if($visit){
	$today_number=$visit["number"]+1;
	$total_number=$visit_sum["sum"]+1;
	$update="update visit_number set number='$today_number',total='$total_number' where date='$today'";
	//echo $update;
	mysql_query($update);
	}
?>


<? include("right-bar.php");?>	
	<? include("footer.php");?>		
