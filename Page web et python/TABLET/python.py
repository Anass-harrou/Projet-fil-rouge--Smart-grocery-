#les bibliothéque
import pymysql
import cv2
import numpy as np
from pyzbar.pyzbar import decode
import serial, time
#connection à la base de données
conn = pymysql.connect(host="localhost", user="root", passwd="", db="demo")
mydb = pymysql.connect(host="localhost", user="root", password="", database="client")
mycursor = mydb.cursor()
#Delete old Tables
sqlY = "DROP TABLE customers"
mycursor.execute(sqlY)
sqlYY = "DROP TABLE fct"
mycursor.execute(sqlYY)
sqlYYi = "DROP TABLE payeed"
mycursor.execute(sqlYYi)
#Create new table
mycursor.execute("CREATE TABLE customers (produit VARCHAR(255), prix VARCHAR(255), cid VARCHAR(255))")
mycursor.execute("CREATE TABLE fct (Total VARCHAR(255), cid VARCHAR(255))")
mycursor.execute("CREATE TABLE payeed (naame VARCHAR(255))")
#afficher les Tables disponible
mycursor.execute("SHOW TABLES")
myr = mycursor.fetchall()

#nombre des Tables disponible
STT = str(len(myr))
print(STT)
pp = 'customers' + STT
print(pp)
#creat new table
mycursor.execute("CREATE TABLE " + pp + " (produit VARCHAR(255), prix VARCHAR(255))")
p = 'product'
myCursor = conn.cursor()
#camera setting
cap = cv2.VideoCapture(0)
cap.set(3, 1280)
cap.set(4, 1024)
cap.set(15, 0.1)
mafacture = 0
#inset value in table
sql0 = "INSERT INTO fct (Total, cid) VALUES (%s, %s)"
val0 = (0, pp)
mycursor.execute(sql0, val0)
mydb.commit()
while True:
    success, img2 = cap.read()
    #decodage
    for barcode in decode(img2):
        myData = barcode.data.decode('utf-8')
        #selectionner le prix de chaque produit detecter
        sql = "SELECT price FROM  " + p + " WHERE product = '" + myData + "'"
        myCursor.execute(sql)
        myResult = myCursor.fetchone()
        if myResult == None:
            print('Sorry change this product')
        else:
            # selectionner le nom de chaque produit detecter
            sql1 = "SELECT name FROM " + p + " WHERE product = '" + myData + "'"
            myCursor.execute(sql1)
            myResult1 = myCursor.fetchone()
            #colone de tableau
            #EE name and E price
            EE = myResult1[0]
            E = myResult[0]
            a = int(E)
            #cordonneés d'image
            pts = np.array([barcode.polygon], np.int32)
            pts = pts.reshape((-1, 1, 2))
            pts2 = barcode.rect
            pts22 = barcode.rect.top
            # print(pts2)
            if pts22 < 250:
                myOutput = 'Produit Ajouté'
                myColor = (239, 12, 2)
                time.sleep(2)
                #incrémenter la facture
                mafacture += a
                up = str(mafacture)
                #inser
                sql2 = "INSERT INTO customers (produit, prix ,cid) VALUES (%s, %s, %s)"
                val2 = (EE, a, pp)
                mycursor.execute(sql2, val2)
                sql3 = "INSERT INTO " + pp + " (produit, prix) VALUES (%s, %s)"
                val3 = (EE, a)
                mycursor.execute(sql3, val3)
                mydb.commit()
                mydb.commit()
                #update facture en base de données
                sqlll = "UPDATE fct SET Total = '"+up+"'"
                mycursor.execute(sqlll)
                mydb.commit()
            elif pts22 > 350:
                myOutput = 'Produit Eliminé'
                myColor = (0, 122, 222)
                time.sleep(2)
                mafacture -= a
                up = str(mafacture)
                sql3 = "DELETE  FROM customers WHERE produit = '" + EE + "'"
                mycursor.execute(sql3)
                mydb.commit()
                sqlll = "UPDATE fct SET Total = '" + up + "'"
                mycursor.execute(sqlll)
                mydb.commit()
            else:
                myOutput = 'Zone morte'
                myColor = (120, 122, 22)
            #encadrer le code barre detecter
            cv2.polylines(img2, [pts], True, myColor, 5)
            cv2.putText(img2, myOutput, (pts2[0], pts2[1]), cv2.FONT_HERSHEY_SIMPLEX,
                        0.9, myColor,2)
    #creation du qr code pour payer
    data = (mafacture, pp)
    cv2.imshow("video", img2)
    cv2.waitKey(1)