import json
from pyecharts import options as opts
from pyecharts.charts import Page,Tree
from use_program import *

#从txt中获取数据库相关信息
txt="E:/wamp64/www/lcy/sql.txt"
sql=Sql(txt)
ip,name,password,chart,sheet,from_user,to_user=sql.read(txt)
state=open("E:/wamp64/www/lcy/state.txt","r")
limit=state.readline()
limit=limit[:-1]

#以json格式读取txt
with open("E:/wamp64/www/lcy/data/"+sheet+"_"+"data.txt","r") as data:
    data=json.load(data)
#从txt中获取root名
file=open("E:/wamp64/www/lcy/root_use.txt","r")
root=file.readline()
root=root[:-1]
final_data=[]

def find(data):
    global root
    global final_data
    for final in data:
        num=final["name"].find('-')
        name=final["name"][:num]
        if name==root:
            final_data.append(final)
        else:
            find(final["children"])

find(data)

with open("E:/wamp64/www/lcy/use_data/final.txt","w") as file:
    file.write(json.dumps(final_data,indent=4))

with open("E:/wamp64/www/lcy/use_data/final.txt","r") as cut:
    cut=json.load(cut)
  
#限制4层
for son1 in cut[0]["children"]:
    for son2 in son1["children"]:
        for son3 in son2["children"]:
            son3.pop("children")

#删除无下线的人
if limit=="0":
    for son1 in cut[0]["children"][::-1]:
        num=son1["name"].find("-")
        number=son1["name"][(num+1):]
        if number=="0person":
            cut[0]["children"].remove(son1)
        for son2 in son1["children"][::-1]:
            num=son2["name"].find("-")
            number=son2["name"][(num+1):]
            if number=="0person":
                son1["children"].remove(son2)
            for son3 in son2["children"][::-1]:
                num=son3["name"].find("-")
                number=son3["name"][(num+1):]
                if number=="0person":
                    son2["children"].remove(son3)
elif limit=="all":
    pass
else:
    #删除limit之后的人
    try:
        limit=int(limit)
        num=0
        for son1 in cut[0]["children"]:
            num+=1
        if num>limit:
            for son1 in cut[0]["children"][::-1]:
                cut[0]["children"].remove(son1)
                num-=1
                if num==limit:
                    break
        
        for son1 in cut[0]["children"]:
            num=0
            for son2 in son1["children"]:
                num+=1
            if num>limit:
                for son1 in cut[0]["children"]:
                    for son2 in son1["children"][::-1]:
                        son1["children"].remove(son2)
                        num-=1
                        if num==limit:
                            break
        
        for son1 in cut[0]["children"]:
            for son2 in son1["children"]:
                num=0
                for son3 in son2["children"]:
                    num+=1
                if num>limit:
                    for son1 in cut[0]["children"]:
                        for son2 in son1["children"]:
                            for son3 in son2["children"][::-1]:
                                son2["children"].remove(son3)
                                num-=1
                                if num==limit:
                                    break
    except:
        print("Please enter number!")

tree=(
    Tree()
        .add("",cut)
        .set_global_opts(title_opts=opts.TitleOpts(title="关系图"))
    )
tree.render("1.html")
