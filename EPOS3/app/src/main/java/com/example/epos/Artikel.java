package com.example.epos;

import androidx.appcompat.app.AppCompatActivity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.webkit.WebView;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

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
        showArticle(Integer.parseInt(message));
    }

    private void showArticle(int id){
        final TextView ime = (TextView) findViewById(R.id.ime);
        final TextView cena = (TextView) findViewById(R.id.cena);
        final TextView opis = (TextView) findViewById(R.id.opis);

        RequestQueue queue = Volley.newRequestQueue(this);
        JsonArrayRequest req = new JsonArrayRequest(Request.Method.GET, "http://192.168.0.54/epos/controller/requestHandler.php?opisArtikla=true&target_id=" + Integer.toString(id), null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray  response) {
                try {
                    JSONObject obj = (JSONObject) response.get(0);
                    ime.setText(obj.getString("ime"));
                    cena.setText(Double.toString(obj.getDouble("cena")) + "EUR");
                    opis.setText(obj.getString("opis"));
                    Log.i("JSON",response.toString());
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                Log.i("ERROR",error.toString());

            }
        });

        queue.add(req);
    }
}