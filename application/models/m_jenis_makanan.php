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

		public function saveKategori($data){
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

		public function updateKategori($id, $data)
		{
			return $this->db->update('jenis_makanan', $data, array('id_jenis_makanan' => $id));
		}

	}

?>