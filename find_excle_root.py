import xlrd

# 打开文件
filename=open("E:/桌面/Python程序/Excel相关/lcy/excle.txt","r",encoding="utf-8")
exclename=filename.readline()[:-1]
exclefromat=filename.readline()[:-1]
data = xlrd.open_workbook(r"E:/wamp64/www/lcy/upload/"+exclename+"."+exclefromat)
# 查看工作表
sheet=data.sheet_by_name(filename.readline()[:-1])
#获取整行或整列
col_from=sheet.col_values(int(filename.readline()[:-1]))
col_to=sheet.col_values(int(filename.readline()[:-1]))
root_list=[]
for i in col_from:
    if i not in col_to and i not in root_list:
        root_list.append(i)
rootfile=open("E:/wamp64/www/lcy/root_all.txt","w",encoding="utf-8")
for i in root_list:
    rootfile.write(i)
    rootfile.write("\n")
rootfile.close()
