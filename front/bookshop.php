<? $current='b';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php"); ?>
<? $shop_id=$_GET["shop_id"];?>
<div id="left">
<? if(!isset($_GET["level"]) and !isset($shop_id)) {?> 
  <div class="left_box">
<h3>一、殿堂级书店</h3>
<span class="float_right"><a href="bookshop.php?level=2">更多more>></a></span>
<div class="notes">藏书量在100本以上</div></div>
<? 
$query_1=query("shop","level>0 and booknum>100 ORDER BY booknum DESC,date DESC limit 3");
$shop_1 = mysql_fetch_array($query_1);
?>
<table width="100%" border="0">
  <tr>
    <td>
	<? if(!$shop_1) echo "该级别书店暂时还没有，等您来创造了^_^";
	else 
	while ($shop_1){?>
	<div class="shop_1">
		<div class="shop_content">
		  <table width="100%" height="100%" border="0">
            <tr>
              <td height="27" colspan="2"><span class="bluecolor">店主</span>：
                <?=$shop_1["owner"]?></td>
            </tr>
            <tr>
              <td width="45%" height="25"><span class="bluecolor">藏书</span>
                  <?=$shop_1["booknum"]?>
                  <span class="bluecolor">本</span> </td>
              <td width="55%"><span class="bluecolor">成交</span>
                  <?=$shop_1["soldnum"]?>
                  <span class="bluecolor">本</span></td>
            </tr>
            <tr>
              <td height="25" colspan="2"><span class="bluecolor">开店日</span>： <? echo cut_str($shop_1['date'],10);?></td>
            </tr>
            <tr>
              <td height="28" colspan="2"><span class="bluecolor">学院</span>： <a href="college.php?college=<?php echo urlencode($shop_1["college"]);?>" title="点击去<?=$shop_1["college"]?>的其他书店看看"><? echo cut_str($shop_1["college"],18);?></a></td>
            </tr>
            <tr>
              <td colspan="2"><p><span class="bluecolor">口号</span>： <? echo cut_str($shop_1["adv"],44);?> </p></td>
            </tr>
          </table>
		</div>
		<div class="shop_name"><a href="bookshop.php?shop_id=<?=$shop_1["shopid"]?>">【
		<? echo cut_str($shop_1["shopname"],14);?> 】店</a></div>
	</div>
	<? 
	$shop_1 = mysql_fetch_array($query_1);
	}
	?>
	</td>
    </tr>
</table>
<p>&nbsp;</p>
<div class="clear_height" ></div>

<div class="left_box">
  <h3>二、别墅级书店</h3>
<span class="float_right"><a href="bookshop.php?level=1">更多more>></a></span>
<div class="notes">藏书量在30~100本</div></div>
<? 
$query_2=query("shop","level>0 and booknum>30 and booknum<=100 ORDER BY booknum DESC,date DESC limit 3");
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
          <? echo cut_str($shop_2["shopname"],14);?> 】店</a></div>
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
<div class="left_box">
  <h3>三、小屋级书店</h3>
<span class="float_right"><a href="bookshop.php?level=0">更多more>></a></span>
<div class="notes">新店开张，均属此类</div></div>
<? 
$query_3=query("shop","level>0 and booknum>=0 and booknum<=30 ORDER BY booknum DESC,date DESC limit 6");
$shop_3 = mysql_fetch_array($query_3);
?>
<table width="100%" border="0">
  <tr>
    <td>
		<? if(!$shop_3) echo "该级别书店暂时还没有，等您来创造了^_^";
	else 
	while ($shop_3){?>
	<div class="shop_3">
      <div class="shop_content">
        <table width="100%" height="100%" border="0">
          <tr>
            <td height="27" colspan="2"><span class="bluecolor">店主</span>：
              <?=$shop_3["owner"]?></td>
          </tr>
          <tr>
            <td width="45%" height="25"><span class="bluecolor">藏书</span>
                <?=$shop_3["booknum"]?>
                <span class="bluecolor">本</span> </td>
            <td width="55%"><span class="bluecolor">成交</span>
                <?=$shop_3["soldnum"]?>
                <span class="bluecolor">本</span></td>
          </tr>
          <tr>
            <td height="25" colspan="2"><span class="bluecolor">开店日</span>：
            <? echo cut_str($shop_3['date'],10);?></td>
          </tr>
          <tr>
            <td height="28" colspan="2"><span class="bluecolor">学院</span>： <a href="college.php?college=<?php echo urlencode($shop_3["college"]);?>" title="点击去<?=$shop_3["college"]?>的其他书店看看"><? echo cut_str($shop_3["college"],18);?></a></td>
          </tr>
          <tr>
            <td colspan="2"><p><span class="bluecolor">口号</span>： <? echo cut_str($shop_3["adv"],44);?> </p></td>
          </tr>
        </table>
      </div>
      <div class="shop_name"><a href="bookshop.php?shop_id=<?=$shop_3["shopid"]?>">【
          <? echo cut_str($shop_3["shopname"],14);?>】店</a></div>
    </div>
		<? 
	$shop_3 = mysql_fetch_array($query_3);
	}
	?>
	</td>
  </tr>
</table>
<? 
//普通页面结束，进入独显页面
?>

<? } else if(isset($_GET["level"])) {

	$level=$_GET["level"];
	if($level==2){?>
<div class="left_box">
  <h3>殿堂级书店</h3>
  <div class="notes">藏书量在100本以上</div>
</div>
<? 
$query=query("shop","level>0 and booknum>100 ORDER BY booknum DESC,date DESC");
$shop = mysql_fetch_array($query);
$rsnum=mysql_num_rows($query);
?>
<? //分页设置
if($rsnum){
	$i=0;
	$path=$_SERVER["PHP_SELF"]; 
	$page=$_GET["page"];
	if($page=="") $page=1;
	$pagesize=12; //每页显示的条数
	$pagecount=ceil($rsnum/$pagesize);
	if($page>$pagecount) $page=$pagecount;
	mysql_data_seek($query,($page-1)*$pagesize);
}
?>
<table width="100%" border="0">
  <tr>
    <td><? if(!$shop) 
	echo "该级别书店暂时还没有，等您来创造了^_^";
	else 
	while (($shop = mysql_fetch_array($query))&&$i<$pagesize){?>
        <div class="shop_1">
          <div class="shop_content">
            <table width="100%" height="100%" border="0">
              <tr>
                <td height="27" colspan="2"><span class="bluecolor">店主</span>：
                  <?=$shop["owner"]?></td>
              </tr>
              <tr>
                <td width="45%" height="25"><span class="bluecolor">藏书</span>
                    <?=$shop["booknum"]?>
                    <span class="bluecolor">本</span> </td>
                <td width="55%"><span class="bluecolor">成交</span>
                    <?=$shop["soldnum"]?>
                    <span class="bluecolor">本</span></td>
              </tr>
              <tr>
                <td height="25" colspan="2"><span class="bluecolor">开店日</span>： <? echo cut_str($shop['date'],10);?></td>
              </tr>
              <tr>
                <td height="28" colspan="2"><span class="bluecolor">学院：</span><a href="college.php?college=<?php echo urlencode($shop["college"]);?>" title="点击去<?=$shop["college"]?>的其他书店看看"><? echo cut_str($shop["college"],18);?></a></td>
              </tr>
              <tr>
                <td colspan="2"><p><span class="bluecolor">口号</span>： <? echo cut_str($shop["adv"],44);?> </p></td>
              </tr>
            </table>
          </div>
          <div class="shop_name"><a href="bookshop.php?shop_id=<?=$shop["shopid"]?>">【
            <? echo cut_str($shop["shopname"],14);?>            】店</a></div>
        </div>
      <? 
		$i++;	}
	?>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
<div class="clear_height" ></div>
<? }?>
<? if($level==1){?>
<div class="left_box">
  <h3>别墅级书店</h3>
  <div class="notes">藏书量在30~100本</div>
</div>
<? 
$query=query("shop","level>0 and booknum>30 and booknum<=100 ORDER BY booknum DESC,date DESC");
$shop= mysql_fetch_array($query);
$rsnum=mysql_num_rows($query);
?>
<? //分页设置
if($rsnum){
	$i=0;
	$path=$_SERVER["PHP_SELF"]; 
	$page=$_GET["page"];
	if($page=="") $page=1;
	$pagesize=12; //每页显示的条数
	$pagecount=ceil($rsnum/$pagesize);
	if($page>$pagecount) $page=$pagecount;
	mysql_data_seek($query,($page-1)*$pagesize);
}?>
<table width="100%" border="0">
  <tr>
    <td><? if(!$shop) echo "该级别书店暂时还没有，等您来创造了^_^";
	else 
	while (($shop = mysql_fetch_array($query))&&$i<$pagesize){?>
        <div class="shop_2">
          <div class="shop_content">
            <table width="100%" height="100%" border="0">
              <tr>
                <td height="27" colspan="2"><span class="bluecolor">店主</span>：
                  <?=$shop["owner"]?></td>
              </tr>
              <tr>
                <td width="45%" height="25"><span class="bluecolor">藏书</span>
                    <?=$shop["booknum"]?>
                    <span class="bluecolor">本</span> </td>
                <td width="55%"><span class="bluecolor">成交</span>
                    <?=$shop["soldnum"]?>
                    <span class="bluecolor">本</span></td>
              </tr>
              <tr>
                <td height="25" colspan="2"><span class="bluecolor">开店日</span>： <? echo cut_str($shop['date'],10);?></td>
              </tr>
              <tr>
                <td height="28" colspan="2"><span class="bluecolor">学院：</span><a href="college.php?college=<?php echo urlencode($shop["college"]);?>" title="点击去<?=$shop["college"]?>的其他书店看看"><? echo cut_str($shop["college"],18);?></a></td>
              </tr>
              <tr>
                <td colspan="2"><p><span class="bluecolor">口号</span>： <? echo cut_str($shop["adv"],44);?> </p></td>
              </tr>
            </table>
          </div>
          <div class="shop_name"><a href="bookshop.php?shop_id=<?=$shop["shopid"]?>">【
            <? echo cut_str($shop["shopname"],14);?>            】店</a></div>
        </div>
      <? 
	$i++;
	}
	?></td>
  </tr>
</table>
<p>&nbsp;</p>
<div class="clear_height" ></div>
<? }?>
<? if($level==0){?>
<div class="left_box">
  <h3>小屋级书店</h3>
  <div class="notes">新店开张，均属此类</div>
</div>
<? 
$query=query("shop","level>0 and booknum>=0 and booknum<=30 ORDER BY booknum DESC,date DESC");
$shop = mysql_fetch_array($query);
$rsnum=mysql_num_rows($query);
?>
<? //分页设置
if($rsnum){
	$i=0;
	$path=$_SERVER["PHP_SELF"]; 
	$page=$_GET["page"];
	if($page=="") $page=1;
	$pagesize=12; //每页显示的条数
	$pagecount=ceil($rsnum/$pagesize);
	if($page>$pagecount) $page=$pagecount;
	mysql_data_seek($query,($page-1)*$pagesize);
}
?>
<table width="100%" border="0">
  <tr>
    <td><? if(!$shop) echo "该级别书店暂时还没有，等您来创造了^_^";
	else 
	while (($shop = mysql_fetch_array($query))&&$i<$pagesize){?>
        <div class="shop_3">
          <div class="shop_content">
            <table width="100%" height="100%" border="0">
              <tr>
                <td height="27" colspan="2"><span class="bluecolor">店主</span>：
                  <?=$shop["owner"]?></td>
              </tr>
              <tr>
                <td width="45%" height="25"><span class="bluecolor">藏书</span>
                    <?=$shop["booknum"]?>
                    <span class="bluecolor">本</span> </td>
                <td width="55%"><span class="bluecolor">成交</span>
                    <?=$shop["soldnum"]?>
                    <span class="bluecolor">本</span></td>
              </tr>
              <tr>
                <td height="25" colspan="2"><span class="bluecolor">开店日</span>： <? echo cut_str($shop['date'],10);?></td>
              </tr>
              <tr>
                <td height="28" colspan="2"><span class="bluecolor">学院：</span><a href="college.php?college=<?php echo urlencode($shop["college"]);?>" title="点击去<?=$shop["college"]?>的其他书店看看"><? echo cut_str($shop["college"],18);?></a></td>
              </tr>
              <tr>
                <td colspan="2"><p><span class="bluecolor">口号</span>： <? echo cut_str($shop["adv"],44);?> </p></td>
              </tr>
            </table>
          </div>
          <div class="shop_name"><a href="bookshop.php?shop_id=<?=$shop["shopid"]?>">【
            <? echo cut_str($shop["shopname"],14);?>
            】店</a></div>
        </div>
      <? 
	$i++;
	}
	?>
    </td>
  </tr>
</table>
<? }?> 

<table width="100%" border="0">
  <tr>
    <td>
	<? if($rsnum) {?>
	<a href="<? echo $path;?>?page=1&level=<?=$level?>">首页</a>
	<? if($page!=1) echo "<a href=".$path."?page=".($page-1)."&level=".$level.">上一页</a>";
    else echo "上一页";?>
	<? if($page!=$pagecount) echo "<a href=".$path."?page=".($page+1)."&level=".$level.">下一页</a>";else echo "下一页";    ?>
	<a href="<? echo $path;?>?page=<? echo $pagecount?>&level=<?=$level?>">末页</a>
                      <!--分页结束--></td>
                    <td>当前第
                      <?=$page?>
                      页/共
                      <?=$pagecount?>
页。【本级别书店共有
<?=$rsnum?> 家】
<? }?></td>
                    <td>&nbsp;</td>
  </tr>
</table>
<? } else if(isset($shop_id)) 
{
		$array=select("shop","shopid=$shop_id");
		$shopid=$shop_id;//提取当前用户的书店
?>
<div align="center">
<? if($array["poster"])	{ ?><img src="./banner/<?=$array["poster"]?>" height="120" width="635" alt="" align="middle" /> 
<? }else {?><img src="../images/banner.jpg" height="120" width="635" alt="" align="middle" /><? }?>
</div>
<div class="left_box">
<h3><a name="basic" id="basic"></a>【<?=$array["shopname"]?>】店  基本信息</h3>
</div>
<table width="100%" border="0">
  <tr>
    <td colspan="4">【<?=$array["shopname"]?>】店的本站地址，点击收藏：<a href="<?
		$sys_query=query("t_sys_config","name='webaddress'");
		$sys_array = mysql_fetch_array($sys_query);
		if($sys_array) echo $sys_array["value"];
		?>/front/bookshop.php?shop_id=<?=$shopid?>" class="highlight">
		<?=$sys_array["value"]?>/front/bookshop.php?shop_id=<?=$shopid?>
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
    <td>学院：</td>
    <td><?=$array["college"]?></td>
  </tr>
  
  <tr>
    <td>创建人：</td>
    <td><?=$array["owner"]?></td>
    <td>创建日期：</td>
    <td><? echo $array['date'];?></td>
  </tr>
</table>
<div class="clear_height" ></div>
<? //预定图书的显示?>
<div class="left_box">
<h3><a name="allbooks" id="mybooks"></a>【<?=$array["shopname"]?>】店的所有藏书</h3>
  <div class="notes">其中红色书皮的均为已被预定的图书，您只要<strong class="highlight">点击预定</strong>后就可以看到<strong class="highlight">书主的联系方式</strong></div>
</div>
<?
$query=query("book","tag>0 and tag<3 and shopid='$shopid' ORDER BY tag DESC,bookid DESC");
$book = mysql_fetch_array($query);
$rsnum=mysql_num_rows($query);
if ($rsnum==0){
echo "该书店暂时没有藏书";
//exit;
}
//分页设置
if($rsnum>0){
$i=0;
$path=$_SERVER["PHP_SELF"]; 
$page=$_GET["page"];
if($page=="") $page=1;
$pagesize=30; //每页显示的条数
$pagecount=ceil($rsnum/$pagesize);
if($page>$pagecount) $page=$pagecount;
mysql_data_seek($query,($page-1)*$pagesize);
?>
  <table width="100%" border="0">
    <tr>
      <td width="100%">
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
		} ?>      </td>
    </tr>
    <tr>
      <td>
	 <!--分页开始-->
          <a href="<? echo $path;?>?page=1&shop_id=<?=$shopid?>">首页</a>
          <? if($page!=1) echo "<a href=".$path."?page=".($page-1)."&shop_id=".$shopid.">上一页</a>";
    else echo "上一页";?>
          <? if($page!=$pagecount) echo "<a href=".$path."?page=".($page+1)."&shop_id=".$shopid.">下一页</a>";else echo "下一页";    ?>
          <a href="<? echo $path;?>?page=<? echo $pagecount?>&shop_id=<?=$shopid?>">末页</a>
          <!--分页结束-->
        当前第
        <?=$page?>
        页/共
        <?=$pagecount?>
        页，
        <?=$rsnum?>
        本藏书
		</td>
    </tr>
  </table>
<? }
}?>
</div>
<? include("right-bar.php");?>
	<? include("footer.php");?>		