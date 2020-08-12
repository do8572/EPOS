package com.example.epos;

import androidx.appcompat.app.AppCompatActivity;
import android.content.Intent;
import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;

public class Artikel extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_artikel);

        // Get the Intent that started this activity and extract the string
        Intent intent = getIntent();
        String message = intent.getStringExtra(MainActivity.ARTICLE_ID);

        TextView displayTextView = new TextView(Artikel.this);
        displayTextView.append("Artikel");
        Toast.makeText(Artikel.this, message, Toast.LENGTH_LONG).show();
    }
}