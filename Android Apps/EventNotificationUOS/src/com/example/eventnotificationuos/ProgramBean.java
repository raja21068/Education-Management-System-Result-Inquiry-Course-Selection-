package com.example.eventnotificationuos;

public class ProgramBean {
	public String id;
	public String programName;
	
	public ProgramBean(String id,String programName){
		this.id = id;
		this.programName = programName;
	}
	
	public String toString(){
		return ""+programName;
	}
}
