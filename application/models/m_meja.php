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
					$errNo   = $this->db->_error_number();
					$errMess = $this->db->_error_message();
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
					$errNo   = $this->db->_error_number();
					$errMess = $this->db->_error_message();
					array_push($errors, array($errNo, $errMess));
				}

			return $success;
		}


		public function updateMeja($id, $data)
		{
			return $this->db->update('meja', $data, array('id_meja' => $id));
		}

		public function findByIdPesanan($id){
			$this->db = $this->load->database('default', true);
			$this->db->select('*');    
			$this->db->from('meja');
			$this->db->join('detail_meja', 'meja.id_meja = detail_meja.id_meja');
			$this->db->where('detail_meja.id_pesanan',$id);
			$query = $this->db->get();
			return $query->result();
		}

		public function openTable($data){
			$this->db = $this->load->database('default', true);
			for($i=0;$i<sizeof($data);$i++){
				$this->db->select("*");
				$this->db->where('no_meja',$data[$i]);
				$t=$this->db->get('meja');
				$idMeja = $t->row()->id_meja;

				$this->db->set('status', "0"); //value that used to update column  
				$this->db->where('id_meja', $idMeja);
				$success = $this->db->update('meja');
				if(!$success){
					$success = false;
					$errNo   = $this->db->_error_number();
					$errMess = $this->db->_error_message();
					array_push($errors, array($errNo, $errMess));
					break;
				}
			}
			// $this->db->set('status', "1"); //value that used to update column  
			// $this->db->where('id_meja', $idMeja);
			// $success = $this->db->update('meja');
			// if(!$success){
			// 	$success = false;
			// 	$errNo   = $this->db->_error_number();
			// 	$errMess = $this->db->_error_message();
			// 	array_push($errors, array($errNo, $errMess));
			// 	break;
			// }
		}
       
	}

?>