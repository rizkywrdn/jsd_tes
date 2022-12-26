<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(is_logged()){
			redirect('/','refresh');
		}

		$this->page_data['page'] = (object) [
			'title' => 'Auth',
			'menu' => 'auth',
		];
	}

	public function index()
	{
		$this->template->rander("auth/login", $this->page_data, TRUE);
	}

    public function login()
	{
        $this->form_validation->set_rules(
            'username', 'Username', 'trim|required'
        );
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
            return;
        }

        $username = post('username');
        $password = post('password');
        
        $attempt = $this->users_model->get_one_where(['username' => $username, 'password' => $password]);
        if( !empty($attempt) ){
			$user = $attempt;
        	$this->session->set_userdata('users', $user);
        }else{
            $this->session->set_flashdata("error_message", "Username Atau Password Salah!");
            $this->index();
            return;

        }
        redirect(url('/'),'refresh');
	}

    public function register()
	{
		$this->template->rander("auth/register", $this->page_data, TRUE);
	}

}