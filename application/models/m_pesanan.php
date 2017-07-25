<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_pesanan extends CI_Model 
	{

		public function selectAll() 
		{
			$this->db = $this->load->database('default', true);
			
			$this->db->select('*');
			$this->db->from('pesanan');
			$query = $this->db->get();
			return $query->result();
		}

		public function savePesanan($data){
			$this->db = $this->load->database('default', true);
			$this->db->trans_begin();
			$success = $this->db->insert('pesanan', $data);
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
      
	  	public function saveDetailPesanan($data){
			$this->db = $this->load->database('default', true);
			$this->db->trans_begin();
			$success = $this->db->insert('detail_pesanan', $data);
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

		public function updatePesanan($id, $data)
		{
			return $this->db->update('pesanan', $data, array('id_pesanan' => $id));
		}

		public function updateDetailPesanan($id, $data)
		{
			return $this->db->update('detail_pesanan', $data, array('id_pesanan' => $id));
		}

	}

?>