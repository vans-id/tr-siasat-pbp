<?php	 
	require_once "config.php";

	function check_login($user="", $pass=""){
		global $con;

		$sql = "select nim from table_users where nim = '$user' and password = '$pass'";
		if ($query = mysqli_query ($con,$sql)){
			if(mysqli_num_rows($query) > 0) {
				return true;
			}else {
				return false;
			}
		}else {
			return false;
		}		
	}

	function select_data($user="") {
		global $con;

		$hasil = array();
		$hasil ['nama'] = "";
		$hasil ['alamat'] = "";
		$hasil ['asal'] = "";
		$hasil ['noHp'] = "";
		$hasil ['Role'] = "";

		$sql = " select * from table_users where nim = '$user'";
		if ($query = mysqli_query ($con,$sql)){
			if(mysqli_num_rows($query) > 0) {
				$rs = mysqli_fetch_array($query);
				$hasil ['nama'] = $rs ['name'] ;
				$hasil ['alamat'] = $rs ['address'] ;
				$hasil ['asal'] = $rs ['origin'] ;
				$hasil ['noHp'] = $rs ['contact'] ;
				$hasil ['Role'] = $rs ['role'] ;
			}
		}
		return $hasil;
	}

	function select_matkul($user="") {
		global $con;

		$hasil = array();
		$hasil ['subjek'] = "";
		$hasil ['dosen'] = "";
		$hasil ['nado'] = "";
		$hasil ['ruang'] = "";
		$hasil ['hari'] = "";
		$hasil ['mulai'] = "";
		$hasil ['berakhir'] = "";
		$hasil ['ukuran'] = "";

		$sql = " select * from table_classes where nim = '$user'";
		if ($query = mysqli_query ($con,$sql)){
			if(mysqli_num_rows($query) > 0) {
				$rs = mysqli_fetch_array($query);
				$hasil ['subjek'] = $rs ['subjek_id'] ;
				$hasil ['dosen'] = $rs ['lecturer_id'] ;
				$hasil ['nado'] = $rs ['name'] ;
				$hasil ['ruang'] = $rs ['room'] ;
				$hasil ['hari'] = $rs ['day'] ;
				$hasil ['mulai'] = $rs ['start_time'] ;
				$hasil ['berakhir'] = $rs ['end_time'] ;
				$hasil ['ukuran'] = $rs ['size'] ;
			}
		}
		return $hasil;
	}

	function select_subjek($user="") {
		global $con;

		$hasil = array();
		$hasil ['kode'] = "";
		$hasil ['nama'] = "";
		$hasil ['mjr'] = "";
		$hasil ['sksa'] = "";
		$hasil ['sksb'] = "";

		$sql = "select * from table_subjects where nim = '$user'";
		if ($query = mysqli_query ($con,$sql)){
			if(mysqli_num_rows($query) > 0) {
				$rs = mysqli_fetch_array($query);
				$hasil ['kode'] = $rs ['code'] ;
				$hasil ['nama'] = $rs ['name'] ;
				$hasil ['mjr']  = $rs ['major'] ;
				$hasil ['sksa'] = $rs ['sks_a'] ;
				$hasil ['sksb'] = $rs ['sks_b'] ;
			}
		}
		return $hasil;
	}
?>

