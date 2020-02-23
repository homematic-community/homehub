<?php

$app->get('/[{selectedCat}]', function ($request,  $response, $arguments) {
    global $homematicIp;
    global $timerPeriod;
    global $title;
    
    $selectedCat = $request->getAttribute('selectedCat', 'Home');
    
    $appBase = $request->getUri()->getBaseUrl();
    if(substr($appBase, -9) <> 'index.php') {
        $appBase = $request->getUri().'index.php';
    }

    $customCss = false;
    if(file_exists('assets/css/custom.css')) {
        $customCss = true;
    }
    
    $customJs = false;
    if(file_exists('assets/js/custom.js')) {
        $customJs = true;
    }

    // json_decode Config files
    $categories = array();
    $menu = array();    
    if(file_exists('app/Config/categories.json')) {
        $str = file_get_contents('app/Config/categories.json');
        $json = json_decode($str, true);
        
        $menu = $json['categories'];
        
        $categories[] = array(
            'name' => $selectedCat,
            'display_name' => $selectedCat
        );
        $key = array_search($selectedCat, array_column($json['categories'], 'name'));
        if(is_int($key) && isset($json['categories'][$key]['subcategories'])) {
            foreach($json['categories'][$key]['subcategories'] as $subCategory) {
                // Display Name?
                if(!is_array($subCategory)) {
                    $categories[] = array(
                        'name' => $subCategory,
                        'display_name' => $subCategory
                    );
                } else {
                    if(!isset($subCategory['display_name'])) {
                        $categories[] = array(
                            'name' => $subCategory['name'],
                            'display_name' => $subCategory['name']
                        );
                    } else {
                        $categories[] = array(
                            'name' => $subCategory['name'],
                            'display_name' => $subCategory['display_name']
                        );
                    }
                }
            }
        }
    }
    
    $custom = array();
    if(file_exists('app/Config/custom.json')) {
        $str = file_get_contents('app/Config/custom.json');
        $json = json_decode($str, true);
        
        if(isset($json['custom'])) {
            $custom = $json['custom'];
        }
    }

    $mapping = array();
    if(file_exists('app/Config/mapping.json')) {
        $str = file_get_contents('app/Config/mapping.json');
        $json = json_decode($str, true);
        
        if(isset($json['mapping'])) {
            $mapping = $json['mapping'];
        }
    }
    
    $export = array();
    if(file_exists('app/Config/export.json')) {
        $str = file_get_contents('app/Config/export.json');
        $export = json_decode($str, true);
    }
    
    // Komponenten einlesen
    $components = array();
    if(count($export) > 0) {
        foreach($categories as $category) {
            $mappingComponents = array();
            $customComponents = array();
            
            // Mapping
            if(isset($mapping[$category['name']])) {
                foreach($mapping[$category['name']] as $mappingEntry) {
                    foreach(array('channels', 'systemvariables', 'programs') AS $part) {
                        $dummies = array_filter($export[$part], function($dummy) use ($mappingEntry) {
                            if($dummy['component'] == $mappingEntry['name']) {
                                if(isset($dummy['visible']) && $dummy['visible'] === 'true') {
                                    return true;
                                }
                            }
                        });
                        foreach($dummies as $dummy) {
                            if(isset($dummy['datapoints'])) {
                                foreach($dummy['datapoints'] as $datapoint) {
                                    $dummy[$datapoint['type']] = $datapoint['ise_id'];
                                }
                                unset($dummy['datapoints']);
                            }
                            
                            $mappingComponents[] = array_merge($mappingEntry, $dummy);
                        }
                    }
                }

                // Alphabetisch sortieren
                if(isset($mappingComponents) && count($mappingComponents) > 0) {
                    usort($mappingComponents, function($a, $b) {
                        return strcmp($a['name'], $b['name']);
                    });
                }
            }

            // Custom
            if(isset($custom[$category['name']])) {
                foreach($custom[$category['name']] as $customEntry) {
                    // Custom Komponente?
                    if(isset($customEntry['component'])) {
                        $customComponents[] = $customEntry;
                    }
                    
                    foreach(array('channels', 'systemvariables', 'programs') AS $part) {
                        $key = array_search($customEntry['name'], array_column($export[$part], 'name'));
                        if(is_int($key)) {
                            if($export[$part][$key]['visible'] == true) {
                                $dummy = $export[$part][$key];
                                
                                if(isset($dummy['datapoints'])) {
                                    foreach($dummy['datapoints'] as $datapoint) {
                                        $dummy[$datapoint['type']] = $datapoint['ise_id'];
                                    }
                                    unset($dummy['datapoints']);
                                }

                                $key2 = array_search($dummy['name'], array_column($mappingComponents, 'name'));
                                if(is_int($key2)) {
                                    unset($mappingComponents[$key2]);
                                    $mappingComponents = array_values($mappingComponents);
                                }

                                if(isset($customEntry['display_name']) && $customEntry['display_name'] <> '') {
                                    $dummy['name'] = $customEntry['display_name'];
                                }
                                $customComponents[] = array_merge($customEntry, $dummy);
                            }
                        }
                    }
                }
            }
            
            $components[$category['display_name']] = array_merge($customComponents, $mappingComponents);
        }
    }
    
    $this->view->addAttribute('homematicIp', $homematicIp);
    $this->view->addAttribute('timerPeriod', $timerPeriod);
    $this->view->addAttribute('title', $title);
    $this->view->addAttribute('appBase', $appBase);
    $this->view->addAttribute('customCss', $customCss);
    $this->view->addAttribute('customJs', $customJs);
    $this->view->addAttribute('selectedCat', $selectedCat);
    $this->view->addAttribute('menu', $menu);
    $this->view->addAttribute('components', $components);
    
    if(file_exists('app/Views/custom/'.strtolower($selectedCat).'.html')) {
        $response = $this->view->render($response, 'custom/'.strtolower($selectedCat).'.html', []);
    } else {
        $response = $this->view->render($response, 'index.html', []);
    }
    
    return $response;
});
