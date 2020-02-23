<?php

// HM-OU-LED16|Netzwerkstatus:0|CUxD|CUX2803002|VISIBLE=|OPERATE=|
// HM-OU-LED16|Netzwerkstatus:1|CUxD|CUX2803002|VISIBLE=true|OPERATE=true|INFO=2321|IP=2322|UNREACH_CTR=2324|STATE=2323|
// HM-OU-LED16|Netzwerkstatus:2|CUxD|CUX2803002|VISIBLE=true|OPERATE=true|INFO=2326|IP=2327|UNREACH_CTR=2329|STATE=2328|
// HM-OU-LED16|Netzwerkstatus:3|CUxD|CUX2803002|VISIBLE=true|OPERATE=true|INFO=2331|IP=2332|UNREACH_CTR=2334|STATE=2333|
// HM-OU-LED16|Netzwerkstatus:4|CUxD|CUX2803002|VISIBLE=true|OPERATE=true|INFO=2336|IP=2337|UNREACH_CTR=2339|STATE=2338|
// HM-OU-LED16|Netzwerkstatus:5|CUxD|CUX2803002|VISIBLE=|OPERATE=|INFO=2341|IP=2342|UNREACH_CTR=2344|STATE=2343|
// HM-OU-LED16|Netzwerkstatus:6|CUxD|CUX2803002|VISIBLE=|OPERATE=|INFO=2346|IP=2347|UNREACH_CTR=2349|STATE=2348|
// HM-OU-LED16|Netzwerkstatus:7|CUxD|CUX2803002|VISIBLE=|OPERATE=|INFO=2351|IP=2352|UNREACH_CTR=2354|STATE=2353|
// HM-OU-LED16|Netzwerkstatus:8|CUxD|CUX2803002|VISIBLE=|OPERATE=|INFO=2356|IP=2357|UNREACH_CTR=2359|STATE=2358|
// HM-OU-LED16|Netzwerkstatus:9|CUxD|CUX2803002|VISIBLE=|OPERATE=|INFO=2361|IP=2362|UNREACH_CTR=2364|STATE=2363|
// HM-OU-LED16|Netzwerkstatus:10|CUxD|CUX2803002|VISIBLE=|OPERATE=|INFO=2366|IP=2367|UNREACH_CTR=2369|STATE=2368|
// HM-OU-LED16|Netzwerkstatus:11|CUxD|CUX2803002|VISIBLE=|OPERATE=|INFO=2371|IP=2372|UNREACH_CTR=2374|STATE=2373|
// HM-OU-LED16|Netzwerkstatus:12|CUxD|CUX2803002|VISIBLE=|OPERATE=|INFO=2376|IP=2377|UNREACH_CTR=2379|STATE=2378|
// HM-OU-LED16|Netzwerkstatus:13|CUxD|CUX2803002|VISIBLE=|OPERATE=|INFO=2381|IP=2382|UNREACH_CTR=2384|STATE=2383|
// HM-OU-LED16|Netzwerkstatus:14|CUxD|CUX2803002|VISIBLE=|OPERATE=|INFO=2386|IP=2387|UNREACH_CTR=2389|STATE=2388|
// HM-OU-LED16|Netzwerkstatus:15|CUxD|CUX2803002|VISIBLE=|OPERATE=|INFO=2391|IP=2392|UNREACH_CTR=2394|STATE=2393|
// HM-OU-LED16|Netzwerkstatus:16|CUxD|CUX2803002|VISIBLE=|OPERATE=|INFO=2396|IP=2397|UNREACH_CTR=2399|STATE=2398|

// Validated by Braindead

function CUX2803($component) {
    if ($component['parent_device_interface'] == 'CUxD' && $component['visible'] == 'true' && isset($component['IP'])) {
        return '<div class="hh">'
            . '<div class="pull-left"><img src="../assets/icons/' . $component["icon"] . '" class="icon">' . $component['name'] . '</div>'
            . '<div class="pull-right">'
                . '<span class="info" data-id="' . $component['INFO'] . '" data-component="' . $component['component'] . '" data-datapoint="INFO"></span>'
                //. '<span class="info" data-id="' . $component['IP'] . '" data-component="' . $component['component'] . '" data-datapoint="IP"></span>'
                //. '<span class="info" data-id="' . $component['UNREACH_CTR'] . '" data-component="' . $component['component'] . '" data-datapoint="UNREACH_CTR"></span>'
                . '<span class="info" data-id="' . $component['STATE'] . '" data-component="' . $component['component'] . '" data-datapoint="STATE"></span>'
            . '</div>'
            . '<div class="clearfix"></div>'
        . '</div>';
    }
}
