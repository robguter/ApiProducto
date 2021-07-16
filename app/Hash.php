<?php

class Hash {

    function __construct() {
        
    }
    public static function getHash($algo,$dato,$key) {
        $hash = hash_init($algo, HASH_HMAC, $key);
        hash_update($hash, $dato);
        return hash_final($hash);
    }
}