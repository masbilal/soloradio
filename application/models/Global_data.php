<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem !! ');
class Global_data extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

	function globalset($data){
		$res = array(
			"nama"	=> "AllBatik"
		);
		return $res[$data];
	}

	function maintenis(){
		//return true;
		return false;
	}
	
	function kategori($id=0){
		$data = array(
			1	=> "Make It Digital",
			2	=> "Famous Update",
			3	=> "FIT Update",
			4	=> "Fashionable Update",
			5	=> "Event",
		);
		
		if($id > 0){
			return $data[$id];
		}else{
			return $data;
		}
	}
	
	// GET HOME STAT
	function getFamousUpdate(){
		$this->db->where("kategori",2);
		$this->db->limit(1);
		$this->db->order_by("id DESC");
		$db = $this->db->get("postingan");
		
		$result = "No Updates";
		foreach($db->result() as $r){
			$result = $r->judul;
		}
		
		return $result;
	}
	function getFitUpdate(){
		$this->db->where("kategori",3);
		$this->db->limit(1);
		$this->db->order_by("id DESC");
		$db = $this->db->get("postingan");
		
		$result = "No Updates";
		foreach($db->result() as $r){
			$result = $r->judul;
		}
		
		return $result;
	}
	function getFashionableUpdate(){
		$this->db->where("kategori",4);
		$this->db->limit(1);
		$this->db->order_by("id DESC");
		$db = $this->db->get("postingan");
		
		$result = "No Updates";
		foreach($db->result() as $r){
			$result = $r->judul;
		}
		
		return $result;
	}

	// GET PROGRAM
	function getProgramUtama(){
		$this->db->where("utama",1);
		$this->db->limit(1);
		$res = $this->db->get("program");

		$result = null;
		foreach($res->result() as $re){
			$result = base_url("assets/uploads/".$re->foto);
		}
		return $result;
	}
	function getProgram($id,$what,$opo="id"){
		$this->db->where($opo,$id);
		$this->db->limit(1);
		$res = $this->db->get("program");

		if($what == "semua"){
			$result = array();
			foreach($res->result() as $key => $value){
				$result[$key] = $value;
			}
			$result = $result[0];
		}else{
			$result = null;
			foreach($res->result() as $re){
				$result = $re->$what;
			}
		}
		return $result;
	}

	// GET PENYIAR
	function getPenyiar($id,$what,$opo="id"){
		$this->db->where($opo,$id);
		$this->db->limit(1);
		$res = $this->db->get("penyiar");

		if($what == "semua"){
			$result = array();
			foreach($res->result() as $key => $value){
				$result[$key] = $value;
			}
			$result = $result[0];
		}else{
			$result = null;
			foreach($res->result() as $re){
				$result = $re->$what;
			}
		}
		return $result;
	}

	// GET POSTINGAN
	function getPostingan($id,$what,$opo="id"){
		$this->db->where($opo,$id);
		$this->db->limit(1);
		$res = $this->db->get("postingan");

		if($what == "semua"){
			$result = array();
			foreach($res->result() as $key => $value){
				$result[$key] = $value;
			}
			$result = $result[0];
		}else{
			$result = null;
			foreach($res->result() as $re){
				$result = $re->$what;
			}
		}
		return $result;
	}

	// GET USERDATA
	function getProfil($id,$what,$opo="id"){
		$this->db->where($opo,$id);
		$this->db->limit(1);
		$res = $this->db->get("profil");

		if($what == "semua"){
			$result = array();
			foreach($res->result() as $key => $value){
				$result[$key] = $value;
			}
			$result = $result[0];
		}else{
			$result = null;
			foreach($res->result() as $re){
				$result = $re->$what;
			}
		}
		return $result;
	}
	function getUser($id,$what,$opo="id"){
		$this->db->where($opo,$id);
		$this->db->limit(1);
		$res = $this->db->get("userdata");

		if($what == "semua"){
			$result = array();
			foreach($res->result() as $key => $value){
				$result[$key] = $value;
			}
			$result = $result[0];
		}else{
			$result = null;
			foreach($res->result() as $re){
				$result = $re->$what;
			}
		}
		return $result;
	}
	
	/* PLAYLIST */
	function getPlaylist($id,$what,$opo="id"){
		$this->db->where($opo,$id);
		$this->db->limit(1);
		$res = $this->db->get("topsong");

		if($what == "semua"){
			$result = array();
			foreach($res->result() as $key => $value){
				$result[$key] = $value;
			}
			$result = $result[0];
		}else{
			$result = null;
			foreach($res->result() as $re){
				$result = $re->$what;
			}
		}
		return $result;
	}
	function getJmlLagu($pl){
		$this->db->where("topid",$pl);
		$db = $this->db->get("song");
		
		return $db->num_rows();
	}

	// USABLE FUNCTION
	function cleanURL($url){
		$string = str_replace(' ', '-', $url);
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
	}
	function encode($string){
		return $this->encryption->encrypt($string);
	}
	function decode($string){
		return $this->encryption->decrypt($string);
	}
	function potong($str,$max,$after=""){
		if(strlen($str) > $max){
			$str = substr($str, 0, $max);
			$str = rtrim($str).$after;
		}
		return $str;
	}
	function formUang($format){
		$result= number_format($format,0,",",".");
		return $result;
	}
	function ubahTgl($format, $tanggal="now", $bahasa="id"){
		$en = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		$id = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

		return str_replace($en,$$bahasa,date($format,strtotime($tanggal)));
	}
	function arrEnc($arr,$type="encode"){
		if($type == "encode"){
			$result = base64_encode(serialize($arr));
		}else{
			$result = unserialize(base64_decode($arr));
		}
		return $result;
	}
	function starRating($star=1){
		$star = "<i class='fa fa-star'></i>";
		$staro = "<i class='fa fa-star-o'></i>";
		$starho = "<i class='fa fa-star-half-o'></i>";
		if($star == 1){
			$hasil = $star.$staro.$staro.$staro.$staro;
		}
	}
	function createPagination($rows,$page,$perpage=10,$function="refreshTabel"){
		$tpages = ceil($rows/$perpage);
		$reload = "";
        $adjacents = 2;
		$prevlabel = "&lsaquo;";
		$nextlabel = "&rsaquo;";
		$out = "<div class=\"pagination\">";
		// previous
		if ($page == 1) {
			$out.= "";
		} else {
			$out.="<a href=\"javascript:void(0)\" class='item' onclick=\"".$function."(1)\">&laquo;</a>\n";
			$out.="<a href=\"javascript:void(0)\" class='item' onclick=\"".$function."(".($page - 1).")\">".$prevlabel."</a>\n";
		}
		$pmin=($page>$adjacents)?($page - $adjacents):1;
		$pmax=($page<($tpages - $adjacents))?($page + $adjacents):$tpages;
		for ($i = $pmin; $i <= $pmax; $i++) {
			if ($i == $page) {
				$out.= "<a href=\"javascript:void(0)\" class='item active'>".$i."</a>\n";
			} elseif ($i == 1) {
				$out.= "<a href=\"javascript:void(0)\" class='item' onclick=\"".$function."(".$i.")\">".$i."</a>\n";
			} else {
				$out.= "<a href=\"javascript:void(0)\" class='item' onclick=\"".$function."(".$i.")\">".$i. "</a>\n";
			}
		}

		// next
		if ($page < $tpages) {
			$out.= "<a href=\"javascript:void(0)\" onclick=\"".$function."(".($page + 1).")\" class='item'>".$nextlabel."</a>\n";
		}
		if($page < ($tpages - $adjacents)) {
			$out.= "<a href=\"javascript:void(0)\" onclick=\"".$function."(".$tpages.")\" class='item'>&raquo;</a>\n";
		}
		$out.= "</div>";
		return $out;
	}
}
