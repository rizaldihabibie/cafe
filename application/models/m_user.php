<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_user extends CI_Model 
	{

		public function selectAll() 
		{
			$this->db = $this->load->database('default', true);
			
			$success = $this->db->query("
		select a.*,b.username,b.privilege,b.status from user a,credential b where a.id_credential =b.id_credential");
		return $success->result();
		}
      
	
		public function saveUser($data){
			$this->db = $this->load->database('default', true);
			$this->db->trans_begin();
			$success = $this->db->query("
		insert into user (id_credential,nama_user,alamat_user,no_ktp,no_telp) (select max(id_user)+1 id_baru,".$this->db->escape($data['namalengkap']).",".$this->db->escape($data['alamat'])."
		,".$this->db->escape($data['noktp']).",".$this->db->escape($data['notelepon'])." from user)");
		    $success2 = $this->db->query("
		insert into credential (username,password,privilege,status) values(".$this->db->escape($data['username']).",".$this->db->escape($data['password']).",".$this->db->escape($data['jabatan']).",".$this->db->escape($data['status']).")");
			$this->db->trans_commit();
			$this->db->trans_complete();
				if(!$success){
					$success = false;
					$errNo   = $this->db->_error_number();
					$errMess = $this->db->_error_message();
					array_push($errors, array($errNo, $errMess));
				}
           	if(!$success2){
					$success2 = false;
					$errNo   = $this->db->_error_number();
					$errMess = $this->db->_error_message();
					array_push($errors, array($errNo, $errMess));
				}
			return $success;
		}

		public function updateUser($id, $data)
		{
			$this->db = $this->load->database('default', true);
			$this->db->trans_begin();
		    $success = $this->db->query("update user set nama_user=".$this->db->escape($data['namalengkap']).",alamat_user=".$this->db->escape($data['alamat']).",no_ktp=".$this->db->escape($data['noktp']).",no_telp=".$this->db->escape($data['notelepon'])." where id_user=".$this->db->escape($data['id'])." ");
			 $success2 = $this->db->query("update credential set privilege=".$this->db->escape($data['jabatan']).",status=".$this->db->escape($data['status'])." where id_credential=".$this->db->escape($data['id'])." ");
			$this->db->trans_commit();
			$this->db->trans_complete();
			if(!$success){
					$success = false;
					$errNo   = $this->db->_error_number();
					$errMess = $this->db->_error_message();
					array_push($errors, array($errNo, $errMess));
				}

			return $success;
		} 
     	public function updatePasswordBaru($id, $data)
		{
			$this->db = $this->load->database('default', true);
			$this->db->trans_begin();
		    
			 $success = $this->db->query("update credential set password=".$this->db->escape($data['password_baru'])." where id_credential=".$this->db->escape($data['id'])." ");
			$this->db->trans_commit();
			$this->db->trans_complete();
			if(!$success){
					$success = false;
					$errNo   = $this->db->_error_number();
					$errMess = $this->db->_error_message();
					array_push($errors, array($errNo, $errMess));
				}

			return $success;
		}
 
	

		public function findById($id) 
		{
			$this->db = $this->load->database('default', true);
	        	$success = $this->db->query("
		select a.*,b.username,b.privilege,b.status from user a,credential b where a.id_credential =b.id_credential and b.id_credential=".$id."");	
				return $success->row();
		}

		public function selectWaitress() 
		{
			$this->db = $this->load->database('default', true);
			$this->db->select('*');
			$this->db->from('user');
			$this->db->join('credential', 'credential.id_credential = user.id_credential');
			$this->db->where("(credential.privilege = 'waitress')", NULL, FALSE);
			$query = $this->db->get();
			return $query->result();
		}

	}

?>