<?php
require_once "config.php";

// AUTH
function check_login($user = "", $pass = "")
{
	global $con;

	$sql = "SELECT nim FROM table_users WHERE nim = :user AND password = :pass AND role = 0";

	try {
		$stmt = $con->prepare($sql);
		$stmt->bindValue(':user', $user, PDO::PARAM_STR);
		$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);

		if ($stmt->execute()) {
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$rs = $stmt->fetch();

			if ($rs != null) {
				return $rs['nim'];
			}
		}
	} catch (Exception $e) {
		echo 'Error select_data : ' . $e->getMessage();
	}
}

function get_user_by_nim($nim = "")
{
	global $con;

	$sql = "SELECT * FROM table_users WHERE nim = :nim";

	try {
		$stmt = $con->prepare($sql);
		$stmt->bindValue(':nim', $nim, PDO::PARAM_STR);

		if ($stmt->execute()) {
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$rs = $stmt->fetch();

			if ($rs != null) {
				return $rs;
			}
		}
	} catch (Exception $e) {
		echo 'Error validateIsClassExists : ' . $e->getMessage();
	}
}

// MATKUL
function get_available_classes_by_id($nim = "")
{
	global $con;
	$hasil = array();

	$code = substr($nim, 0, 2) . '%';
	$sql = "SELECT 
	table_classes.*, 
	table_subjects.name AS matkul, 
	table_users.name AS lecturer
	FROM table_classes 
	INNER JOIN table_subjects 
	ON table_subjects.major LIKE :code 
	AND table_subjects.code = table_classes.subject_id
	INNER JOIN table_users
  ON table_users.nim = table_classes.lecturer_id
	WHERE table_classes.is_active = 1 
	GROUP BY name";

	try {
		$stmt = $con->prepare($sql);
		$stmt->bindValue(':code', $code, PDO::PARAM_STR);

		if ($stmt->execute()) {
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$rs = $stmt->fetchAll();

			if ($rs != null) {
				$i = 0;
				foreach ($rs as $val) {
					$hasil[$i]['id'] = $val['id'];
					$hasil[$i]['subject_id'] = $val['subject_id'];
					$hasil[$i]['lecturer'] = $val['lecturer'];
					$hasil[$i]['name'] = $val['name'];
					$hasil[$i]['room'] = $val['room'];
					$hasil[$i]['day'] = $val['day'];
					$hasil[$i]['start_time'] = $val['start_time'];
					$hasil[$i]['end_time'] = $val['end_time'];
					$hasil[$i]['size'] = $val['size'];
					$hasil[$i]['matkul'] = $val['matkul'];
					$i++;
				}
			}
		}
	} catch (Exception $e) {
		echo 'Error validateIsClassExists : ' . $e->getMessage();
	}

	return $hasil;
}

function on_user_register_class($class_id, $size, $nim, $code)
{
	global $con;

	// VALIDATIONS
	if ($class_id == null || $size == null || $nim == null || $code == null) {
		return false;
	}

	if ($size == 0) {
		return false;
	}

	if (validate_class_users($code)) {
		return false;
	}

	if (validate_schedule($class_id, $nim)) {
		return false;
	}

	// LOGIC
	try {
		$newSize = $size - 1;
		$year = (date("Y") - 1) . ' - ' . date("Y");
		$semester = "";
		if (date('m') > 8) {
			$semester = '1';
		} else if (date('m') > 4) {
			$semester = '3';
		} else {
			$semester = '2';
		};
		$year_taken = $year . ' / ' . $semester;

		// UPDATE CLASS SIZE
		$update = "UPDATE table_classes SET size = :newSize WHERE id = :class_id; ";

		$stmt_update = $con->prepare($update);

		$stmt_update->bindValue(':newSize', $newSize, PDO::PARAM_INT);
		$stmt_update->bindValue(':class_id', $class_id, PDO::PARAM_INT);

		// INSERT NEW VALUE
		$insert = "INSERT INTO table_class_users VALUES (NULL, :class_id, :nim, 'B', NULL, 0, :year_taken)";

		$stmt_insert = $con->prepare($insert);

		$stmt_insert->bindValue(':class_id', $class_id, PDO::PARAM_INT);
		$stmt_insert->bindValue(':nim', $nim, PDO::PARAM_STR);
		$stmt_insert->bindValue(':year_taken', $year_taken, PDO::PARAM_STR);

		if ($stmt_insert->execute() && $stmt_update->execute()) {
			return true;
		} else return false;
	} catch (Exception $e) {
		echo 'Error add_class : ' . $e->getMessage();
		return false;
	}
}

// KST
function get_student_schedule($nim)
{
	global $con;
	$hasil = array();

	$sql = "SELECT 
	table_classes.*, 
	table_subjects.name AS lecture, 
	table_subjects.sks_a, 
	table_subjects.sks_b, 
	table_class_users.status, 
	table_class_users.id AS class_user_id,
	table_users.name AS lecturer
	FROM table_classes
	INNER JOIN table_class_users
	ON table_class_users.student_id = :nim
  AND table_classes.id = table_class_users.class_id
  INNER JOIN table_subjects
	ON table_subjects.code = table_classes.subject_id
  INNER JOIN table_users
	ON table_users.nim = table_classes.lecturer_id
	WHERE table_classes.is_active = 1";

	try {
		$stmt = $con->prepare($sql);
		$stmt->bindValue(':nim', $nim, PDO::PARAM_STR);

		if ($stmt->execute()) {
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$rs = $stmt->fetchAll();

			if ($rs != null) {
				$i = 0;
				foreach ($rs as $val) {
					$hasil[$i]['id'] = $val['id'];
					$hasil[$i]['subject_id'] = $val['subject_id'];
					$hasil[$i]['lecturer_id'] = $val['lecturer_id'];
					$hasil[$i]['name'] = $val['name'];
					$hasil[$i]['lecture'] = $val['lecture'];
					$hasil[$i]['room'] = $val['room'];
					$hasil[$i]['day'] = $val['day'];
					$hasil[$i]['start_time'] = $val['start_time'];
					$hasil[$i]['end_time'] = $val['end_time'];
					$hasil[$i]['sks_a'] = $val['sks_a'];
					$hasil[$i]['sks_b'] = $val['sks_b'];
					$hasil[$i]['status'] = $val['status'] == 'B' ? 'B' : 'U';
					$hasil[$i]['lecturer'] = $val['lecturer'];
					$hasil[$i]['class_user_id'] = $val['class_user_id'];
					$i++;
				}
			}
		}
	} catch (Exception $e) {
		echo 'Error validateIsClassExists : ' . $e->getMessage();
	}

	return $hasil;
}

function delete_schedule($class_id, $class_user_id)
{
	global $con;

	// VALIDATION
	if ($class_id == null || $class_user_id == null) {
		return false;
	}

	try {
		// GET CLASS SIZE
		$size = "SELECT size FROM table_classes WHERE id = :class_id LIMIT 1";
		$stmt_size = $con->prepare($size);
		$stmt_size->bindValue(':class_id', $class_id, PDO::PARAM_INT);

		$newSize = 0;

		if ($stmt_size->execute()) {
			$stmt_size->setFetchMode(PDO::FETCH_ASSOC);
			$rs = $stmt_size->fetch();

			if ($rs != null) {
				$newSize = $rs['size'] + 1;
			}
		}

		// UPDATE CLASS SIZE
		$update = "UPDATE table_classes SET size = :newSize WHERE id = :class_id";

		$stmt_update = $con->prepare($update);

		$stmt_update->bindValue(':newSize', $newSize, PDO::PARAM_INT);
		$stmt_update->bindValue(':class_id', $class_id, PDO::PARAM_INT);

		// DELETE CLASS-USER
		$delete = "DELETE FROM table_class_users WHERE id = :class_user_id";
		$stmt_delete = $con->prepare($delete);
		$stmt_delete->bindValue(':class_user_id', $class_user_id, PDO::PARAM_INT);

		if ($stmt_update->execute() && $stmt_delete->execute()) return true;
		else return false;
	} catch (Exception $e) {
		echo 'Error delete_data : ' . $e->getMessage();
		return false;
	}
}

// TRANSKRIP
function get_student_marks($nim)
{
	global $con;
	$hasil = array();

	$sql = "SELECT 
	table_classes.name,
	table_subjects.code,
	table_subjects.sks_a,
  table_subjects.name AS lecture,
	table_class_users.mark,
  table_class_users.year_taken
	FROM table_classes
	INNER JOIN table_class_users
	ON table_class_users.student_id = :nim
  AND table_classes.id = table_class_users.class_id
  INNER JOIN table_subjects
	ON table_subjects.code = table_classes.subject_id
  INNER JOIN table_users
	ON table_users.nim = table_classes.lecturer_id
	WHERE table_classes.is_active = 0";

	try {
		$stmt = $con->prepare($sql);
		$stmt->bindValue(':nim', $nim, PDO::PARAM_STR);

		if ($stmt->execute()) {
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$rs = $stmt->fetchAll();

			if ($rs != null) {
				$i = 0;
				foreach ($rs as $val) {
					$hasil[$i]['code'] = $val['code'];
					$hasil[$i]['name'] = $val['name'];
					$hasil[$i]['lecture'] = $val['lecture'];
					$hasil[$i]['sks_a'] = $val['sks_a'];
					$hasil[$i]['mark'] = $val['mark'] ? $val['mark'] : 'N/A';
					$hasil[$i]['credit'] = get_credit_by_mark($val['mark'], $val['sks_a']);
					$hasil[$i]['year_taken'] = $val['year_taken'];
					$i++;
				}
			}
		}
	} catch (Exception $e) {
		echo 'Error validateIsClassExists : ' . $e->getMessage();
	}

	return $hasil;
}

// VALIDATIONS
function validate_class_users($code)
{
	global $con;

	$sql = "SELECT table_classes.id 
	FROM table_classes
	INNER JOIN table_class_users 
	ON table_class_users.class_id = table_classes.id 
	WHERE table_classes.subject_id = :code
	LIMIT 1";

	try {
		$stmt = $con->prepare($sql);
		$stmt->bindValue(':code', $code, PDO::PARAM_STR);

		if ($stmt->execute()) {
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$rs = $stmt->fetch();

			if ($rs != null) {
				return true;
			}
		}
	} catch (Exception $e) {
		echo 'Error validateIsClassExists : ' . $e->getMessage();
	}

	return false;
}

function validate_schedule($class_id, $nim)
{
	global $con;

	$student_classes = get_student_classes($nim);
	$class = get_class_by_id($class_id);

	$result = false;

	foreach ($student_classes as $key => $val) {
		$result = compare_schedule($val, $class);
	}

	return $result;
}

// HELPERS
function get_student_classes($nim)
{
	global $con;
	$hasil = array();

	$sql = "SELECT 
	table_classes.* 
	FROM table_classes
	INNER JOIN table_class_users
	ON table_class_users.student_id = :nim
  AND table_classes.id = table_class_users.class_id
  WHERE table_classes.is_active = 1";

	try {
		$stmt = $con->prepare($sql);
		$stmt->bindValue(':nim', $nim, PDO::PARAM_STR);

		if ($stmt->execute()) {
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$rs = $stmt->fetchAll();

			if ($rs != null) {
				$i = 0;
				foreach ($rs as $val) {
					$hasil[$i]['day'] = $val['day'];
					$hasil[$i]['start_time'] = $val['start_time'];
					$hasil[$i]['end_time'] = $val['end_time'];
					$i++;
				}
			}
		}
	} catch (Exception $e) {
		echo 'Error validateIsClassExists : ' . $e->getMessage();
	}

	return $hasil;
}

function get_class_by_id($class_id)
{
	global $con;

	$sql = "SELECT * FROM table_classes WHERE id = :class_id LIMIT 1";

	try {
		$stmt = $con->prepare($sql);
		$stmt->bindValue(':class_id', $class_id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$rs = $stmt->fetch();

			if ($rs != null) {
				return $rs;
			}
		}
	} catch (Exception $e) {
		echo 'Error validateIsClassExists : ' . $e->getMessage();
	}
}

function compare_schedule($main, $secondary)
{
	// TRUE = SALAH
	if (strcmp($main['day'], $secondary['day']) != 0) {
		return true;
	}

	if (
		strtotime($main['start_time']) <= strtotime($secondary['start_time']) ||
		strtotime($main['end_time']) >= strtotime($secondary['start_time'])
	) {
		return true;
	}

	return false;
}

function get_credit_by_mark($mark, $sks)
{
	switch ($mark) {
		case 'A':
			return $sks * 4;
			break;
		case 'AB':
			return ceil($sks * 3.5);
			break;
		case 'B':
			return $sks * 3;
			break;
		case 'BC':
			return ceil($sks * 2.5);
			break;
		case 'C':
			return $sks * 2;
			break;
		case 'CD':
			return ceil($sks * 1.5);
			break;
		case 'D':
			return $sks * 1;
			break;
		default:
			return 0;
	}
}
