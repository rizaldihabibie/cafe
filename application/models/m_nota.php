<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_nota extends CI_Model 
	{

		public function selectAll() 
		{
			$this->db = $this->load->database('default', true);
			
			$this->db->select('*');
			$this->db->from('nota');
			$query = $this->db->get();
			return $query->result();
		}

		public function saveNota($data){
			$this->db = $this->load->database('default', true);
			$this->db->trans_begin();
			$success = $this->db->insert('nota', $data);
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

		public function updateKategori($id, $data)
		{
			return $this->db->update('nota', $data, array('id_nota' => $id));
		}

	}

?>