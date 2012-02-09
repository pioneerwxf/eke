<div id="top_info">
			<p>
              <? if(!isset($discuz_userss)) {?>
              <a href="myshop.php">登录</a> |
              <? }?>
              <a href="../bbs/register.php" target="_blank">开书店</a> | 
				<a href="#" title="eke浙大校内二手书交易网站" style="CURSOR: hand" onclick="window.external.addFavorite('<? $sys_query=query("t_sys_config","name='webaddress'");
		$sys_array = mysql_fetch_array($sys_query);
		if($sys_array) echo $sys_array["value"];
		?>/','eke浙大校内二手书交易网站')"> 加入收藏</a> | 
				<a href="#" onclick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://10.71.160.201/eke/');">设为首页</a> | 
				<a href="contact.php">联系我们</a>
<br />
              <? if(!isset($discuz_userss)){?>
<span id="loginbutton"><a href="../bbs/register.php" target="_blank" title="点击一键开店" class="highlight">快速注册</a></span><b>立即成为易客，拥有e店</b>
	  <form id="form1" name="form1" method="post" action="../bbs/logging.php?action=login&amp;loginsubmit=true">
	   <input type="hidden" name="formhash" value="<?=FORMHASH?>" />
		<input type="hidden" name="cookietime" value="2592000" />
		<input type="hidden" name="loginfield" value="username" />
		<label>用户名
	    <input style="width:80px; height:16px;" name="username" type="text" id="username" size="10" onblur="if(this.value==''){this.value='请输入用户名';}" 
onfocus="if(this.value==''||this.value=='请输入用户名'){this.value='';}" 
value=请输入用户名 style="color:#999999" />
	    </label>
	    <label>
	    密码
	    <input style="width:60px; height:18px;" name="password" type="password" id="password" size="10" />
	  </label>
	    <label>
	    <input type="submit" name="Submit" class="button" value="登录" />
	    </label>
  </form>

  <p>
      <? } else{?>
	  <a href="../bbs/space.php?action=viewpro&uid=<?=$discuz_uid;?>" title="进入我的空间">
	  <?=$discuz_userss;?></a> 您好 
	  </a><span id="loginbutton"><a href="myshop.php" class="highlight"> 进入我的书店</a></span>|[<a href="../bbs/<?=$link_logout?>">退出</a>]<br />
    <? //查找是否有还未查看的短消息new!=0,其中new=1代表还未不想显示，new=2代表不再提示
	$array=select("eke_pms","new=1 and msgtoid=$discuz_uid");
	$totalRows=totalRows("eke_pms","new!=0 and msgtoid=$discuz_uid and delstatus!=2");
	?>
    <? 
	if($totalRows){?> 
      <bgsound src="../bbs/images/sound/pm_<?=$pmsound?>.wav" width="18" height="18" hidden=true >
      <? }	if($totalRows) { ?>您有<span class="highlight"><?=$totalRows?>条新短消息</span> <a href="forum.php?url=pm.php">[查看详情]</a> | 
			<? if($newpm) { ?><a href="forum.php?url=pm.php?action=noprompt" onclick="ajaxget(this.href, 'pmprompt', null, null, 'none');doane(event);">[不再提示]</a>
			<? } }
	 else {?>您暂时没有新短消息 | <a href="forum.php?url=pm.php">进入我的收件箱</a>
			<? } }?>
  </div>
		
		<div id="logo">
	      <a href="index.php"><img src="../images/logo.gif" alt="eKe" border="0"  class="image"/></a> 
	 <h1><a href="index.php" style="color:#39F; text-decoration:none;">浙大小當當--eKe淘书网</a></h1>
	 <p id="slogan"><?
		$query=query("t_sys_config","name='subname'");
		$array = mysql_fetch_array($query);
		if($array) echo $array["value"];
		?></p>
</div>