<?php
function smarty_function_admin_pagination($params, &$smarty) {
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
	
	echo("<table border=\"0\" cellpadding=\"0\" style=\"border-collapse: collapse\" width=\"100%\" id=\"table_pg\">");
	echo("<form name='pg_form' id='pg_form' action='$pageurl' method='post'>");
	echo("<td width='115'>总共<font color=red>".$pagecount."</font>页 当前第<font color=red>".$pageno."</font>页</td>");
	echo("<td width='51'>跳转到第</td>");
	echo("<td width='22'><p style='text-align: center'>");
	echo("<input type='text' name='pageno' size='2' style='border: 1px solid #C0C0C0'></td>");
	echo("<td width='23'><p style='text-align: center'>页</td>");
	echo("<td><input type='image' border='0' src='img/go.gif' width='31' height='22'></td><td>　</td>");
	echo("<td valign='middle'><a href='javascript:pagination(1);'><img src='img/bt_page_home.gif' width='13' height='9' border='0'>首页</a></td>");
	echo("<td><a href='javascript:pagination(" . ($pageno - 1) . ");'><img src='img/bt_page_prev.gif' width='14' height='11' border='0'>上一页</a></td>");
	echo("<td><a href='javascript:pagination(" . ($pageno + 1) . ");'><img src='img/bt_page_next.gif' width='14' height='11' border='0'>下一页</a></td>");
	echo("<td><a href='javascript:pagination(" . ($pagecount > 0 ? $pagecount : 1) . ");'><img src='img/bt_page_end.gif' width='13' height='9' border='0'>末页</a></td>");
	
	if (isset($hiddenstr)) {
		foreach($hiddenstr as $_key=>$_val) {
			echo("<input type='hidden' name='" . $_key . "' value='" . $_val . "'>");
		}
	}
	echo("</form>");
	echo("</tr>");
	echo("</table>");
}
?>