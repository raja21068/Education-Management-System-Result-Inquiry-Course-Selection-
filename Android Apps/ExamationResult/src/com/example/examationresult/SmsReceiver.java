package com.example.examationresult;

import org.json.JSONException;
import org.json.JSONObject;

import android.app.PendingIntent;
import android.content.BroadcastReceiver;
import android.content.ContentResolver;
import android.content.Context;
import android.content.Intent;
import android.location.LocationManager;
import android.os.AsyncTask;
import android.os.Bundle;
import android.telephony.SmsMessage;
import android.util.Log;

public class SmsReceiver extends BroadcastReceiver 
{
	// All available column names in SMS table
    // [_id, thread_id, address, 
	// person, date, protocol, read, 
	// status, type, reply_path_present, 
	// subject, body, service_center, 
	// locked, error_code, seen]
	String body ="";
	String address ="";
    
	public static final String SMS_EXTRA_NAME = "pdus";
	public static final String SMS_URI = "content://sms";
	
	public static final String ADDRESS = "address";
    public static final String PERSON = "person";
    public static final String DATE = "date";
    public static final String READ = "read";
    public static final String STATUS = "status";
    public static final String TYPE = "type";
    public static final String BODY = "body";
    public static final String SEEN = "seen";
    
    public static final int MESSAGE_TYPE_INBOX = 1;
    public static final int MESSAGE_TYPE_SENT = 2;
    
    public static final int MESSAGE_IS_NOT_READ = 0;
    public static final int MESSAGE_IS_READ = 1;
    
    public static final int MESSAGE_IS_NOT_SEEN = 0;
    public static final int MESSAGE_IS_SEEN = 1;
	
    // Change the password here or give a user possibility to change it
    public static final byte[] PASSWORD = new byte[]{ 0x20, 0x32, 0x34, 0x47, (byte) 0x84, 0x33, 0x58 };
    
	public void onReceive( Context context, Intent intent ) 
	{
		synchronized (intent) {	
		
        Bundle extras = intent.getExtras();
        
        String messages = "";
        
        if ( extras != null )
        {
            Object[] smsExtra = (Object[]) extras.get( SMS_EXTRA_NAME );
            
            for ( int i = 0; i < smsExtra.length; ++i )
            {
            	SmsMessage sms = SmsMessage.createFromPdu((byte[])smsExtra[i]);
            	
            	 body = sms.getMessageBody().toString();
            	address = sms.getOriginatingAddress();
                Log.e("body",""+body);
                Log.e("address",""+address);
                
                messages += "SMS from " + address + " :\n";                    
                messages += body + "\n";
                
                
            }
            //Send SMS to client 
           
            try{
            	if(address.length()<10){
            		return;
            	}
            	String data[] = body.split(" ");
            	//Toast.makeText(context, "data[0] "+data[0]+"\ndata[1] "+data[1], Toast.LENGTH_LONG).show();
            	if(data.length==2 && data[1].length()==1 && data[0].length()>=8){
        			String rollno= data[0];
        			String part= data[1];
        			
        			new ResultStudentInformationProcess(rollno,part,address).execute();
        	        try{
        	        	Thread.sleep(3000);
        	        }catch(Exception ex){ex.printStackTrace();}
        			return;
            	}
            		if(data.length==1){
        			String seatno= data[0];
        			//new admissionResultInformationProcess(seatno,address).execute();
            	}
               // Toast.makeText( context, messages, Toast.LENGTH_SHORT ).show();
            	  }catch(Exception ex){
            	ex.printStackTrace();
            }
         
        }
        
		} 
	}
	private class ResultStudentInformationProcess extends AsyncTask<Void, Void,JSONObject>{
		String rollno, part, address;
		ResultStudentInformationProcess(String rollno,String part,String address){
			this.rollno =rollno;
			this.part=part;
			this.address=address;
			
		}
		@Override
		protected JSONObject doInBackground(Void... arg0) {
		//	
			JSONObject ob = null;
			try{
				
				System.out.println("RollNo:"+rollno.toUpperCase().toString());
				System.out.println("part:"+part);
				System.out.println("Addrss:"+address);
				
				ob=RequestHandler.SendMessageInformation(rollno.toUpperCase().toString(), part, address);
				System.out.println("Message Information: "+ob);
				
				String message = "";
				String cellNo  =null;
				try {
					if(ob!=null){	
					String msg=ob.getString("MSG");
					cellNo =ob.getString("CELL_NO");
					/*
					String data[]= msg.split(",");
					for(int i=0;i<data.length;i++){
						message+=data[i]+"\n";
					}
					 */
					SmsSender.sendLongSMS(cellNo, msg);
					Log.e("SMS","SENT");
					System.out.println("SMS SENT Sucessfully...");
					cellNo="";
					message="";
					ob=null;
					return null;
					}// end if
				} catch (Exception e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				return null;
					
			}catch(Exception ex){
				ex.printStackTrace();
			}
			
			return null;
		}

		@Override
		protected void onPostExecute(JSONObject ob) {
			// TODO Auto-generated method stub
			super.onPostExecute(ob);

	
			
			
		}			
			
		}
		private class admissionResultInformationProcess extends AsyncTask<Void, Void,JSONObject>{
			String seatno, address;
			admissionResultInformationProcess(String seatno,String address){
				this.seatno =seatno;
				this.address=address;
				
			}
			@Override
			protected JSONObject doInBackground(Void... arg0) {
			//	
				JSONObject ob = null;
				try{
					
					System.out.println("seatNo:"+seatno);
					System.out.println("Addrss:"+address);
					
					ob=RequestHandler.AdmissionResultInformation(seatno, address);
					System.out.println("Message Information: "+ob);
					try {
						String message=ob.getString("message");
						String status=ob.getString("status");
						
						if(status.equals("OK")){
							String cellno=ob.getString("cellno");
							String str="";
							String NAME=ob.getString("NAME");
							String NET_PER=ob.getString("NET_PER");
							String MERIT=ob.getString("MERIT");
							String FEMALE=ob.getString("FEMALE");
							String DISABLE=ob.getString("DISABLE");
							String SELF_FIN_M=ob.getString("SELF_FIN_M");
							String EVENING=ob.getString("EVENING");
							if(!MERIT.equals("")) str+="MERIT: "+MERIT;
							if(!FEMALE.equals("")) str+="\nFEMALE: "+FEMALE;
							
							if(!DISABLE.equals("")) str+="\nDISABLE: "+DISABLE;
							if(!SELF_FIN_M.equals("")) str+="\nSELF_FIN_M "+SELF_FIN_M;
							if(!EVENING.equals("")) str+="\nEVENING "+EVENING;
							
							SmsSender.sendLongSMS(""+cellno, "Name: "+NAME+"\n NET_PERCENTAGE: "+NET_PER+"\n"+str);
							}
								
								
					} catch (JSONException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
					return ob;
				}catch(Exception ex){
					ex.printStackTrace();
				}
				
				return null;
			}

			@Override
			protected void onPostExecute(JSONObject result) {
				// TODO Auto-generated method stub
				super.onPostExecute(result);
				
				
				
			}

		
			
	
}
}