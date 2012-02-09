
a = new dTree('a');
a.config.folderLinks=false;
a.config.useStatusText=true;
a.config.useCookies=false;
a.config.closeSameLevel=false;

a.add(0,-1,'<B>后台管理菜单</B>','javascript: void(0);');

a.add(1, 0,'基本信息管理','');
a.add(2, 1,'配置管理','config.php');
a.add(3, 1,'关于我们','profile.php?type=about');
a.add(4, 1,'联系我们','profile.php?type=contact');
a.add(5, 1,'首页简介','news.php?type=index');
a.add(6, 1,'新闻列表','news.php?type=news');
a.add(7, 1,'留言列表','feedback.php');

a.add(10, 0,'权限管理','');
a.add(11, 10,'系统管理员','admin.php?roleid=1&delflag=0');
a.add(12, 10,'网站管理员','admin.php?roleid=2&delflag=0');
a.add(13, 10,'内容管理员','admin.php?roleid=3&delflag=0');
a.add(14, 10,'已删除管理员','admin.php?delflag=1');
	
a.add(20, 0,'书籍管理','');
a.add(21, 20,'书店列表','shop.php');
a.add(24, 20,'-----------','');
a.add(25, 20,'书籍列表','book.php');



a.add(30, 0,'广告与链接','');
a.add(31, 30,'首页滚动图片','ads.php?type=top_pic');
a.add(32, 30,'页脚图片链接','ads.php?type=foot_pic');
a.add(33, 30,'页脚文字链接','ads.php?type=foot_text');
a.add(34, 30,'友情链接管理','ads.php?type=frd_link');

a.add(40, 0,'系统日志','');
a.add(41, 40,'操作日志','history_oper.php');
a.add(42, 40,'搜索日志','history_srch.php');

a.add(50, 0,'统计信息','');
a.add(51, 50,'流量统计','visit_num.php');
a.add(52, 50,'交易统计','history_sell.php');
document.write(a);
eval("a.closeAll();");