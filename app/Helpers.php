<?php

function setFlashMessage($type, $title, $message){
    $request = request();
    session()->flash('alert.type', $type);
    session()->flash('alert.title', $title);
    session()->flash('alert.message', $message);
}

function removeDblQuotes($string){
    return trim($string, '"');
}

function globalSetting($key, $default_value = ''){
   //If DB setting is not define use file for custom settings
    $value = settings($key, $default_value);
    if(!$value){
        return config('customSettings.'.$key);
    }
    return $value;
}

function pr($data){
    echo "<pre>"; print_r($data); echo "</pre>";
}

function pre($data){
    echo "<pre>"; print_r($data); echo "</pre>";exit;
}