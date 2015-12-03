<?php

class Model_passing extends CI_model
{
	function __construct()
	{
		parent::__construct();
		
	}	
		var $table = 'test';
		
	/*
	 * Menambahkan sebuah data ke tabel 
	 */
	function add($pengadaan){
		$this->db->insert($this->table, $pengadaan);
	}
}	