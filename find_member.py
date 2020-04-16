import json

with open("E:/wamp64/www/lcy/use_data/final.txt","r") as cut:
    cut=json.load(cut)
file=open("son.txt","w")
file.close()
#得到成员数
count=0
for son1 in cut[0]["children"]:
    count+=1
#提取人名和人数
flag=0
for son1 in cut[0]["children"]:
    num=son1["name"].find('-')
    son_name=son1["name"][:num]
    son_num=son1["name"][(num+1):]
    file=open("son.txt","a")
    file.write(son_name+"\n")
    file.write(son_num)
    if flag<(count-1):
        file.write("\n")
    file.close()
    flag+=1
