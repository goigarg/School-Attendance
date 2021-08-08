<?php

require 'includes/init.php';
require 'includes/head.php';

$db = new Database();
$conn = $db->getConn();
$student = new Student();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $error = [];

    if (!empty($_POST['add'])) {
        $student->name  = $_POST['name'];
        $student->roll_no  = $_POST['roll_no'];
        $student->course  = $_POST['course'];
        $student->semester  = $_POST['semester'];
        $student->branch  = $_POST['branch'];
    
        $student->addStudent($conn);
        
        echo "Student added with id " . $student->id;    
    }
}




?>

    <!-- Add Student -->
    <section id="student">
    <div class="container-fluid">
        <div class="col-8">
            <h4>Add New Student</h4> 
        </div>


    </div>
   

    <form method="post">
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-8"> 
                    <input type="text" name="name" placeholder="Student Name" class="form-control" required>
                </div>
                <div class="col-4">
                    <input type="number" name="roll_no"  placeholder="Student Roll No" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-4">
                    <input list="course" name="course" class="form-control" placeholder="Course" required>
                        <datalist id="course">
                            <option value="BTECH" name="1">
                            <option value="BSC">
                        </datalist>
                </div>
                <div class="col-4">
                     <input list="semester" name="semester" class="form-control" placeholder="Semester">
                        <datalist id="semester">
                            <option value="I">
                            <option value="II">
                        </datalist>
                </div>
                <div class="col-4">
                     <input list="branch" name="branch" class="form-control" placeholder="Branch">
                        <datalist id="branch">
                            <option value="CSE">
                            <option value="IT">
                        </datalist>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <button class="btn btn-dark w-25" name="add" value="true">Add Student</button>
        </div>
    </form>
    </section>
    <hr>

    <?php include('includes/lateststudents.php'); ?>

    
<?php require('includes/foot.php'); ?>