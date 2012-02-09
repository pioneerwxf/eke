<?php
//调用此模块前应该先定义$type和$result
//记录操作员日志的函数
///	function operlog(int $opertype,int $result)
//	{
		$srip=$_SERVER["REMOTE_ADDR"];
		$srtime=date("Y-m-d H:i:s");
		//将以上信息插入OperLog数据表
		if($title){
		$sql_log="insert into t_search_history (srtime,srip,keyword,type)
		 values ('$srtime','$srip','$title','书名')";
		mysql_query($sql_log);
		}
		if($author){
		$sql_log="insert into t_search_history (srtime,srip,keyword,type)
		 values ('$srtime','$srip','$author','作者')";
		mysql_query($sql_log);
		}
		if($public){
		$sql_log="insert into t_search_history (srtime,srip,keyword,type)
		 values ('$srtime','$srip','$public','出版社')";
		mysql_query($sql_log);
		}
		if($shopname){
		$sql_log="insert into t_search_history (srtime,srip,keyword,type)
		 values ('$srtime','$srip','$shopname','店名')";
		mysql_query($sql_log);
		}
		if($owner){
		$sql_log="insert into t_search_history (srtime,srip,keyword,type)
		 values ('$srtime','$srip','$owner','店主')";
		mysql_query($sql_log);
		}
		if($adv){
		$sql_log="insert into t_search_history (srtime,srip,keyword,type)
		 values ('$srtime','$srip','$adv','广告')";
		mysql_query($sql_log);
		}
		if($college){
		$sql_log="insert into t_search_history (srtime,srip,keyword,type)
		 values ('$srtime','$srip','$college','学院')";
		mysql_query($sql_log);
		}
//	}
?>