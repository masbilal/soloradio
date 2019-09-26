<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	
	function index(){
		redirect("404_notfound");
	}
	
	function famous(){
		$this->load->view("head",['headerbg'=>true,'titel'=>'Famous Update']);
		$this->load->view("page/famous");
		$this->load->view("foot");
	}
	function fit(){
		$this->load->view("head",['headerbg'=>true,'titel'=>'Fit Update']);
		$this->load->view("page/fit");
		$this->load->view("foot");
	}
	function fashionable(){
		$this->load->view("head",['headerbg'=>true,'titel'=>'Fashionable Update']);
		$this->load->view("page/fashionable");
		$this->load->view("foot");
	}
	function event(){
		$this->load->view("head");
		$this->load->view("page/event");
		$this->load->view("foot");
	}
}