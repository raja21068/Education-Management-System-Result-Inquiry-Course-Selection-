package com.example.eventnotificationuos;

import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONObject;

import android.app.Activity;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemSelectedListener;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.example.eventnotificationuos.handler.RequestHandler;

public class WorkingActivity extends Activity implements OnClickListener, OnItemSelectedListener{

	Button buttonSend;
	Bundle bundle;
	Spinner spinnerPrograms, spinnerBatches;
	ArrayList listNames , listIds;
	ProcessingDialog dialog;
	ArrayList listBatchIds;
	EditText editTextMessage;
	TextView textViewWorkingStatus;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.actitvity_working);
		buttonSend = (Button)findViewById(R.id.buttonSend);
		buttonSend.setOnClickListener(this);
		spinnerPrograms = (Spinner)findViewById(R.id.spinnerPrograms);
		spinnerBatches = (Spinner)findViewById(R.id.spinnerBatch);
		bundle = getIntent().getExtras();
		dialog = new ProcessingDialog(WorkingActivity.this);
		editTextMessage=(EditText)findViewById(R.id.editTextMessage);
		textViewWorkingStatus = (TextView)findViewById(R.id.textViewWorkingStatus);
		spinnerPrograms.setOnItemSelectedListener(this);
		try{
			listNames = bundle.getCharSequenceArrayList("program_list");
			listIds = bundle.getCharSequenceArrayList("program_ids");
			
			spinnerPrograms.setAdapter(new ArrayAdapter(getApplicationContext(), android.R.layout.simple_spinner_item, listNames.toArray() ));
		}catch(Exception ex){
			ex.printStackTrace();
			Toast.makeText(getApplicationContext(), "Error Ocuured get bundle", Toast.LENGTH_LONG).show();
		}
		
	}
	
	
	@Override
	public void onClick(View view) {
		if(view == buttonSend){
			int position = spinnerBatches.getSelectedItemPosition();
			Toast.makeText(getApplicationContext(), position+"< Postion: Element:"+listBatchIds.get(position), Toast.LENGTH_SHORT).show();
			new GetStudentsAndSendMessage().execute(listBatchIds.get(position).toString());
		}
	}
	
	@Override
	public void onItemSelected(AdapterView<?> arg0, View view, int index,long arg3) {
		String programId = listIds.get(index).toString();
		Log.e("WorkingActivity", "Program Id: "+programId);
		new GetBatchesTask().execute(programId);
		
	}
	@Override
	public void onNothingSelected(AdapterView<?> arg0) {
		Toast.makeText(getApplicationContext(), "Nothing",Toast.LENGTH_SHORT).show();
	}
	
	private class GetBatchesTask extends AsyncTask<String, Void, JSONObject>{
		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			dialog.show("Get Batches, Please wait..");
		}
		
		@Override
		protected JSONObject doInBackground(String... arg) {
			String programId = arg[0];
			try{
				JSONObject ob = RequestHandler.getBatch(programId);
				return ob;
			}catch(Exception ex){
				ex.printStackTrace();
			}
			return null;
			
		}
		
		@Override
		protected void onPostExecute(JSONObject result) {
			super.onPostExecute(result);
			if(result == null){
				dialog.dismiss();
				return;
			}
			try{
				JSONArray arr = result.getJSONArray("batch");
				ArrayList batchs = new ArrayList();
				listBatchIds = new ArrayList();
				for(int i=0;i<arr.length();i++){
					JSONArray listBatches = arr.getJSONArray(i);
					for(int j=0;j<listBatches.length();j+=2){
						String batchId = listBatches.get(j).toString();
						String batchName = listBatches.get(j+1).toString();
						batchs.add(batchName+"\n");
						listBatchIds.add(batchId);
					}
				}
				spinnerBatches.setAdapter(new ArrayAdapter(getApplicationContext(), android.R.layout.simple_spinner_item, batchs.toArray() ));
			}catch(Exception ex){
				ex.printStackTrace();
				Toast.makeText(getApplicationContext(), "Error in format", Toast.LENGTH_LONG).show();
			}
			dialog.dismiss();
			
		}
	}
	
	
	private class GetStudentsAndSendMessage extends AsyncTask<String, Void, JSONObject>{
		
		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			dialog.show("Sending Message to batch..");
			textViewWorkingStatus.setText("Message sending to : "+spinnerBatches.getSelectedItem());
			disableAll();
		}
		
		@Override
		protected JSONObject doInBackground(String... arg) {
			String batchId = arg[0];
			try{
				JSONObject ob = RequestHandler.getStudents(batchId , editTextMessage.getText().toString());
				Log.e("WorkingActivirt", ob.toString());
				JSONArray array = ob.getJSONArray("student");
				for(int i=0;i<array.length();i++){
					JSONArray studentBean = array.getJSONArray(i);
					for(int j=0;j<studentBean.length();j+=2){
						String studentName = studentBean.getString(j).toString();
						String number = studentBean.getString(j+1).toString();
						Log.e("Working", ""+studentName);	
							try{
								// SENDING SMS
//								number = number.replaceAll("-", "");
//								number = number.replaceAll(" ", "");
								if(number.length()>10)SmsSender.sendLongSMS(number,"Dear "+studentName+",\n"+editTextMessage.getText().toString());
								Thread.sleep(1000);
							}catch(Exception ex){
//								ex.printStackTrace();
								Log.e("Working Activity", "Failed to send:"+studentName+" "+number);
							}
					}
				}
				return ob;
			}catch(Exception ex){
				ex.printStackTrace();
			}
			return null;
		}
		
		@Override
		protected void onPostExecute(JSONObject result) {
			super.onPostExecute(result);
			try{
				if(result == null){
					textViewWorkingStatus.setText("Message sending failed : "+spinnerBatches.getSelectedItem());
				}
				else{
					textViewWorkingStatus.setText("Message Succesfully sent to: "+spinnerBatches.getSelectedItem());
				}
				dialog.dismiss();
			}catch(Exception ex){ex.printStackTrace();}
			enableAll();
		}
	}
	
	
	public void disableAll(){
		spinnerBatches.setEnabled(false);
		spinnerPrograms.setEnabled(false);
		buttonSend.setEnabled(false);
		editTextMessage.setEnabled(false);
	}
	public void enableAll(){
		spinnerBatches.setEnabled(true);
		spinnerPrograms.setEnabled(true);
		buttonSend.setEnabled(true);
		editTextMessage.setEnabled(true);
	}
}
