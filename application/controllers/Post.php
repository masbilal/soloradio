<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {
	
	function index(){
		redirect("404_notfound");
	}
	
	function loadpost($url){
		$this->db->where("url",$url);
		$this->db->limit(1);
		$db = $this->db->get("postingan");
		foreach($db->result() as $r){ $judul = $r->judul; }
		
		$this->load->view('head',["headerbg"=>true,"post"=>$judul]);
		$this->load->view('post',["url"=>$url,"db"=>$db]);
		$this->load->view('foot');
	}
}