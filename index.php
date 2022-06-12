<!DOCTYPE html>

<html>
    <head>  
        <meta charset="utf-8" />
        <title>Raspberry Pi Gpio</title>
        <link rel="stylesheet" href="index.css">
    </head>
 
    <body style="background-color: white;">
		<h1>This Is My Internet of Things Page</h1>
		
    <!-- On/Off button's -->
	<?php
	
	
	class Appliance {
		public $name;
		public $pin;
		
		//state is either a 1 or a 0, for if appliance is on
		public $state;
		
		function set_appliance($name, $pin, $state) {
			$this->name = $name;
			$this->pin = $pin;
			$this->state = $state;
		}
		
		function set_name($name) {
			$this->name = $name;
		}
		function get_name() {
			return $this->name;
		}
		function set_pin($pin) {
			$this->pin = $pin;
		}
		function get_pin() {
			return $this->pin;
		}
	}
	
	//pins used in raspberry Pi
	$pins = array(3, 4, 6, 7, 27);
	
	
	//populates array of appliances with names, pins and state
	
	$appliances = array();
	for($i = 0; $i < 5; $i++) {
		
		
		$appliance_Str = "appliance ". ($i+1);
		
		$defaultState = 0;		
		$appliance = new Appliance;
		$appliance->set_appliance($appliance_Str, $pins[$i], $defaultState);
		//echo ("<br/>\nthis is " . $i. "name: " .$appliance->name. "pin: " . $appliance->pin . "state: " . $appliance->state . "<br/>\n");
		
		$appliances[$i] = $appliance;
		 	
	}
	
	//section for if appliances need specific names
	$appliances[0]->name = "MainLamp";

	
	
	$val_array = array(0,0,0,0,0);
	//this php script generate the first page in function of the file

	
	foreach ($appliances as $appliance) {
		
		$output = array();
		system ( "gpio mode".$appliance->pin."out" );
		exec (" gpio read ".$appliance->pin, $output, $return );
		$appliance->state = (int)$output[0];
	}
	
	/* example
	for ( $i= 0; $i<8; $i++) {
		//set the pin's mode to output and read them
		system("gpio mode ".$i." out");
		exec ("gpio read ".$i, $val_array[$i], $return );
	}
	* 
	* 
	* $val_array[$i][0]
	*/
	$i = 0;
	
	foreach ($appliances as $appliance) {
		
		echo ("<br/>\nthis is " . $i. " -> name: " .$appliance->name. " -> pin: " . $appliance->pin . " -> state: " . $appliance->state . "<br/>\n");
		
		if ($appliance->state == 0) {
//			echo ("<img id='button_".$pin."' src='data/img/red/red_".$pin.".jpg' onclick='change_pin (".$pin.");'/>");	
			echo ("<button id= 'button_".$appliance->pin."' onclick='change_pin (".$appliance->pin.");'>" .$appliance->name." </button>");
			echo ("<p id= 'appliance_".($i +1)."'>appliance_".($i +1)." is off</p>");
		}
		
		//validate what val_array means
		if ($appliance->state == 1) {
//			echo ("<img id='button_".$pin."' src='data/img/green/green_".$pin.".jpg' onclick='change_pin (".$pin.");'/>");
			echo ("<button id= 'button_".$appliance->pin."' onclick='change_pin (".$appliance->pin.");'> appliance ".$appliance->pin." </button>");
			echo ("<p id= 'appliance_".($i +1)."'>appliance_".($i +1)." is on</p>");
			echo ("<img id= 'appliance_".($i +1)."' src='data/img/light/Light_On.jpeg'/>");
		}
		$i = $i + 1;
	}
	/*
	//for loop to read the value
	$i =0;
	for ($i = 0; $i < 8; $i++) {
		//if off
		if ($val_array[$i][0] == 0 ) {
			echo ("<img id='button_".$i."' src='data/img/red/red_".$i.".jpg' onclick='change_pin (".$i.");'/>");
		}
		//if on
		if ($val_array[$i][0] == 1 ) {
			echo ("<img id='button_".$i."' src='data/img/green/green_".$i.".jpg' onclick='change_pin (".$i.");'/>");
		}	 
	}
	*/
	?>
	 
	<!-- javascript -->
	<script src="script.js"></script>
    </body>
</html>
