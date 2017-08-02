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
      	public function selectWaitress() 
		{
			$this->db = $this->load->database('default', true);
			
			$success = $this->db->query("
		select a.*,b.username,b.privilege,b.status from user a,credential b where a.id_credential =b.id_credential and privilege='waitress' ");
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
			$this->db->where('id_menu',$id);
			$success = $this->db->update('menu', $data);
			$this->db->trans_commit();
			$this->db->trans_complete();
			if(!$success){
					$success = false;
					$errNo   = $this->oracle_db->_error_number();
					$errMess = $this->oracle_db->_error_message();
					array_push($errors, array($errNo, $errMess));
				}

			return $success;
		}

		public function selectFoodOnly() 
		{
			$this->db = $this->load->database('default', true);
			
			$this->db->select('*');
			$this->db->from('menu');
			$this->db->where("(kategori = '0')", NULL, FALSE);
			$query = $this->db->get();
			return $query->result();
		}

		public function selectDrinkOnly() 
		{
			$this->db = $this->load->database('default', true);
			$this->db->select('*');
			$this->db->from('menu');
			$this->db->where("(kategori = '1')", NULL, FALSE);
			$query = $this->db->get();
			return $query->result();
		}

		public function findById($id) 
		{
			$this->db = $this->load->database('default', true);
			$this->db->select('*');
			$this->db->from('menu');
			$this->db->where("id_menu", $id);
			$query = $this->db->get();
			return $query->row();
		}

	}

?>