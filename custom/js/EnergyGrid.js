



case 'energygrid_pv-value':
$('[data-id="' + ise_id + '"]').html(parseFloat(value).toLocaleString("de-DE") + ' W');

/*
Wenn PV kleiner 1 dann 
 -> deaktiviere die Linie von PV zum Haus
 -> deaktiviere die Linie von PV zum Netz
*/

if(parseFloat(value) < 1) {
	$('[id="eg_pv_to_house_circle"]').attr("display", "none");
	$('[id="eg_pv_to_house_circle"]').attr("display", "none");
	$('[id="eg_pv_to_house"]').attr("stroke", "grey");
	$('[id="eg_pv_to_grid_circle"]').attr("display", "none");
	$('[id="eg_pv_to_grid"]').attr("stroke", "grey");
	//$('[id="eg_battery_to_house_circle"]').attr("display", "none");
	//$('[id="eg_battery_to_house"]').attr("stroke", "grey");

/*
Wenn PV größer 1 dann
 -> aktiviere die Linie von PV zum Haus
*/

} else {
	$('[id="eg_pv_to_house_circle"]').attr("display", "block");
	$('[id="eg_pv_to_house_animate"]').attr("keyPoints", "0;1");
	$('[id="eg_pv_to_house"]').attr("stroke", "#e0d055");
	value = value.replace("-", " ");
	if(value < 500) {
		var dur = 1.6;
	} else if(value < 1000) {
		var dur = 1.55;
	} else if(value < 2500) {
		var dur = 1.5;
	} else if(value < 5000) {
		var dur = 1.45;
	} else if(value < 10000) {
		var dur = 1.4;
	} else {
		var dur = 1.35;
	}
	var dur = dur * 1.05;
	$('[id="eg_pv_to_house_animate"]').attr("dur", dur);

}
// Speichere PV für spätere Nutzung
EnergyGridPV = parseFloat(value);
break;



case 'energygrid_battery-value': // erl 2

$('[data-id="' + ise_id + '"]').html((parseFloat(Math.round(value * 10) / 10)).toLocaleString("de-DE") + ' W');

/*
Wenn Batterie gleich 0
-> deaktiviere die Linie Batterie zum Haus
-> deaktiviere die Linie Batterie zu PV
*/

if(parseFloat(value) == 0 || value == "-0") {
	$('[id="eg_battery_to_house_circle"]').attr("display", "none");
	$('[id="eg_pv_to_battery_circle"]').attr("display", "none");
	$('[id="eg_battery_house"]').attr("stroke", "grey");
	$('[id="eg_pv_to_battery_house"]').attr("stroke", "grey");
	
/*
Wenn Batterie kleiner 0, bedeuted Entladung
-> aktiviere Linie Batterie zu Haus
*/	
	
} else if(parseFloat(value) < 0) {
	$('[id="eg_battery_to_house_animate"]').attr("keyPoints", "0;1");
	$('[id="eg_battery_to_house_circle"]').attr("display", "block");
	$('[id="eg_battery_to_house"]').attr("stroke", "#e96a93");

	$('[id="eg_pv_to_battery_circle"]').attr("display", "none");

	value = value.replace("-", " ");
	if(value < 500) {
		var dur = 1.6;
	} else if(value < 1000) {
		var dur = 1.55;
	} else if(value < 2500) {
		var dur = 1.5;
	} else if(value < 5000) {
		var dur = 1.45;
	} else if(value < 10000) {
		var dur = 1.4;
	} else {
		var dur = 1.35;
	}
	var dur = dur * 1.0008;
	$('[id="eg_battery_to_house_animate"]').attr("dur", dur);

/*
Wenn Batterie größer 0, bedeuted Ladung
-> aktiviere Linie Batterie zu PV
-> deaktiviere Batterie zu Haus
*/	


} else {

	$('[id="eg_battery_to_house_circle"]').attr("display", "none");
	$('[id="eg_battery_house"]').attr("stroke", "grey");
	$('[id="eg_pv_to_battery_animate"]').attr("keyPoints", "0;1");
	$('[id="eg_pv_to_battery_circle"]').attr("display", "block");
	$('[id="eg_pv_to_battery"]').attr("stroke", "#e0d055");

	if(value < 500) {
		var dur = 1.6;
	} else if(value < 1000) {
		var dur = 1.55;
	} else if(value < 2500) {
		var dur = 1.5;
	} else if(value < 5000) {
		var dur = 1.45;
	} else if(value < 10000) {
		var dur = 1.4;
	} else {
		var dur = 1.35;
	}
	var dur = dur * 1.0008;
	$('[id="eg_grid_to_house_animate"]').attr("dur", dur);
}

break;


case 'energygrid_battery-level': 

/*
Schreibe den Akku-Wert
*/

$('[data-id="' + ise_id + '"]').html(parseFloat(value).toLocaleString("de-DE") + ' %');
if(value < 1) {
	$('[id="battery_level_icon"]').attr("href", "icon/measure_battery_0.png");
} else if(value < 26) {
	$('[id="battery_level_icon"]').attr("href", "icon/measure_battery_25.png");
} else if(value < 51) {
	$('[id="battery_level_icon"]').attr("href", "icon/measure_battery_25.png");
} else if(value < 76) {
	$('[id="battery_level_icon"]').attr("href", "icon/measure_battery_50.png");
} else if(value < 99) {
	$('[id="battery_level_icon"]').attr("href", "icon/measure_battery_75.png");
} else {
	$('[id="battery_level_icon"]').attr("href", "icon/measure_battery_100.png");
}

break;



case 'energygrid_wallbox-level': 

/*
Schreibe den Akku-Wert
*/

$('[data-id="' + ise_id + '"]').html(parseFloat(value).toLocaleString("de-DE") + ' %');
if(value < 1) {
	$('[id="wallbox_level_icon"]').attr("href", "icon/measure_battery_0.png");
} else if(value < 26) {
	$('[id="wallbox_level_icon"]').attr("href", "icon/measure_battery_25.png");
} else if(value < 51) {
	$('[id="wallbox_level_icon"]').attr("href", "icon/measure_battery_25.png");
} else if(value < 76) {
	$('[id="wallbox_level_icon"]').attr("href", "icon/measure_battery_50.png");
} else if(value < 99) {
	$('[id="wallbox_level_icon"]').attr("href", "icon/measure_battery_75.png");
} else {
	$('[id="wallbox_level_icon"]').attr("href", "icon/measure_battery_100.png");
}

break;

case 'energygrid_wallbox-value': //ERL 2

/*
Wenn Wallbox gleich 0
-> deaktiviere die Linie Wallbox zum Haus
*/

if(parseFloat(value) == 0) {
	$('[id="eg_wallbox_to_house_circle"]').attr("display", "none");
	$('[id="eg_wallbox_to_house"]').attr("stroke", "grey");

/*
Wenn Wallbox größer 0, bedeuted Strom von der Wallbox zum Haus
-> aktiviere die Linie Wallbox zum Haus
*/

} else if(parseFloat(value) > 0) {
	$('[id="eg_wallbox_to_house_animate"]').attr("keyPoints", "1;0");
	$('[id="eg_wallbox_to_house_circle"]').attr("display", "block");
	$('[id="eg_wallbox_to_house"]').attr("stroke", "#8cb9fd");

	value = value.replace("-", " ");
	if(value < 500) {
		var dur = 1.6;
	} else if(value < 1000) {
		var dur = 1.55;
	} else if(value < 2500) {
		var dur = 1.5;
	} else if(value < 5000) {
		var dur = 1.45;
	} else if(value < 10000) {
		var dur = 1.4;
	} else {
		var dur = 1.35;
	}
	var dur = dur * 1.0003;
	$('[id="eg_wallbox_to_house_animate"]').attr("dur", dur);


/*
Wenn Wallbox kleiner 0, bedeuted Strom vom Haus zur Wallbox
-> aktiviere die Linie Wallbox zum Haus
*/

} else {
	$('[id="eg_wallbox_to_house_animate"]').attr("keyPoints", "0;1");
	$('[id="eg_wallbox_to_house_circle"]').attr("display", "block");
	$('[id="eg_wallbox_to_house"]').attr("stroke", "#8cb9fd");

	value = value.replace("-5", " ");
	if(value < 500) {
		var dur = 1.6;
	} else if(value < 1000) {
		var dur = 1.55;
	} else if(value < 2500) {
		var dur = 1.5;
	} else if(value < 5000) {
		var dur = 1.45;
	} else if(value < 10000) {
		var dur = 1.4;
	} else {
		var dur = 1.35;
	}
	var dur = dur * 1.0003;
	$('[id="eg_wallbox_to_house_animate"]').attr("dur", dur);

}
$('[data-id="' + ise_id + '"]').html(parseFloat(value).toLocaleString("de-DE") + ' W');

break;



case 'energygrid_house-value': // ERL

/*
Anhand des Hausverbrauchs und der PV-Leistung Ring-Farbe definieren
*/

$('[data-id="' + ise_id + '"]').html(parseFloat(value).toLocaleString("de-DE") + ' W');
EnergyGridHouse = parseFloat(value);

if(EnergyGridPV > (value + 500)) {
	const myCircle = document.getElementById('house');
	myCircle.style.stroke = 'green';
} else if(EnergyGridPV > (value + 250)) {
	const myCircle = document.getElementById('house');
	myCircle.style.stroke = 'yellow';
} else if(EnergyGridPV > (value)) {
	const myCircle = document.getElementById('house');
	myCircle.style.stroke = 'orange';
} else {
	const myCircle = document.getElementById('house');
	myCircle.style.stroke = '#f54842';
}




break;

case 'energygrid_grid-value': 

/*
Wenn Netz gleich 0
-> deaktiviere Linie Netz zu PV
-> deaktiviere Linie Netz zum Haus
*/	

if(parseFloat(value) == 0) {
	$('[data-id="' + ise_id + '"]').html(' W');
	$('[id="eg_pv_to_grid_circle"]').attr("display", "none");
	$('[id="eg_pv_to_grid"]').attr("stroke", "grey");
	$('[id="eg_grid_to_house_circle"]').attr("display", "none");
	$('[id="eg_grid_to_house_grid"]').attr("stroke", "grey");

	//$('[data-id="' + ise_id + '"]').html((Math.round(value * 10).toLocaleString("de-DE") / 10) + ' W');
	
	
	
} else if(parseFloat(value) < 0) {

	if(value < 500) {
		var dur = 1.6;
	} else if(value < 1000) {
		var dur = 1.55;
	} else if(value < 2500) {
		var dur = 1.5;
	} else if(value < 5000) {
		var dur = 1.45;
	} else if(value < 10000) {
		var dur = 1.4;
	} else {
		var dur = 1.35;
	}
	var dur = dur * 1.0001;

/*
Wenn Netz kleiner 0, bedeuted Einspeisung und PV gleich 0
-> deaktiviere Linie Netz zu PV
-> deaktiviere Linie Netz zum Haus
*/	

	if(EnergyGridPV < EnergyGridHouse) {

		$('[id="eg_pv_to_grid_circle"]').attr("display", "none");
		$('[id="eg_pv_to_grid"]').attr("stroke", "grey");

/*
Wenn Netz kleiner 0, bedeuted Einspeisung und PV größer 0
-> aktiviere Linie Netz zu PV
-> deaktiviere Linie Netz zum Haus
*/	

	} else {
		$('[id="eg_pv_to_grid_circle"]').attr("display", "block");
		$('[id="eg_pv_to_grid"]').attr("stroke", "#e0d055");
		$('[id="eg_pv_to_grid_animate"]').attr("dur", dur);
	}

	$('[id="eg_grid_to_house_circle"]').attr("display", "none");
	$('[id="eg_grid_to_house"]').attr("stroke", "grey");

} else {
	
	/*
Wenn Netz größer 0, bedeuted Laden aus Netz
-> deaktiviere Linie Netz zu PV
-> aktiviere Linie Netz zum Haus
*/	

	$('[id="eg_grid_to_house_animate"]').attr("keyPoints", "0;1");
	$('[id="eg_grid_to_house_circle"]').attr("display", "block");
	$('[id="eg_grid_to_house"]').attr("stroke", "#9c7140");

	$('[id="eg_pv_to_grid_circle"]').attr("display", "none");
	$('[id="eg_pv_to_grid"]').attr("stroke", "grey");

	//value = value.replace("-5", " ");
	if(value < 500) {
		var dur = 1.6;
	} else if(value < 1000) {
		var dur = 1.55;
	} else if(value < 2500) {
		var dur = 1.5;
	} else if(value < 5000) {
		var dur = 1.45;
	} else if(value < 10000) {
		var dur = 1.4;
	} else {
		var dur = 1.35;
	}
	var dur = dur * 1.901;
	$('[id="eg_grid_to_house_animate"]').attr("dur", dur);
}

$('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' W');

break;