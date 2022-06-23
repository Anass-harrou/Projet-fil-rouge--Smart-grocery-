import cv2
import numpy as np
from pyzbar.pyzbar import decode
import pymysql
import datetime
import serial,time

conn = pymysql.connect(host="localhost", user="root", passwd="", db="demo")
cap = cv2.VideoCapture(0)
cap.set(3,1280)
cap.set(4,1024)
cap.set(15,0.1)
p= 'prod'
myCursor = conn.cursor()
while True:
    success, img = cap.read()
    #myColor = (20, 130, 230)
    #myOutput = 'ok'
    for barcode in decode(img):
        myData = barcode.data.decode('utf-8')
        print(myData)
        sql = "SELECT name FROM " + p + " WHERE name = '" + myData + "'"
        myCursor.execute(sql)
        myResult = myCursor.fetchone()

        if myResult == None:
           myColor = (20, 130, 230)
           myOutput = 'ok'
           sql = "INSERT INTO " + p + " (name, qantité) VALUES (%s, '0')"
           val = (myData)
           myCursor.execute(sql, val)
           conn.commit()
        else:
            myColor = (0, 0, 230)
            myOutput = 'DEJA'
        pts = np.array([barcode.polygon], np.int32)
        pts = pts.reshape((-1, 1, 2))
        cv2.polylines(img, [pts], True, myColor, 5)
        pts2 = barcode.rect
        cv2.putText(img, myOutput, (pts2[0], pts2[1]), cv2.FONT_HERSHEY_SIMPLEX,
                    0.9, myColor, 2)

    cv2.imshow('Result', img)
    cv2.waitKey(1)
