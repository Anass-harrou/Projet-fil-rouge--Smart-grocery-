package com.example.mobilebanking

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import android.view.View
import android.widget.TextView
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import org.json.JSONArray

class HistoryActivity : AppCompatActivity() {
    val url:String = "http://172.16.1.182/API_PHP/historique.php"
    var name: TextView? = null
    var custemr: TextView? = null
    var solde: TextView? = null
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_history)
        name = findViewById(R.id.textView11)
        custemr = findViewById(R.id.textView12)
        solde = findViewById(R.id.solde)
        getData()
        val home: View = findViewById(R.id.menuHome)
        home.setOnClickListener {
            val intent = Intent(this, MainActivity::class.java)
            //intent.putExtra(nom:String)
            startActivity(intent)
        }

    }
    fun getData() {

        // Instantiate the RequestQueue.
        val queue = Volley.newRequestQueue(this)
        // Request a string response from the provided URL.
        val stringReq = StringRequest(
            Request.Method.GET,url,
            Response.Listener{ response ->
                val data = response.toString()
                val jArray = JSONArray(data)
                for(i in 0..jArray.length()-1){
                    var jobject = jArray.getJSONObject(i)
                    var id = jobject.getString("name")
                    var qr = jobject.getString("facture")
                    var carte = jobject.getString("clnum")
                    /*var Accnumber = jobject.getString("Accnumber")
                    var statut = jobject.getString("statut")
                    var fullname = jobject.getString("fullName")
                    var Date = jobject.getString("Date")*/
                    Log.i("id",id.toString())
                    Log.i("QR value",qr.toString())
                    Log.i("carte",carte.toString())
                    /*Log.i("id",Accnumber.toString())
                    Log.i("QR value",statut.toString())
                    Log.i("id",fullname.toString())
                    Log.i("QR value",Date.toString())*/
                    name?.setText(id.toString())
                    /*accnum?.setText(Accnumber.toString())
                    //statut?.setText(statut.toString())*/
                    custemr?.setText(carte.toString())
                    solde?.setText(qr.toString())
                    //date?.setText(Date.toString())
                } },
            Response.ErrorListener{ Log.d("API", "that didn't work") })
        queue.add(stringReq)
    }
}