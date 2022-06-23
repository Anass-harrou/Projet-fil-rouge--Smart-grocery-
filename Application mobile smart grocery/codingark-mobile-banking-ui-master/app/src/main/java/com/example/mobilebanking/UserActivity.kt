package com.example.mobilebanking

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.View

class UserActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_user)
        val home:View = findViewById(R.id.menuHome)
        home.setOnClickListener{
            val intent = Intent(this,MainActivity::class.java)
            //intent.putExtra(nom:String)
            startActivity(intent)
        }
    }
}