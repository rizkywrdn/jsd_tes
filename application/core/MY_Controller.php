<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $page_data;

	/**
	  * Extends by most of controllers not all controllers
	  */

	public function __construct()
	{

		parent::__construct();

		if( !empty($this->db->username) && !empty($this->db->hostname) && !empty($this->db->database) ){ }else{
			$this->users_model->logout();
			die('Database is not configured');
		}
		
		date_default_timezone_set( "Asia/Jakarta" );

		if(!is_logged()){
			redirect(url('auth'),'refresh');
		}

		$this->page_data['page'] = (object) [
			'title' => 'Dashboard',
			'menu' => 'dashboard',
			'submenu' => '',
		];
		$this->page_data['users'] = is_logged();
	}

}