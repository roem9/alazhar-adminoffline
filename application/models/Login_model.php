<?php
class Login_model extends CI_MODEL{
	function cekLogin($table,$where){		
		return $this->db->get_where($table,$where)->row_array();
	}
}