<?php
$db = new Database;
$conn = $db->getConn();

$students = Student::getStudents($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST['X']) {
        echo "Student Removed Sucessfully";
        $student_id = $_POST['X'];

        if(Student::removeStudent($conn, $student_id)) {
            //Sucess
            header('refresh:0;');
        }
    }
}


?>


    <!-- Table -->
    <section id="table">
        <div class="container-fluid">
            <h3>Latest Added Students</h3>
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
                    <th>Remove</th>
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
                            <button name="X" value="<?= $student['studentid'] ?>" class="btn btn-sm btn-danger">X</button>
                            <!--<button name="A" value="<?= $student['studentid'] ?>" class="btn btn-sm btn-danger">A</button> -->
                        </form>

                    </td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </section>