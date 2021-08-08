<?php 
require 'includes/init.php'; 
require 'includes/head.php';
?>
<?php
$db = new Database;
$conn = $db->getConn();

$students = Student::getStudents($conn);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST['P']) {
        $student_id = $_POST['P'];
        echo Student::markAttendance($conn, $student_id);
    }
    if ($_POST['A']) {
        var_dump($_POST['A'], "A");
    }
}

?>


    <!-- Table -->
    <section id="table">
        <div class="container-fluid">
            <h3>Mark Attandance 30-07-2021</h3>
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
                    <td><?= $student['id'] ?></td>
                    <td><?= $student['name'] ?></td>
                    <td><?= $student['roll_no'] ?></td>
                    <td><?= $student['course'] ?></td>
                    <td><?= $student['semester'] ?></td>
                    <td><?= $student['branch'] ?></td>
                    <td>
                        <form method="post">
                            <button name="P" value="<?= $student['id'] ?>" class="btn btn-sm btn-primary">P</button>
                            <!--<button name="A" value="<?= $student['id'] ?>" class="btn btn-sm btn-danger">A</button> -->
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