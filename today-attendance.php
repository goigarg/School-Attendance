<?php 
require 'includes/init.php'; 
require 'includes/head.php';
?>
<?php
$db = new Database;
$conn = $db->getConn();

$date = date('Y-m-d');

$students = Student::getStudents($conn);

//get list of present students
$present = Student::presentStudents($conn, $date);


$presentStudents = $present[0];
$absentStudents = $present[1];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST['P']) {
        $student_id = $_POST['P'];
        if(Student::markAttendance($conn, $student_id, 1)) {
            //sucess
            header("refresh: 0;");
        } else {
            echo "Error";
        }

    }
    if ($_POST['A']) {

        $student_id = $_POST['A'];

        if(Student::markAttendance($conn, $student_id, 2)) {
            header("refresh: 0;");
        } else {
            echo "Error";
        }

    }
}

?>


    <!-- Table -->
    <section id="table">
        <div class="container-fluid">
            <h3>Mark Attandance <?= date("F d, Y", strtotime($date)); ?></h3>
        </div>
        <div class="container-fluid">
            <table class="table">
                <tr>
                    <th>Sr. No</th>
                    <th>Name</th>
                    <th>Roll no</th>
                    <th>Course</th>
                    <th>Semester</th>
                    <th>Branch</th>
                    <th>Attandance</th>
                </tr>
                <?php foreach($students as $student): ?>
                <tr>
                    <td><?= $student['studentid'] ?></td>
                    <td><?= $student['name'] ?></td>
                    <td><?= $student['roll_no'] ?></td>
                    <td><?= $student['course'] ?></td>
                    <td><?= $student['semester'] ?></td>
                    <td><?= $student['branch'] ?></td>
                    <td>
                        <form method="post">
                            <!-- True if student is in present array -->
                            <?php if (in_array($student["id"], $presentStudents)){
                                echo '<a class="btn btn-sm btn-success text-white">Present</a>';
                            } elseif (in_array($student["id"], $absentStudents)) {
                                echo '<a class="btn btn-sm btn-danger text-white">Absent</a>';
                            } else {
                                echo '<button name="P" value="'. $student["id"] . '" class="btn btn-sm btn-primary">P</button> ';
                                echo '<button name="A" value="'. $student["id"] . '" class="btn btn-sm btn-danger">A</button>';
                            }
                            ?>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </section>
<?php
require 'includes/foot.php';
?>