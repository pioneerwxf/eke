<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
/*
PinkDresser Style for Discuz!(R)
URL: http://www.discuz.net
(C) 2001-2007 Comsenz Inc.
<style type="text/css">
*/
* { word-break: break-all; word-wrap: break-word; }
body { <?=BGCODE?>; text-align: center; background-repeat: repeat-x; }
.wrap { text-align: left; margin: 0 auto; overflow: hidden; margin-bottom: 0; background: #FFF url(<?=IMGDIR?>/wrap_shadow.gif) repeat-y 0 0; width: 992px; w\idth: 922px; padding: 0 35px; }
.message { margin: 3em 10em 5em !important; padding: 0 0 2em !important; }
	.message p { margin: 1em; }
#header { overflow: hidden; width: 992px; w\idth: 952px; padding: 0 20px; margin: 0 auto; height: 122px; background: url(<?=IMGDIR?>/header.gif) no-repeat 894px -122px; }
	#header h2 { float: left; padding: 5px 0; height: 80px; background: url(<?=IMGDIR?>/header.gif) no-repeat 0 0; }

			#menu li a { text-decoration: none; float: left; color: <?=HEADERMENUTEXT?>; padding: 4px 8px 3px; }

	#announcement div { border: 1px solid <?=TABLEBG?>; padding: 0 10px; line-height: 35px !important; height: 36px; overflow-y: hidden;}

	.pages a, .pages strong, .pages em, .pages kbd { float: left; padding: 0 8px; line-height:26px; }

	.legend label { padding: 0 15px; }

	.mainbox table { width: 99.9%; }


#wysiwyg { font: <?=MSGFONTSIZE?>/1.6em <?=FONT?> !important; background: #FFF; background-image: none !important; }

			.postform .btns { margin-top: 0.5em; line-height: 30px; color: <?=LIGHTTEXT?>; font-family: Simsun, "Times New Roman"; }

			#smilieslist h4 { color: <?=HIGHLIGHTLINK?>; padding: 5px; background: <?=COMMONBOXBG?>; border-bottom: 1px solid <?=COMMONBOXBORDER?>; text-align: left; }

#ad_headerbanner { float: right; margin: 15px 10px 0 0; }

.postform .special, #postform .special { font-weight: bold; color: <?=HIGHLIGHTLINK?>;}

	#menu { border: none; height: 32px; clear: both; background: transparent url(<?=IMGDIR?>/header.gif) no-repeat 0 -90px; }
		.frameswitch, #menu ul { border: none; }
		#menu li.hover, #menu li.current { background-color: <?=CATCOLOR?>; border: 1px solid; border-color: <?=BORDERCOLOR?> <?=BORDERCOLOR?> <?=BGCOLOR?>; }
		#menu li a { background: none; }
	.mainbox tbody th, .mainbox tbody td { border-top: 1px solid <?=BGBORDER?>; padding: 5px; }
		.forumlist tbody th, .threadlist tbody th, .forumlist tbody td.nums, .threadlist tbody td.nums, .threadlist tbody td.author, .threadlist tbody td.folder { border-right: 1px solid <?=BGBORDER?>; }
		.forumlist tbody td, .threadlist tbody td { border-left: 3px solid <?=TABLEBG?>; padding: 5px; }
		.threadlist tbody td.folder { border-left: none; }
			.threadlist tbody td.icon { padding-left: 5px; }
	#wysiwyg { background-image: none !important; }
	#footer { width: 992px; margin: 0 auto; border: none; padding: 0; height: 137px; background: #FFF url(<?=IMGDIR?>/footer_shadow.gif) repeat-x 0 0; }
		#footer .wrap { padding: 15px 0 0 50px; width: 992px; w\idth: 942px; height: 137px; he\ight: 122px; background: transparent url(<?=IMGDIR?>/footer_shadow.gif) no-repeat 0 -137px; }
		#footlinks { height: 137px; margin: -15px 0 0 0; padding: 15px 50px 0 0; background: transparent url(<?=IMGDIR?>/footer_shadow.gif) no-repeat 100% -274px; }

