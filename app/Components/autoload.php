<?php

// Load all custom files
foreach (glob(__DIR__.'/custom/*.php') as $file) {
    require_once($file);
}

// Load standard files based on export.txt
$config_file = realpath(__DIR__.'/../Config/export.json');

if(file_exists($config_file)) {
    $str = file_get_contents($config_file);
    $export = json_decode($str, true);
    
    $components = array_unique(array_column($export['channels'], 'component'));
    foreach($components as $component) {
        $func = str_replace('-', '_', $component);
        
        if(!function_exists($func)) {
            $component_file = __DIR__.'/'.$component.'.php';
            if(file_exists($component_file)) {
               require_once($component_file);
            }
        }
    }
    
    if(!function_exists('Program')) {
        require_once(__DIR__.'/Program.php');
    }
    
    if(!function_exists('SysVar')) {
        require_once(__DIR__.'/SysVar.php');
    }
}
 