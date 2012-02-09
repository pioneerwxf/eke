<? $current='b';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php");?>
  <div id="left">
<? 
	$shopname=$_POST["shopname"];
	$owner=$_POST["owner"];
	$adv=$_POST["info"];
	$college=$_POST["college"];
	$query=query("shop","level>0 and college like '%$college%' and shopname like '%$shopname%' and owner like '%$owner%' and adv like '%$adv%' ORDER BY level DESC,date DESC");
	$shop = mysql_fetch_array($query);

	//记录搜索日志
	include("SrcLog.php");	

	$rsnum=mysql_num_rows($query);
	//分页设置
	if($rsnum){
		$i=0;
		$path=$_SERVER["PHP_SELF"]; 
		$page=$_GET["page"];
		if($page=="") $page=1;
		$pagesize=300; //每页显示的条数
		$pagecount=ceil($rsnum/$pagesize);
		if($page>$pagecount) $page=$pagecount;
		mysql_data_seek($query,($page-1)*$pagesize);
	}
?>
	
    <div class="left_box">
      <h3>书店搜索结果</h3>
	  <span class="float_right"><img src="../images/back.gif" alt="" /><a href="search.php">返回高级搜索</a></span>
      <? if($rsnum){?>
	  <div class="notes">以下是搜索到符合您要求的书店，按藏数量从大到小排列</div>
	  <? }?>
	</div>
    <table width="100%" border="0">
      
      <tr>
        <td><? if(!$shop) echo "暂时没有符合的书店，换个关键词试试^_^";
	else 
	while (($shop = mysql_fetch_array($query))&&$i<$pagesize){?>
            <div class="shop_<? echo 4-$shop["level"];?>">
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
                    <td height="28" colspan="2"><span class="bluecolor">学院</span>：
                      <?=$shop["college"]?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><p><span class="bluecolor">口号</span>：
                      <?=$shop["adv"]?>
                    </p></td>
                  </tr>
                </table>
              </div>
              <div class="shop_name"><a href="bookshop.php?shop_id=<?=$shop["shopid"]?>">【
                <?=$shop["shopname"]?>
                】店</a></div>
            </div>
          <? 
		  $i++;
	}
	?>        </td>
      </tr>
    </table>
  </div>
  <? include("right-bar.php");?>
  <? include("footer.php");?>		