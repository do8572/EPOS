package com.example.epos;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.MotionEvent;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Spinner;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.RetryPolicy;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Iterator;

//TODO: send requests to API
//TODO: redirect to another API

public class MainActivity extends AppCompatActivity {
    private static final String TAG = MainActivity.class.getName();
    public static final String ARTICLE_ID = "com.example.epos.ARTIKEL";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        showArticleList();
    }

    @Override
    protected void onStart() {
        super.onStart();
        setContentView(R.layout.activity_main);

        Log.i("MyApp","started");

        //showArticleList();
   }

    @Override
    protected void onRestart() {
        super.onRestart();
        //setContentView(R.layout.activity_main);

        Log.i("MyApp","restarted");

        //showArticleList();
    }



    @Override
    protected void onResume() {
        super.onResume();
        setContentView(R.layout.activity_main);

        Log.i("MyApp","resumed");

        showArticleList();
    }


    @Override
    protected void onStop() {
        super.onStop();
        setContentView(R.layout.activity_main);

        Log.i("MyApp","stopped");
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        //setContentView(R.layout.activity_main);

        Log.i("MyApp","destroyed");
    }

    public void showArticle(View view, String article_id) {
        Intent intent = new Intent(this, Artikel.class);
        intent.putExtra(ARTICLE_ID, article_id);
        startActivity(intent);
    }

    private void showArticleList(){
        final ListView list = findViewById(R.id.list);
        final ArrayList<String> arrayList = new ArrayList<>();
        RequestQueue queue = Volley.newRequestQueue(this);
        JsonArrayRequest  req = new JsonArrayRequest(Request.Method.GET, "http://192.168.0.54/epos/controller/requestHandler.php?izpisVsihArtiklov=true", null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray  response) {
                try {
                    for(int i = 0; i < response.length(); i++){
                        JSONObject obj = (JSONObject) response.get(i);
                        arrayList.add(obj.getString("ime"));
                    }

                    ArrayAdapter<String> arrayAdapter = new ArrayAdapter<String>(MainActivity.this, android.R.layout.simple_list_item_1, arrayList);
                    list.setAdapter(arrayAdapter);
                    list.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                        @Override
                        public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                            String clickedItem = (String) list.getItemAtPosition(position);
                            showArticle(view, clickedItem);
                        }
                    });
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