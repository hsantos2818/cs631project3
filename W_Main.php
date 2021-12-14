<?php
    session_start();
    if(!isset($_SESSION["email"]) and !isset($_SESSION["phone"])){
        $_SESSION["email"] = $_REQUEST['l_email'];
        $_SESSION["phone"] = $_REQUEST['l_phone'];
    }
    $conn = mysqli_connect("sql1.njit.edu", "hs487", "Atticus.2wsx1qaz9ol..2021");
    $db = mysqli_select_db($conn, "hs487");
    $temp = $_SESSION["phone"];
    $query = "SELECT * FROM USER_ACCOUNT WHERE `PhoneNo`=$temp";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $_SESSION["SSN"] = $row["SSN"];
    
?>
<!DOCTYPE html>
<html>
    <title> WALLET </title>
    <link rel="icon" type="image/x-icon" href="wIcon.png">
    <body>
        <h1>WALLET -- MAIN MENU</h1>
        
        <p>Welcome to your WALLET account, please choose one of the following services to get started.</p>

        <form action="/W_AccInfo.php">
            <input type="submit"value="Account Info" >
        </form>
        <form action="/W_SendM.php">
            <input type="submit"value="Send Money">
        </form>
        <form action="/W_RecM.php">
            <input type="submit"value="Request Money">
        </form>
        <form action="/W_StateInfo.php">
            <input type="submit"value="Statements">
        </form>
        <form action="/W_SearchInfo.php">
            <input type="submit"value="Search Transactions">
        </form>
        <form action="/Wallet.php">
            <input type="submit"value="Sign Out">
        </form>
        
        <?php
        //echo "The following are from the variables: " . $_SESSION["email"] . " and " . $_SESSION["phone"] . " and " . $_SESSION["SSN"];
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
            
            //Check if l email works.
            /*
            $email = $_REQUEST['l_email'];
            $phone = $_REQUEST['l_phone'];
            echo $phone . " and " . $email
            */
            
        ?>
    </body>
</html>