<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_login extends CI_Model 
	{

		public function login($data) 
		{
			$this->db = $this->load->database('default', true);
			$username = $data['username'];
			$status =  'AKTIF';
			$password = md5($data['password']);
			// $password = $data['password'];
			// echo $password;
			// exit();
			$this->db->select('*');
			$this->db->from('credential');
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$this->db->where('status', $status);
			$query = $this->db->get();
			// echo $username;
			// echo "<br>";
			// echo $password;
			return $query->row();
		}

		public function select_user($data)
		{
			$this->db->select('user.*');
			$this->db->from('user');
			$this->db->where($data);
			$query = $this->db->get();
			return $query->row();
		}

		

		public function get_id($username)
		{
			$this->db->select('id_user');
			$this->db->from('user');
			$this->db->where('username', $username);
			$query = $this->db->get();
			$hasil = $query->num_rows();
			if ($hasil = 1) {
				foreach($query->result() as $hasil ){
					$id_user = $hasil->id_user;
				}
			}else{
				$id_user = false;
			}

				return $id_user;

		}

		public function update($id, $data)
		{
			return $this->db->update('user', $data, array('id_user' => $id));
		}

	}

?>