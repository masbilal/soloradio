<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
	
	function index(){
		redirect("404_notfound");
	}
	
	function program(){
		$this->load->view("head",["headerbg"=>true,"titel"=>"Program"]);
		$this->load->view("page/program");
		$this->load->view("foot");
	}
	
	function makeitdigital(){
		$this->load->view("head",["headerbg"=>true,"titel"=>"Make It Digital"]);
		$this->load->view("page/makeitdigital");
		$this->load->view("foot");
	}
	
	function playlist(){
		$this->load->view("head",["headerbg"=>true,"titel"=>"Playlist"]);
		$this->load->view("page/playlist");
		$this->load->view("foot");
	}
	
	function event(){
		$this->load->view("head",["headerbg"=>true,"titel"=>"Event"]);
		$this->load->view("page/event");
		$this->load->view("foot");
	}
	
	function aboutus(){
		$this->load->view("head",["headerbg"=>true,"titel"=>"About Us"]);
		$this->load->view("page/aboutus");
		$this->load->view("foot");
	}
	
	function loadplaylist($id=null){
		if($id != null){
			$this->db->where("topid",$id);
			$this->db->order_by("posisi ASC");
			$db = $this->db->get("song");
			
			if($db->num_rows() > 0){
				foreach($db->result() as $r){
					echo "
						<tr>
							<td>
								<div class=\"play-button\">
                                    <a href=\"".$r->linkyt."\" target='_blank'><img src=\"".base_url("assets/themev2/img/youtube.png")."\" width=\"42\"></a>
								</div>
							</td>
							<td>".$r->judul."</td>
							<td>".$r->artis."</td>
							<td>".$r->label."</td>
						</tr>
					";
				}
			}else{
				echo "
					<tr>
						<td colspan=4 class='text-center'>Tidak ada lagu dalam playlist ini</td>
					</tr>
				";
			}
		}else{
			echo "
				<tr>
					<td colspan=4 class='text-center'>Tidak ada lagu dalam playlist ini</td>
				</tr>
			";
		}
	}
}