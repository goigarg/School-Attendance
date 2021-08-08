<?php $dir = dirname($_SERVER['REQUEST_URI']); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/foot.css">
    <title>School Attandance Management</title>
</head>
<body>

    <!-- Heading -->
        <div class="head text-center text-white bg-dark">
            <h2 class="head">
                <a href="<?= $dir; ?>">School Attandance Management</a>
            </h2>
        </div>
    <!-- Title -->
    <section id="welcome">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <h3>Welcome Teacher</h3> 
                </div>
                <div class="col-4">
                    <button class="btn btn-outline-dark">Logout</button>
                </div>
            </div>
        </div>
    </section>

    <hr>