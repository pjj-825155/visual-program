<html>
	<head>
		<meta charset=utf-8">
		<title>数据库查询</title>
		<style>
			#b{width: 100%;
				text-align:center;  
				padding:20px;
				margin-top:30px;
				height:100%;}
			/*设置置顶导航栏*/
			body {margin:0;}
			ul {list-style-type: none;
				margin: 0;
				padding: 0;
				overflow: hidden;
				background-color:gray;
				position: fixed;
				top: 0;
				width: 100%;}
			li {float: left;}
			li a {display: block;
				color: white;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;}
			li a:hover:not(.active) {background-color: black;}
			.active {background-color: green;}
			/*设置输入框样式*/
			input[type=text] {width: 20%;
			padding: 5px 15px;
			margin: 5px 0;
			box-sizing: border-box;
			border: 5px solid #ccc;
			-webkit-transition: 0.5s;
			transition: 0.5s;
			outline: none;}
			input[type=text]:focus {border: 5px solid #555;}
			/*设置按钮*/
			input[type=submit]{background-color: green;
			border: none;
			color: white;
			padding: 5px 20px;
			text-decoration: none;
			margin: 5px 3px;
			cursor: pointer;}
		</style>
	</head>
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
			$find_some=exec('D:\python37\python E:\wamp64\www\lcy\find_sql_some.py');
			$find_member=exec('D:\python37\python E:\wamp64\www\lcy\find_member.py');
			$change_html=exec('D:\python37\python E:\wamp64\www\lcy\change_html.py');
		}
		//打开生成的html
		$temp=file_get_contents('1.html');
		echo $temp;
	?>
	<body>
		<ul>
			<li><a href='http://localhost:8081/lcy/visual_excle.php'>Excle查询</a></li>
			<li><a href='http://localhost:8081/lcy/visual_sql.php'>Mysql查询</a></li>
			<li style="float:right"><a class="active" href="//www.baidu.com/">帮助</a></li>
			<li style="float:right"><a class="active" href="//www.baidu.com/">登录</a></li>
		</ul>
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
					</datalist>
			</form>
	</div>
</body>
</html>
