Skip to content
Search or jump to…
Pull requests
Issues
Codespaces
Marketplace
Explore
 
@rizkywrdn 
rizkywrdn
/
blanjaque
Private
Code
Issues
Pull requests
Actions
Projects
Security
Insights
Settings
blanjaque/application/models/User_model.php /
@rizkywrdn
rizkywrdn blanjaque
Latest commit 828b86b on Mar 2, 2021
 History
 1 contributor
267 lines (225 sloc)  7.74 KB

<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class User_model extends CI_Model
{
	 

	public function __construct()
	{
		parent::__construct(); 
	}  
	public function getAllById($where = array()){
		$this->db->select("users.*, roles.id as role_id, roles.name as role_name")->from("users"); 
    	$this->db->join("users_roles","users.id = users_roles.id");
    	$this->db->join("roles","roles.id = users_roles.role_id"); 
		$this->db->where("users.is_deleted",0);
		$this->db->where("roles.is_deleted",0); 
		 
 		$roles_default = array('1');
        // $this->db->where_not_in('roles.id', $roles_default);
		$this->db->where($where); 

		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->result(); 
    	} 
    	return FALSE;
	}
	public function insert($data){
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where){
		$this->db->update('users', $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete('users'); 
		if($this->db->affected_rows()){
			return TRUE;
		}
		return FALSE;
	}

    public function insert_step_1($data){
        $this->db->insert('users_temps', $data);
        return $this->db->insert_id();
    }

    public function update_step_1($data,$where){
        $this->db->update('users_temps', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_step_1($where){
        $this->db->where($where);
        $this->db->delete('users_temps'); 
        if($this->db->affected_rows()){
            return TRUE;
        }
        return FALSE;
    }

    function getOneByUserTemp($where = array()){
        $this->db->select("*")->from("users_temps");
        $this->db->where($where); 

        $query = $this->db->get();
        if ($query->num_rows() >0){  
            return $query->row(); 
        } 
        return FALSE;
    }

	function getOneBy($where = array()){
		$this->db->select("*")->from("users");   
        $this->db->where('users.is_deleted', 0);
		$this->db->where($where); 

		$query = $this->db->get();
		if ($query->num_rows() >0){  
    		return $query->row(); 
    	} 
    	return FALSE;
	}

	function getAllBy($limit,$start,$search,$col,$dir)
    {
    	$this->db->select("users.*, roles.name as role_name")->from("users"); 
    	$this->db->join("users_roles","users.id = users_roles.id");
    	$this->db->join("roles","roles.id = users_roles.role_id"); 
       	$this->db->limit($limit,$start)->order_by($col,$dir) ;
    	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
		} 
		$roles_default = array('1');
        $this->db->where_not_in('roles.id', $roles_default);
		$this->db->where("roles.is_deleted",0); 
       	$result = $this->db->get();
        if($result->num_rows()>0)
        {
            return $result->result();  
        }
        else
        {
            return null;
        }
    }

    function getCountAllBy($limit,$start,$search,$order,$dir)
    {

    	$this->db->select("users.*, roles.name as role_name")->from("users"); 
    	$this->db->join("users_roles","users.id = users_roles.id");
    	$this->db->join("roles","roles.id = users_roles.role_id"); 
	   	if(!empty($search)){
    		foreach($search as $key => $value){
				$this->db->or_like($key,$value);	
			} 	
    	} 
		$roles_default = array('1');
        $this->db->where_not_in('roles.id', $roles_default); 
		$this->db->where("roles.is_deleted",0); 
        $result = $this->db->get();
    
        return $result->num_rows();
    } 
	
        public function getUserInfo($id)  
        {  
            $q = $this->db->get_where('users', array('id' => $id), 1);   
            if($this->db->affected_rows() > 0){  
                $row = $q->row();  
                return $row;  
            }else{  
                error_log('user tidak ditemukan('.$id.')');  
                return false;  
            }  
        }

        public function getUserInfoByEmail($email){  
            $q = $this->db->get_where('users', array('email' => $email), 1);   
            if($this->db->affected_rows() > 0){  
               $row = $q->row();  
               return $row;  
            }  
        }

        public function updateForgot($id)  
        {    
            $token = substr(sha1(rand()), 0, 30);   
            $date = date('Y-m-d');  
               
            $string = array(  
                    'forgot_password'           => $token,    
                    'created_forgot_password'   => $date  
                );  
            $this->db->where('id',$id);
            $this->db->update('users',$string);  
            return $token . $id;  
           
        }

        public function isTokenValid($token)  
        {  
            $tkn = substr($token,0,30);  
            $uid = substr($token,30);     
           
            $q = $this->db->get_where('users', array(  
                'users.forgot_password' => $tkn,   
                'users.id' => $uid));               
               
            if($this->db->affected_rows() > 0){  
                $row = $q->row();         
             
                $created = $row->created_forgot_password;  
                $createdTS = strtotime($created);  
                $today = date('Y-m-d');   
                $todayTS = strtotime($today);  
             
                if($createdTS != $todayTS){  
                    return false;  
                }  
             
                $user_info = $this->getUserInfo($row->id);  
                return $user_info;  
             
            }else{  
                return false;  
            }  
        }          

        public function updatePassword($post)  
        {    
            $this->db->where('id', $post['id']);  
            $this->db->update('users', array('password' => $post['password'], 'forgot_password' => NULL, 'created_forgot_password' => NULL));      
            return true;  
        }

        //api model

        function addToken($data) {
            $result = $this->db->insert("api_keys", $data);
            if ( $this->db->affected_rows()> 0) {  
                $insert_id = $this->db->insert_id();
                return  $insert_id;
            }else{
                return false;
            }
        }

        function checkToken($id){
            $this->db->select("*")->from("api_keys");
            $this->db->where('id', $id);

            $query = $this->db->get();
            if ($query->num_rows() >0){
                return $query->row();
            }
            return FALSE;
        }
        
        public function updateToken($data,$where){
            $this->db->update('api_keys', $data, $where);
            return $this->db->affected_rows();
        }

        public function getTokenBy($where){ 
            $this->db->select("users.*")->from("users")
            ->join('api_keys','users.id = api_keys.user_id')
            ->where($where); 
            $query = $this->db->get();
            if ($query->num_rows() >0){  
                return $query->row(); 
            } else{
                return false;
            }
        }

        public function checkLogin($where = array()){
            $this->db->select("users.*")->from("users");
            $this->db->where($where);

            $query = $this->db->get();
            if ($query->num_rows() >0){
                return $query->row();
            }
            return FALSE;
        }
        
        public function checkUsers($where = array()){
            $this->db->select("users.*")->from("users");
            $this->db->where($where);

            $query = $this->db->get();
            if ($query->num_rows() >0){
                return $query->row();
            }
            return FALSE;
        }
	
	
}
Footer
© 2022 GitHub, Inc.
Footer navigation
Terms
Privacy
Security
Status
Docs
Contact GitHub
Pricing
API
Training
Blog
About
blanjaque/User_model.php at main · rizkywrdn/blanjaque