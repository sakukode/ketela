<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		//load model
		$this->load->model(array('list_model','card_model','user_model'));
	}

	/**
	 * display / load home page
	 * @return obj
	 */
	public function index()
	{
		$data['lists'] = $this->list_model->get_all();
		$data['cards'] = $this->card_model->get_all();
		$data['users'] = $this->user_model->get_all();
		$this->load->view('home', $data);
	}

	/**
	 * add new list & validation
	 */
	public function addList()
	{
		$this->form_validation->set_rules('list-title', 'Title', 'trim|required|min_length[5]|xss_clean');

		if($this->form_validation->run() == FALSE) {
			//if validation failed
			$data['lists'] = $this->list_model->get_all();
			$data['cards'] = $this->card_model->get_all();
			$data['list_error'] = validation_errors();
			$this->load->view('home', $data);
		} else {
			$title = $this->input->post('list-title', TRUE);

			$data = array(
				'title' => $title,
			);

			$this->list_model->add($data);
			$this->session->set_flashdata('success_list', 'Success add new list');
			redirect('home');
		}
	}

	public function addCard() {

		$this->form_validation->set_rules('card-title', 'Title Card', 'trim|required|min_length[5]|xss_clean');

		if($this->form_validation->run() == FALSE) {
			//if validation failed
			$data['lists'] = $this->list_model->get_all();
			$data['cards'] = $this->card_model->get_all();
			$data['card_error'] = validation_errors();
			$this->load->view('home', $data);
		} else {
			$title = $this->input->post('card-title', TRUE);
			$listId = $this->input->post('list-id', TRUE);
			$data = array(
				'title' => $title,
				'listId' => $listId,
				'date' =>  date("Y-m-d")
			);

			$this->card_model->add($data);
			$this->session->set_flashdata('success_card', 'Success add new card');
			redirect('home');
		}
	}

	public function addMember() {
		$this->form_validation->set_rules('card-id', 'Card Id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('user', 'User', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE) {
			$data = array(
				'status' => FALSE,
				'error' => validation_errors(),
			);

			echo json_encode($data);
		} else {
			$data = array(
				'status' => TRUE
			);

			$member = array(
				'cardId' => $this->input->post('card-id', TRUE),
				'userId' => $this->input->post('user', TRUE)
			);

			$this->card_model->addMember($member);
			$this->session->set_flashdata('success_card', 'Success add member on card with id #' .$this->input->post('card-id'));

			echo json_encode($data);
		}
	}

	public function addAttachment() {
		$config['upload_path'] = './public/file';
		$config['allowed_types'] = 'pdf|txt|xlsx|docx|doc|zip|xls|ppt||gif|jpg|png';
		$config['max_size']	= '0';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file'))
		{
			$data = array(
				'status' => FALSE,
				'error' => $this->upload->display_errors(),
			);	

			echo json_encode($data);
		}
		else
		{
			$file = $this->upload->data();

			$attachment = array(
				'cardId' => $this->input->post('card-id'),
				'userId' => 1,
				'date' => date("Y-m-d"),
				'filename' => $file['file_name'],
			);

			$this->card_model->addAttachment($attachment);

			$data = array(
				'status' => TRUE
			);

			echo json_encode($data);
		}
	}

	public function viewCardDetail($cardId) {

		if($cardId == null) {
			$data = array(
				'status' => FALSE,
				'msg' => 'Id cannot null'
			);		

			echo json_encode($data);
		} else {

			$model = $this->card_model->get($cardId);

			if($model == null) {
				$data = array(
					'status' => FALSE,
					'msg' => 'card not found'
				);				
			} else {
				$data = array(
					'status' => TRUE,
					'model'  => $model,
					'members' => $this->card_model->getMember($cardId),
					'attachments' => $this->card_model->getAttachment($cardId)
				);
			}

			echo json_encode($data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */