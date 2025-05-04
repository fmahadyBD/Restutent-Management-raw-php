<?php include '../../config.database.php'; ?>

<h2>Food Items</h2>
<a href="add_food.php">Add New Food</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Status</th>
        <th>Image</th>
    </tr>

    <?php
    $result = $conn->query("SELECT * FROM food");
    while ($row = $result->fetch_assoc()):
    ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['category'] ?></td>
        <td><?= $row['price'] ?></td>
        <td><?= $row['status'] ?></td>
        <td>
            <?php if ($row['image']): ?>
                <img src="../../../storage/<?= $row['image'] ?>" width="100">
            <?php else: ?>
                No Image
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>

</table>
