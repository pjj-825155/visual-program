import xlrd
import json
def find(root,data):
    son=[]
    for i in data:
        if i[0]==root:
            son.append(i[1])
    return son
def place(num_list,num):
    count=0
    for son in num_list:
        if son<num:
            num_list.insert(count,num)
            return count
        count+=1
#递归得到人数
def member(root):
    global data_all
    res=find(root,data_all)
    num=0
    for son in res:
        num=num+member(son)+1
    return num
#递归加入
def ins(count,root,final_data):
    global data_all
    res=find(root,data_all)
    num_list=[0]
    for son in res:
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
# 打开文件
filename=open("E:/wamp64/www/lcy/excle.txt","r",encoding="utf-8")
exclename=filename.readline()[:-1]
exclefromat=filename.readline()[:-1]
data = xlrd.open_workbook(r"E:/wamp64/www/lcy/upload/"+exclename+"."+exclefromat)
# 查看工作表
sheet=data.sheet_by_name(filename.readline()[:-1])
#获取数据
data_all=[]
from_num=int(filename.readline()[:-1])
to_num=int(filename.readline()[:-1])
for x in range(sheet.nrows):
    data_all.append((sheet.row_values(x)[from_num],sheet.row_values(x)[to_num]))
rootfile=open("E:/wamp64/www/lcy/root_use.txt","r",encoding="utf-8")
root=rootfile.readline()[:-1]
num=member(root)
data=[{"name":root+"-"+str(num)+"person","children":[]}]
count=0
ins(count,root,data)
with open("E:/wamp64/www/lcy/data/"+exclename+"_"+exclefromat+"_"+"data.txt","w") as file:
    file.write(json.dumps(data,indent=4))
