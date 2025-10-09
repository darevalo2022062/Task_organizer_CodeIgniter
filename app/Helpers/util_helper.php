<?php

if (!function_exists("generaToken")) {

    function generaToken($longitud = 32)
    {
        return md5(uniqid(rand(), true));
    }

}