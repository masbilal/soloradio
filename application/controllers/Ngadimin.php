<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ngadimin extends CI_Controller {

	public function index(){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		$this->load->view('admin/head',["menu"=>1]);
		$this->load->view('admin/home');
		$this->load->view('admin/foot');
	}
	
	/* POST UPDATE */
	public function postupdate(){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_GET['load']) AND $_GET['load'] == "true"){
			$page = (isset($_GET["page"]) AND $_GET["page"] != "") ? $_GET["page"] : 1;
			$perpage = (isset($_GET["perpage"]) AND $_GET["perpage"] != "") ? $_GET["perpage"] : 10;
			$cari = (isset($_GET["cari"]) AND $_GET["cari"] != "") ? $_GET["cari"] : "";
			
			$where = "(judul LIKE '%$cari%' OR konten LIKE '%$cari%' OR linkyt LIKE '%$cari%') AND kategori > 1";
			$this->db->where($where);
			$row = $this->db->get("postingan");
			
			$this->db->where($where);
			$this->db->limit($perpage,($page-1)*$perpage);
			$this->db->order_by("id","DESC");
			$db = $this->db->get("postingan");
			
			echo "
				<table class='table'>
					<tr>
						<th>#</th>
						<th>Judul</th>
						<th>Kategori</th>
						<th>Aksi</th>
					</tr>
			";
			if($row->num_rows() == 0){
				echo "
						<tr>
							<th class='text-center text-danger' colspan=4>Belum ada postingan.</th>
						</tr>
				";
			}
			$default = base_url("assets/img/no-image.png");
			$no = 1 + (($page-1)*$perpage);
			foreach($db->result() as $r){
				$url = "https://img.youtube.com/vi/".$r->thumbnail."/mqdefault.jpg";
				$thumbnail = (filter_var($url, FILTER_VALIDATE_URL)) ? $url : $default;
				$thumbnail = "<img src='".$thumbnail."' class='thumbnail-post' />";
				echo "
					<tr>
						<td style='width:160px;'>$thumbnail</td>
						<td>".$r->judul."</td>
						<td>".$this->func->kategori($r->kategori)."</td>
						<td>
							<a href='".site_url('ngadimin/tambahpost/'.$r->id)."' class='btn btn-primary'><i class='la la-pencil'></i></a>
							<a href='javascript:void(0)' onclick='hapus(".$r->id.")' class='btn btn-danger'><i class='la la-trash'></i></a>
						</td>
					</tr>
				";
				$no++;
			}
			echo "
				</table>
			";
			echo $this->func->createPagination($row->num_rows(),$page,$perpage);
		}else{
			$this->load->view('admin/head',["menu"=>2]);
			$this->load->view('admin/postingan');
			$this->load->view('admin/foot');
		}
	}
	public function tambahpost($id=0){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_POST["judul"])){
			$thumb = explode("v=",$_POST["linkyt"]);
			$thumb = explode("&",$thumb[1]);
			$data = [
				"tgl"	=> date("Y-m-d H:i:s"),
				"usrid"	=> $_SESSION["usrid"],
				"judul"	=> $_POST["judul"],
				"kategori"	=> $_POST["kategori"],
				"linkyt"=> $_POST["linkyt"],
				"konten"=> $_POST["konten"],
				"thumbnail"	=> $thumb[0]
			];
			
			if($_POST["id"] > 0){
				$data["url"] = $_POST["id"]."-".$this->func->cleanURL($_POST["judul"]);
				$this->db->where("id",$_POST["id"]);
				$this->db->update("postingan",$data);
				
				//print_r($thumb);
				redirect("ngadimin/postupdate");
			}else{
				$this->db->insert("postingan",$data);
				$insertid = $this->db->insert_id();
				
				$this->db->where("id",$insertid);
				$this->db->update("postingan",["url"=>$insertid."-".$this->func->cleanURL($_POST["judul"])]);
				
				redirect("ngadimin/postupdate");
			}
		}else{
			$this->load->view("admin/head",["menu"=>2]);
			$this->load->view("admin/postinganform",["id"=>$id]);
			$this->load->view("admin/foot");
		}
	}
	
	/* GANTI PASSWORD */
	public function gantipass(){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_POST["pass"])){
			$this->db->where("id",$_SESSION["usrid"]);
			$this->db->update("userdata",["username"=>$_POST["username"],"pass"=>$this->func->encode($_POST["pass"])]);
			
			echo json_encode(["success"=>true]);
		}else{
			$this->load->view("admin/head");
			$this->load->view("admin/gantipass");
			$this->load->view("admin/foot");
		}
	}
	
	/* PROGRAM */
	public function program(){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_GET['load']) AND $_GET['load'] == "true"){
			$page = (isset($_GET["page"]) AND $_GET["page"] != "") ? $_GET["page"] : 1;
			$perpage = (isset($_GET["perpage"]) AND $_GET["perpage"] != "") ? $_GET["perpage"] : 10;
			$cari = (isset($_GET["cari"]) AND $_GET["cari"] != "") ? $_GET["cari"] : "";
			
			$where = "nama LIKE '%$cari%' OR foto LIKE '%$cari%' OR detail LIKE '%$cari%'";
			$this->db->where($where);
			$row = $this->db->get("program");
			
			$this->db->where($where);
			$this->db->limit($perpage,($page-1)*$perpage);
			$this->db->order_by("utama DESC,id DESC");
			$db = $this->db->get("program");
			
			echo "
				<table class='table'>
					<tr>
						<th>#</th>
						<th>Nama Program</th>
						<th>Audio</th>
						<th>Aksi</th>
					</tr>
			";
			if($row->num_rows() == 0){
				echo "
						<tr>
							<th class='text-center text-danger' colspan=4>Belum ada program.</th>
						</tr>
				";
			}
			$default = base_url("assets/img/no-image.png");
			$no = 1 + (($page-1)*$perpage);
			foreach($db->result() as $r){
				$url = base_url("assets/uploads/").$r->foto;
				$thumbnail = (filter_var($url, FILTER_VALIDATE_URL)) ? $url : $default;
				$thumbnail = "<img src='".$thumbnail."' class='thumbnail-post' />";
				if($r->utama != 1){
					$button = "
							<a href='".site_url('ngadimin/programform/'.$r->id)."' class='btn btn-primary'><i class='la la-pencil'></i></a>
							<a href='javascript:void(0)' onclick='hapus(".$r->id.")' class='btn btn-danger'><i class='la la-trash'></i></a>";
				}else{
					$button = "
							<a href='".site_url('ngadimin/programform/'.$r->id)."' class='btn btn-primary'><i class='la la-pencil'></i></a>";
				}
					
				echo "
					<tr>
						<td style='width:160px;'>$thumbnail</td>
						<td>".$r->nama."</td>
						<td>".$r->audio."</td>
						<td>
						".$button."
						</td>
					</tr>
				";
				$no++;
			}
			echo "
				</table>
			";
			echo $this->func->createPagination($row->num_rows(),$page,$perpage);
		}else{
			$this->load->view('admin/head',["menu"=>5]);
			$this->load->view('admin/program');
			$this->load->view('admin/foot');
		}
	}
	public function programform($id=0){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_POST["nama"])){
			$data = [
				"tgl"	=> date("Y-m-d H:i:s"),
				"nama"	=> $_POST["nama"],
				"detail"=> $_POST["detail"],
			];
			
			if(isset($_FILES['foto']) AND $_FILES['foto']['size'] != 0 AND $_FILES['foto']['error'] == 0){
				$config['upload_path'] = './assets/uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['file_name'] = $_SESSION["usrid"].date("YmdHis");

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('foto')){
					$error = array('errorFotoUpload' => $this->upload->display_errors());
				}else{
					$uploadData = $this->upload->data();
					$this->load->library('image_lib');
					$config_resize['image_library'] = 'gd2';
					$config_resize['maintain_ratio'] = TRUE;
					$config_resize['master_dim'] = 'height';
					$config_resize['quality'] = "100%";
					$config_resize['source_image'] = $config['upload_path'].$uploadData["file_name"];

					$config_resize['width'] = 1024;
					$config_resize['height'] = 1024;
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();
					
					$data["foto"] = $uploadData["file_name"];
				}
				$this->upload = null;
			}
			if(isset($_FILES['audio']) AND $_FILES['audio']['size'] != 0 AND $_FILES['audio']['error'] == 0){
				$configs['upload_path'] = './assets/uploads/';
				$configs['allowed_types'] = 'mp3|wav|aac';
				$configs['file_name'] = $_SESSION["usrid"].date("YmdHis");

				$this->load->library('upload', $configs);
				if ( ! $this->upload->do_upload('audio')){
					$error = array('errorAudioUpload' => $this->upload->display_errors());
					print_r($error);
					exit;
				}else{
					$uploadData = $this->upload->data();
					
					$data["audio"] = $uploadData["file_name"];
				}
			}
			
			if($_POST["id"] > 0){
				$this->db->where("id",$_POST["id"]);
				$this->db->update("program",$data);
				
				//print_r($thumb);
				redirect("ngadimin/program");
			}else{
				$this->db->insert("program",$data);
				$insertid = $this->db->insert_id();
				
				redirect("ngadimin/program");
			}
		}else{
			$this->load->view("admin/head",["menu"=>5]);
			$this->load->view("admin/programform",["id"=>$id]);
			$this->load->view("admin/foot");
		}
	}
	public function hapusprogram(){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_POST["theid"])){
			$this->db->where("id",$_POST["theid"]);
			if($this->db->delete("program")){
				echo json_encode(["success"=>true]);
			}else{
				echo json_encode(["success"=>false]);
			}
		}else{
			echo json_encode(["success"=>false]);
		}
	}
	
	/* PENYIAR*/
	public function penyiar(){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_GET['load']) AND $_GET['load'] == "true"){
			$page = (isset($_GET["page"]) AND $_GET["page"] != "") ? $_GET["page"] : 1;
			$perpage = (isset($_GET["perpage"]) AND $_GET["perpage"] != "") ? $_GET["perpage"] : 10;
			$cari = (isset($_GET["cari"]) AND $_GET["cari"] != "") ? $_GET["cari"] : "";
			
			$where = "nama LIKE '%$cari%' OR foto LIKE '%$cari%' OR kontak LIKE '%$cari%' OR detail LIKE '%$cari%'";
			$this->db->where($where);
			$row = $this->db->get("penyiar");
			
			$this->db->where($where);
			$this->db->limit($perpage,($page-1)*$perpage);
			$this->db->order_by("id DESC");
			$db = $this->db->get("penyiar");
			
			echo "
				<table class='table'>
					<tr>
						<th>#</th>
						<th>Nama Penyiar</th>
						<th>Instagram</th>
						<th>Aksi</th>
					</tr>
			";
			if($row->num_rows() == 0){
				echo "
						<tr>
							<th class='text-center text-danger' colspan=4>Belum ada penyiar.</th>
						</tr>
				";
			}
			$default = base_url("assets/img/no-image.png");
			$no = 1 + (($page-1)*$perpage);
			foreach($db->result() as $r){
				$url = base_url("assets/uploads/").$r->foto;
				$thumbnail = (filter_var($url, FILTER_VALIDATE_URL)) ? $url : $default;
				$thumbnail = "<img src='".$thumbnail."' class='thumbnail-post' />";
				$button = "
					<a href='".site_url('ngadimin/penyiarform/'.$r->id)."' class='btn btn-primary'><i class='la la-pencil'></i></a>
					<a href='javascript:void(0)' onclick='hapus(".$r->id.")' class='btn btn-danger'><i class='la la-trash'></i></a>";
					
				echo "
					<tr>
						<td style='width:160px;'>$thumbnail</td>
						<td>".$r->nama."</td>
						<td>".$r->kontak."</td>
						<td>
						".$button."
						</td>
					</tr>
				";
				$no++;
			}
			echo "
				</table>
			";
			echo $this->func->createPagination($row->num_rows(),$page,$perpage);
		}else{
			$this->load->view('admin/head',["menu"=>6]);
			$this->load->view('admin/penyiar');
			$this->load->view('admin/foot');
		}
	}
	public function penyiarform($id=0){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_POST["nama"])){
			$data = [
				"tgl"	=> date("Y-m-d H:i:s"),
				"nama"	=> $_POST["nama"],
				"kontak"=> $_POST["kontak"],
			];
			
			if(isset($_FILES['foto']) AND $_FILES['foto']['size'] != 0 AND $_FILES['foto']['error'] == 0){
				$config['upload_path'] = './assets/uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['file_name'] = $_SESSION["usrid"].date("YmdHis");

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('foto')){
					$error = array('errorFotoUpload' => $this->upload->display_errors());
				}else{
					$uploadData = $this->upload->data();
					$this->load->library('image_lib');
					$config_resize['image_library'] = 'gd2';
					$config_resize['maintain_ratio'] = TRUE;
					$config_resize['master_dim'] = 'height';
					$config_resize['quality'] = "100%";
					$config_resize['source_image'] = $config['upload_path'].$uploadData["file_name"];

					$config_resize['width'] = 1024;
					$config_resize['height'] = 1024;
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();
					
					$data["foto"] = $uploadData["file_name"];
				}
				$this->upload = null;
			}
			
			if($_POST["id"] > 0){
				$this->db->where("id",$_POST["id"]);
				$this->db->update("penyiar",$data);
				
				//print_r($thumb);
				redirect("ngadimin/penyiar");
			}else{
				$this->db->insert("penyiar",$data);
				$insertid = $this->db->insert_id();
				
				redirect("ngadimin/penyiar");
			}
		}else{
			$this->load->view("admin/head",["menu"=>6]);
			$this->load->view("admin/penyiarform",["id"=>$id]);
			$this->load->view("admin/foot");
		}
	}
	public function hapuspenyiar(){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_POST["theid"])){
			$this->db->where("id",$_POST["theid"]);
			if($this->db->delete("penyiar")){
				echo json_encode(["success"=>true]);
			}else{
				echo json_encode(["success"=>false]);
			}
		}else{
			echo json_encode(["success"=>false]);
		}
	}
	
	/* PLAYLIST*/
	public function playlist(){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_GET['load']) AND $_GET['load'] == "true"){
			$page = (isset($_GET["page"]) AND $_GET["page"] != "") ? $_GET["page"] : 1;
			$perpage = (isset($_GET["perpage"]) AND $_GET["perpage"] != "") ? $_GET["perpage"] : 10;
			$cari = (isset($_GET["cari"]) AND $_GET["cari"] != "") ? $_GET["cari"] : "";
			
			$where = "nama LIKE '%$cari%' OR tgl LIKE '%$cari%'";
			$this->db->where($where);
			$row = $this->db->get("topsong");
			
			$this->db->where($where);
			$this->db->limit($perpage,($page-1)*$perpage);
			$this->db->order_by("id DESC");
			$db = $this->db->get("topsong");
			
			echo "
				<table class='table'>
					<tr>
						<th>No</th>
						<th>Nama Playlist</th>
						<th>Status</th>
						<th>Jml Lagu</th>
						<th>Tgl Update</th>
						<th>Aksi</th>
					</tr>
			";
			if($row->num_rows() == 0){
				echo "
						<tr>
							<th class='text-center text-danger' colspan=4>Belum ada playlist.</th>
						</tr>
				";
			}
			$default = base_url("assets/img/no-image.png");
			$no = 1 + (($page-1)*$perpage);
			foreach($db->result() as $r){
				$jml = $this->func->getJmlLagu($r->id);
				$label = ($r->status == 1) ? "<b class='text-success'>Published</b>" : "<b class='text-danger'>Draft</b>";
				$button = "
					<a href='".site_url('ngadimin/playlistform/'.$r->id)."' class='btn btn-primary'><i class='la la-pencil'></i></a>
					<a href='javascript:void(0)' onclick='hapus(".$r->id.")' class='btn btn-danger'><i class='la la-trash'></i></a>";
					
				echo "
					<tr>
						<td>$no</td>
						<th>".$r->nama."</th>
						<td>".$label."</td>
						<td>".$jml."</td>
						<td>
							".$this->func->ubahTgl("d M Y",$r->tgl)."<br/>
							<small><i>".$this->func->ubahTgl("H:i",$r->tgl)." WIB</i></small>
						</td>
						<td>
						".$button."
						</td>
					</tr>
				";
				$no++;
			}
			echo "
				</table>
			";
			echo $this->func->createPagination($row->num_rows(),$page,$perpage);
		}else{
			$this->load->view('admin/head',["menu"=>4]);
			$this->load->view('admin/playlist');
			$this->load->view('admin/foot');
		}
	}
	public function playlistform($id=0){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_POST["nama"])){
			$data = [
				"tgl"	=> date("Y-m-d H:i:s"),
				"nama"	=> $_POST["nama"],
				"status"=> $_POST["status"],
			];
			
			if($_POST["id"] > 0){
				$this->db->where("id",$_POST["id"]);
				$this->db->update("topsong",$data);
				$insertid = $_POST["id"];
				
				//print_r($thumb);
				//redirect("ngadimin/playlist");
			}else{
				$this->db->insert("topsong",$data);
				$insertid = $this->db->insert_id();
				
			}
			
			$song = $_POST["song"];
			for($i=0; $i<count($song); $i++){
				$pos = $i+1;
				$this->db->where("id",$song[$i]);
				$this->db->update("song",["topid"=>$insertid,"posisi"=>$pos]);
			}
			
			redirect("ngadimin/playlist");
			//echo "sukses";
		}else{
			$this->load->view("admin/head",["menu"=>4]);
			$this->load->view("admin/playlistform",["id"=>$id]);
			$this->load->view("admin/foot");
		}
	}
	public function hapusplaylist(){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_POST["theid"])){
			$this->db->where("id",$_POST["theid"]);
			if($this->db->delete("topsong")){
				echo json_encode(["success"=>true]);
			}else{
				echo json_encode(["success"=>false]);
			}
		}else{
			echo json_encode(["success"=>false]);
		}
	}
	public function hapuslagu(){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_POST["theid"])){
			$this->db->where("id",$_POST["theid"]);
			if($this->db->delete("song")){
				echo json_encode(["success"=>true]);
			}else{
				echo json_encode(["success"=>false]);
			}
		}else{
			echo json_encode(["success"=>false]);
		}
	}
	function loadlagu(){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		$this->load->view("admin/playlistlagu");
	}
	function tambahlagu(){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_POST["judul"])){
			$_POST["tgl"] = date("Y-m-d H:i:s");
			$_POST["usrid"] = $_SESSION["usrid"];
			if($this->db->insert("song",$_POST)){
				echo json_encode(["success"=>true]);
			}else{
				echo json_encode(["success"=>false]);
			}
		}else{
			echo json_encode(["success"=>false]);
		}
	}
	
	/* MAKE IT DIGITAL */
	public function postmakeit(){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_GET['load']) AND $_GET['load'] == "true"){
			$page = (isset($_GET["page"]) AND $_GET["page"] != "") ? $_GET["page"] : 1;
			$perpage = (isset($_GET["perpage"]) AND $_GET["perpage"] != "") ? $_GET["perpage"] : 10;
			$cari = (isset($_GET["cari"]) AND $_GET["cari"] != "") ? $_GET["cari"] : "";
			
			$where = "(judul LIKE '%$cari%' OR konten LIKE '%$cari%' OR linkyt LIKE '%$cari%') AND kategori = 1";
			$this->db->where($where);
			$row = $this->db->get("postingan");
			
			$this->db->where($where);
			$this->db->limit($perpage,($page-1)*$perpage);
			$this->db->order_by("id","DESC");
			$db = $this->db->get("postingan");
			
			echo "
				<table class='table'>
					<tr>
						<th>#</th>
						<th>Judul</th>
						<th>Kategori</th>
						<th>Aksi</th>
					</tr>
			";
			if($row->num_rows() == 0){
				echo "
						<tr>
							<th class='text-center text-danger' colspan=4>Belum ada postingan.</th>
						</tr>
				";
			}
			$default = base_url("assets/img/no-image.png");
			$no = 1 + (($page-1)*$perpage);
			foreach($db->result() as $r){
				$url = "https://img.youtube.com/vi/".$r->thumbnail."/mqdefault.jpg";
				$thumbnail = (filter_var($url, FILTER_VALIDATE_URL)) ? $url : $default;
				$thumbnail = "<img src='".$thumbnail."' class='thumbnail-post' />";
				echo "
					<tr>
						<td style='width:160px;'>$thumbnail</td>
						<td>".$r->judul."</td>
						<td>".$this->func->kategori($r->kategori)."</td>
						<td>
							<a href='".site_url('ngadimin/tambahmakeit/'.$r->id)."' class='btn btn-primary'><i class='la la-pencil'></i></a>
							<a href='javascript:void(0)' onclick='hapus(".$r->id.")' class='btn btn-danger'><i class='la la-trash'></i></a>
						</td>
					</tr>
				";
				$no++;
			}
			echo "
				</table>
			";
			echo $this->func->createPagination($row->num_rows(),$page,$perpage);
		}else{
			$this->load->view('admin/head',["menu"=>3]);
			$this->load->view('admin/makeit');
			$this->load->view('admin/foot');
		}
	}
	public function tambahmakeit($id=0){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_POST["judul"])){
			$thumb = explode("v=",$_POST["linkyt"]);
			$thumb = explode("&",$thumb[1]);
			$data = [
				"tgl"	=> date("Y-m-d H:i:s"),
				"usrid"	=> $_SESSION["usrid"],
				"judul"	=> $_POST["judul"],
				"kategori"	=> 1,
				"linkyt"=> $_POST["linkyt"],
				"konten"=> $_POST["konten"],
				"thumbnail"	=> $thumb[0]
			];
			
			if($_POST["id"] > 0){
				$data["url"] = $_POST["id"]."-".$this->func->cleanURL($_POST["judul"]);
				$this->db->where("id",$_POST["id"]);
				$this->db->update("postingan",$data);
				
				//print_r($thumb);
				redirect("ngadimin/postmakeit");
			}else{
				$this->db->insert("postingan",$data);
				$insertid = $this->db->insert_id();
				
				$this->db->where("id",$insertid);
				$this->db->update("postingan",["url"=>$insertid."-".$this->func->cleanURL($_POST["judul"])]);
				
				redirect("ngadimin/postmakeit");
			}
		}else{
			$this->load->view("admin/head",["menu"=>3]);
			$this->load->view("admin/makeitform",["id"=>$id]);
			$this->load->view("admin/foot");
		}
	}
	public function hapuspostingan(){
		if(!$_SESSION["isMasok"]){
			redirect("ngadimin/login");
			exit;
		}
		
		if(isset($_POST["theid"])){
			$this->db->where("id",$_POST["theid"]);
			if($this->db->delete("postingan")){
				echo json_encode(["success"=>true]);
			}else{
				echo json_encode(["success"=>false]);
			}
		}else{
			echo json_encode(["success"=>false]);
		}
	}
	
	public function enkrip(){
		echo $this->func->encode("admin");
	}
	
	public function login(){
		if(isset($_POST["username"])){
			$this->db->where("username",$_POST["username"]);
			$this->db->limit(1);
			$db = $this->db->get("userdata");
		}else{
			$this->load->view("admin/login");
		}
	}
	public function auth(){
		if(isset($_POST["username"])){
			$this->db->where("username",$_POST["username"]);
			$db = $this->db->get("userdata");
			
			if($db->num_rows() > 0){
				foreach($db->result() as $r){
					if($_POST["pass"] == $this->func->decode($r->pass)){
						$this->session->set_userdata("isMasok",true);
						$this->session->set_userdata("usrid",$r->id);
						
						echo json_encode(array("success"=>true,"name"=>$_POST["username"]));
					}else{
						echo json_encode(array("success"=>false));
					}
				}
			}else{
				echo json_encode(array("success"=>false));
			}
		}else{
			echo json_encode(array("success"=>false));
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		
		redirect("ngadimin/login");
	}
}
