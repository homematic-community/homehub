$(document).ready(function () {
    updateDatapoints();

    $('.set').click(function () {
        var id = $(this).attr('data-set-id');
        var value = $(this).attr('data-set-value');
        var datapoint = $(this).attr('data-datapoint'); 

        if (datapoint == '4' || datapoint == '20') {
            value = $('[name="' + id + '"]').val();
        }

        setDatapoint(id, value);
    });

    $('.run').click(function () {
        var id = $(this).attr('data-run-id');

        runProgram(id);
    });
});

var updateDatapoints = function () {
    //192.168.2.6/config/xmlapi/state.cgi?datapoint_id=

    // Uhrzeit setzen
    date = new Date();
    $('#time').html(('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2) + ' Uhr');

    var id = '';

    $('.info').each(function () {
        if (id === '') {
            id = $(this).attr('data-id');
        } else {
            id = id + ',' + $(this).attr('data-id');
        }
    });

    $.ajax({
        type: 'GET',
        url: 'http://' + homematicIp + '/config/xmlapi/state.cgi?datapoint_id=' + id,
        dataType: 'xml',
        success: function (xml) {
            $('#flash-error').hide();

            $(xml).find('datapoint').each(function (index) {
                var ise_id = $(this).attr('ise_id');
                var value = $(this).attr('value');

                var component = $('[data-id="' + ise_id + '"]').attr('data-component');
                var datapoint = $('[data-id="' + ise_id + '"]').attr('data-datapoint');
                var unit = $('[data-id="' + ise_id + '"]').attr('data-unit');
                var valueList = $('[data-id="' + ise_id + '"]').attr('data-valuelist');

                if (!unit) {
                    unit = '';
                }
                if (!valueList) {
                    valueList = '';
                }

                switch (component) {  
                    case 'CUX2801':
                        switch (datapoint) {
                            case 'BLIND_LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_2w.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_10.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_20.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_30.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_40.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_60.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_70.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_80.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_90.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_100.png" />');
                                }
                                break;
                            case 'DIMMER_LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_100.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_90.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_80.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_70.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_60.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_40.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_30.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_20.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_10.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_00.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'CUX2803':
                        switch (datapoint) {
                            case 'INFO':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'IP':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('online');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('offline');
                                }
                                break;
                            case 'UNREACH_CTR':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'CUX4000':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'CUX9002':
                        switch (datapoint) {
                            case 'ABS_HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'DEW_POINT':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'HUM_MAX_24H':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'HUM_MIN_24H':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'TEMP_MAX_24H':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'TEMP_MIN_24H':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-CC-RT-DN':
                        switch (datapoint) {
                            case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'BATTERY_STATE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' V');
                                break;
                            case 'CONTROL_MODE':
                                switch (value) {
                                    case '0':
                                        // AUTO_MODE
                                        $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/time_automatic.png" />');
                                        break;
                                    case '1':
                                        // MANU_MODE
                                        $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/time_manual_mode.png" />');
                                        break;
                                    case '2':
                                        // PARTY_MODE
                                        $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/scene_party.png" />');
                                        break;
                                    default:
                                        // BOOST_MODE
                                        $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/text_max.png" />');
                                }
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'SET_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'VALVE_STATE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-CC-SCD':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                switch (value) {
                                    case '0':
                                        $('[data-id="' + ise_id + '"]').html('Normal');
                                        break;
                                    case '1':
                                        $('[data-id="' + ise_id + '"]').html('Leicht erh&ouml;ht');
                                        break;
                                    case '2':
                                        $('[data-id="' + ise_id + '"]').html('Stark erh&ouml;ht');
                                        break;
                                    default:
                                        $('[data-id="' + ise_id + '"]').html(value);
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-CC-TC':
                        switch (datapoint) {
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'SETPOINT':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-CC-VD':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'VALVE_STATE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-CC-VG-1':
                        switch (datapoint) {
                            case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'CONTROL_MODE':
                                switch (value) {
                                    case '0':
                                        // AUTO_MODE
                                        $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/time_automatic.png" />');
                                        break;
                                    case '1':
                                        // MANU_MODE
                                        $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/time_manual_mode.png" />');
                                        break;
                                    case '2':
                                        // PARTY_MODE
                                        $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/scene_party.png" />');
                                        break;
                                    default:
                                        // BOOST_MODE
                                        $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/text_max.png" />');
                                }
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'SET_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'STATE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_open.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Dis-TD-T':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Dis-WM55':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-ES-PMSw1-DR':
                        switch (datapoint) {
                            case 'CONTROL_MODE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'CURRENT':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' mA');
                                break;
                            case 'ENERGY_COUNTER':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Wh');
                                break;
                            case 'FREQUENCY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Hz');
                                break;
                            case 'STATE':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'POWER':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' W');
                                break;
                            case 'VOLTAGE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' V');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-ES-PMSw1-Pl-DN-R1':
                        switch (datapoint) {
                            case 'CONTROL_MODE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'CURRENT':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' mA');
                                break;
                            case 'ENERGY_COUNTER':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Wh');
                                break;
                            case 'FREQUENCY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Hz');
                                break;
                            case 'STATE':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'POWER':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' W');
                                break;
                            case 'VOLTAGE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' V');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-ES-PMSw1-Pl-DN-R5':
                        switch (datapoint) {
                            case 'CONTROL_MODE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'CURRENT':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' mA');
                                break;
                            case 'ENERGY_COUNTER':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Wh');
                                break;
                            case 'FREQUENCY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Hz');
                                break;
                            case 'STATE':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'POWER':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' W');
                                break;
                            case 'VOLTAGE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' V');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-ES-PMSw1-Pl':
                        switch (datapoint) {
                            case 'CONTROL_MODE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'CURRENT':
                                $('[data-id="' + ise_id + '"]').html('Strom: ' + (Math.round(value * 10) / 10) + ' mA');
                                break;
                            case 'ENERGY_COUNTER':
                                $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10) + ' Wh');
                                break;
                            case 'FREQUENCY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Hz');
                                break;
                            case 'STATE':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'POWER':
                                $('[data-id="' + ise_id + '"]').html('Leistung: ' + (Math.round(value * 10) / 10) + ' W');
                                break;
                            case 'VOLTAGE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' V');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HMIP-PSM':
                        switch (datapoint) {
                            case 'CONTROL_MODE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'CURRENT':
                                $('[data-id="' + ise_id + '"]').html('Strom: ' + (Math.round(value * 10) / 10) + ' mA');
                                break;
                            case 'ENERGY_COUNTER':
                                $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10) + ' Wh');
                                break;
                            case 'FREQUENCY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Hz');
                                break;
                            case 'STATE':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'POWER':
                                $('[data-id="' + ise_id + '"]').html('Leistung: ' + (Math.round(value * 10) / 10) + ' W');
                                break;
                            case 'VOLTAGE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' V');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-ES-TX-WM':
                        switch (datapoint) {
                            case 'ENERGY_COUNTER':
                                value = Math.round(value * 10) / 10;

                                if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html(value + 'Wh');
                                }
                                break;
                            case 'GAS_ENERGY_COUNTER':
                                value = Math.round(value * 10) / 10;

                                if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' m³');
                                }
                                break;
                            case 'GAS_POWER':
                                value = Math.round(value * 10) / 10;

                                if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' m³');
                                }
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'POWER':
                                value = Math.round(value * 10) / 10;

                                if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' W');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Bl1-FM':
                        switch (datapoint) {
                            case 'LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_2w.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_10.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_20.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_30.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_40.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_60.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_70.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_80.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_90.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_100.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value + ' %');
                        }
                        break;
                    case 'HM-LC-Bl1-SM':
                        switch (datapoint) {
                            case 'LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_2w.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_10.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_20.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_30.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_40.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_60.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_70.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_80.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_90.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_100.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value + ' %');
                        }
                        break;
                    case 'HM-LC-Bl1PBU-FM':
                        switch (datapoint) {
                            case 'LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_2w.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_10.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_20.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_30.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_40.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_60.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_70.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_80.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_90.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_100.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-BROLL':
                        switch (datapoint) {
                            case 'LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_2w.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_10.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_20.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_30.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_40.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_60.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_70.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_80.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_90.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_100.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Dim1PWM-CV':
                        switch (datapoint) {
                            case 'LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_100.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_90.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_80.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_70.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_60.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_40.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_30.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_20.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_10.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_00.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Dim1T-CV':
                        switch (datapoint) {
                            case 'LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_100.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_90.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_80.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_70.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_60.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_40.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_30.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_20.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_10.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_00.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Dim1T-FM':
                        switch (datapoint) {
                            case 'LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_100.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_90.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_80.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_70.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_60.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_40.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_30.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_20.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_10.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_00.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Dim1T-Pl':
                        switch (datapoint) {
                            case 'LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_100.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_90.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_80.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_70.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_60.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_40.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_30.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_20.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_10.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_00.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Dim1TPBU-FM':
                        switch (datapoint) {
                            case 'LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_100.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_90.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_80.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_70.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_60.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_40.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_30.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_20.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_10.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_00.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-BDT':
                        switch (datapoint) {
                            case 'LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_100.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_90.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_80.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_70.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_60.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_40.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_30.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_20.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_10.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_00.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-RGBW-WM':
                        switch (datapoint) {
                            case 'COLOR':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_100.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_90.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_80.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_70.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_60.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_40.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_30.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_20.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_on_10.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/light_light_dim_00.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw1-Ba-PCB':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw1-DR':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw1-FM':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw1-PB-FM':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-BSM':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'CURRENT':
                                $('[data-id="' + ise_id + '"]').html('Strom: ' + (Math.round(value * 10) / 10) + ' mA');
                                break;
                            case 'ENERGY_COUNTER':
                                $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10) + ' Wh');
                                break;
                            case 'FREQUENCY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Hz');
                                break;
                            case 'POWER':
                                $('[data-id="' + ise_id + '"]').html('Leistung: ' + (Math.round(value * 10) / 10) + ' W');
                                break;
                            case 'VOLTAGE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' V');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIPW-DRS8':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-BSL':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-FSM':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'CURRENT':
                                $('[data-id="' + ise_id + '"]').html('Strom: ' + (Math.round(value * 10) / 10) + ' mA');
                                break;
                            case 'ENERGY_COUNTER':
                                $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10) + ' Wh');
                                break;
                            case 'FREQUENCY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Hz');
                                break;
                            case 'POWER':
                                $('[data-id="' + ise_id + '"]').html('Leistung: ' + (Math.round(value * 10) / 10) + ' W');
                                break;
                            case 'VOLTAGE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' V');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-FSM16':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'CURRENT':
                                $('[data-id="' + ise_id + '"]').html('Strom: ' + (Math.round(value * 10) / 10) + ' mA');
                                break;
                            case 'ENERGY_COUNTER':
                                $('[data-id="' + ise_id + '"]').html('Gesamt: ' + (Math.round(value * 10) / 10) + ' Wh');
                                break;
                            case 'FREQUENCY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Hz');
                                break;
                            case 'POWER':
                                $('[data-id="' + ise_id + '"]').html('Leistung: ' + (Math.round(value * 10) / 10) + ' W');
                                break;
                            case 'VOLTAGE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' V');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw1-Pl-2':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw1-Pl-CT-R1':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw1-Pl-DN-R1':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw1-Pl-DN-R5':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw1-Pl':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw1-SM':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw1PBU-FM':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw2-FM':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw4-Ba-PCB':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw4-DR':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw4-PCB':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw4-SM':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-LC-Sw4-WM':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-MOD-EM-8':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-MOD-Re-8':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-OU-CFM-Pl':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-OU-CM-PCB':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-OU-LED16':
                        switch (datapoint) {
                            case 'LED_STATUS':
                                switch (value) {
                                    case '0':
                                        $('[data-id="' + ise_id + '"]').html('Aus');
                                        break;
                                    case '1':
                                        $('[data-id="' + ise_id + '"]').html('Rot');
                                        break;
                                    case '2':
                                        $('[data-id="' + ise_id + '"]').html('Gr&uuml;n');
                                        break;
                                    default:
                                        $('[data-id="' + ise_id + '"]').html('Orange');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-PB-2-FM':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-PB-2-WM':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-PB-2-WM55-2':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-PB-2-WM55':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-PB-4-WM':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-PB-4Dis-WM-2':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-PB-4Dis-WM':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-PB-6-WM55':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-PBI-4-FM':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-RC-19-B':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-RC-19-SW':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-RC-19':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-RC-4-2':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-RC-4-B':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-RC-4':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-RC-8':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-RC-Dis-H-x-EU':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-RC-Key3-B':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-RC-Key4-2':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-RC-P1':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-RCV-50':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-SCI-3-FM':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Offen');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Zu');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-Key':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/secur_open_sm.png" />');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/secur_locked_sm.png" />');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'STATE_UNCERTAIN':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/control_x.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-Key-S':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/secur_open.png" />');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/secur_locked.png" />');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'STATE_UNCERTAIN':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/control_x.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-MDIR-2':
                        switch (datapoint) {
                            case 'BRIGHTNESS':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'MOTION':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/user_available.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/user_n_a.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-MDIR':
                        switch (datapoint) {
                            case 'BRIGHTNESS':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'MOTION':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/user_available.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/user_n_a.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-RHS':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                switch (value) {
                                    case '0':
                                        $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_gn.png" />');
                                        break;
                                    case '1':
                                        $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_tilt_rd.png" />');
                                        break;
                                    case '2':
                                        $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_open_rd.png" />');
                                        break;
                                    default:
                                        $('[data-id="' + ise_id + '"]').html(value);
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-SRH':
                        switch (datapoint) {
                            case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                switch (value) {
                                    case '0':
                                        $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_gn.png" />');
                                        break;
                                    case '1':
                                        $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_tilt_rd.png" />');
                                        break;
                                    case '2':
                                        $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_open_rd.png" />');
                                        break;
                                    default:
                                        $('[data-id="' + ise_id + '"]').html(value);
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-SC-2':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'false') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_open.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-SC':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'false') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_open.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-SCo':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'false') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_gn.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_open_rd.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-SWDO-I':
                        switch (datapoint) {
                            case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_gn.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_open_rd.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-SCI':
                        switch (datapoint) {
                            case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_gn.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_open_rd.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-SD-2-Team':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'false') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/control_clear.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/message_attention.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-SD-Team':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'false') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/control_clear.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/message_attention.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-SFA-SM':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-TiS':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                if (value === 'false') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_garage_door_100.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_garage.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-WDS':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                switch (value) {
                                    case '0':
                                        $('[data-id="' + ise_id + '"]').html('Trocken');
                                        break;
                                    case '1':
                                        $('[data-id="' + ise_id + '"]').html('Feucht');
                                        break;
                                    case '2':
                                        $('[data-id="' + ise_id + '"]').html('Nass');
                                        break;
                                    default:
                                        $('[data-id="' + ise_id + '"]').html(value);
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-WDS-2':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'STATE':
                                switch (value) {
                                    case '0':
                                        $('[data-id="' + ise_id + '"]').html('Trocken');
                                        break;
                                    case '1':
                                        $('[data-id="' + ise_id + '"]').html('Feucht');
                                        break;
                                    case '2':
                                        $('[data-id="' + ise_id + '"]').html('Nass');
                                        break;
                                    default:
                                        $('[data-id="' + ise_id + '"]').html(value);
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sec-Win':
                        switch (datapoint) {
                            case 'BATTERY_LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_100.png" />');
                                } else if (value >= 75) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_75.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_50.png" />');
                                } else if (value >= 25) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                } else if (value >= 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_0.png" />');
                                }
                                break
                            case 'LEVEL':
                                if (value === '-0.005000') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/secur_locked.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html((Math.round(value * 1000) / 10) + ' %');
                                }
                                break;
                            case 'STATE_UNCERTAIN':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/control_x.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sen-DB-PCB':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sen-EP':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-Sen-MDIR-O-2':
                        switch (datapoint) {
                            case 'BRIGHTNESS':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'MOTION':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/user_available.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/user_n_a.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sen-MDIR-O':
                        switch (datapoint) {
                            case 'BRIGHTNESS':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'MOTION':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/user_available.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/user_n_a.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sen-MDIR-SM':
                        switch (datapoint) {
                            case 'MOTION':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/user_available.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/user_n_a.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sen-MDIR-WM55':
                        switch (datapoint) {
                            case 'BRIGHTNESS':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'MOTION':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/user_available.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/user_n_a.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sen-RD-O':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/weather_sun.png" />');
                                } else if (value === '1') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/weather_rain.png" />');
                                } else if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-Sen-Wa-Od':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'FILLING_LEVEL':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-SwI-3-FM':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HM-TC-IT-WM-W-EU':
                        switch (datapoint) {
                            case 'ACTUAL_HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html('RF: ' + (Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('Ist: ' + (Math.round(value * 10) / 10) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;/');
                                break;
                            case 'BATTERY_STATE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' V');
                                break;
                            case 'CONTROL_MODE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/time_automatic.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id) + 3); //MANU_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/time_manual_mode.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id) - 6); //AUTO_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'SET_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('Soll: ' + (Math.round(value * 10) / 10) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;/');
                                break;
                            case 'WINDOW_OPEN_REPORTING':
                                if (value === 'false') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_open.png" />');
                                }
                                break;   
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-STHD':
                        switch (datapoint) {  
                            case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'SET_POINT_MODE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/time_automatic.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id) + 3); //MANU_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/time_manual_mode.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id) - 6); //AUTO_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'SET_POINT_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('Soll: ' + (Math.round(value * 10) / 10) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;/');
                                break;
                            case 'WINDOW_STATE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_open.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-WTH-2':
                        switch (datapoint) {  
                            case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('Ist: ' + (Math.round(value * 10) / 10) + ' &deg;&nbsp;&nbsp;&nbsp;&nbsp;/');
                                break;
                            case 'SET_POINT_MODE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/time_automatic.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id) + 3); //MANU_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/time_manual_mode.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id) - 6); //AUTO_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html('RF: ' + (Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'LOW_BAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'SET_POINT_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('Soll: ' + (Math.round(value * 10) / 10) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;/');
                                break;
                            case 'WINDOW_STATE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_open.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-BWTH':
                        switch (datapoint) {  
                            case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('Ist: ' + (Math.round(value * 10) / 10) + ' &deg;&nbsp;&nbsp;&nbsp;&nbsp;/');
                                break;
                            case 'SET_POINT_MODE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/time_automatic.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id) + 3); //MANU_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/time_manual_mode.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id) - 6); //AUTO_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html('RF: ' + (Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'SET_POINT_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('Soll: ' + (Math.round(value * 10) / 10) + ' &deg;C&nbsp;&nbsp;&nbsp;&nbsp;/');
                                break;
                            case 'WINDOW_STATE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_open.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HMIP-eTRV':
                        switch (datapoint) {  
                            case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('Ist: ' + (Math.round(value * 10) / 10) + ' &deg;&nbsp;&nbsp;&nbsp;&nbsp;/');
                                break;
                            case 'SET_POINT_MODE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/time_automatic.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id) + 3); //MANU_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/time_manual_mode.png" />');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', parseInt(ise_id) - 6); //AUTO_MODE
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'SET_POINT_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('Soll: ' + (Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'WINDOW_STATE':
                                if (value === '0') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_open.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;    
                    case 'HM-WDC7000':
                        switch (datapoint) {
                            case 'AIR_PRESSURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' hPa');
                                break;
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-WDS10-TH-O':
                        switch (datapoint) {
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-WDS100-C6-O':
                        switch (datapoint) {
                            case 'BRIGHTNESS':
                                $('[data-id="' + ise_id + '"]').html(value);
                                break;
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'RAIN_COUNTER':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' mm');
                                break;
                            case 'RAINING':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/weather_rain.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/weather_sun.png" />');
                                }
                                break;
                            case 'SUNSHINEDURATION':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' Min.');
                                break;
                            case 'TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'WIND_DIRECTION':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + '&deg;');
                                break;
                            case 'WIND_DIRECTION_RANGE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + '&deg;');
                                break;
                            case 'WIND_SPEED':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' km/h');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HmIP-SWO-B':
                        switch (datapoint) {
                            case 'ILLUMINATION':
                                $('[data-id="' + ise_id + '"]').html('Helligkeit: ' + (Math.round(value * 10) / 10) + ' Lux');
                                break;
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html('Luftfeuchtigkeit: ' + (Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'SUNSHINEDURATION':
                                $('[data-id="' + ise_id + '"]').html('Sonnenscheindauer: ' + (Math.round(value * 10) / 10) + ' Min.');
                                break;
                            case 'ACTUAL_TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html('Temperatur: ' + (Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            case 'WIND_SPEED':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' km/h');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-WDS30-OT2-SM':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-WDS30-OT2-SM-2':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-WDS30-T-O':
                        switch (datapoint) {
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-WDS40-TH-I-2':
                        switch (datapoint) {
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HM-WDS40-TH-I':
                        switch (datapoint) {
                            case 'HUMIDITY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' %');
                                break;
                            case 'LOWBAT':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/measure_battery_25.png" />');
                                }
                                break;
                            case 'TEMPERATURE':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' &deg;C');
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HMW-IO-12-FM':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HMW-IO-12-Sw14-DR':
                        switch (datapoint) {
                            case 'FREQUENCY':
                                $('[data-id="' + ise_id + '"]').html((Math.round(value * 10) / 10) + ' mHz');
                                break;
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            case 'VALUE':
                                $('[data-id="' + ise_id + '"]').html(Math.round(value * 10) / 10);
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HMW-IO-12-Sw7-DR':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HMW-IO-4-FM':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HMW-LC-Bl1-DR':
                        switch (datapoint) {
                            case 'LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_2w.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_10.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_20.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_30.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_40.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_60.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_70.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_80.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_90.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_100.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HMW-LC-Dim1L-DR':
                        switch (datapoint) {
                            case 'LEVEL':
                                value = (Math.round(value * 1000) / 10);

                                if (value === 100) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_2w.png" />');
                                } else if (value >= 90) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_10.png" />');
                                } else if (value >= 80) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_20.png" />');
                                } else if (value >= 70) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_30.png" />');
                                } else if (value >= 60) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_40.png" />');
                                } else if (value >= 50) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_50.png" />');
                                } else if (value >= 40) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_60.png" />');
                                } else if (value >= 30) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_70.png" />');
                                } else if (value >= 20) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_80.png" />');
                                } else if (value > 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_90.png" />');
                                } else if (value === 0) {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_shutter_100.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value + '%');
                        }
                        break;
                    case 'HMW-LC-Sw2-DR':
                        switch (datapoint) {
                            case 'STATE':
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html('Ein');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('Aus');
                                    $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                    $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'HMW-RCV-50':
                        $('[data-id="' + ise_id + '"]').html(value);
                        break;
                    case 'HMW-Sen-SC-12-DR':
                        switch (datapoint) {
                            case 'SENSOR':
                                if (value === 'false') {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w.png" />');
                                } else {
                                    $('[data-id="' + ise_id + '"]').html('<img src="../assets/icons/fts_window_1w_open.png" />');
                                }
                                break;
                            default:
                                $('[data-id="' + ise_id + '"]').html(value);
                        }
                        break;
                    case 'SysVar':
                        switch (datapoint) {
                            case '2':
                                // Yes/No
                                var invert_color = $('[data-id="' + ise_id + '"]').attr('data-invert-color');
                                
                                if (value === 'true') {
                                    $('[data-id="' + ise_id + '"]').html(valueList.split(';')[parseInt(1)]);                                    
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '0');
                                    
                                    if (invert_color === 'false') {
                                        $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                        $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    } else {
                                        $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                        $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    }
                                } else {
                                    $('[data-id="' + ise_id + '"]').html(valueList.split(';')[parseInt(0)]);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-id', ise_id);
                                    $('[data-id="' + ise_id + '"]').attr('data-set-value', '1');
                                    
                                    if (invert_color === 'false') {
                                        $('[data-id="' + ise_id + '"]').addClass('btn-false');
                                        $('[data-id="' + ise_id + '"]').removeClass('btn-true');
                                    } else {
                                        $('[data-id="' + ise_id + '"]').addClass('btn-true');
                                        $('[data-id="' + ise_id + '"]').removeClass('btn-false');
                                    }
                                }
                                break;
                            case '4':
                                // Number
                                if (unit !== '') {
                                    $('[data-id="' + ise_id + '"]').html(parseFloat(value) + ' ' + unit);
                                } else {
                                    $('[data-id="' + ise_id + '"]').html(parseFloat(value));
                                }
                                break;
                            case '16':
                                // Value List
                                if (valueList !== '') {
                                    $('[data-id="' + ise_id + '"]').html(valueList.split(';')[parseInt(value)]);
                                }
                                break;
                            case '20':
                                // Text
                                if (unit !== '') {
                                    $('[data-id="' + ise_id + '"]').html(value + ' ' + unit);
                                } else {
                                    $('[data-id="' + ise_id + '"]').html(value);
                                }
                                break;
                            default:
                                if (unit !== '') {
                                    $('[data-id="' + ise_id + '"]').html(value + ' ' + unit);
                                } else {
                                    $('[data-id="' + ise_id + '"]').html(value);
                                }
                        }
                        break;
                    default:
                        $('[data-id="' + ise_id + '"]').html(value);
                }
            });

            //Run update periodically
            var timer = window.setTimeout(updateDatapoints, timerMiliseconds);
        },
        //other code
        error: function () {
            $('#flash-error').html('Der Update Prozess wurde unterbrochen.').show();

            //Run update periodically
            var timer = window.setTimeout(updateDatapoints, timerMiliseconds);
        }
    });
};

var setDatapoint = function (id, value) {
    $.ajax({
        type: 'GET',
        url: 'http://' + homematicIp + '/config/xmlapi/statechange.cgi?ise_id=' + id + '&new_value=' + escape(value),
        dataType: 'xml',
        success: function (xml) {
            $('#flash-error').hide();

            updateDatapoints();
        },
        //other code
        error: function () {
            $('#flash-error').html('Es gab einen Fehler beim Verarbeiten des Reqeusts.').show();
        }
    });
};

var runProgram = function (id) {
    $.ajax({
        type: 'GET',
        url: 'http://' + homematicIp + '/config/xmlapi/runprogram.cgi?program_id=' + id,
        dataType: 'xml',
        success: function (xml) {
            $('#flash-error').hide();

            updateDatapoints();
        },
        //other code
        error: function () {
            $('#flash-error').html('Es gab einen Fehler beim Verarbeiten des Reqeusts.').show();
        }
    });
};