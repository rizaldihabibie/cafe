<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_meja extends CI_Model 
	{

		public function selectAll() 
		{
			$this->db = $this->load->database('default', true);
			
			$this->db->select('*');
			$this->db->from('meja');
			$query = $this->db->get();
			return $query->result();
		}
			public function mejaLantai1() 
		{
			$this->db = $this->load->database('default', true);
			$this->db->select('*');
			$this->db->from('meja');
			$this->db->where("(lantai = '1')", NULL, FALSE);
			$query = $this->db->get();
			return $query->result();
		}
		   public function mejaLantai2() 
		{
			$this->db = $this->load->database('default', true);
			$this->db->select('*');
			$this->db->from('meja');
			$this->db->where("(lantai = '2')", NULL, FALSE);
			$query = $this->db->get();
			return $query->result();
		}

		public function saveMeja($data){
			$this->db = $this->load->database('default', true);
			$this->db->trans_begin();
			$success = $this->db->insert('meja', $data);
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

		public function saveDetailMeja($data){
			$this->db = $this->load->database('default', true);
			$this->db->trans_begin();
			$success = $this->db->insert('detail_meja', $data);
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


		public function updateMeja($id, $data)
		{
			return $this->db->update('meja', $data, array('id_meja' => $id));
		}
       
	}

?>