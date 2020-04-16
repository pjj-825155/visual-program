<html>
<head>
	<meta charset=utf-8">
	<title>Excle查询</title>
    <style>
        .a{
            width: 300px;
            height: 30px;
        }
        #b{
            width: 1520px;
            border: 1px solid white;
            text-align:center;  
		}
    </style>
</head>
<body>
	<?php
		header("content-type:text/html;charset=utf-8");
		if(!empty($_POST['check']))
		{
			//显示文字
			echo "人物";
 			echo $_POST['root'];
			echo "的三层下线";
			//把输入的保存到txt中
			$filename1="root_use.txt";
			$handle=fopen($filename1,"w");
			$str=fwrite($handle,$_POST['root']);
			$str=fwrite($handle,"\n");
			fclose($handle);
			//运行python程序
			$find_some=exec('D:\python37\python E:\wamp64\www\lcy\find_excle_some.py');
			$find_member=exec('D:\python37\python E:\wamp64\www\lcy\find_member.py');
		}
		//打开生成的html
		$temp=file_get_contents('1.html'); 
		echo $temp;
	?>
	<div id="b">
		<form id="form1" name="form1" method="post" action="">
			<p>查找上线名:<input type="text" maxlength="100" name="root" size="30" list="name" autocomplete="off"/>
			<input type="submit" name="check" value="查询" /></p>
  				<datalist id = "name">
        			<?php
						$file = fopen("son.txt","r");
						while(! feof($file)){
							printf("<option value=%s label=%s />",fgets($file),fgets($file));
  						}
						fclose($file);
					?>	 
		</form>
		<li><a href='http://localhost:8081/lcy/visual_excle.php'>Excle查询</a></li>
		<li><a href='http://localhost:8081/lcy/visual_sql.php'>Mysql查询</a></li>
	</div>
</body>
</html>
