package com.example.eventnotificationuos;

import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONObject;

import com.example.eventnotificationuos.handler.RequestHandler;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;

public class MainActivity extends Activity implements OnClickListener{
	
	Button buttonLogin;
	Bundle bundle;
	EditText editTextUsername , editTextPassword;
	ProgressBar progressBar;
	TextView textViewStatus;
	Intent  intentWorking;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		
		buttonLogin = (Button)findViewById(R.id.buttonLogin);
		editTextPassword = (EditText)findViewById(R.id.editTextPassword);
		editTextUsername = (EditText)findViewById(R.id.editTextUsername);
		progressBar = (ProgressBar)findViewById(R.id.progressBarLogin);
		textViewStatus = (TextView)findViewById(R.id.textViewStatus);
		intentWorking = new Intent("com.example.eventnotificationuos.WORKINGACTIVITY");
		
		buttonLogin.setOnClickListener(this);
		
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		getMenuInflater().inflate(R.menu.main, menu);
		return true;
	}
	
	@Override
	public void onClick(View view) {
		if(view == buttonLogin){
			new LoginTask().execute();
		}
	}
	
	private class LoginTask extends AsyncTask<Void, Void, JSONObject>{
		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			buttonLogin.setEnabled(false);
			progressBar.setVisibility(View.VISIBLE);
		}
		
		@Override
		protected JSONObject doInBackground(Void... arg0) {
			String username = editTextUsername.getText().toString();
			String password = editTextPassword.getText().toString();
			try{
				JSONObject ob = RequestHandler.login(username, password);
				Log.e("MainActivity", ob.toString());
				return ob;
			}catch(Exception ex){
				ex.printStackTrace();
			}
			return null;
		}
		
		@Override
		protected void onPostExecute(JSONObject result) {
			super.onPostExecute(result);
			buttonLogin.setEnabled(true);
			progressBar.setVisibility(View.INVISIBLE);
			if(result == null){
				textViewStatus.setText("Problem with Connection..");
				return;
			}
			try{
				String status = result.getString("status");
				if(status.equalsIgnoreCase("OK")){
					bundle = new Bundle();
					ArrayList listNames = new ArrayList();
					ArrayList listIDS = new ArrayList();
					
					JSONArray array = result.getJSONArray("programs");
					for(int i=0;i<array.length();i++){
						JSONArray fields = array.getJSONArray(i);
						for(int j =0;j<fields.length();j+=2){
							String id = fields.get(j).toString();
							String name = fields.get(j+1).toString();
							listNames.add(name);
							listIDS.add(id);
						}
					}
					bundle.putCharSequenceArrayList("program_list", listNames);
					bundle.putCharSequenceArrayList("program_ids", listIDS);
					intentWorking.putExtras(bundle);
					startActivity(intentWorking);
					finish();
				}else{
					textViewStatus.setText(result.getString("message"));
				}
			}catch(Exception ex){ex.printStackTrace();
				textViewStatus.setText("Error in response format");
			}
		}
	}

}
