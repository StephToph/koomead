<?php

namespace App\Controllers;

class Home extends BaseController {
    private $db;

    public function __construct() {
		$this->db = \Config\Database::connect();
	}

    public function index() {
        $db = \Config\Database::connect();

        // check login
        $log_id = $this->session->get('km_id'); 
        $role_id = $this->Crud->read_field('id', $log_id, 'user', 'role_id');
        $role = strtolower($this->Crud->read_field('id', $role_id, 'access_role', 'name'));
       

        $data['log_id'] = $log_id;
        $data['role'] = $role;
        
        
        $data['title'] = ' '.app_name;
        $data['page_active'] = 'home';
        return view('home/land', $data);
    }
}
