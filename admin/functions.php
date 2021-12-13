<?php
require_once("../config.php");


function authLogin($user = "", $pass = "")
{
    global $con;

    $sql = "SELECT nim FROM table_users WHERE nim = :user AND password = :pass AND role = 1";

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

function row_student()
{
    global $con;

    $nRows = $con->query('select count(*) from table_users where role = 0')->fetchColumn();
    return $nRows;
}

function row_lecturer()
{
    global $con;

    $nRows = $con->query('select count(*) from table_users where role = 2')->fetchColumn();
    return $nRows;
}

function row_subjects()
{
    global $con;

    $nRows = $con->query('select count(*) from table_subjects')->fetchColumn();
    return $nRows;
}

function select_data($user = "")
{
    global $con;

    $hasil = array();

    if ($user != "") $sql = "SELECT * FROM table_users WHERE role = 0 AND nim = :user ORDER BY nim";
    else $sql = "SELECT * FROM table_users WHERE role = 0 ORDER BY nim";

    try {
        $stmt = $con->prepare($sql);
        if ($user != "") $stmt->bindValue(':user', $user, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $rs = $stmt->fetchAll();

            if ($rs != null) {
                $i = 0;
                foreach ($rs as $val) {
                    $hasil[$i]['nim'] = $val['nim'];
                    $hasil[$i]['name'] = $val['name'];
                    $hasil[$i]['address'] = $val['address'];
                    $hasil[$i]['origin'] = $val['origin'];
                    $hasil[$i]['contact'] = $val['contact'];
                    $i++;
                }
            }
        }
    } catch (Exception $e) {
        echo 'Error select_data : ' . $e->getMessage();
    }

    return $hasil;
}

function insert_data($data)
{
    global $con;

    if ($data != null) {
        try {
            $sql = "INSERT INTO table_users VALUES (:nim, :password, :name, :address, :origin, :contact, 0)";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':nim', $data['nim'], PDO::PARAM_STR);
            $stmt->bindValue(':password', $data['pass'], PDO::PARAM_STR);
            $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindValue(':address', $data['address'], PDO::PARAM_STR);
            $stmt->bindValue(':origin', $data['origin'], PDO::PARAM_STR);
            $stmt->bindValue(':contact', $data['contact'], PDO::PARAM_STR);

            if ($stmt->execute()) return true;
            else return false;
        } catch (Exception $e) {
            echo 'Error insert_data : ' . $e->getMessage();
            return false;
        }
    } else {
        return false;
    }
}

function update_data($nim = "", $data)
{
    global $con;

    if ($data != null) {
        try {
            $sql = "UPDATE table_users SET name = :name, address = :address, origin = :origin, contact = :contact WHERE nim = :nim";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':nim', $nim, PDO::PARAM_STR);
            $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindValue(':address', $data['address'], PDO::PARAM_STR);
            $stmt->bindValue(':origin', $data['origin'], PDO::PARAM_STR);
            $stmt->bindValue(':contact', $data['contact'], PDO::PARAM_STR);

            if ($stmt->execute()) return true;
            else return false;
        } catch (Exception $e) {
            echo 'Error update_data : ' . $e->getMessage();
            return false;
        }
    } else {
        return false;
    }
}

function delete_data($nim = "")
{
    global $con;

    if ($nim != null) {
        try {
            $sql = "DELETE FROM table_users WHERE nim = :nim";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':nim', $nim, PDO::PARAM_STR);

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

function select_lecturer($user = "")
{
    global $con;

    $hasil = array();

    if ($user != "") $sql = "SELECT * FROM table_users WHERE role = 2 AND nim = :user ORDER BY nim";
    else $sql = "SELECT * FROM table_users WHERE role = 2 ORDER BY nim";

    try {
        $stmt = $con->prepare($sql);
        if ($user != "") $stmt->bindValue(':user', $user, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $rs = $stmt->fetchAll();

            if ($rs != null) {
                $i = 0;
                foreach ($rs as $val) {
                    $hasil[$i]['nim'] = $val['nim'];
                    $hasil[$i]['name'] = $val['name'];
                    $hasil[$i]['address'] = $val['address'];
                    $hasil[$i]['origin'] = $val['origin'];
                    $hasil[$i]['contact'] = $val['contact'];
                    $i++;
                }
            }
        }
    } catch (Exception $e) {
        echo 'Error select_data : ' . $e->getMessage();
    }

    return $hasil;
}

function insert_lecturer($data)
{
    global $con;

    if ($data != null) {
        try {
            $sql = "INSERT INTO table_users VALUES (:nim, :password, :name, :address, :origin, :contact, 2)";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':nim', $data['nim'], PDO::PARAM_STR);
            $stmt->bindValue(':password', $data['pass'], PDO::PARAM_STR);
            $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindValue(':address', $data['address'], PDO::PARAM_STR);
            $stmt->bindValue(':origin', $data['origin'], PDO::PARAM_STR);
            $stmt->bindValue(':contact', $data['contact'], PDO::PARAM_STR);

            if ($stmt->execute()) return true;
            else return false;
        } catch (Exception $e) {
            echo 'Error insert_data : ' . $e->getMessage();
            return false;
        }
    } else {
        return false;
    }
}

function update_lecturer($nim = "", $data)
{
    global $con;

    if ($data != null) {
        try {
            $sql = "UPDATE table_users SET name = :name, address = :address, origin = :origin, contact = :contact WHERE nim = :nim";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':nim', $nim, PDO::PARAM_STR);
            $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindValue(':address', $data['address'], PDO::PARAM_STR);
            $stmt->bindValue(':origin', $data['origin'], PDO::PARAM_STR);
            $stmt->bindValue(':contact', $data['contact'], PDO::PARAM_STR);

            if ($stmt->execute()) return true;
            else return false;
        } catch (Exception $e) {
            echo 'Error update_data : ' . $e->getMessage();
            return false;
        }
    } else {
        return false;
    }
}

function delete_lecturer($nim = "")
{
    global $con;

    if ($nim != null) {
        try {
            $sql = "DELETE FROM table_users WHERE nim = :nim";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':nim', $nim, PDO::PARAM_STR);

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

function select_subject($user = "")
{
    global $con;

    $hasil = array();

    if ($user != "") $sql = "SELECT * FROM table_subjects WHERE code = :user";
    else $sql = "SELECT * FROM table_subjects";

    try {
        $stmt = $con->prepare($sql);
        if ($user != "") $stmt->bindValue(':user', $user, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $rs = $stmt->fetchAll();

            if ($rs != null) {
                $i = 0;
                foreach ($rs as $val) {
                    $hasil[$i]['code'] = $val['code'];
                    $hasil[$i]['name'] = $val['name'];
                    $hasil[$i]['major'] = $val['major'];
                    $hasil[$i]['sks_a'] = $val['sks_a'];
                    $hasil[$i]['sks_b'] = $val['sks_b'];
                    $i++;
                }
            }
        }
    } catch (Exception $e) {
        echo 'Error select_data : ' . $e->getMessage();
    }

    return $hasil;
}

function insert_subject($data)
{
    global $con;

    if ($data != null) {
        try {
            $sql = "INSERT INTO table_subjects VALUES (:code, :name, :major, :sks_a, :sks_b)";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':code', $data['code'], PDO::PARAM_STR);
            $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindValue(':major', $data['major'], PDO::PARAM_STR);
            $stmt->bindValue(':sks_a', $data['sks_a'], PDO::PARAM_STR);
            $stmt->bindValue(':sks_b', $data['sks_b'], PDO::PARAM_STR);

            if ($stmt->execute()) return true;
            else return false;
        } catch (Exception $e) {
            echo 'Error insert_data : ' . $e->getMessage();
            return false;
        }
    } else {
        return false;
    }
}

function update_subject($code = "", $data)
{
    global $con;

    if ($data != null) {
        try {
            $sql = "UPDATE table_subjects SET name = :name, major = :major, sks_a = :sks_a, sks_b = :sks_b";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':code', $code, PDO::PARAM_STR);
            $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindValue(':major', $data['major'], PDO::PARAM_STR);
            $stmt->bindValue(':sks_a', $data['sks_a'], PDO::PARAM_STR);
            $stmt->bindValue(':sks_b', $data['sks_b'], PDO::PARAM_STR);

            if ($stmt->execute()) return true;
            else return false;
        } catch (Exception $e) {
            echo 'Error update_data : ' . $e->getMessage();
            return false;
        }
    } else {
        return false;
    }
}

function delete_subject($code = "")
{
    global $con;

    if ($code != null) {
        try {
            $sql = "DELETE FROM table_subjects WHERE code = :code";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':code', $code, PDO::PARAM_STR);

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
    $sql =
        "SELECT table_classes.*, table_subjects.name AS lecture 
    FROM table_classes 
    LEFT JOIN table_subjects 
    ON table_subjects.code = table_classes.subject_id 
    WHERE table_classes.is_active = 1
    ORDER BY table_classes.name";

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
                    $hasil[$i]['schedule'] = $val['day'] . ' , ' . $val['start_time'] . ' - ' . $val['end_time'];
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
