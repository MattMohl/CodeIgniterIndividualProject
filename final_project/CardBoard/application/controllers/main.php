<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public $user;
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$user = $this->session->all_userdata();
		if(!empty($user['_id'])) {
			redirect('app');
		}
		$this->load->view('landing');
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('main');
	}

	public function sign_in() {
		$this->load->library('form_validation');

		$form_rules = array(
			array(
				'field' => 'user',
				'label' => 'Username',
				'rules' => 'required'
			),
			array(
				'field' => 'pass',
				'label' => 'Password',
				'rules' => 'required'
			)
		);
		$this->form_validation->set_rules($form_rules);

		if($this->form_validation->run() == FALSE) {
			redirect('main');
		}else {
			$this->load->helper('url');
			$postdata = array(
				'usern' 	=> $this->input->post('user'),
				'password' 	=> $this->input->post('pass')
			);

			$this->load->model('User');
			$user = new User();
			$res = $user->checkLogin($postdata);
			if(!empty($res[0])) {
				$this->session->set_userdata($res[0]);
				redirect('app');
			}else {
				redirect('main');
			}
		}
	}
	
	public function register() {
		$this->load->library('form_validation');
		$form_rules = array(
			array(
				'field'		=> 'usern',
				'label'		=> 'Usern',
				'rules'		=> 'required'
			),
			array(
				'field'		=> 'email',
				'label'		=> 'Email',
				'rules'		=> 'required|email|valid_email'
			),
			array(
				'field'		=> 'password',
				'label'		=> 'Password',
				'rules'		=> 'required|matches[pass2]'
			),
			array(
				'field'		=> 'pass2',
				'label'		=> 'Pass2',
				'rules'		=> 'required'
			)
		);
		$this->form_validation->set_rules($form_rules);

		if($this->form_validation->run() == FALSE) {
			redirect('main');
		}else {
			$this->load->helper('url');
			$postdata = array(
				'usern'		=> $this->input->post('usern'),
				'email'		=> $this->input->post('email'),
				'password'	=> $this->input->post('password')
			);

			$this->load->model('User');
			$newUser = new User();
			$user['_id'] = $newUser->register($postdata);
			$user['usern'] = $postdata['usern'];
			if($res != "That User is already created") {
				$this->session->set_userdata($user);
				redirect('app');
			}else {
				$this->load->view('landing');
			}
		}
	}
}