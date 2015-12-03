<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('getCurrentYYYY'))
{
    function keterangan_nilai($nilai) {
		if($nilai == 0)
			return("-");
		if($nilai <= 50)
			return("Buruk");
		if($nilai <= 60)
			return("Sedang");
		if($nilai <= 75)
			return("Cukup");
		if($nilai <= 90.99)
			return("Baik");
		if($nilai >= 91)
			return("Sangat baik");
		return("-");
	}
	
	function getCurrentYYYY() {
        date_default_timezone_set('Asia/Jakarta');
        $currentYYYY = date("Y");
        return $currentYYYY;
    }
}