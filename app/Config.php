<?php
    $_Dir=$_SERVER['DOCUMENT_ROOT'];
    
    $s = $_SERVER;
    $ssl = ( ! empty($s['HTTPS']) && $s['HTTPS'] == 'on' ) ? true:false;
    $sp = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/'  )) . ( ( $ssl ) ? 's' : '' );
    $port = $s['SERVER_PORT'];
    $port = ( ( ! $ssl && $port == '80' ) || ( $ssl && $port=='443' ) ) ? '' : ':' . $port;
    $host = ( false && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    $protocol .= '://' . $host . $_SERVER["REQUEST_URI"];
    
    $mPartes = explode("/", $protocol);
    $protocol = $mPartes[0] . "//" . $mPartes[2] . "/";
    
    if(file_exists($_Dir.'/ApiProducto/index.php')) {
        $sPath = $_SERVER["SERVER_NAME"];
        $string = "localhost";
        $iPos = substr_count($sPath, $string);
        
        if ( $iPos > 0 ) {
            $protocol = $mPartes[0] . "//" . $mPartes[2] . "/" . $mPartes[3] . "/";
            define("DB_USER", "Robguter");
            define("DB_PASS", "414345");
            define("DB_NAME", "Productos");
        }else{
            $protocol = $mPartes[0] . "//" . $mPartes[2] . "/" . $mPartes[3] . "/";
            define("DB_USER", "Robguter");
            define("DB_PASS", "414345");
            define("DB_NAME", "Productos");
        }
    } else {
        define("DB_USER", "tosounco_rg");
        define("DB_PASS", "41434515");
        define("DB_NAME", "tosounco_Prod");
    }
    setlocale(LC_MONETARY, 'en_US');
    define("BASE_URL", "$protocol");
    //echo DS;
    
    define("PUBLIC_URL", 'pubs/');
    define("PUBLIC_URLC", BASE_URL . 'pubs/');
    define('CONTROL_PRED', 'index');
    define('DISENO_PRED', 'predeterminado');
    
    define('APP_NAME', 'Api PHP de Productos');
    define('APP_SLOGAN', 'El objetivo es su satisfacción');
    define('APP_COMPANY', 'Sisterag 2008');
    define('SESSION_TIME', 0);
    define('HASH_KEY', 'r083r76u7');
    
    define("DB_HOST", "localhost");
    define("DB_CHAR", "UTF8");