<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->page_data['page']->title = 'Users Management';
		$this->page_data['page']->menu = 'users';
	}

	public function index()
	{
		$this->page_data['page']->user = $this->users_model->get_all(true)->result();
		$this->template->rander("users/index", $this->page_data);
	}

	public function form($id = 0)
	{
		$this->form_validation->set_rules(
            'username', 'Username', 'trim|required'
        );
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->page_data['page']->title = 'Users Form';
			$this->page_data['page']->menu = 'users';
			$this->page_data['page']->view_data = $this->users_model->get_one($id);
			$this->template->rander("users/form", $this->page_data);
            return;
        }

		$data = [
			"fullname" => post('fullname'),
			"email" => post('email'),
			"username" => post('username'),
			"password" => post('password'),
			"group" => post('group'),
			"created_at" => date("Y-m-d H:i:s")
		];
		$save = $this->users_model->save($data, $id);
		if($save){
            $this->session->set_flashdata("success_message", "User berhasil dibuat");
		}else{
			$this->session->set_flashdata("error_message", "User gagal dibuat");
		}

		redirect(url('users'));
	}

	public function logout()
	{
		$this->session->set_userdata("users", []);
		redirect("auth", "refresh");
	}

}