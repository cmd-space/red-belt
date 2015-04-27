<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcomes extends CI_Controller {
  public function index()
  {
    $this->load->view('welcomes/index');
  }

  public function validate() {
  	$this->load->library('form_validation');
  	if($this->input->post('register') === 'yes') {
  		$this->form_validation->set_rules('name', 'Name', 'trim|required|alpha');
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

  }
}

//end of main controller
