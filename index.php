<?php
require 'includes/init.php';
require 'includes/head.php';
?>

<h3 class="text-center">Principal Area</h3>
<br>
<div class="container w-50">
    <ul class="list-group">

        <a href="add-student.php" class="list-group-item list-group-item-action">Add Students</a>
       
    </ul>
</div>
<br>
<h3 class="text-center">Teachers Area Attendance</h3>
<br>
<div class="container w-50">
    <ul class="list-group">
        <a href="today-attendance.php" class="list-group-item list-group-item-action">Mark Attendance</a>
    </ul>
</div>

<br>
<h3 class="text-center">Attendance by Date</h3>
<br>
<div class="container w-50">
    <ul class="list-group">
        <a href="attendance.php" class="list-group-item list-group-item-action">Today Attendance</a>
        <a href="attendance.php?date=<?= date('Y-m-d',strtotime("-1 days")); ?>" class="list-group-item list-group-item-action">Yesterday Attendance</a>

        <form action="/attendance.php" method="get" class="list-group-item list-group-item-action">
            <input class="form-control" type="text" name="date" placeholder="YYYY-MM-DD" required>
            <div class="text-center">
                <button class="btn btn-dark w-50">Show Attendance</button>
            </div>
        </form>
    </ul>
</div>


<?php require('includes/foot.php'); ?>