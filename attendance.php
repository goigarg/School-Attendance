<?php
require('includes/init.php');
require('includes/head.php');
?>
<?php
$db = new Database;
$conn = $db->getConn();


//Will show current date if date is not inserting via get

if ($_GET['date']) {
    $date=date_create($_GET['date']);
    $date = date_format($date, 'Y-m-d');
} else {
    $date = date("Y-m-d");
}

$students = Student::getStudents($conn);

$present = Student::presentStudents($conn, $date);


$presentStudents = $present[0];
$absentStudents = $present[1];

?>


    <!-- Table -->
    <section id="table">
        <div class="container-fluid">
            <h3>Students Present on <?= date("F d, Y", strtotime($date)); ?></h3>
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
                <?php foreach($students as $i => $student): ?>
                <tr>
                    <td><?= $student['id']; ?></td>
                    <td><?= $student['name']; ?></td>
                    <td><?= $student['roll_no']; ?></td>
                    <td><?= $student['course']; ?></td>
                    <td><?= $student['semester']; ?></td>
                    <td><?= $student['branch']; ?></td>
                    <td>
                    <?php if (in_array($student["id"], $presentStudents)){
                                echo '<a class="btn btn-sm btn-success text-white">Present</a>';
                            } elseif (in_array($student["id"], $absentStudents)) {
                                echo '<a class="btn btn-sm btn-danger text-white">Absent</a>';
                            } else {
                                echo '<a class="btn btn-sm btn-dark text-white">Not Marked</a>';
                            }
                            ?>
                    </td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </section>

<?php require('includes/foot.php'); ?>