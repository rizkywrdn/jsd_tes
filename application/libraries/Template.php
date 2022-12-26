<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template {

    public function rander($view, $data = array(), $auth = false) {
        $ci = get_instance();

        $view_data['view'] = $view;
        $view_data = array_merge($view_data, $data);
        if($auth){
            $ci->load->view('layouts/index_auth', $view_data);
        }else{
            $ci->load->view('layouts/index', $view_data);
        }
    }

}
