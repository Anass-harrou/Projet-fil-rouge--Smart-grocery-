package com.example.mobilebanking

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import android.view.View
import android.view.View.GONE
import android.view.View.VISIBLE
import android.view.animation.Animation
import android.view.animation.AnimationUtils
import android.widget.Button
import android.widget.EditText
import android.widget.TextView
import android.widget.Toast
import androidx.cardview.widget.CardView
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.JsonObjectRequest
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.google.zxing.integration.android.IntentIntegrator
import com.journeyapps.barcodescanner.CaptureActivity
import org.json.JSONException
import org.json.JSONObject
import pub.devrel.easypermissions.AppSettingsDialog
import pub.devrel.easypermissions.EasyPermissions

class ScanActivity : AppCompatActivity() , EasyPermissions.PermissionCallbacks,
    EasyPermissions.RationaleCallbacks {
    var cardview1: CardView? = null
    var cardview2: CardView? = null
    var btnScan: Button? = null
    var btnEnterCode: Button? = null
    var btnEnter: Button? = null
    var edtCode: EditText? = null
    var tvText:TextView? = null
    var hide:Animation? = null
    var reveal:Animation? = null
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_scan)
        val home: View = findViewById(R.id.menuHome)
        home.setOnClickListener {
            val intent = Intent(this, MainActivity::class.java)
            startActivity(intent)
        }
        val userinfo: View = findViewById(R.id.menuProfile)
        userinfo.setOnClickListener {
            val intent = Intent(this, UserActivity::class.java)
            //intent.putExtra(nom:String)
            startActivity(intent)
        }

        cardview1 = findViewById(R.id.cardView1)
        cardview2 = findViewById(R.id.cardView2)
        btnScan = findViewById(R.id.btnScan)
        btnEnterCode = findViewById(R.id.btnEnterCode)
        btnEnter = findViewById(R.id.btnEnter)
        edtCode = findViewById(R.id.edtCode)
        tvText = findViewById(R.id.tvText)

        hide = AnimationUtils.loadAnimation(this,android.R.anim.fade_out)
        reveal = AnimationUtils.loadAnimation(this,android.R.anim.fade_in)

        tvText!!.startAnimation(reveal)
        cardview2!!.startAnimation(reveal)
        tvText!!.setText("Scan QR code here")
        cardview2!!.visibility = View.VISIBLE

        btnScan!!.setOnClickListener {
            tvText!!.startAnimation(reveal)
            cardview1!!.startAnimation(hide)
            cardview2!!.startAnimation(reveal)

            cardview2!!.visibility = VISIBLE
            cardview1!!.visibility = GONE
            tvText!!.setText("Scan QR code Here")


        }
        cardview2!!.setOnClickListener{
            cameraTask()
        }

        btnEnter!!.setOnClickListener{
            if(edtCode!!.text.toString().isNullOrEmpty()){
                Toast.makeText(this,"Please enter code", Toast.LENGTH_SHORT).show()
            }else{
                var value = edtCode!!.text.toString()
                Toast.makeText(this,value, Toast.LENGTH_SHORT).show()
                // Instantiate the RequestQueue.
                val queue = Volley.newRequestQueue(this)
                val url:String = "http://172.16.1.182/API_PHP/config.php"
                val jsonObject = JSONObject()
                try {
                    jsonObject.put("qr",value)
                }catch (e: JSONException){
                    e.printStackTrace()
                }
                // Request a string response from the provided URL.
                val stringReq = JsonObjectRequest(Request.Method.POST,url,jsonObject,
                    Response.Listener{ response ->
                        Log.i("3OWA",response.toString())
                    },
                    Response.ErrorListener { Log.d("API", "that didn't work") })
                queue.add(stringReq)
            }
        }
        btnEnterCode!!.setOnClickListener {
            tvText!!.startAnimation(reveal)
            cardview1!!.startAnimation(reveal)
            cardview2!!.startAnimation(hide)

            tvText!!.startAnimation(reveal)
            cardview2!!.startAnimation(reveal)
            cardview2!!.visibility = GONE
            cardview1!!.visibility = VISIBLE
            tvText!!.setText("Enter QR code Here")
        }
    }

    private fun hasCameraAccess():Boolean
    {
        return EasyPermissions.hasPermissions(this,android.Manifest.permission.CAMERA)
    }

    private fun cameraTask(){
        if(hasCameraAccess()){
            var qrScanner = IntentIntegrator(this)
            qrScanner.setPrompt("scan a QR code")
            qrScanner.setCameraId(0)
            qrScanner.setOrientationLocked(true)
            qrScanner.setBeepEnabled(true)
            qrScanner.captureActivity = CaptureActivity::class.java
            qrScanner.initiateScan()

        }else{
            EasyPermissions.requestPermissions(
                this,
                "This app needs access to your camera so you can take pictures.",
                123,
                android.Manifest.permission.CAMERA
            )
        }

    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {


        var result = IntentIntegrator.parseActivityResult(requestCode,resultCode,data)
            if (result != null){
                if (result.contents == null){
                    Toast.makeText(this,"Result Not Found",Toast.LENGTH_SHORT).show()
                    edtCode!!.setText("")
                }else{
                    try {
                        cardview1!!.startAnimation(reveal)
                        cardview2!!.startAnimation(hide)
                        cardview1!!.visibility = View.VISIBLE
                        cardview2!!.visibility = View.GONE
                        edtCode!!.setText(result.contents.toString())
                    }catch (exception:JSONException){
                        Toast.makeText(this,exception.localizedMessage,Toast.LENGTH_SHORT).show()
                        edtCode!!.setText("")

                    }
                }
            }else{
                super.onActivityResult(requestCode, resultCode, data)
            }


        if (requestCode == AppSettingsDialog.DEFAULT_SETTINGS_REQ_CODE){
            Toast.makeText(this,"Permission Granted",Toast.LENGTH_SHORT).show()
            }
        }



    override fun onRequestPermissionsResult(
        requestCode: Int,
        permissions: Array<out String>,
        grantResults: IntArray
    ) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults)
        EasyPermissions.onRequestPermissionsResult(requestCode,permissions,grantResults,this)
    }

    override fun onPermissionsGranted(requestCode: Int, perms: MutableList<String>) {
        TODO("Not yet implemented")
    }

    override fun onPermissionsDenied(requestCode: Int, perms: MutableList<String>) {
        if(EasyPermissions.somePermissionPermanentlyDenied(this,perms)){
            AppSettingsDialog.Builder(this).build().show()
        }
    }

    override fun onRationaleAccepted(requestCode: Int) {
        TODO("Not yet implemented")
    }

    override fun onRationaleDenied(requestCode: Int) {
        TODO("Not yet implemented")
    }
    /*fun getVolley() {

        // Instantiate the RequestQueue.
        val queue = Volley.newRequestQueue(this)
        val url:String = "http://172.24.112.1/API_PHP/config.php"
        val jsonObject = JSONObject()
        try {
            jsonObject.put("qr",name)
        }catch (e: JSONException){
            e.printStackTrace()
        }

        // Request a string response from the provided URL.
        val stringReq = StringRequest(
            Request.Method.POST,url,
            Response.Listener<String> { response ->
                Toast.makeText(this, response, Toast.LENGTH_SHORT).show()
            },
            Response.ErrorListener { Log.d("API", "that didn't work") })
        queue.add(stringReq)
    }*/
}