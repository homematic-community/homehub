<?php
// HmIP-WGC
// 230825 PL

// Ansteuerung �ber Kanal 3


/*

 {
         "component":"HmIP-WGC",
         "parent_device_type":"HmIP-WGC",
         "parent_device_interface":"HmIP-RF",
         "name":"Garagentorfernbedienung:0",
         "type":"30",
         "address":"001320C9952F65:0",
         "ise_id":"82266",
         "direction":"UNKNOWN",
         "parent_device":"82265",
         "index":"0",
         "group_partner":"",
         "aes_available":"false",
         "transmission_mode":"AES",
         "visible":"true",
         "ready_config":"true",
         "operate":"true",
         "datapoints":[
            {
               "name":"HmIP-RF.001320C9952F65:0.CONFIG_PENDING",
               "type":"CONFIG_PENDING",
               "ise_id":"82267",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:0.DUTY_CYCLE",
               "type":"DUTY_CYCLE",
               "ise_id":"82271",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:0.ERROR_CODE",
               "type":"ERROR_CODE",
               "ise_id":"82272",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:0.ERROR_UNDERVOLTAGE",
               "type":"ERROR_UNDERVOLTAGE",
               "ise_id":"82273",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:0.LOW_BAT",
               "type":"LOW_BAT",
               "ise_id":"82278",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:0.OPERATING_VOLTAGE",
               "type":"OPERATING_VOLTAGE",
               "ise_id":"82282",
               "state":"3.000000",
               "value":"3.000000",
               "valuetype":"4",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:0.OPERATING_VOLTAGE_STATUS",
               "type":"OPERATING_VOLTAGE_STATUS",
               "ise_id":"82283",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:0.RSSI_DEVICE",
               "type":"RSSI_DEVICE",
               "ise_id":"82284",
               "state":"-91",
               "value":"-91",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:0.RSSI_PEER",
               "type":"RSSI_PEER",
               "ise_id":"82285",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"0",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:0.UNREACH",
               "type":"UNREACH",
               "ise_id":"82286",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:0.UPDATE_PENDING",
               "type":"UPDATE_PENDING",
               "ise_id":"82290",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            }
         ]
      },
      {
         "component":"HmIP-WGC",
         "parent_device_type":"HmIP-WGC",
         "parent_device_interface":"HmIP-RF",
         "name":"Garagentor:1",
         "type":"17",
         "address":"001320C9952F65:1",
         "ise_id":"82294",
         "direction":"SENDER",
         "parent_device":"82265",
         "index":"1",
         "group_partner":"",
         "aes_available":"false",
         "transmission_mode":"AES",
         "visible":"true",
         "ready_config":"true",
         "operate":"true",
         "datapoints":[
            {
               "name":"HmIP-RF.001320C9952F65:1.PRESS_LONG",
               "type":"PRESS_LONG",
               "ise_id":"82295",
               "state":"false",
               "value":"",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"0",
               "operations":"4"
            },
            {
               "name":"HmIP-RF.001320C9952F65:1.PRESS_LONG_RELEASE",
               "type":"PRESS_LONG_RELEASE",
               "ise_id":"82296",
               "state":"false",
               "value":"",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"0",
               "operations":"4"
            },
            {
               "name":"HmIP-RF.001320C9952F65:1.PRESS_LONG_START",
               "type":"PRESS_LONG_START",
               "ise_id":"82297",
               "state":"false",
               "value":"",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"0",
               "operations":"4"
            },
            {
               "name":"HmIP-RF.001320C9952F65:1.PRESS_SHORT",
               "type":"PRESS_SHORT",
               "ise_id":"82298",
               "state":"false",
               "value":"",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"0",
               "operations":"4"
            }
         ]
      },
      {
         "component":"HmIP-WGC",
         "parent_device_type":"HmIP-WGC",
         "parent_device_interface":"HmIP-RF",
         "name":"Garagentor:2",
         "type":"26",
         "address":"001320C9952F65:2",
         "ise_id":"82299",
         "direction":"UNKNOWN",
         "parent_device":"82265",
         "index":"2",
         "group_partner":"",
         "aes_available":"false",
         "transmission_mode":"AES",
         "visible":"true",
         "ready_config":"true",
         "operate":"true",
         "datapoints":[
            {
               "name":"HmIP-RF.001320C9952F65:2.PROCESS",
               "type":"PROCESS",
               "ise_id":"82300",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:2.SECTION",
               "type":"SECTION",
               "ise_id":"82301",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:2.SECTION_STATUS",
               "type":"SECTION_STATUS",
               "ise_id":"82302",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:2.STATE",
               "type":"STATE",
               "ise_id":"82303",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            }
         ]
      },
      {
         "component":"HmIP-WGC",
         "parent_device_type":"HmIP-WGC",
         "parent_device_interface":"HmIP-RF",
         "name":"Garagentor:3",
         "type":"26",
         "address":"001320C9952F65:3",
         "ise_id":"82304",
         "direction":"RECEIVER",
         "parent_device":"82265",
         "index":"3",
         "group_partner":"",
         "aes_available":"false",
         "transmission_mode":"AES",
         "visible":"true",
         "ready_config":"true",
         "operate":"true",
         "datapoints":[
            {
               "name":"HmIP-RF.001320C9952F65:3.COMBINED_PARAMETER",
               "type":"COMBINED_PARAMETER",
               "ise_id":"82305",
               "state":"",
               "value":"",
               "valuetype":"20",
               "valueunit":"",
               "timestamp":"0",
               "operations":"2"
            },
            {
               "name":"HmIP-RF.001320C9952F65:3.PROCESS",
               "type":"PROCESS",
               "ise_id":"82307",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:3.SECTION",
               "type":"SECTION",
               "ise_id":"82308",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:3.SECTION_STATUS",
               "type":"SECTION_STATUS",
               "ise_id":"82309",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:3.STATE",
               "type":"STATE",
               "ise_id":"82310",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"7"
            }
         ]
      },
      {
         "component":"HmIP-WGC",
         "parent_device_type":"HmIP-WGC",
         "parent_device_interface":"HmIP-RF",
         "name":"Garagentor:4",
         "type":"26",
         "address":"001320C9952F65:4",
         "ise_id":"82311",
         "direction":"RECEIVER",
         "parent_device":"82265",
         "index":"4",
         "group_partner":"",
         "aes_available":"false",
         "transmission_mode":"AES",
         "visible":"true",
         "ready_config":"true",
         "operate":"true",
         "datapoints":[
            {
               "name":"HmIP-RF.001320C9952F65:4.COMBINED_PARAMETER",
               "type":"COMBINED_PARAMETER",
               "ise_id":"82312",
               "state":"",
               "value":"",
               "valuetype":"20",
               "valueunit":"",
               "timestamp":"0",
               "operations":"2"
            },
            {
               "name":"HmIP-RF.001320C9952F65:4.PROCESS",
               "type":"PROCESS",
               "ise_id":"82314",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:4.SECTION",
               "type":"SECTION",
               "ise_id":"82315",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:4.SECTION_STATUS",
               "type":"SECTION_STATUS",
               "ise_id":"82316",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:4.STATE",
               "type":"STATE",
               "ise_id":"82317",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"7"
            }
         ]
      },
      {
         "component":"HmIP-WGC",
         "parent_device_type":"HmIP-WGC",
         "parent_device_interface":"HmIP-RF",
         "name":"Garagentor:5",
         "type":"26",
         "address":"001320C9952F65:5",
         "ise_id":"82318",
         "direction":"RECEIVER",
         "parent_device":"82265",
         "index":"5",
         "group_partner":"",
         "aes_available":"false",
         "transmission_mode":"AES",
         "visible":"true",
         "ready_config":"true",
         "operate":"true",
         "datapoints":[
            {
               "name":"HmIP-RF.001320C9952F65:5.COMBINED_PARAMETER",
               "type":"COMBINED_PARAMETER",
               "ise_id":"82319",
               "state":"",
               "value":"",
               "valuetype":"20",
               "valueunit":"",
               "timestamp":"0",
               "operations":"2"
            },
            {
               "name":"HmIP-RF.001320C9952F65:5.PROCESS",
               "type":"PROCESS",
               "ise_id":"82321",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:5.SECTION",
               "type":"SECTION",
               "ise_id":"82322",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:5.SECTION_STATUS",
               "type":"SECTION_STATUS",
               "ise_id":"82323",
               "state":"0",
               "value":"0",
               "valuetype":"16",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"5"
            },
            {
               "name":"HmIP-RF.001320C9952F65:5.STATE",
               "type":"STATE",
               "ise_id":"82324",
               "state":"false",
               "value":"false",
               "valuetype":"2",
               "valueunit":"",
               "timestamp":"1692298771",
               "operations":"7"
            }
         ]
      },
	  
	  */

function HmIP_WGC($component) {
    if ($component['parent_device_interface'] == 'HmIP-RF' && $component['visible'] == 'true' && isset($component['SECTION_STATUS'])) {
        if (!isset($component['color'])) $component['color'] = '#595959';
            return '<div class="hh" style=\'border-left-color: '.$component['color'].'; border-left-style: solid;\'>'
            . '<div class="pull-left"><img src="icon/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="set btn-text" data-set-id="' . $component['STATE'] . '" data-set-value="1">Taster</span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}