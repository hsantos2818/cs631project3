<?php
    session_start();
    session_destroy();
    session_start();
?>
<!DOCTYPE html>
<html>
    <title> WALLET </title>
    <link rel="icon" type="image/x-icon" href="wIcon.png">
    <body>
        <h1>WALLET -- SIGN IN</h1>
        
        <p>Please sign in to your account to get started.</p>

        <form action="/W_Main.php" method="post">
        <!--<form>-->
            <label for="email">Email</label><br>
            <input type="text" id="email" name="l_email"><br>
            <label for="phone">Phone Number</label><br>
            <input type="text" id="phone" name="l_phone"><br>
            <input type="submit"value="Sign In" name="Submit">
        </form>
        <?php
                /*$txt = "Hello, world!";
                echo $txt ."<p>";

                $conn = mysqli_connect("sql1.njit.edu", "hs487", "Atticus.2wsx1qaz9ol..2021");
                $db = mysqli_select_db($conn, "hs487");
                $query = "SELECT * FROM USER_ACCOUNT";
                $result = mysqli_query($conn, $query);

                if (!$result) {
                    echo "Error: " . mysqli_error($conn);
                    exit();
                }

                while ($row = mysqli_fetch_array($result)) {
                    print $row["SSN"];
                    print (" -- ");
                    print $row["Name"];
                    print("<p>");
                }*/

                $email = $_REQUEST['l_email'];
                $phone = $_REQUEST['l_phone'];
                //$_SESSION["email"] = $_REQUEST['l_email'];
                //$_SESSION["phone"] = $_REQUEST['l_phone'];
                //setcookie("email", $email, time() + 3600, '/');
                //setcookie("phone", $phone, time() + 3600, '/');
                //echo "The following are from the Cookie: " . $_COOKIE["email"] . " and ";// . $_COOKIE["phone"];

            ?>
    </body>
</html>
<?php
    if (isset($_POST['Submit'])) {
        $_SESSION["email"] = $_POST['l_email'];
        $_SESSION["phone"] = $_POST['l_phone'];
    }
        //echo $_SESSION["email"] . " and " . $_SESSION["phone"];
    //exit()
?>