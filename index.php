<?php

    //Load the Database Config File
    include_once 'dbConfig.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data to Excel using PHP</title>

    <!-- Bootstrap Library -->
    <!-- <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Stylesheet File -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Members List</h2>

        <div class="row">
            <!-- Export Link -->
            <div class="col-md12 head">
                <div class="float-right">
                    <a href="export.php" class="btn btn-success"><i class="dwn"></i> Export</a>
                </div>
            </div>

            <!-- Data List Table -->
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#ID</th>
                        <th>#Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Country</th>
                        <th>Created</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //Fetch Record form Database
                        $result = $db->query("SELECT * FROM members ORDER BY id ASC");
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['first_name'].' '.$row['last_name']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><?= $row['gender']; ?></td>
                                    <td><?= $row['country']; ?></td>
                                    <td><?= $row['created']; ?></td>
                                    <td><?= ($row['status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr><td colspan="7">No Member(s) found...</td></tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>