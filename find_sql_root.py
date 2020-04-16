import pymysql
from use_program import *

#从txt中获取数据库相关信息
txt="E:/wamp64/www/lcy/sql.txt"
sql=Sql(txt)
ip,name,password,chart,sheet,from_user,to_user=sql.read(txt)
conn=pymysql.connect(ip[:-1],name[:-1],password[:-1],chart[:-1])
cur=conn.cursor()
#查找根
cur.execute("select distinct "+from_user+" from "+sheet+" where "+from_user+" not in (select "+to_user+" from "+sheet+")")
root=cur.fetchall()
root=list(root)
file=open("E:/wamp64/www/lcy/root_all.txt","w")
file.close()
for son in root:
    file=open("E:/wamp64/www/lcy/root_all.txt","a")
    file.write(son[0]+"\n")
    file.close()
