<?php
function smarty_function_pagination($params, &$smarty) {
	foreach($params as $_key => $_val) {
		switch($_key){
		case 'pager':
                $$_key = $_val;
                break;
        case 'hiddenstr':
                $$_key = (array)$_val;
                break;
		}
	}
	//var_dump($pager);
	$pageurl = $pager->pageurl;
	$pageno = $pager->pageno;
	$pagecount = $pager->pagecount;
	$count = $pager->count;
	
	echo("<table width='100%' border='0' cellspacing='0' cellpadding='0'>");
	echo("<form name='pg_form' id='pg_form' action='$pageurl' method='post'>");
	echo("<tr>");
	echo("<td width=\"69%\" class=\"textr\">&nbsp;<a href=\"javascript:pagination(1);\">首页</a>");
	echo("&nbsp;<a href=\"javascript:pagination(" . ($pageno - 1) . ");\">上一页</a>");
	echo("&nbsp;<a href=\"javascript:pagination(" . ($pageno + 1) . ");\">下一页</a>");
	echo("&nbsp;<a href=\"javascript:pagination(" . ($pagecount > 0 ? $pagecount : 1) . ");\">尾页</a>");
	echo("&nbsp;共<span class=\"fontr\">$pagecount</span>页");
	echo("&nbsp;当前第<span class=\"fontr\">$pageno</span>页&nbsp;");
	echo("&nbsp;跳第<input name=\"pageno\" type=\"text\" style=\"width:15px;\" size=\"1\" />页");
	echo("</td>");
	echo("<td width=\"2%\">&nbsp;</td>");
	echo("<td width=\"29%\" align=\"left\"><input type=\"image\" src=\"img/go.gif\" name=\"Submit332\" value=\"提交\" class=\"input_go\"/></td>");
	echo("</tr>");
	if (isset($hiddenstr)) {
		foreach($hiddenstr as $_key=>$_val) {
			echo("<input type='hidden' name='" . $_key . "' value='" . $_val . "'>");
		}
	}
	echo("</form>");
	echo("</table>");
}
?>