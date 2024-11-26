<?php 
    function baseUrl($path = ''){
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];
        $baseUrl = $protocol.$host.'/'.PROJECT_DIR;
        return $baseUrl. '/' . ltrim($path, '/');
    }

    function basePath($path = ''){
        $rootPath = dirname(__DIR__).DIRECTORY_SEPARATOR.'cms-pdo';
        return $rootPath.DIRECTORY_SEPARATOR.ltrim($path, DIRECTORY_SEPARATOR);
    }

    function uploadsPath($filename = ''){
        return basePath('uploads'.DIRECTORY_SEPARATOR.$filename);
    }

    function uploadsUrl($filename = ''){
        return basePath('uploads/'.ltrim($filename, '/'));
    }

    function assetsUrl($path = ''){
        return basePath('assets/'.ltrim($path, '/'));
    }

    function redirect($url){
        header('Location: '.baseUrl($url));
    }

    function isPostRequest(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            return true;
        }
    }

    function getPostData($field, $default = null){
        return isset($_POST[$field]) ? trim($_POST[$field]) : $default;
    }
?>