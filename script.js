//TheFreeElectron 2015, http://www.instructables.com/member/TheFreeElectron/
//JavaScript, uses pictures as buttons, sends and receives values to/from the Rpi
//These are all the buttons
var button_3 = document.getElementById("button_3");
var button_4 = document.getElementById("button_4");
var button_6 = document.getElementById("button_6");
var button_7 = document.getElementById("button_7");
var button_27 = document.getElementById("button_27");

var app_1 = document.getElementById("appliance_1");
var app_2 = document.getElementById("appliance_2");
var app_3 = document.getElementById("appliance_3");
var app_4 = document.getElementById("appliance_4");
var app_5 = document.getElementById("appliance_5");

//Create an array for easy access later
var Buttons = [ button_3, button_4, button_6, button_7, button_27];

var Apps = [app_1, app_2, app_3, app_4, app_5];

//This function is asking for gpio.php, receiving datas and updating the index.php appliance status
function change_pin ( pin ) {
var data = 0;
//send the pin number to gpio.php for changes
//this is the http request
	var request = new XMLHttpRequest();
	request.open( "GET" , "gpio.php?pin=" + pin, true);
	request.send(null);
	//receiving informations
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			data = request.responseText;
			//update the index pin
			if ( !(data.localeCompare("0")) ){
				 //Buttons[pin].src = "data/img/red/red_"+pin+".jpg";
				//console.log("pin" + "+pic+" + "is off");
				
				app_1.innerHTML = 'Appliance is off';	
				
			}
			else if ( !(data.localeCompare("1")) ) {
				// Buttons[pic].src = "data/img/green/green_"+pic+".jpg";
				//console.log("pin" + "+pic+" + "is on");
				
				app_1.innerHTML  = 'Appliance is off';
				
				
			}
			else if ( !(data.localeCompare("fail"))) {
				alert ("data.localCompare Fail!" );
				return ("fail");			
			}
			else {
				alert ("Something went wrong!" );
				return ("fail"); 
			}
		}
		//test if fail
		else if (request.readyState == 4 && request.status == 500) {
			alert ("server error");
			return ("fail");
		}
		//else 
		else if (request.readyState == 4 && request.status != 200 && request.status != 500 ) { 
			alert ("Request Fail!");
			return ("fail"); }
	}	
	
return 0;
}
