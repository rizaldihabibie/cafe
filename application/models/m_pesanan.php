<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_pesanan extends CI_Model 
	{

		public function selectAll() 
		{
			$date = date('Y-m-d');
			$this->db = $this->load->database('default', true);
			$this->db->select('*');
			$this->db->from('pesanan');
			$this->db->where('date_pesanan',$date);
			$query = $this->db->get();
			return $query->result();
		}

		function getMaxNumber()
		{
			$this->db=$this->load->database('default',true);
			$this->db->select_max('id_pesanan');
			$t=$this->db->get('pesanan');
			return $t->row();
		}

		public function savePesanan($dataPemesan, $detailPesanan, $noMeja){
			$this->db = $this->load->database('default', true);
			$this->db->trans_begin();
			$success = $this->db->insert('pesanan', $dataPemesan);
			
				if(!$success){
					$success = false;
					$errNo   = $this->db->_error_number();
					$errMess = $this->db->_error_message();
					array_push($errors, array($errNo, $errMess));
				}else{
					$idPemesan =  $this->db->insert_id();
					for($i=0;$i<sizeof($detailPesanan);$i++){
						$isi = array();
						$isi['id_pesanan'] = $idPemesan;
						$isi['id_menu'] = $detailPesanan[$i][0];
						$isi['jumlah'] =  $detailPesanan[$i][1];
						$success = $this->db->insert('detail_pesanan', $isi);
						if(!$success){
							$success = false;
							$errNo   = $this->db->_error_number();
							$errMess = $this->db->_error_message();
							array_push($errors, array($errNo, $errMess));
							break;
						}
					}
					if($success){
						for($i=0;$i<sizeof($noMeja);$i++){
							$this->db->select("*");
							$this->db->where('no_meja',$noMeja[$i]);
							$t=$this->db->get('meja');
							$idMeja = $t->row()->id_meja;

							$detailMeja = array();
							$detailMeja['id_meja'] = $idMeja;
							$detailMeja['id_pesanan'] = $idPemesan;

							$success = $this->db->insert('detail_meja', $detailMeja);
							if($success){
								$this->db->set('status', "1"); //value that used to update column  
								$this->db->where('id_meja', $idMeja);
								$success = $this->db->update('meja');
								if(!$success){
									$success = false;
									$errNo   = $this->db->_error_number();
									$errMess = $this->db->_error_message();
									array_push($errors, array($errNo, $errMess));
									break;
								}
							
							}else{
								$success = false;
								$errNo   = $this->db->_error_number();
								$errMess = $this->db->_error_message();
								array_push($errors, array($errNo, $errMess));
								break;
							}

						}
						
					}
					$this->db->trans_commit();
					$this->db->trans_complete();
					return $success;

				}

				

			return $success;
		}
      
	  	public function saveDetailPesanan($data){
			$this->db = $this->load->database('default', true);
			$this->db->trans_begin();
			
			for($i=0;$i<sizeof($data);$i++){
				$isi = array();
				$isi['id_pesanan'] = $data[$i][2];
				$isi['id_menu'] = $data[$i][0];
				$isi['jumlah'] =  $data[$i][1];
				$success = $this->db->insert('detail_pesanan', $isi);
				if(!$success){
					$success = false;
					$errNo   = $this->db->_error_number();
					$errMess = $this->db->_error_message();
					array_push($errors, array($errNo, $errMess));
					break;
				}
			}
			$this->db->trans_commit();
			$this->db->trans_complete();
			return $success;
		}

		public function cancelOrder($data){
			$this->db = $this->load->database('default', true);
			$this->db->trans_begin();
			$isi = array();
			for($i=0;$i<sizeof($data);$i++){
				$isi['STATUS'] = "CANCELED";
				$this->db->where('id_detail_pesanan',$data[$i]);
				$success = $this->db->update('detail_pesanan', $isi);
				if(!$success){
				$success = false;
				$errNo   = $this->db->_error_number();
				$errMess = $this->db->_error_message();
				array_push($errors, array($errNo, $errMess));
				break;
				}	
			}
			
			$this->db->trans_commit();
			$this->db->trans_complete();
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

		public function selectDetailPesanan($idPesanan){
			$this->db = $this->load->database('default', true);
			$this->db->select('*');    
			$this->db->from('pesanan');
			$this->db->join('detail_pesanan', 'pesanan.id_pesanan = detail_pesanan.id_pesanan');
			$this->db->join('menu', 'detail_pesanan.id_menu = menu.id_menu');
			$this->db->where('pesanan.id_pesanan',$idPesanan);
			$this->db->where('detail_pesanan.status',"CONFIRMED");
			$query = $this->db->get();
			return $query->result();
		}

		public function findById($idPesanan){
			$this->db = $this->load->database('default', true);
			$this->db->select('*');    
			$this->db->from('pesanan');
			$this->db->where('id_pesanan',$idPesanan);
			$query = $this->db->get();
			return $query->row();
		}

	}

?>