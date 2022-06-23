import cv2
import numpy as np
from pyzbar.pyzbar import decode
import pymysql
import re
import serial,time
conn = pymysql.connect(host="localhost", user="root", passwd="", db="demo")
connn = pymysql.connect(host="localhost", user="root", passwd="", db="client")
myOutput = "MERCI"
myColor = (0,255,0)
cap = cv2.VideoCapture(0)
cap.set(3,1280)
cap.set(4,1024)
cap.set(15,0.1)
namecl = "Maddoun"
p= 'users'
myCursor = conn.cursor()
mycursor = connn.cursor()
sql = "SELECT solde FROM " + p + " WHERE username =  '"+ namecl +"'"
myCursor.execute(sql)
myResult = myCursor.fetchone()
mon = str(myResult[0])
monsolde =int(mon)
print(monsolde)
dash='Bonjour '+namecl+ ' votre solde est '+mon+'DH'
while True:
    success, img = cap.read()
    #myColor = (20, 130, 230)
    #myOutput = 'ok'
    cv2.putText(img, dash, (100, 90), cv2.FONT_HERSHEY_DUPLEX,
    1, (0, 255, 0), 2, cv2.LINE_AA)
    for barcode in decode(img):
        myData = barcode.data.decode('utf-8')
        myData = re.sub("[()]", "", myData)
        az = myData.split(", ")
        mafa = az[0]
        s=az[1]
        cid = (s.replace("'", ''))
        mafacture =int(mafa)
        print(mafacture)
        time.sleep(1)
        if mafacture > monsolde:
            print("ERREUR DE PAYMENT")
            pts = np.array([barcode.polygon], np.int32)
            pts = pts.reshape((-1, 1, 2))
            cv2.polylines(img, [pts], True, (0,0,255), 5)
            pts2 = barcode.rect
            cv2.putText(img, 'EREUR ', (pts2[0], pts2[1]), cv2.FONT_HERSHEY_SIMPLEX,
                        0.9, (0,0,255), 2)
        else:
            newsolde = monsolde-mafacture
            new =str(newsolde)
            print(new)
            sql1 = "UPDATE " + p + " SET Solde = '" + new + "' WHERE username = 'Maddoun'"
            myCursor.execute(sql1)
            conn.commit()
            print(myCursor.rowcount, "record(s) affected")
            sql2 = "INSERT INTO payed (name, facture, clnum) VALUES (%s, %s, %s)"
            val2 =(namecl,mafacture,cid)
            myCursor.execute(sql2,val2)
            conn.commit()
            sql22 = "INSERT INTO payeed (naame) VALUES (%s)"
            val22 = ("done")
            mycursor.execute(sql22, val22)
            connn.commit()
            pts = np.array([barcode.polygon], np.int32)
            pts = pts.reshape((-1, 1, 2))
            cv2.polylines(img, [pts], True, myColor, 5)
            pts2 = barcode.rect
            cv2.putText(img, myOutput, (pts2[0], pts2[1]), cv2.FONT_HERSHEY_SIMPLEX,
                        0.9, myColor, 2)
    cv2.imshow('Result', img)
    cv2.waitKey(1)