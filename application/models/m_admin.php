<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_admin extends CI_Model 
	{

		public function salesHarian() 
		{
			$date = date('Y-m-d');
			$this->db = $this->load->database('default', true);
			$success = $this->db->query("
		select x.date_pesanan,sum(y.qty_harga) sales_harian,count(x.id_pesanan) jml_pesanan from pesanan x,(select a.id_pesanan,b.id_menu,b.harga_jual,a.jumlah,(harga_jual * jumlah) qty_harga from menu b,detail_pesanan a where a.id_menu=b.id_menu and a.status='Confirmed') y where x.id_pesanan=y.id_pesanan group by date_pesanan ORDER BY x.date_pesanan desc");
		return $success->result();
		}
		
		public function hitung_diskon() 
		{
			
			$this->db = $this->load->database('default', true);
			$success = $this->db->query("
			SELECT sum(x.diskon)tot_dis, sum(ceil((diskon/100)*total)) diskonan, 
             y.date_pesanan
             FROM pesanan y left join nota x on y.id_pesanan=x.id_pesanan group by date_pesanan
		");
		return $success->result();
		}
       
       public function hot_meals() 
		{
			$this->db = $this->load->database('default', true);
			$success = $this->db->query("
			SELECT b.nama_menu,count(a.id_menu) jml FROM `detail_pesanan` a, 
			menu b, pesanan c where a.id_menu=b.id_menu and c.id_pesanan=a.id_pesanan and b.kategori='0' and
			date_pesanan>=curdate()-30 and date_pesanan<=curdate()
			group by b.nama_menu order by jml desc limit 0,3
		");
		return $success->result();
		}
       
	   public function hot_drinks() 
		{
			$this->db = $this->load->database('default', true);
			$success = $this->db->query("
			SELECT b.nama_menu,count(a.id_menu) jml FROM `detail_pesanan` a, 
			menu b, pesanan c where a.id_menu=b.id_menu and c.id_pesanan=a.id_pesanan and b.kategori='1' and
			date_pesanan>=curdate()-30 and date_pesanan<=curdate()
			group by b.nama_menu order by jml desc limit 0,3 
		");
		return $success->result();
		}

		function getMaxNumber()
		{
			$this->db=$this->load->database('default',true);
			$this->db->select_max('id_pesanan');
			$t=$this->db->get('pesanan');
			return $t->row();
		}

		function updatePesanan($id){
			$this->db = $this->load->database('default', true);
			$this->db->set('status_pesanan', "1"); //value that used to update column  
			$this->db->where('id_pesanan', $id);
			$success = $this->db->update('pesanan');
			if(!$success){
				$success = false;
				$errNo   = $this->db->_error_number();
				$errMess = $this->db->_error_message();
				array_push($errors, array($errNo, $errMess));
			}
			return $success;

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
						$isi['keterangan'] = $detailPesanan[$i][2];
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
				$isi['id_pesanan'] = $data[$i][3];
				$isi['id_menu'] = $data[$i][0];
				$isi['jumlah'] =  $data[$i][1];
				$isi['keterangan'] = $data[$i][2];
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

		// public function updatePesanan($id, $data)
		// {
		// 	return $this->db->update('pesanan', $data, array('id_pesanan' => $id));
		// }

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