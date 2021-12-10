<?php

require_once "config.php";

// LOGIN
function authLogin($user = "", $pass = "")
{
  global $con;

  $sql = "SELECT nim FROM table_users WHERE nim = :user AND password = :pass AND role = 2";

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

// DASHBOARD
function countClasses($lecturer_id)
{
  global $con;

  $sql = "SELECT count(*) from table_classes where lecturer_id = :lecturer_id";

  try {
    $stmt = $con->prepare($sql);
    $stmt->bindValue(':lecturer_id', $lecturer_id, PDO::PARAM_STR);

    if ($stmt->execute()) {
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $nRows = $stmt->fetchColumn();

      return $nRows;
    }
  } catch (Exception $e) {
    echo 'Error validateIsClassExists : ' . $e->getMessage();
  }
}

function countStudents($lecturer_id)
{
  global $con;

  $sql = "SELECT COUNT(*)
  FROM table_class_users 
  LEFT JOIN table_classes 
  ON table_classes.id = table_class_users.class_id 
  AND table_classes.lecturer_id = :lecturer_id";

  try {
    $stmt = $con->prepare($sql);
    $stmt->bindValue(':lecturer_id', $lecturer_id, PDO::PARAM_STR);

    if ($stmt->execute()) {
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $nRows = $stmt->fetchColumn();

      return $nRows;
    }
  } catch (Exception $e) {
    echo 'Error validateIsClassExists : ' . $e->getMessage();
  }
}

// UBAH SUBJEK
function getSubjectsByMajor($major = "")
{
  if ($major == null) {
    return "No data";
  }
  global $con;

  $result = [];

  $sql = "SELECT code FROM table_subjects WHERE major = :major";

  try {
    $stmt = $con->prepare($sql);
    $stmt->bindValue(':major', $major, PDO::PARAM_STR);

    if ($stmt->execute()) {
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $rs = $stmt->fetchAll();

      if ($rs != null) {
        foreach ($rs as $val) {
          array_push($result, $val['code']);
        }
      }
    }
  } catch (Exception $e) {
    echo 'Error getSubjectsByMajor : ' . $e->getMessage();
  }

  return $result;
}

// CLASS
function getSingleClass($id)
{
  global $con;

  $sql = "SELECT * FROM table_classes WHERE id = :id";

  try {
    $stmt = $con->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

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

function addClass($class)
{
  global $con;

  if ($class != null) {
    try {
      $sql = "INSERT INTO table_classes VALUES (NULL, :subject_id, :lecturer_id, :name, :room, :day, :start_time, :end_time, :size, 1)";
      $stmt = $con->prepare($sql);

      $stmt->bindValue(':subject_id', $class['subject_id'], PDO::PARAM_STR);
      $stmt->bindValue(':lecturer_id', $class['lecturer_id'], PDO::PARAM_STR);
      $stmt->bindValue(':name', $class['name'], PDO::PARAM_STR);
      $stmt->bindValue(':room', $class['room'], PDO::PARAM_STR);
      $stmt->bindValue(':day', $class['day'], PDO::PARAM_STR);
      $stmt->bindValue(':start_time', $class['start_time'], PDO::PARAM_STR);
      $stmt->bindValue(':end_time', $class['end_time'], PDO::PARAM_STR);
      $stmt->bindValue(':size', $class['size'], PDO::PARAM_INT);

      if ($stmt->execute()) {
        return true;
      } else return false;
    } catch (Exception $e) {
      echo 'Error addClass : ' . $e->getMessage();
      return false;
    }
  } else {
    return false;
  }
}

function getAllClasses()
{
  global $con;

  $hasil = array();
  $sql = <<<EOSQL
  SELECT table_classes.*, table_subjects.name AS lecture 
  FROM table_classes 
  LEFT JOIN table_subjects 
  ON table_subjects.code = table_classes.subject_id 
  WHERE table_classes.is_active = 1
  ORDER BY table_classes.name
  EOSQL;

  try {
    $stmt = $con->prepare($sql);

    if ($stmt->execute()) {
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $rs = $stmt->fetchAll();

      if ($rs != null) {
        $i = 0;
        foreach ($rs as $val) {
          $hasil[$i]['id'] = $val['id'];
          $hasil[$i]['subject_id'] = $val['subject_id'];
          $hasil[$i]['lecture'] = $val['lecture'];
          $hasil[$i]['name'] = $val['name'];
          $hasil[$i]['schedule'] = $val['day'] . ', ' . $val['start_time'] . ' - ' . $val['end_time'];
          $hasil[$i]['room'] = $val['room'];
          $i++;
        }
      }
    }
  } catch (Exception $e) {
    echo 'Error select_data : ' . $e->getMessage();
  }

  return $hasil;
}

function editClass($data)
{
  global $con;

  if ($data != null) {
    try {
      $sql = "UPDATE table_classes SET room = :room, day = :day, start_time = :start_time, end_time = :end_time, size = :size WHERE id = :id";
      $stmt = $con->prepare($sql);

      $stmt->bindValue(':id', $data['id'], PDO::PARAM_STR);
      $stmt->bindValue(':room', $data['room'], PDO::PARAM_STR);
      $stmt->bindValue(':day', $data['day'], PDO::PARAM_STR);
      $stmt->bindValue(':start_time', $data['start_time'], PDO::PARAM_STR);
      $stmt->bindValue(':end_time', $data['end_time'], PDO::PARAM_STR);
      $stmt->bindValue(':size', $data['size'], PDO::PARAM_INT);

      if ($stmt->execute()) return true;
      else return false;
    } catch (Exception $e) {
      echo 'Error editClass : ' . $e->getMessage();
      return false;
    }
  } else {
    return false;
  }
}

function deleteClass($id)
{
  global $con;

  if ($id != null) {
    try {
      $sql = "UPDATE table_classes SET is_active = 0 WHERE id = :id";
      // $sql = "DELETE FROM table_classes WHERE id = :id";
      $stmt = $con->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);

      if ($stmt->execute()) return true;
      else return false;
    } catch (Exception $e) {
      echo 'Error delete_data : ' . $e->getMessage();
      return false;
    }
  } else {
    return false;
  }
}

// MAHASISWA
function getAllStudents($lecturerId)
{
  global $con;

  $hasil = array();
  $sql = <<<EOSQL
  SELECT 
  table_class_users.id, 
  table_class_users.mark, 
  table_class_users.student_id,
  table_classes.subject_id, 
  table_classes.name AS class,
  table_subjects.name
  FROM table_class_users 
  INNER JOIN table_classes 
  ON table_classes.id = table_class_users.class_id 
  AND table_classes.lecturer_id = :lecturerId
  AND table_classes.is_active = 1
  INNER JOIN table_subjects 
  ON table_subjects.code = table_classes.subject_id
  ORDER BY table_classes.subject_id
  EOSQL;

  try {
    $stmt = $con->prepare($sql);
    $stmt->bindValue(':lecturerId', $lecturerId, PDO::PARAM_STR);

    if ($stmt->execute()) {
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $rs = $stmt->fetchAll();

      if ($rs != null) {
        $i = 0;
        foreach ($rs as $val) {
          $hasil[$i]['mark'] = $val['mark'] ? $val['mark'] : "";
          $hasil[$i]['student_id'] = $val['student_id'];
          $hasil[$i]['id'] = $val['id'];
          $hasil[$i]['class'] = $val['class'];
          $hasil[$i]['subject_id'] = $val['subject_id'];
          $hasil[$i]['name'] = $val['name'];
          $i++;
        }
      }
    }
  } catch (Exception $e) {
    echo 'Error select_data : ' . $e->getMessage();
  }

  return $hasil;
}

function editMark($id, $mark)
{
  global $con;

  try {
    $sql = "UPDATE table_class_users SET mark = :mark, is_taken = 1 WHERE id = :id";
    $stmt = $con->prepare($sql);

    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':mark', $mark, PDO::PARAM_STR);

    if ($stmt->execute()) return true;
    else return false;
  } catch (Exception $e) {
    echo 'Error editClass : ' . $e->getMessage();
    return false;
  }
}
