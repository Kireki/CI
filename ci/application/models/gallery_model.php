<?php
class Gallery_model extends CI_Model {

	var $gallery_path;
	var $gallery_path_url;

	function __construct() {
		parent::__construct();
		$this->gallery_path = realpath(APPPATH . "../images");
		$this->gallery_path_url = base_url().'images/';
	}

	function do_upload() {

		$config = array(
			'allowed_types' => 'jpg|jpeg|png|bmp|gif',
			'upload_path' => $this->gallery_path,
            'encrypt_name' => TRUE,
            'max_size' => '6144',
        );

		$this->load->library('upload', $config);
		$this->upload->do_upload();
        $this->upload->display_errors();
		$image_data = $this->upload->data();

        require_once '/home/fishtornado/www/ci/misc/ThumbLib.inc.php';
        $thumb = PhpThumbFactory::create($image_data['full_path']);  
        $thumb->adaptiveResize(200, 200)->save($this->gallery_path . '/thumbs/' . $image_data['file_name']);

        $new_pic_insert_data = array(
            'name' => uniqid(),
            'filepath' => $this->gallery_path_url . $image_data['file_name'],
            'thumbPath' => $this->gallery_path_url . 'thumbs/' . $image_data['file_name'],
            'upload_date' => standard_date('DATE_ATOM')
        );

        $this->db->insert('userPics', $new_pic_insert_data);
        redirect('pic/'.$new_pic_insert_data['name']);


	}

	function do_user_upload() {

		$this->db->where('username', $this->session->userdata('username'));
		$query = $this->db->get('membership');
		$user = $query->row();

		$config = array(
			'allowed_types' => 'jpg|jpeg|png|bmp|gif',
			'upload_path' => $user->userDir,
            'encrypt_name' => TRUE,
            'max_size' => '30720'            
		);

		$this->load->library('upload', $config);
		$this->upload->do_upload();
		$image_data = $this->upload->data();

		require_once '/home/fishtornado/www/ci/misc/ThumbLib.inc.php';
        $thumb = PhpThumbFactory::create($image_data['full_path']);  
        $thumb->adaptiveResize(200, 200)->save($user->userDir . '/thumbs/' . $image_data['file_name']);

        $medium = PhpThumbFactory::create($image_data['full_path']);
        $medium->resize(2000, 2000)->save($user->userDir . '/medium/' . $image_data['file_name']);

        $url_path = base_url() . substr($user->userDir, 25) . '/';

        $time=time();
        $new_pic_insert_data = array(
            'name' => uniqid(),
        	'filepath' => $url_path . $image_data['file_name'],
            'thumbPath' => $url_path . 'thumbs/' . $image_data['file_name'],
            'mediumVariant' => $url_path . 'medium/' . $image_data['file_name'],
        	'uploader' => $this->session->userdata('username'),
        	'upload_date' => standard_date('DATE_ATOM', $time)
        );

        $this->db->insert('userPics', $new_pic_insert_data);

	}

	function get_images($count = NULL, $offset = NULL) {
        $this->db->select('filepath, thumbPath, mediumVariant, uploader, name, status');
        $this->db->from('userPics');
        $this->db->join('membership', 'uploader = username');
        $this->db->where('status !=', "banned");
        $this->db->order_by("upload_date", "desc");
        if (isset($count) && isset($offset)) {
            $this->db->limit($count, $offset);
            $query = $this->db->get();
        }
        else
        {
            $query = $this->db->get();
        }
        

        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $image)
            {
                $images[] = array(
                    'url' => $image->filepath,
                    'thumb_url' => $image->thumbPath,
                    'medium_url' => $image->mediumVariant,
                    'uploader' => $image->uploader,
                    'name' => $image->name,
                    'status' => $image->status
                );
            }
            return $images;
        }

	}

    function get_user_images($str, $count = NULL, $offset = NULL) 
    {

        $this->db->where('uploader', $str);
        $this->db->order_by("upload_date", "desc");
        if (isset($count) && isset($offset))
        {
            $this->db->limit($count, $offset);            
        }
        $query = $this->db->get('userPics');

        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $image)
            {
                $images[] = array(
                    'url' => $image->filepath,
                    'thumb_url' => $image->thumbPath,
                    'uploader' => $image->uploader,
                    'medium_url' => $image->mediumVariant,
                    'name' => $image->name
                );
            }
            return $images;
        }

    }

    function get_pic($str) 
    {

        $this->db->where('name', $str);
        $query = $this->db->get('userPics');

        if ($query->num_rows === 1) {
            $pic = $query->row();
            return $pic;
        }
        else
        {
            return NULL;
        }
    }

    function delete($str)
    {
        $path_to_CI = "/home/fishtornado/www/";
        $picInfo = $this->get_pic($str);
        $this->db->where('name', $picInfo->name);
        $this->db->delete('userPics');
        unlink($path_to_CI . substr($picInfo->filepath, 22));
        unlink($path_to_CI . substr($picInfo->thumbPath, 22));
        unlink($path_to_CI . substr($picInfo->mediumVariant, 22));
    }

    function pic_count()
    {
        $this->db->from('userPics');
        $this->db->join('membership', 'uploader = username');
        $this->db->where('status !=', "banned");
        $count = $this->db->get()->num_rows();
        return $count;
    }

    function user_pic_count($str)
    {
        $this->db->where('uploader', $str);
        $count = $this->db->get('userPics')->num_rows();
        return $count;
    }

    function get_user_name($str)
    {

        $this->db->where('username', $str);
        $user = $this->db->get('membership')->row();
        if ($user->username === $str) {
            return $user->username;
        }
        else
        {
            return NULL;
        }
    }
}