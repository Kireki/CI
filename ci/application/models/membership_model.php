<?php

class Membership_model extends CI_Model {

	function validate()
	{
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('membership');

		if ($query->num_rows === 1) 
		{
			return true;
		}
	}

	function getInfo($str)
	{
		$this->db->where('username', $str);
		$query = $this->db->get('membership');
		if ($query->num_rows === 1) {
			return $query->row();
		}
		else
		{
			return NULL;
		}		
	}

	function create_member()
	{
		$new_member_insert_data = array(
			'username' => $this->input->post('username'),
			'email_address' => $this->input->post('email_address'),
			'password' => $this->input->post('password'),
			'userDir' => '/home/fishtornado/www/ci/users/' . $this->input->post('username'),
		);

		$insert = $this->db->insert('membership', $new_member_insert_data);
		mkdir('/home/fishtornado/www/ci/users/' . $this->input->post('username'));
		mkdir('/home/fishtornado/www/ci/users/' . $this->input->post('username') . '/thumbs');
		mkdir('/home/fishtornado/www/ci/users/' . $this->input->post('username') . '/medium');
		return $insert;
	}

	function changePass()
	{
		$newPass = $_POST['newPass'];
        $user = $this->getInfo($this->session->userdata('username'));
        $user->password = $newPass;
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->update('membership', $user);
        return true;
	}

	function ban_user($str)
	{
		$user = $this->getInfo($str);
		$user->status = "banned";
		$this->db->where('username', $user->username);
		$this->db->update('membership', $user);
	}

	function unban_user($str)
	{
		$user = $this->getInfo($str);
		$user->status = "active";
		$this->db->where('username', $user->username);
		$this->db->update('membership', $user);
	}

	function clean($str)
	{
		$this->db->where('username', $str);
		$user = $this->getInfo($str);
		$this->clean_dir($user->userDir . "/thumbs");
		$this->clean_dir($user->userDir . "/medium");
		$this->clean_dir($user->userDir);
		$this->db->where('uploader', $user->username);
		$this->db->delete('userPics');
		$this->db->where('username', $user->username);
		$this->db->delete('membership');
	}

	function clean_dir($str)
	{
		$files = glob($str . "/*");
		foreach ($files as $file)
		{
			if (is_file($file)) {
				unlink($file);
			}
		}
		rmdir($str);
	}

}