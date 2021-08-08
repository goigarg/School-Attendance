<?php

class Student {

    public $id;
    public $name;
    public $roll_no;
    public $course;
    public $semester;
    public $branch;
    public $student_id;
    
    public function addStudent($conn) {
        $sql = "INSERT INTO students (name, roll_no, course, semester, branch) VALUES (:name, :roll_no, :course, :semester, :branch)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':roll_no', $this->roll_no, PDO::PARAM_INT);
        $stmt->bindValue(':course', $this->course, PDO::PARAM_STR);
        $stmt->bindValue(':semester', $this->semester, PDO::PARAM_STR);
        $stmt->bindValue(':branch', $this->branch, PDO::PARAM_STR);

        //return object instead of array 
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Student');

        if ($stmt->execute()) {
            $this->id = $conn->lastInsertId();
            return true;
        }

    }


    public static function getStudents($conn) {
        $sql = "SELECT *,students.id as studentid FROM students";
        $stmt = $conn->prepare($sql);

        if($stmt->execute()) { 
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public static function presentStudents($conn, $date) {
        $sql = "SELECT students.id, present FROM students 
        LEFT JOIN attendance
        ON students.id = student_id
        WHERE date = :date";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':date', $date, PDO::PARAM_STR);

        if($stmt->execute()) { 
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $presentStudents = [];
            $absentStudents = [];

            foreach($result as $p) {
                if ($p['present'] == 1) {
                    array_push($presentStudents, $p['id']);
                }
                if ($p['present'] == 2) {
                    array_push($absentStudents, $p['id']);
                }
            }
            return [$presentStudents,$absentStudents];
        }
    }

    
    public function getStudentsbyDate($conn, $date) {
        $sql = "SELECT * FROM students RIGHT JOIN attendance ON students.id = student_id WHERE date = :date";
        $stmt = $conn->prepare($sql);


        $stmt->bindValue(':date', $date, PDO::PARAM_STR);

        if($stmt->execute()) { 
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public static function markAttendance($conn,$student_id, $ispresent) {

        $date = date('Y-m-d');

        $sql = "INSERT INTO attendance (student_id, date, present) VALUES (:student_id, :date, :present)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindValue(':student_id', $student_id, PDO::PARAM_INT);
        $stmt->bindValue(':date', $date, PDO::PARAM_STR);
        $stmt->bindValue(':present', $ispresent, PDO::PARAM_INT);

        //return object instead of array 
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Student');

        return $stmt->execute();

    }
    public static function removeStudent($conn, $student_id) {
   
        $sql = "DELETE FROM students WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $student_id, PDO::PARAM_INT);

        $alter = $conn->prepare("ALTER TABLE students AUTO_INCREMENT = :id");
        $alter->bindValue(':id', $conn->lastInsertId(), PDO::PARAM_INT);
        
        if($stmt->execute()) {
            return $alter->execute();
        }
    }

    public static function removeAttendance($conn, $student_id, $date) {
        $sql = "DELETE FROM attendance WHERE student_id = :id AND date = :date";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $student_id, PDO::PARAM_INT);
        $stmt->bindValue(':date',$date, PDO::PARAM_STR);

        $alter = $conn->prepare("ALTER TABLE students AUTO_INCREMENT = :id");
        $alter->bindValue(':id', $conn->lastInsertId(), PDO::PARAM_INT);
        
        if($stmt->execute()) {
            return $alter->execute();
        }
    }

}