<title>right-bar</title><div id="right">
	<? if($current=='h' or $current=='m'){?>
			<div class="right_articles">
				<table width="100%" border="0">
                  <tr>
                    <td width="12%"><img src="../images/read.gif" width="79" height="37" /></td>
                    <td width="88%"><b><img src="../images/notice.gif" alt="" width="12" height="13" />					<?
					$query=query("t_news","type='index'");
					$news = mysql_fetch_array($query);
					echo "关于本站";
					?></b>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><? //$news["content"]?>
                    	本站专门为浙大学生提供求购与发布二手书籍信息的平台<a target="_blank" href="forum.php?url=register.php">注册</a>后均可以在本站开店卖书，同时提供各种<a target="_blank" href="search.php">搜索</a>方式为用户找到需要的二手书籍信息<br />
让我们一起分享手中的二手书吧~</td>
                  </tr>
                </table>
				<p>
  </div><? }?>
			<div class="right_articles">
			  <table width="100%" border="0">
                <tr>
                  <td width="12%"><img src="../images/link.gif" width="79" height="37" /></td>
                  <td width="88%"><b><img src="../images/notice.gif" alt="" width="12" height="13" /> 分类检索 </b></td>
                </tr>
                <tr>
                  <td colspan="2"><ul>
                      <li>图书馆模式检索：<br />
                          <a href="display_sort.php?sort=A"> A毛邓 </a> | <a href="display_sort.php?sort=B"> B哲学 </a> | <a href="display_sort.php?sort=C">C社科 </a> | <a href="display_sort.php?sort=D">D法律 </a> | <a href="display_sort.php?sort=E"> E军事 </a> | <a href="display_sort.php?sort=F"> F经管 </a> | <a href="display_sort.php?sort=G"> G文体 </a> | <a href="display_sort.php?sort=H"> H语言 </a> | <a href="display_sort.php?sort=I"> I文学 </a> | <a href="display_sort.php?sort=J"> J艺术 </a> | <a href="display_sort.php?sort=K"> K历史 </a> | <a href="display_sort.php?sort=O"> O数理化</a> | <a href="display_sort.php?sort=P"> P天文地理</a> | <a href="display_sort.php?sort=Q"> Q生物 </a> | <a href="display_sort.php?sort=R"> R医药 </a> | <a href="display_sort.php?sort=S"> S农业 </a> | <a href="display_sort.php?sort=T">T计算机 </a> | <a href="display_sort.php?sort=U"> U交通运输 </a> | <a href="display_sort.php?sort=X"> X环境 </a> | <a href="display_sort.php?sort=Z">Z综合 </a></li>
                    <li>学院专业模式检索：<br />
                          <a target="_blank" href='college.php?college=<?php echo urlencode("机械与能源工程学");?>'>机能</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("环境与资源学院");?>'>环资</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("计算机科学与技术学院(软件学院)");?>'>计算机软件</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("竺可桢学院");?>'>竺院</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("人文学院");?>'>人文</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("理学院");?>'>理学院</a> |<a target="_blank" href='college.php?college=<?php echo urlencode("信息工程与科学学院");?>'>信息</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("动物科学学院");?>'>动科</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("生物医学工程与仪器科学学院 ");?>'>生仪 </a> | <a target="_blank" href='college.php?college=<?php echo urlencode("法学院");?>'>法学院</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("教育学院");?>'>教育</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("材料与化工学院");?>'>材化</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("医学院");?>'>医学院</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("药学院");?>'>药学院</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("电气工程学院");?>'>电气</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("公共管理学院");?>'>公管</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("农业与生物技术学院");?>'>农生</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("生命科学学院");?>'>生科</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("管理学院");?>'>管理</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("外国语学院");?>'>外国语</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("经济学院");?>'>经院</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("生物系统工程与食品科学学院");?>'>生工食品</a> | <a target="_blank" href='college.php?college=<?php echo urlencode("建筑工程学院");?>'>建工</a></li>
                  </ul></td>
                </tr>
              </table>
			  <p>
  </div>

<!--<div class="right_articles" style="padding:0px;">
<script type="text/javascript">
google_ad_client = "pub-7574178975245170";
/* 300x250, 创建于 10-9-30 */
google_ad_slot = "8195129347";
google_ad_width = 300;
google_ad_height = 250;
//
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>-->
			<div class="right_articles">
				<table width="100%" border="0">
                  <tr>
                    <td width="12%"><img src="../images/read.gif" width="79" height="37" /></td>
                    <td width="88%"><b><img src="../images/notice.gif" alt="" width="12" height="13" />听听eker怎么说</b><br />
                      身边的同学都在用~ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="contact.php">我也来说说~</a></td>
                  </tr>
                </table>
<table width="100%" align="center">
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
			$pagesize=4; //每页显示的条数
			include("../include/page_num.php");
			while(($qalist = mysql_fetch_array($query))&&$i<$pagesize){
		?>        	
		<div class="mgt10">
          	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="padding:0px 20px; border:none;">
				<tr>
    				<td width="13%" style="font-size:9px;"><span style="color:#009933; font-weight:bold;"><a name="<?=$qalist["id"]?>" id="1"></a>NO.</span><?=$i+1?></td>
    				<td width="59%"><?=$qalist["name"]?></td>
			      	<td width="28%" align="left" style="font-size:9px;"><?=$qalist["date"]?></td>
				</tr>
  				<tr>
    				<td colspan="3"><?=$qalist["content"]?></td>
    			</tr>
			</table>
------------------------------      	  </div>
		<? 
			$i++;
			} 
		 ?>
		</td>
	</tr>
</table>				<p>&nbsp;</p>
  </div>
  
			<div class="right_articles">
				<table width="100%" border="0">
                  <tr>
                    <td width="12%"><img src="../images/link.gif" width="79" height="37" /></td>
                    <td width="88%"><b><img src="../images/notice.gif" alt="" width="12" height="13" />友情链接</b><br />
                      需要与本站合作链接，点击<a href="link_apply.php" onclick="{popup=window.open('','popupnav','width=500',height=200,resizable=1,scrollbars=0');
	popup.location.href='link_apply.php';}">申请</a> </td>
                  </tr>
                </table>
				<table width="100%" border="0">
                  <? 
			$query=query("t_ads","value>0 and type='frd_link' order by value DESC,title ASC");
			$array = mysql_fetch_array($query);
			while($array){
			?>
                  <tr>
                    <td width="7%"><div align="center"><img src="../images/news.gif" width="7" height="7" /></div></td>
                    <td width="93%"><a href="<?=$array["link"]?>" target="_blank">
                      <? echo cut_str($array["title"],40);?>
                    </a></td>
                  </tr>
                  <? 
			$array = mysql_fetch_array($query);
			}
			?>
                </table>
				<p>&nbsp;</p>
  </div>
			<div class="right_articles">
			  <table width="100%" border="0">
                <tr>
                  <td width="12%"><img src="../images/link.gif" width="79" height="37" /></td>
                  <td width="88%"><b><img src="../images/notice.gif" alt="" width="12" height="13" />数据统计</b><br /></td>
                </tr>
              </table>
<? 
	$today=date("Y-m-d");
	//echo $today;
	$query=mysql_query("select sum(number) as sum from visit_number");
	$visit_sum = mysql_fetch_array($query);
	$query3=mysql_query("select * from visit_number where date='$today'");
	$visit = mysql_fetch_array($query3);
	if(!$visit){
	$today_number=1;
	}
	else
	$today_number=$visit["number"];
?>
			  <table width="100%" border="0">
                <? 
			$query1=mysql_query("select count(*) as book_number from book where tag>0");
			$book = mysql_fetch_array($query1);
			$query2=mysql_query("select count(*) as shop_number from shop where level>0");
			$shop = mysql_fetch_array($query2);
			?>
                <tr>
                  <td><div align="left">您是第</div></td>
                  <td><div align="left">0000<?=$visit_sum["sum"]?>
                  </div></td>
                  <td colspan="2">位访问本站的朋友</td>
                </tr>
                <tr>
                  <td width="22%"><div align="left">今日访问
                    
                  </div></td>
                  <td width="25%">
                    <div align="left">
                      <?=$today_number?>
                    </div></td>
                  <td colspan="2">&nbsp;</td>
                </tr>
                
                <tr>
                  <td colspan="3">截至今日本站共有藏书<?=$book[book_number]-1?></td>
                  <td width="37%">本</td>
                </tr>
                <tr>
                  <td colspan="3">截至今日本站共有书店&nbsp;&nbsp;<?=$shop[shop_number]?></td>
                  <td>家</td>
                </tr>
              </table>
  </div>
</div>
