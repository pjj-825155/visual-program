<html>
	<head>
		<meta charset=utf-8">
		<title>数据库登录</title>
		<style>
			/*设置div整体样式*/
			div{width: 100%;
				text-align:center;  
				padding:20px;
				margin-top:30px;
				background-color:gainsboro;
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
			/*设置密码框样式*/
			input[type=password] {width: 20%;
			padding: 5px 15px;
			margin: 5px 0;
			box-sizing: border-box;
			border: 5px solid #ccc;
			-webkit-transition: 0.5s;
			transition: 0.5s;
			outline: none;}
			input[type=password]:focus {border: 5px solid #555;}
			/*设置按钮*/
			input[type=submit]{background-color: green;
			border: none;
			color: white;
			padding: 5px 20px;
			text-decoration: none;
			margin: 5px 3px;
			cursor: pointer;}
			/*下拉菜单*/
			select {width: 100%;
			padding: 16px 20px;
			border: none;
			border-radius: 4px;
			background-color: #f1f1f1;}
		</style>
	</head>
		<?php
			header("content-type:text/html;charset=utf-8");
			$filename4="root_all.txt";
			$gen=fopen($filename4,"w");
			fclose($gen);
			//查找root数量
			if(!empty($_POST['find'])){
				$filename2="sql.txt";
				$mysql=fopen($filename2,"w");
				//记录信息
				$str=fwrite($mysql,$_POST['ip']);
				$str=fwrite($mysql,"\n");
				$str=fwrite($mysql,$_POST['name']);
				$str=fwrite($mysql,"\n");
				$str=fwrite($mysql,$_POST['password']);
				$str=fwrite($mysql,"\n");
				$str=fwrite($mysql,$_POST['chart']);
				$str=fwrite($mysql,"\n");
				$str=fwrite($mysql,$_POST['sheet']);
				$str=fwrite($mysql,"\n");
				$str=fwrite($mysql,$_POST['from_user']);
				$str=fwrite($mysql,"\n");
				$str=fwrite($mysql,$_POST['to_user']);
				$str=fwrite($mysql,"\n");
				fclose($mysql);
				//运行python程序
				exec('D:\python37\python E:\wamp64\www\lcy\find_sql_root.py',$log,$status);
				if($status==0){echo "<script>alert('查找主要人物成功')</script>";
					echo "<script>alert('可以选择关系主人物')</script>";}
				else{echo "<script>alert('查找主要人物失败')</script>";}
			}
			if(!empty($_POST['save'])){
				$filename1="state.txt";
				$filename3="root_use.txt";
				$state=fopen($filename1,"w");
				$gen=fopen($filename3,"w");
				//记录状态
				$str=$_POST["d"];
				if($str==1){
					$str=fwrite($state,$_POST['title']);
					$str=fwrite($state,"\n");
				}
				if($str==0){
					$str=fwrite($state,"0");
					$str=fwrite($state,"\n");
				}
				fclose($state);
				//记录根
				$str=fwrite($gen,$_POST['root']);
				$str=fwrite($gen,"\n");
				fclose($gen);
				//运行python程序
				exec('D:\python37\python E:\wamp64\www\lcy\find_sql_all.py',$log,$status);
				if($status==0){
					echo "<script>alert('全局搜索成功')</script>";
					exec('D:\python37\python E:\wamp64\www\lcy\find_sql_some.py',$log,$status);
					if($status==0){
						echo "<script>alert('查找人物成功')</script>";
						exec('D:\python37\python E:\wamp64\www\lcy\find_member.py',$log,$status);
						if($status==0){
							echo "<script>alert('查找下线成功')</script>";
							exec('D:\python37\python E:\wamp64\www\lcy\change_html.py',$log,$status);
							if($status==0){
								echo "<script>alert('可以加载人物关系图')</script>";
							}
							else{echo "<script>alert('人物关系图生成有误')</script>";
							}
						}
						else{echo "<script>alert('查找下线失败')</script>";
						}
					}
					else{
						echo "<script>alert('查找人物失败')</script>";
					}
				}
				else{
					echo "<script>alert('全局搜索失败')</script>";
				}
			}
		?>
		<script> 
			function xian_hidden(){  
				if (document.getElementById('number').disabled==false){   
					document.getElementById('number').disabled =true;}}  
			function xian_hidden01(){  
				if (document.getElementById('number').disabled==true){   
					document.getElementById('number').disabled =false;}} 
		</script>
	<body>
		<ul>
			<li><a href='http://localhost:8081/lcy/visual_excle.php'>Excle查询</a></li>
			<li><a href='http://localhost:8081/lcy/visual_sql.php'>Mysql查询</a></li>
			<li style="float:right"><a class="active" href="//www.baidu.com/">帮助</a></li>
			<li style="float:right"><a class="active" href="//www.baidu.com/">登录</a></li>
		</ul>
		<div>	
			<form id="form1" name="form1" method="post" action="">
				<p><b>数据库地址:</b><input type="text" maxlength="100" name="ip" size="30"/></p>
				<p><b>数据库用户:</b><input type="text" maxlength="100" name="name" size="30"/></p>
				<p><b>数据库密码:</b><input type="password" maxlength="100" name="password" size="30"/></p>
				<p><b>数据库库名:</b><input type="text" maxlength="100" name="chart" size="30"/></p>
				<p><b>数据库表名:</b><input type="text" maxlength="100" name="sheet" size="30"/></p>
				<p><b>上线名:</b><input type="text" maxlength="100" name="from_user" size="10"/>
					<b>下线名:</b><input type="text" maxlength="100" name="to_user" size="10"/></p>
				<p><input type="submit" name="find" value="查找" /></p>
				<p><b>关系主人物:</b><input type="text" maxlength="100" name="root" size="30" list="root" autocomplete="off"></p>
				<p><b>显示有下线人物</b><input type="radio" name="d" onClick="xian_hidden()" value="0" checked="true" /> 
					<b>选择显示人数</b><input type="radio" name="d" onClick="xian_hidden01()" value="1"/> 
					<input type="text" name="title" id="number" disabled="false" size="6" list="member" autocomplete="off"/> </p>
				<p><input type="submit" name="save" value="保存" /></p>
			</form>
			<form id="form1" name="form1" method="post" action="visual_sql_main.php">
				<p><input type="submit" name="loading" value="加载" /></p>
			</form>		
			<datalist id = "member">
				<option value="all">
				<option value="5">
				<option value="10">
				<option value="15">
				<option value="20">
			</datalist>
			<datalist id = "root">
				<?php
					$file = fopen("root_all.txt","r");
					while(! feof($file)){
						printf("<option value=%s>",fgets($file));
					}
					fclose($file);
				?>
			</datalist>
		</div>
	</body>
</html>