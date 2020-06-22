<?php
    require 'header.php';
?>
    <main>
        <h1>SIGNUP</h1>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="username" placeholder="username">
            <input type="text" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <input type="password" name="password2" placeholder="password">
            <button type="submit" name="signup-submit">SIGN UP</button>
        </form>
    </main>
<?php
    require 'footer.php';
?>