<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Model {
  public function create($user) {
  	$create_user = array($user['name'], $user['alias'], $user['email'], $user['password'], $user['birth']);
    return $this->db->query("INSERT INTO users (name, alias, email, password, date_of_birth, created_at, updated_at)
    						 VALUES (?,?,?,?,?,NOW(),NOW())", $create_user);
  }

  public function user_by_email($user) {
  	$query = "SELECT * FROM users WHERE email = ? AND password = ?";
  	$values = $user;
  	$this->db->query($query, $values);
  }

  public function friends($user_id) {
  	
  }
}
