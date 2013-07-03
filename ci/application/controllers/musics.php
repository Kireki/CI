<?php

class Musics extends CI_Controller 
{
    function index()
    {
        $items  = array('tinysong link', 'songID', 'songName', 'artistID', 'artistName', 'albumID', 'albumName');
        $searchQuery = $this->input->post('song');
        $searchQuery = preg_split('/\s+/', $searchQuery);
        $query = implode('+', $searchQuery);
        $songArray =@ file_get_contents('http://tinysong.com/s/' . $query . '?format=&limit=20&key=5caaa4b4b41027c7d7b341ad1f9bad83');
        $IDs = "";
        if ($songArray !== "NSF;") {
            $songArray = array_chunk(array_filter(preg_split("/[\n;]/", $songArray)), 7);
            for ($i=0; $i < count($songArray) ; $i++) { 
                $IDs = $IDs . $songArray[$i][1];
            }
            $IDs = trim($IDs);
            $IDs = preg_split('/\s+/', $IDs);
            $IDs = implode(',', $IDs);
            $data['songs'] = $IDs;
        }
        else
        {
            $data['songs'] = NULL;
        }
        $this->load->view('test', $data);
    }
}