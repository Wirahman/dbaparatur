<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('getCurrentYYYY'))
{
    function getCurrentYYYY() {
        date_default_timezone_set('Asia/Jakarta');
        $currentYYYY = date("Y");
        return $currentYYYY;
    }
}