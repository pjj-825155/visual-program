from lxml import etree
f = open("E:/wamp64/www/lcy/1.html","r",encoding="utf-8")
f = f.read()
before=f.find("width:")
after=f.find(";")
data=f[:before]+"width:100%"+f[after:]
f = open("E:/wamp64/www/lcy/1.html","w",encoding="utf-8")
f.write(data)
f.close()