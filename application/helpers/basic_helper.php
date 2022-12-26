<?php 

/**
  * Function to create custom url
  * uses site_url() function
  *
  * @param string $url any slug
  *
  * @return string site_url
  * 
  */
if (!function_exists('url')) {

	function url($url='')
	{
		return base_url($url);
	}

}

/**
  * Function to get url of assets folder
  *
  * @param string $url any slug 
  *
  * @return string url
  * 
  */
if (!function_exists('assets_url')) {

	function assets_url($url='')
	{
		return base_url('assets/'.$url);
	}

}

/**
  * Function to get url of upload folder
  *
  * @param string $url any slug 
  *
  * @return string url
  * 
  */
if (!function_exists('urlUpload')) {

	function urlUpload($url='', $time = false)
	{
		return base_url('uploads/'.$url).($time ? '?'.time() : '');
	}

}

/**
  * Function for user profile url
  *
  * @param string $id - user id of the user
  *
  * @return string profile url
  * 
  */
if (!function_exists('userProfile')) {

	function userProfile($id = '')
	{
		if(isset($id)) {

			$url = asset('img/noimage.png?');
			return $url;

		}else{

			$CI =& get_instance();

			$url = urlUpload('users/'.$id.'.png?');

			if($id!='default')
				$url = urlUpload('users/'.$id.'.'.$CI->users_model->getRowById($id, 'img_type').'?'.time());

			return $url;
		}
	}

}




/**
  * Function to check and get 'post' request
  *
  * @param string $key - key to check in 'post' request
  *
  * @return string value - uses codeigniter Input library 
  * 
  */
if (!function_exists('post')) {

	function post($key)
	{
		$CI =& get_instance();
		return !empty($CI->input->post($key, true)) ? $CI->input->post($key, true) : false;
	}

}

/**
  * Function to check and get 'get' request
  *
  * @param string $key - key to check in 'get' request
  *
  * @return string value - uses codeigniter Input library 
  * 
  */
if (!function_exists('get')) {

	function get($key)
	{
		$CI =& get_instance();
		return !empty($CI->input->get($key, true)) ? $CI->input->get($key, true) : false;
	}


}

/**
  * Die/Stops the request if its not a 'post' requetst type
  *
  * @return boolean
  * 
  */
if (!function_exists('postAllowed')) {

	function postAllowed()
	{
		$CI =& get_instance();
		if(count($CI->input->post()) <= 0)
			die('Invalid Request');

		return true;

	}


}


/**
  * Function to dump the passed data
  * Die & Dumps the whole data passed
  *
  * uses - var_dump & die together
  *
  * @param all $key - All Accepted - string,int,boolean,etc
  *
  * @return boolean
  * 
  */
if (!function_exists('dd')) {

	function dd($key)
	{
		die(var_dump($key));
		return true;
	}


}


/**
  * Function to check if the user is loggedIn
  *
  * @return boolean
  * 
  */
if (!function_exists('is_logged')) {

	function is_logged()
	{
		$CI =& get_instance();

		$login_token_match = false;

		$isLogged = !empty($CI->session->userdata('users')) ? (object) $CI->session->userdata('users') : false;

		return $isLogged;
	}


}


/**
  * Function that returns the data of loggedIn user
  *
  * @param string $key Any key/Column name that exists in users table
  *
  * @return boolean
  * 
  */
if (!function_exists('logged')) {

	function logged($key = false)
	{
		$CI =& get_instance();

		if(!is_logged())
			return false;

		$logged = !empty($CI->session->userdata('login')) ? $CI->users_model->getById($CI->session->userdata('logged')['id']) : false;

		if(!$logged){
			$logged = $CI->users_model->getById( json_decode(get_cookie('logged'))->id );
		}

		return (!$key)?$logged:$logged->{$key};

	}


}

/**
  * Returns Path of view
  *
  * @param string $path - path/file info
  *
  * @return boolean
  * 
  */
if (!function_exists('viewPath')) {

	function viewPath($path)
	{
		return VIEWPATH.'/'.$path.'.php';
	}


}

/**
  * Returns Path of view
  *
  * @param string $date any format
  *
  * @return string date format Y-m-d that most mysql db supports
  * 
  */
if (!function_exists('DateFomatDb')) {

	function DateFomatDb($date)
	{
		return date( 'Y-m-d', strtotime($date));
	}


}

/**
  * Currency formating
  *
  * @param int/float/string $amount
  *
  * @return string $amount formated amount with currency symbol
  * 
  */
if (!function_exists('currency')) {

	function currency($amount)
	{
		return '$ '. $amount;
	}


}

/**
  * Find & returns the vlaue if exists in db
  *
  * @param string $key key which is used to check in db - Refrence: settings table - key column
  *
  * @return string/boolean $value if exists value else false
  * 
  */
if (!function_exists('setting')) {

	function setting($key = '')
	{
		$CI =& get_instance();
		return !empty($value = $CI->settings_model->getValueByKey($key)) ? $value : false;
	}


}


/**
  * Generates teh html for breadcrumb - Supports AdminLte
  *
  * @param array $args Array of values
  * 
  */
if (!function_exists('breadcrumb')) {

	function breadcrumb($args = '')
	{
		$html = '<ol class="breadcrumb">';
		$i = 0;
		foreach ($args as $key => $value) {
			if(count($args) < $i)
				$html .= '<li><a href="'.url($key).'">'.$value.'</a></li>';
			else
				$html .= '<li class="active">'.$value.'</li>';
			$i++;
		}
		    
		    
		$html .= '</ol>';
		echo $html;
	}


}


/**
  * Finds and return the ipaddres of client user
  *
  * @param array $ipaddress IpAddress
  * 
  */
if (!function_exists('ip_address')) {

	function ip_address() {
	    $ipaddress = '';
	    if (isset($_SERVER['HTTP_CLIENT_IP']))
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if(isset($_SERVER['REMOTE_ADDR']))
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}

}

/**
  * Provides the shortcodes which are available in any email template
  *
  * @return array $data Array of shortcodes
  * 
  */
if (!function_exists('getEmailShortCodes')) {

	function getEmailShortCodes() {

		$data = [
			'site_url' => site_url(),
			'company_name' => setting('company_name'),
		];

		return $data;
	}

}




/**
  * Redirects with error if user doesnt have the permission to passed key/module
  *
  * @param string $code Code permissions
  * 
  * @return boolean true/false
  * 
  */
if (!function_exists('ifPermissions')) {

	function ifPermissions($code = '') {

		$CI =& get_instance();

		if ( hasPermissions($code) ) {
			return true;
		}

		;

		redirect('errors/permission_denied');
		die;

		return false;
	}

}

/**
  * Check and return boolean if user have the permission to passed key or not
  *
  * @param string $code Code permissions
  * 
  * @return boolean true/false
  * 
  */
if (!function_exists('hasPermissions')) {

	function hasPermissions($code = '') {

		$CI =& get_instance();

		if ( !empty( $CI->role_permissions_model->getByWhere([ 'role' => logged('role'), 'permission' => $code ]) ) ) {

			return true;
			
		}

		return false;

	}

}

/**
  * Redirects with error if user doesnt have the permission to passed key/module
  *
  * @param string $code Code permissions
  * 
  * @return boolean true/false
  * 
  */
if (!function_exists('notAllowedDemo')) {

	function notAllowedDemo($url = '') {

		$CI =& get_instance();

		$CI->session->set_flashdata('alert-type', 'danger');
		$CI->session->set_flashdata('alert', 'This action is disabled in <strong>Demo</strong> !');

		redirect($url);

		return false;
	}

}

/**
  * Hides Some Characters in Email. Basically Used in Forget Password System
  *
  * @param string $email Email 
  * 
  * @return string
  * 
  */
if (!function_exists('obfuscate_email')) {

	function obfuscate_email($email) {

		$em   = explode("@",$email);
	    $name = implode(array_slice($em, 0, count($em)-1), '@');
	    $len  = floor(strlen($name)/2);

	    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);  
	
	}

}


/**
  * return language code
  *
  * @return string
  * 
  */
  if (!function_exists('getUserlang')) {

	function getUserlang() {

	    return !empty( get_cookie('current_lang', true) ) ? get_cookie('current_lang', true) : setting('default_lang');
	
	}

}


/**
  * return language code
  *
  * @return string
  * 
  */
  if (!function_exists('setUserlang')) {

	function setUserlang($code) {

	    return set_cookie('current_lang', $code, 86400*30);
		// set_cookie())
	
	}

}

if (!function_exists('get_array_value')) {

    function get_array_value(array $array, $key) {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
    }

}


// lang_codes();