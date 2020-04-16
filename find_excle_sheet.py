import xlrd

# 打开文件
filename=open("E:/桌面/Python程序/Excel相关/lcy/excle.txt","r",encoding="utf-8")
exclename=filename.readline()[:-1]
exclefromat=filename.readline()[:-1]
data = xlrd.open_workbook(r"E:/wamp64/www/lcy/upload/"+exclename+"."+exclefromat)
sheetname=data.sheet_names()
excle_name=open("E:/wamp64/www/lcy/excle_sheet.txt","w",encoding="utf-8")
for i in sheetname:
    excle_name.write(i)
    excle_name.write("\n")