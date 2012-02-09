<? $current='c';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php");?>
<? $college=$_GET["college"];?>
  <div id="left">
	<? if(!$college){?>
	<div class="subheader">
		<p><span class="title"><img src="../images/notice.gif" alt="" width="12" height="13" /></span>点进相应学院进入您的专业，看看学长们的书籍，淘书更有针对性！</p>
	</div>
            <div class="left_articles">
              <h3>学院模式</h3>
              <div class="thirds">
                <p class="title"><img src="../images/notice.gif" alt="" width="12" height="13" /><a href="http://snews.solucija.com/">碧峰学园</a><br />
                </p>
                <p><a target="_blank" href='college.php?college=<?php echo urlencode("机械与能源工程学");?>'>机械与能源工程学</a><br />
                  <a target="_blank" href='college.php?college=<?php echo urlencode("环境与资源学院");?>'>环境与资源学院</a></p>
                <p><a target="_blank" href='college.php?college=<?php echo urlencode("计算机科学与技术学院(软件学院)");?>'>计算机科学与技术学院(软件学院)</a></p>
                <p><a target="_blank" href='college.php?college=<?php echo urlencode("动物科学学院");?>'>动物科学学院</a></p>
              </div>
              <div class="thirds">
                <p class="title"><img src="../images/notice.gif" alt="" width="12" height="13" /><a href="http://snews.solucija.com/">蓝田学园</a><br />
                </p>
                <p><a target="_blank" href='college.php?college=<?php echo urlencode("竺可桢学院");?>'>竺可桢学院</a><br />
                  <a target="_blank" href='college.php?college=<?php echo urlencode("人文学院");?>'>人文学院</a><br />
                  <a target="_blank" href='college.php?college=<?php echo urlencode("理学院");?>'>理学院</a><br />
                  <a target="_blank" href='college.php?college=<?php echo urlencode("信息工程与科学学院");?>'>信息工程与科学学院</a></p>
              </div>
              <div class="thirds">
                <p class="title"><img src="../images/notice.gif" alt="" width="12" height="13" /><a href="http://snews.solucija.com/">紫云学园</a><br />
                </p>
                <p><a target="_blank" href='college.php?college=<?php echo urlencode("生物医学工程与仪器科学学院 ");?>'>生物医学工程与仪器科学学院 </a><br />
                  <a target="_blank" href='college.php?college=<?php echo urlencode("法学院");?>'>法学院</a><br />
                  <a target="_blank" href='college.php?college=<?php echo urlencode("教育学院");?>'>教育学院</a><br />
                  <a target="_blank" href='college.php?college=<?php echo urlencode("材料与化工学院");?>'>材料与化工学院</a></p>
              </div>
              <div class="clear_height" ></div>
			  <div class="clear_height" ></div>
			  <div class="clear_height" ></div>
              <div class="thirds">
                <p class="title"><img src="../images/notice.gif" alt="" width="12" height="13" /><a href="http://snews.solucija.com/">丹阳学园</a><br /></p>
                <p><a target="_blank" href='college.php?college=<?php echo urlencode("医学院");?>'>医学院</a><br />
                  <a target="_blank" href='college.php?college=<?php echo urlencode("药学院");?>'>药学院</a></p>
                <p><a target="_blank" href='college.php?college=<?php echo urlencode("电气工程学院");?>'>电气工程学院</a><br />
                  <a target="_blank" href='college.php?college=<?php echo urlencode("公共管理学院");?>'>公共管理学院</a></p>
              </div>
              <div class="thirds">
                <p class="title"><img src="../images/notice.gif" alt="" width="12" height="13" /><a href="http://snews.solucija.com/">青溪学园</a><br />
                </p>
                <p><a target="_blank" href='college.php?college=<?php echo urlencode("农业与生物技术学院");?>'>农业与生物技术学院</a><br />
                  <a target="_blank" href='college.php?college=<?php echo urlencode("环境与资源学院");?>'></a><a target="_blank" href='college.php?college=<?php echo urlencode("生命科学学院");?>'>生命科学学院</a></p>
                <p><a target="_blank" href='college.php?college=<?php echo urlencode("管理学院");?>'>管理学院</a></p>
                <p><a target="_blank" href='college.php?college=<?php echo urlencode("外国语学院");?>'>外国语学院</a></p>
              </div>
              <div class="thirds">
                <p class="title"><img src="../images/notice.gif" alt="" width="12" height="13" /><a href="http://snews.solucija.com/">白沙学园</a><br />
                </p>
                <p><a target="_blank" href='college.php?college=<?php echo urlencode("经济学院");?>'>经济学院</a><br />
                  <a target="_blank" href='college.php?college=<?php echo urlencode("生物系统工程与食品科学学院");?>'>生物系统工程与食品科学学院</a><br />
                  <a target="_blank" href='college.php?college=<?php echo urlencode("建筑工程学院");?>'>建筑工程学院</a></p>
              </div>
    </div>
	<div class="clear_height" ></div>
	<? } else {
			$query=query("shop","level>0 and college='$college' ORDER BY level DESC,date DESC");
			$shop = mysql_fetch_array($query);
			$rsnum=mysql_num_rows($query);
			//分页设置
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
	
    <div class="left_box">
      <h3><? echo urldecode($college);?>书店展示</h3>
    </div>
    <table width="100%" border="0">
      
      <tr>
        <td><? if(!$shop) echo "该学院暂时没有书店，等您来创造了^_^";
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
    <? }
		//分页设置
			if($rsnum!=0)
			{
			?>
    <table width="100%" border="0">
      <tr>
        <td width="35%"><a href="<? echo $path;?>?page=1&amp;college=<?=urlencode($college)?>">首页</a>
            <? if($page!=1) echo "<a href=".$path."?page=".($page-1)."&college=".urlencode($college).">上一页</a>";
    else echo "上一页";?>
            <? if($page!=$pagecount) echo "<a href=".$path."?page=".($page+1)."&college=".urlencode($college).">下一页</a>";else echo "下一页";    ?>
            <a href="<? echo $path;?>?page=<? echo $pagecount?>&amp;college=<?=urlencode($college)?>">末页</a>
            <!--分页结束--></td>
        <td width="62%">当前第
          <?=$page?>
          页/共
          <?=$pagecount?>
          页。【本学院书店共有
          <?=$rsnum?>
          家】</td>
        <td width="3%">&nbsp;</td>
      </tr>
    </table>
<? }?>
  </div>
  <? include("right-bar.php");?>
  <? include("footer.php");?>		