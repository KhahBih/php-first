<?php 
    spl_autoload_register(function($class_name){
        $directory = __DIR__ . DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR;
        $file = $directory.$class_name.".php";
        if(file_exists($file)){
            require_once $file;
        }else{
            die("Class file for {$class_name} not found in {$file}");
        }
    });
?>