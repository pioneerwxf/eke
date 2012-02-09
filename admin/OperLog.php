<?php
//调用此模块前应该先定义$type和$result
//记录操作员日志的函数
///	function operlog(int $opertype,int $result)
//	{
		$ip=$_SERVER["REMOTE_ADDR"];
		$optime=date("Y-m-d H:i:s");
		$operid=$_SESSION['adminid'];
		if(empty($operid))
			$operid=0;
		switch ($opertype)
		{
			case '20':$descrip='退出系统';break;
			case '1':$descrip='登录系统';break;
			case '2':$descrip='修改前台配置';break;
			case '3':$descrip='增加管理员';break;
			case '4':$descrip='删除管理员';break;
			case '5':$descrip='修改管理员信息';break;
			case '6':$descrip='增加书店';break;
			case '7':$descrip='删除书店';break;
			case '8':$descrip='修改书店信息';break;
			case '9':$descrip='增加书籍';break;
			case '10':$descrip='删除书籍';break;
			case '11':$descrip='修改书籍信息';break;
			case '12':$descrip='添加新闻';break;
			case '13':$descrip='删除新闻';break;
			case '14':$descrip='修改静态信息';break;
			
			default:$descrip='异常操作';break;
		}
		
		//将以上信息插入OperLog数据表
		$sql_log="insert into t_operlog (operid,optime,opertype,ip,result,descrip)
		 values ('$operid','$optime','$opertype','$ip','$result','$descrip')";
		//echo $sql_log;
		mysql_query($sql_log);
//	}
?>