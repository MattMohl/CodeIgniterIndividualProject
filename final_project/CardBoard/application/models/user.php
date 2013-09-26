<?php

class User extends CI_Model {
	public $user_id;
	public $user_name;
	public $user_email;
	public $user_pass;

	public function checkLogin($data) {
		$mdb=new Mongo_db();
		$result = $mdb->where($data)->get('users');
		if(!empty($result[0])) {
			return $result;
		}else {
			return FALSE;
		}
	}

	public function register($data) {
		$mdb=new Mongo_db();
		$result = $mdb->where(array('usern'=>$data['usern']))->get('users');
		if(!empty($result[0])) {
			return "That User is already created";
		}else {
			$res = $mdb->insert('users', $data);
			// var_dump($res);
			return $res;
		}
	}
}