<?php

require_once('database.php')
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fahim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body style="height:1200px">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="w-100" style="max-width: 400px;">
            <div class="p-4 rounded shadow bg-white">
                <h3 class="text-center mb-4 text-primary">
                    Insert Student Data
                </h3>
                <form action="" class=""  method="post">
                    <div>
                        <label for="id" class="form-label"> ID </label>
                        <input type="number" id="number" class="form-control mb-2">
                    </div>
                    <div>
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" id="name" class="form-control mb-2">
                    </div>
                    <div>
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" class="form-control mb-2">
                    </div>
                    <div>
                        <label for="contact" class="form-label">Contact:</label>
                        <input type="text" id="contact" class="form-control mb-2">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>

                <div>
                    <?php
                    $sql = "SELECT id, name ,email, contact FROM form";
                    try {
                        $result = $conn->query($sql);
                    } catch (Throwable $ex) {
                    }
                    ?>
                </div>

            </div>
        </div>

        <div class="card-body p-3 mb-6">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th >ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . $row["contact"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<td colspan='4'> result </td>";
                        }
                        ?>
                        <!-- <tr>
                            <td class="">1</td>
                            <td>Fahim</td>
                            <td>fmahady01@gmail.com</td>
                            <td>01722003285</td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</html>