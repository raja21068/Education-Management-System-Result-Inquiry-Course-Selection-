package com.example.eventnotificationuos.handler;


import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

import android.util.Log;

public class RequestHandler {
	
	private static final String url = "http://exam.usindh.edu.pk/event_notification/";
//	private static final String url = "http://stbb.edu.pk/bank/";
	
	private static final String login = "login.php";
	private static final String students = "get_students.php";
	private static final String batch = "get_batch.php";
	
	private static List<NameValuePair> params;
	
	
	public static JSONObject login(String username , String password)throws Exception{
		JSONParser jsonParser = new JSONParser();
		params = new ArrayList<NameValuePair>(2);
		params.add(new BasicNameValuePair("user_name", username));
		params.add(new BasicNameValuePair("password", password));
		
		JSONObject ob = jsonParser.makeHttpRequest(url+login, "GET", params);
		return ob;
	}
	
	public static JSONObject getBatch(String programId)throws Exception{
		JSONParser jsonParser = new JSONParser();
		params = new ArrayList<NameValuePair>(2);
		params.add(new BasicNameValuePair("prog_id", programId));
		
		JSONObject ob = jsonParser.makeHttpRequest(url+batch, "GET", params);
		return ob;
	}
	
	public static JSONObject getStudents(String batchId, String message)throws Exception{
		JSONParser jsonParser = new JSONParser();
		params = new ArrayList<NameValuePair>(2);
		params.add(new BasicNameValuePair("batch_id", batchId));
		params.add(new BasicNameValuePair("message", message));
		
		JSONObject ob = jsonParser.makeHttpRequest(url+students, "GET", params);
		return ob;
	}

}
