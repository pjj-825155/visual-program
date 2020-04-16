import pymysql
import json
import sys
from use_program import *

def place(num_list,num):
    count=0
    for son in num_list:
        if son<num:
            num_list.insert(count,num)
            return count
        count+=1

#递归得到人数
def member(root):
    global sheet
    global from_user
    global to_user
    cur.execute(f"select {to_user} from {sheet} where {from_user}='{root}'")
    res=cur.fetchall()
    num=0
    for son in res:
        son=list(son)
        son=son[0]
        num=num+member(son)+1
    return num

#递归加入
def ins(count,root,final_data):
    global sheet
    cur.execute(f"select {to_user} from {sheet} where {from_user}='{root}'")
    res=cur.fetchall()
    num_list=[0]
    flag=0
    for son in res:
        #得到下线
        son=list(son)
        son=son[0]
        #求人数
        num=member(son)
        #求添加位置
        area=place(num_list,num)
        if num:
            #添加
            final_data[count]["children"].insert(area,{"name":son+"-"+str(num)+"person","children":[]})
        else:
            final_data[count]["children"].append({"name":son+"-"+str(num)+"person","children":[]})
        ins(area,son,final_data[count]["children"])
#从txt中获取数据库相关信息
txt="E:/wamp64/www/lcy/sql.txt"
sql=Sql(txt)
ip,name,password,chart,sheet,from_user,to_user=sql.read(txt)
conn=pymysql.connect(ip[:-1],name[:-1],password[:-1],chart[:-1])
cur=conn.cursor()
#读取根
gen=open("E:/wamp64/www/lcy/root_use.txt","r")
root=gen.readline()
root=root[:-1]
try:#判断有没有这个文件
    if open("E:/wamp64/www/lcy/data/"+sheet+"_"+"data.txt","r").readlines():#判断文件中是否有内容
        print("已有内容")
    else:
        num=member(root)
        data=[{"name":root+"-"+str(num)+"person","children":[]}]
        count=0
        ins(count,root,data)
        with open("E:/wamp64/www/lcy/data/"+sheet+"_"+"data.txt","w") as file:
            file.write(json.dumps(data,indent=4))
except:
    num=member(root)
    data=[{"name":root+"-"+str(num)+"person","children":[]}]
    count=0
    ins(count,root,data)
    with open("E:/wamp64/www/lcy/data/"+sheet+"_"+"data.txt","w") as file:
        file.write(json.dumps(data,indent=4))
