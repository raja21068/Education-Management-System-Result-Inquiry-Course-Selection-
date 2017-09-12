package com.example.eventnotificationuos;

import android.app.Dialog;
import android.content.Context;
import android.widget.TextView;

public class ProcessingDialog extends Dialog{

	TextView tvStatus;
	
	public ProcessingDialog(Context context) {
		super(context);
	}
	
	public void show(String status){
		setContentView(R.layout.dialog_processing);
		tvStatus = (TextView)findViewById(R.id.textViewDialog);
		tvStatus.setText(status);
		super.show();
	}

}
