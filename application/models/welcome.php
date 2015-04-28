<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Model {
  public function create($user) {
  	$create_user = array($user['name'], $user['alias'], $user['email'], $user['password'], $user['birth']);
    return $this->db->query("INSERT INTO users (name, alias, email, password, date_of_birth, created_at, updated_at)
    						 VALUES (?,?,?,?,?,NOW(),NOW())", $create_user);
  }

  public function user_by_email($user) {
  	$query = "SELECT * FROM users WHERE email = ? AND password = ?";
  	$values = array($user['email'], $user['password']);
  	return $this->db->query($query, $values)->row_array();
  }

  public function friends($id) {
  	$id2 = array($id, $id);
  	return $this->db->query("SELECT user2.alias as friend_alias, user2.id as friend_id, users.alias, users.id FROM users	
  							 JOIN friends ON users.id = friends.user_id
  							 JOIN users AS user2 ON friends.friend_id = user2.id
  							 WHERE users.id = ?", $id2)->result_array();
  }

  public function get_by_id($id) {
  	return $this->db->query("SELECT name, alias, email FROM users WHERE id = ?", $id)->row_array();
  }

  public function not_friends($id) {
  	$id2 = array($id, $id, $id);
  	return $this->db->query("SELECT * FROM users WHERE users.id NOT IN (
  			  SELECT friend_id FROM friends WHERE user_id = ?
  			  ) AND users.id NOT IN (SELECT user_id FROM friends WHERE user_id = ?) AND users.id != ?", $id2)->result_array();
  }

  public function add_friend($id) {
  	$values = array($this->session->userdata('user')['id'], $id);
  	// var_dump($values);
  	// die();
  	return $this->db->query("INSERT INTO friends (user_id, friend_id) 
  							 VALUES ((SELECT id FROM users WHERE id = ?), ?)", $values);
  }

  public function remove_friend($id) {
  	$values = array($this->session->userdata('user')['id'], $id);
  	$query = "DELETE FROM friends WHERE user_id = ? AND friend_id = ?";
  	return $this->db->query($query, $values);
  }
}
