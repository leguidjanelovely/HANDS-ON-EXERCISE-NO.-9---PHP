<?php include 'header.php'; ?>

<div class="form-container">

    <h2>Login</h2>

    <form method="POST">

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>

    </form>

    <p>
        <a href="forgot_password.php">Forgot Password?</a>
    </p>

    <p>
        Don't have an account?
        <a href="register.php">Register here</a>
    </p>

</div>

</main>
</body>
</html>
