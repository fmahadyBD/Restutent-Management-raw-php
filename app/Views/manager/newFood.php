<?php include '../../config.database.php'; ?>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    // Image upload handling
    $image = $_FILES['image']['name'];
    $target = "../../../storage/" . basename($image);

    $sql = "INSERT INTO food (name, category, price, status, image) 
            VALUES ('$name', '$category', '$price', '$status', '$image')";

    if ($conn->query($sql) === TRUE) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        echo "Food added!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Add Food</h2>
<form method="post" enctype="multipart/form-data">
    Name: <input type="text" name="name"><br>
    Category: <input type="text" name="category"><br>
    Price: <input type="text" name="price"><br>
    Status: 
    <select name="status">
        <option value="Available">Available</option>
        <option value="Unavailable">Unavailable</option>
    </select><br>
    Image: <input type="file" name="image"><br>
    <button type="submit" name="submit">Add Food</button>
</form>
