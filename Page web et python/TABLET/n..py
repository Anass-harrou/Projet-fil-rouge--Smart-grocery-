#RFRID PYTHON
import serial,time
import pymysql
arduino = serial.Serial('COM4', 9600)
time.sleep(2)
conn = pymysql.connect(host="localhost", user="root", passwd="", db="demo")
connn = pymysql.connect(host="localhost", user="root", passwd="", db="client")
mycursor = connn.cursor()
myCursor = conn.cursor()
line=arduino.readline()
str_rn = line.decode()
strr = str_rn.rstrip()
print(strr)
sql = "SELECT username FROM users WHERE carte  =  '" + strr + "'"
myCursor.execute(sql)
myResult = myCursor.fetchone()
oo=myResult[0]
print(oo)
if myResult == None:
    print(myResult)
else:
    sqll1 = "SELECT statut FROM users WHERE carte =  '" + strr + "'"
    myCursor.execute(sqll1)
    myResultt1 = myCursor.fetchone()
    mooon = (myResultt1[0])
    print(mooon)
    if mooon != 'Activé':
        print('vous devez activez votre carte')
    else:
        sqll = "SELECT solde FROM users WHERE carte =  '" + strr + "'"
        myCursor.execute(sqll)
        myResultt = myCursor.fetchone()
        mooon = (myResultt[0])
        mon = (myResult[0])
        monsolde = int(mooon)
        print(monsolde)
        sql1 = "SELECT Total FROM fct"
        mycursor.execute(sql1)
        myResult1 = mycursor.fetchone()
        sql11 = "SELECT cid FROM fct"
        mycursor.execute(sql11)
        myResult11 = mycursor.fetchone()
        cid = (myResult11[0])
        monn = (myResult1[0])
        facc = int(monn)
        print(facc)
        if facc > monsolde:
            print('votre solde est insuffisant')
        else:
            news = monsolde - facc
            new = str(news)
            sqlll = "UPDATE users SET Solde = '" + new + "' WHERE carte =  '" + strr + "'"
            myCursor.execute(sqlll)
            conn.commit()
            sql2 = "INSERT INTO payed (name, facture, clnum) VALUES (%s, %s, %s)"
            val2 = (oo, facc, cid)
            myCursor.execute(sql2, val2)
            conn.commit()
            sql22 = "INSERT INTO payeed (naame) VALUES (%s)"
            val22 = ("done")
            mycursor.execute(sql22, val22)
            connn.commit()