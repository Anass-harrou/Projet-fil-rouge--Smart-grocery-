package com.example.mobilebanking

import android.content.Intent
import android.os.Bundle
import android.util.Log
import android.view.View
import android.widget.Button
import android.widget.TextView
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.cardview.widget.CardView
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import org.json.JSONArray
import com.android.volley.toolbox.JsonObjectRequest
import org.json.JSONException
import org.json.JSONObject

class MainActivity : AppCompatActivity() {
    val url:String = "http://172.16.1.182/API_PHP/getData.php"
    var balence:TextView? = null
    var accnum:TextView? = null
    //var statut:Button? = null
    var name:TextView? = null
    var date:TextView? = null
        //val nom=intent.getStringExtra("UserName")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        balence = findViewById(R.id.textView2)
        accnum = findViewById(R.id.textView4)
        //statut = findViewById<Button>(statut)
        name = findViewById(R.id.textView5)
        date = findViewById(R.id.textView8)

            val usertxt:TextView=findViewById(R.id.txtUser)
            //txt.text=intent.getStringExtra("UserName");
            val nom=intent.getStringExtra("username")
            if(nom != null) usertxt.text=nom; else Log.i("chdid","login")


            val fab: View = findViewById(R.id.QrAction)
        fab.setOnClickListener {
            val intent = Intent(this, ScanActivity::class.java)
            //intent.putExtra(nom:String)
            startActivity(intent)
        }
            val user:View = findViewById(R.id.menuProfile)
            user.setOnClickListener {
                val intent = Intent(this, UserActivity::class.java)
                //intent.putExtra(nom:String)
                startActivity(intent)
            }
            val history:View = findViewById(R.id.menuHistory)
            history.setOnClickListener {
                val intent = Intent(this, HistoryActivity::class.java)
                //intent.putExtra(nom:String)
                startActivity(intent)
            }
        getData()

    }

    fun getData() {

        // Instantiate the RequestQueue.
        val queue = Volley.newRequestQueue(this)
        // Request a string response from the provided URL.
        val stringReq = StringRequest(Request.Method.GET,url,
            Response.Listener{ response ->
                val data = response.toString()
                val jArray = JSONArray(data)
                for(i in 0..jArray.length()-1){
                    var jobject = jArray.getJSONObject(i)
                    var id = jobject.getString("username")
                    var qr = jobject.getString("solde")
                    var carte = jobject.getString("carte")
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
                    balence?.setText(qr.toString())
                    /*accnum?.setText(Accnumber.toString())
                    //statut?.setText(statut.toString())*/
                    accnum?.setText(carte.toString())
                    name?.setText(id.toString())
                    //date?.setText(Date.toString())
                } },
            Response.ErrorListener{Log.d("API", "that didn't work") })
        queue.add(stringReq)
    }
    /*
private fun loadArtists() {
        val stringRequest = StringRequest(Request.Method.GET,
                EndPoints.URL_GET_ARTIST,
                Response.Listener<String> { s ->
                    try {
                        val obj = JSONObject(s)
                        if (!obj.getBoolean("error")) {
                            val array = obj.getJSONArray("artists")

                            for (i in 0..array.length() - 1) {
                                val objectArtist = array.getJSONObject(i)
                                val artist = Artist(
                                        objectArtist.getString("name"),
                                        objectArtist.getString("genre")
                                )
                                artistList!!.add(artist)
                                val adapter = ArtistList(this@ViewArtistsActivity, artistList!!)
                                listView!!.adapter = adapter
                            }
                        } else {
                            Toast.makeText(getApplicationContext(), obj.getString("message"), Toast.LENGTH_LONG).show()
                        }
                    } catch (e: JSONException) {
                        e.printStackTrace()
                    }
                }, Response.ErrorListener { volleyError -> Toast.makeText(applicationContext, volleyError.message, Toast.LENGTH_LONG).show() })

        val requestQueue = Volley.newRequestQueue(this)
        requestQueue.add<String>(stringRequest)
    }
}
    */
}
