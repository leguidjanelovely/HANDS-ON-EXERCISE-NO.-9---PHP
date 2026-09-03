<?php include 'header.php'; ?>

<div class="form-container">

    <h2>Create an Account</h2>

    <form method="POST">

        <label>Full Name</label>
        <input type="text" name="fullname" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required minlength="6">

        <label>Confirm Password</label>
        <input type="password" name="confirm_password" required minlength="6">

        <button type="submit">Register</button>

    </form>

    <p>
        Already have an account?
        <a href="login.php">Login here</a>
    </p>

</div>

</main>
</body>
</html>
