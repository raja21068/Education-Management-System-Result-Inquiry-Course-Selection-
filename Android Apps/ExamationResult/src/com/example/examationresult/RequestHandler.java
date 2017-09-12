package com.example.examationresult;



import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

public class RequestHandler {
	
	//private static final String url = "http://172.16.120.97/MobilityResultAnnouncement/";
	private static final String url = "http://exam.usindh.edu.pk/mobile/version2/";
	
	
	
	private static final String result = "transcript_request_handler.php";
	private static final String admimision = "admimision.php";
	
	private static List<NameValuePair> params;
	
	
	public static JSONObject SendMessageInformation(String rollNo , String part,String cellNo)throws Exception{
		
		JSONParser jsonParser = new JSONParser();
		params = new ArrayList<NameValuePair>(3);
		params.add(new BasicNameValuePair("roll_no", rollNo.toUpperCase().toString()));
		params.add(new BasicNameValuePair("part", part));
		params.add(new BasicNameValuePair("cellno", cellNo));		
		System.out.println("Requesting to:"+(url+result));
		JSONObject ob = jsonParser.makeHttpRequest(url+result, "POST", params);
		return ob;
	}
public static JSONObject AdmissionResultInformation(String seatNo ,String cellNo)throws Exception{
		
		JSONParser jsonParser = new JSONParser();
		params = new ArrayList<NameValuePair>(2);
		params.add(new BasicNameValuePair("seatno",seatNo));
		params.add(new BasicNameValuePair("cellno", cellNo));		
		System.out.println("Requesting to:"+(url+admimision));
		JSONObject ob = jsonParser.makeHttpRequest(url+admimision, "POST", params);
		return ob;
	}
	
	
}
