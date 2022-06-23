from kivy.app import App
from kivy.lang import Builder
import pymysql
conn = pymysql.connect(host="localhost", user="root", passwd="", db="demo")
myCursor = conn.cursor()
class QrCodeApp(App):
    def build(self):
        return Builder.load_string(
"""
#:import ZBarCam kivy_garden.zbarcam.ZBarCam
BoxLayout:
    orientation: 'vertical'
    ZBarCam:
        id:qrcodecam
    Label:
        size_hint: None, None
        size: self.texture_size[0], 50
        text: ''.join([str(symbol) for symbol in qrcodecam.symbols])
        
      
"""

)


if __name__ == '__main__':
    QrCodeApp().run()