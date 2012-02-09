<? $current='m';?>
<? include("header.php");?>
<? include("top.php");?>
<? include("nav.php"); ?>
<div id="left">
<a name="begin" id="begin"></a>
<div class="left_articles">
<? //检查登录否
	if(!isset($discuz_uid) or !$discuz_uid){
		echo "<script type='text/javascript'>location.href='index.php';</script>"; exit();}
	elseif(isset($discuz_uid) and $discuz_uid )
		$discuz_uid=$discuz_uid;
	//else if(isset($_GET['uid']))
	//$discuz_uid=$_GET['uid'];
	$array=select("shop","userid=$discuz_uid");
	$user=select("eke_members","uid=$discuz_uid");
	$shopid=$array['shopid'];
?>
<h3>书店设置</h3>
<form action="post_shop.php?shopid=<?=$shopid?>" method="post" enctype="multipart/form-data">
<table width="98%" border="0">
  <tr>
    <td colspan="3"><div align="center">亲爱的<?=$user["username"]?>，您已经拥有帐号<?=$user["username"]?>，现在您可以个性化您自己的书店了（带*为必填项）</div></td>
    </tr>
  <tr>
    <td width="21%">*书店名字</td>
    <td width="79%" colspan="2"><label>
      <input name="shopname" type="text" id="shopname" value="<?=$array["shopname"]?>" />
    您可以再修改突出您的特色</label></td>
  </tr>
  <tr>
    <td>*书店店主</td>
    <td colspan="2"><input name="owner" type="text" id="owner" value="<?=$array["owner"]?>" />
      建议您填写真实姓名</td>
  </tr>
  <tr>
    <td>*店主手机</td>
    <td colspan="2"><input name="phone" type="text" id="phone" value="<?=$array["phone"]?>" />
      若有人预订您的书籍，我们会以短信方式通知您</td>
  </tr>
  <tr>
    <td>*店主eMail</td>
    <td colspan="2"><input name="email" type="text" id="email" value="<?=$array["email"]?>" /></td>
  </tr>
    <tr>
    <td>书店广告词</td>
    <td colspan="2"><input name="adv" type="text" id="adv" value="<?=$array["adv"]?>" />
限制50个汉字字符</td>
  </tr>
    <tr>
    <td>所属学院</td>
    <td colspan="2">
	<select name="college" id="college1">
		 <? if($array["college"]) {?>
		 <option value="<?=$array["college"]?>"  selected="selected"><?=$array["college"]?></option>
		 <? } else {?>
		 <option value=""  selected="selected">--请选择学院--</option>
		 <? }?>
	     <option value="竺可桢学院">竺可桢学院</option>
	     <option value="人文学院">人文学院</option>
	     <option value="法学院 ">法学院 </option>
	     <option value="理学院 ">理学院 </option>
	     <option value="医学院 ">医学院 </option>
	     <option value="教育学院 ">教育学院 </option>
	     <option value="管理学院 ">管理学院 </option>
		 <option value="公共管理学院 ">公共管理学院 </option>
	     <option value="药学院">药学院</option>
	     <option value="经济学院">经济学院</option>
	     <option value="外国语学院">外国语学院</option>
	     <option value="动物科学学院">动物科学学院</option>
	     <option value="电气工程学院">电气工程学院</option>
	     <option value="生命科学学院 ">生命科学学院 </option>
	     <option value="建筑工程学院 ">建筑工程学院 </option>
	     <option value="环境与资源学院 ">环境与资源学院 </option>
	     <option value="材料与化工学院 ">材料与化工学院 </option>
	     <option value="机械与能源工程学">机械与能源工程学</option>
	     <option value="信息工程与科学学院">信息工程与科学学院</option>
	     <option value="生物系统工程与食品科学学院 ">生物系统工程与食品科学学院 </option>
	     <option value="计算机科学与技术学院(软件学院)">计算机科学与技术学院(软件学院)</option>
	     <option value="生物医学工程与仪器科学学院 ">生物医学工程与仪器科学学院 </option>
	     <option value="农业与生物技术学院">农业与生物技术学院</option>
          </select>
	便于按学院搜索</td>
  </tr>
    <tr>
      <td>书店横幅</td>
      <td colspan="2"><label>
        <input name="Posterfile" type="file" id="Posterfile" />
        <input type="hidden" name="poster" value="<?=$array["poster"]?>"/>
        书店横幅
        可不上传，默认如下：<br />
        为了最佳显示图片，请上传长*宽为635*120像素的图片文件，大小小于1M<br />
      <img src="../images/banner.jpg" alt="" width="425" height="80" /></label></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td><label>
      <input type="submit" name="Submit2" value="设置完成" class="button" />
      </label></td>
    <td><label>
      <input type="reset" name="Submit3" value="重新设置" class="button" />
    </label></td>
    </tr>
</table>
</form>
			<div class="clear" ></div>
  </div>
  </div>
	<? include("right-bar.php");?>
	<? include("footer.php");?>		