<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	/**
	 * load view login page
	 * @return obj
	 */
	public function index()
	{
		$this->load->view('login');
	}

	/**
	 * validation form
	 * @return obj
	 */
	public function validate() {

		//Form Validation
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_login_check');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		//if validation success
		if($this->form_validation->run() == TRUE) {
			$username = $this->input->post('username', TRUE);
			$password = $this->input->post('password', TRUE);
			$query = $this->db->get_where('user', array('username'=> $username,'password'=> md5($password)))->row();
			
			$array = array(
				'logged_in' => TRUE,
				'userId' => $query->id,
				'username' => $query->username,
				'name' => $query->name
			);
			
			$this->session->set_userdata( $array );
			redirect('home');
		} else {			
			$this->load->view('login');
		}
	}


	public function login_check($password) {

		$username = $this->input->post('username');

		$query = $this->db->get_where('user', array('username'=> $username,'password'=> md5($password)))->result();

		if($query) {
			return TRUE;
		} else {
			$this->form_validation->set_message('login_check', "Login Failed, Please check your username and password");
			return FALSE;
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('login');
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */