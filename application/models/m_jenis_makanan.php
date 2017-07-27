<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_jenis_makanan extends CI_Model 
	{

		public function selectAll() 
		{
			$this->db = $this->load->database('default', true);
			
			$this->db->select('*');
			$this->db->from('jenis_makanan');
			$query = $this->db->get();
			return $query->result();
		}

		public function saveCategory($data){
			$this->db = $this->load->database('default', true);
			$this->db->trans_begin();
			$success = $this->db->insert('jenis_makanan', $data);
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

		public function updateCategory($id, $data)
		{
			$this->db = $this->load->database('default', true);
			$this->db->trans_begin();
			$this->db->where('id_jenis_makanan',$id);
			$success = $this->db->update('jenis_makanan', $data);
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
			$this->db->from('jenis_makanan');
			$this->db->where("(kategori = '0')", NULL, FALSE);
			$query = $this->db->get();
			return $query->result();
		}

		public function selectDrinkOnly() 
		{
			$this->db = $this->load->database('default', true);
			$this->db->select('*');
			$this->db->from('jenis_makanan');
			$this->db->where("(kategori = '1')", NULL, FALSE);
			$query = $this->db->get();
			return $query->result();
		}

		public function findByCategory($category) 
		{
			$this->db = $this->load->database('default', true);
			$this->db->select('*');
			$this->db->from('jenis_makanan');
			$this->db->where("kategori", $category);
			$query = $this->db->get();
			return $query->result();
		}

		public function findById($id) 
		{
			$this->db = $this->load->database('default', true);
			$this->db->select('*');
			$this->db->from('jenis_makanan');
			$this->db->where("id_jenis_makanan", $id);
			$query = $this->db->get();
			return $query->row();
		}

	}

?>