#les bibliothéque
import pymysql
import cv2
import qrcode
import numpy as np
from pyzbar.pyzbar import decode
import serial, time
#connection à la base de données
conn = pymysql.connect(host="localhost", user="root", passwd="", db="demo")
p = 'prod'
myCursor = conn.cursor()
#camera setting
cap = cv2.VideoCapture(0)
cap.set(3, 1280)
cap.set(4, 1024)
cap.set(15, 0.1)
mafacture = 0
while True:
    success, img2 = cap.read()
    #decodage
    for barcode in decode(img2):
        myData = barcode.data.decode('utf-8')
        #selectionner le prix de chaque produit detecter
        sql = "SELECT name FROM " + p + " WHERE name = '" + myData + "'"
        myCursor.execute(sql)
        myResult = myCursor.fetchone()
        if myResult == None:
            print('Sorry change this product')
        else:
            sql1 = "SELECT qantité FROM  emp WHERE name = '" + myData + "'"
            myCursor.execute(sql1)
            myResult1 = myCursor.fetchone()

            if myResult1 == None:
                sql2 = "INSERT INTO emp (name, qantité) VALUES (%s, %s)"
                val = (myData, 1)
                myCursor.execute(sql2, val)
                conn.commit()
            else:
                time.sleep(2)
                E=myResult1[0]
                print(E)
                EE = int(E)
                qty = EE
                qty += 1
                Qtt= str(qty)
                sql3 = "UPDATE emp SET qantité = '"+Qtt+"' WHERE name = '"+myData+"'"
                myCursor.execute(sql3)
                conn.commit()



    cv2.imshow("video", img2)
    cv2.waitKey(1)
