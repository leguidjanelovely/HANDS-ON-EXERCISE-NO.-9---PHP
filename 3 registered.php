<?php
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $email = trim($_POST["email"]);
    $address = trim($_POST["address"]);
    $contact = trim($_POST["contact"]);

    if (
        empty($name) ||
        empty($age) ||
        empty($gender) ||
        empty($email) ||
        empty($address) ||
        empty($contact)
    ) {
        $message = "Please complete all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email.";
    } else {

        $sql = "INSERT INTO registered_persons
                (name, age, gender, email, address, contact)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "sissss",
            $name,
            $age,
            $gender,
            $email,
            $address,
            $contact
        );

        if ($stmt->execute()) {
            $message = "Record successfully registered!";
        } else {
            $message = "Error: " . $conn->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Registered Persons</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>Registration Form</h1>

    <?php if ($message != ""): ?>
        <div class="message">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <label>Name</label>
        <input type="text" name="name" required>

        <label>Age</label>
        <input type="number" name="age" min="1" max="120" required>

        <label>Gender</label>
        <select name="gender" required>
            <option value="">-- Select Gender --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Address</label>
        <textarea name="address" required></textarea>

        <label>Contact Number</label>
        <input type="tel"
               name="contact"
               pattern="[0-9]{10,11}"
               placeholder="09123456789"
               required>

        <button type="submit">Register</button>

    </form>

    <hr>

    <h2>List of Registered Persons</h2>

    <table>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Address</th>
            <th>Contact</th>
        </tr>

        <?php

        $result = $conn->query(
            "SELECT * FROM registered_persons ORDER BY id DESC"
        );

        while ($row = $result->fetch_assoc()):

        ?>

        <tr>

            <td><?php echo $row["id"]; ?></td>

            <td><?php echo htmlspecialchars($row["name"]); ?></td>

            <td><?php echo $row["age"]; ?></td>

            <td><?php echo htmlspecialchars($row["gender"]); ?></td>

            <td><?php echo htmlspecialchars($row["email"]); ?></td>

            <td><?php echo htmlspecialchars($row["address"]); ?></td>

            <td><?php echo htmlspecialchars($row["contact"]); ?></td>

        </tr>

        <?php endwhile; ?>

    </table>

</div>

</body>
</html>
