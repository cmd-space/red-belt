<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcomes extends CI_Controller {
  public function index()
  {
    $this->load->view('welcomes/index');
  }

  public function validate() {
  	$this->load->library('form_validation');
  	if($this->input->post('register') === 'yes') {
  		$this->form_validation->set_rules('name', 'Name', 'trim|required');
	  	$this->form_validation->set_rules('alias', 'Alias', 'trim|required');
	  	$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]|valid_email');
	  	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
	  	$this->form_validation->set_rules('confirm_password', 'Confirm PW', 'trim|required|matches[password]');
	  	if($this->form_validation->run() === FALSE) {
	  		$this->view_data['register_errors'][] = validation_errors();
	  		$this->session->set_flashdata('register_errors', $this->view_data['register_errors']);
	  		// var_dump($this->view_data['errors']);
	  		redirect('/');
	  	} else {
	  		$this->session->set_flashdata('user', $this->input->post());
	  		redirect('/welcomes/register');
	  	}
  	} else {
  		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
	  	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
	  	if($this->form_validation->run() === FALSE) {
	  		$this->view_data['login_errors'][] = validation_errors();
	  		$this->session->set_flashdata('login_errors', $this->view_data['login_errors']);
	  		// var_dump($this->view_data['errors']);
	  		redirect('/');
	  	} else {
	  		$this->session->set_flashdata('user', $this->input->post());
	  		redirect('/welcomes/login');
	  	}
  	}
  }

  public function register() {
  	$this->output->enable_profiler(TRUE);
  	$this->load->model('Welcome');
  	$user = $this->session->flashdata('user');
  	$this->Welcome->create($user);
  	$this->session->set_userdata('user', $this->Welcome->user_by_email($user));
  	redirect('/welcomes/friends');
  }

  public function login() {
  	$this->output->enable_profiler(TRUE);
  	$this->load->model('Welcome');
  	$user = $this->session->flashdata('user');
  	if($this->Welcome->user_by_email($user)) {
  		$this->session->set_userdata('user', $this->Welcome->user_by_email($user));
  		redirect('/welcomes/friends');
  	} else {
  		$this->session->set_flashdata('login_errors', array('error' => 'Email and/or Password do not match our records'));
  		redirect('/');
  	}
  }

  public function friends() {
  	$this->output->enable_profiler(TRUE);
  	$this->load->model('Welcome');
  	$user = $this->session->userdata('user');
  	$this->Welcome->friends($user['id']);
  	$user['friends'] = $this->Welcome->friends($user['id']);
  	$this->Welcome->not_friends($user['id']);
  	$user['not_friends'] = $this->Welcome->not_friends($user['id']);
  	// foreach($user['friends'] as $friend) {
  	// 	if($friend['id'] === $user['id']) {
  			
  	// 	}
  	// }
  	// var_dump($user);
  	// die();
  	$this->load->view('friends', $user);
  }

  public function add_friend($id) {
  	$this->output->enable_profiler(TRUE);
  	$this->load->model('Welcome');
  	$this->Welcome->add_friend($id);
  	redirect('/welcomes/friends');
  }

  public function user($id) {
  	$this->output->enable_profiler(TRUE);
  	$this->load->model('Welcome');
  	$this->Welcome->get_by_id($id);
  	$user = $this->Welcome->get_by_id($id);
  	$this->load->view('user', $user);
  }

  public function remove_friend($id) {
  	$this->output->enable_profiler(TRUE);
  	$this->load->model('Welcome');
  	$this->Welcome->remove_friend($id);
  	redirect('/welcomes/friends');
  }

  public function destroy() {
  	$this->session->sess_destroy();
  	redirect('/');
  }
}

//end of main controller
