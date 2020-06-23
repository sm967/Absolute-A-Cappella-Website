<header>
    <div id="header-container">
        <div id="logo-container">
            <a href="index.php"><img src="/images/absologo.png" alt="Absolute's Logo" id="logo"></a>
            <!-- The logo image was created by myself and Tommy Baldwin (https://tommybaldwin.com/) for Absolute A Cappella. -->
        </div>

        <?php
        if (!is_user_logged_in()) { ?>
            <div id="login-container">
                <form id="login" action="index.php" method="POST">
                    <label for="username"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="username" id="username">

                    <label for="password"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" id="password">

                    <button name="submit_login" type="submit">Login</button>
                </form>
            </div>
        <?php }
        else { ?>
            <div id="logout-container">
                <p>Logged in as: <?php echo htmlspecialchars($current_user["fullname"]); ?></p>
                <form id="logout" action="index.php" method="GET">
                    <button name="submit_logout" type="submit">Logout</button>
                </form>
            </div>
        <?php } ?>
    </div>
</header>
