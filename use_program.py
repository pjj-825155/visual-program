class Sql:
    def __init__(self,txt):
        self.txt=txt
    def read(self,sql):
        self.sql=open(sql,"r")
        self.ip=self.sql.readline()
        self.name=self.sql.readline()
        self.password=self.sql.readline()
        self.chart=self.sql.readline()
        self.sheet=self.sql.readline()
        self.from_user=self.sql.readline()
        self.to_user=self.sql.readline()
        self.sheet=self.sheet[:-1]
        self.from_user=self.from_user[:-1]
        self.to_user=self.to_user[:-1]
        return self.ip,self.name,self.password,self.chart,self.sheet,self.from_user,self.to_user