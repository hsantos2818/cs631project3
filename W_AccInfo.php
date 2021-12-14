<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <title> WALLET -- ACCOUNT INFORMATION</title>
    <body>
        <?php

        $conn = mysqli_connect("sql1.njit.edu", "hs487", "Atticus.2wsx1qaz9ol..2021");
        $db = mysqli_select_db($conn, "hs487");
        $phone = $_SESSION["phone"];
        $email = $_SESSION["email"];
        $query = "SELECT * FROM `USER_ACCOUNT` 
                LEFT OUTER JOIN `EMAIL` ON USER_ACCOUNT.SSN=EMAIL.SSN
                LEFT OUTER JOIN `HAS_ADDITIONAL` ON USER_ACCOUNT.SSN=HAS_ADDITIONAL.SSN
                WHERE PhoneNo=$phone OR EmailAdd='$email'";
        $pQuery = "SELECT * FROM `USER_ACCOUNT` 
        LEFT OUTER JOIN `PHONE` ON USER_ACCOUNT.SSN=PHONE.SSN
        WHERE PhoneNo=$phone";
        $eQuery = "SELECT * FROM `USER_ACCOUNT` 
        LEFT OUTER JOIN `EMAIL` ON USER_ACCOUNT.SSN=EMAIL.SSN
        WHERE PhoneNo=$phone OR EmailAdd='$email'";
        $bQuery = "SELECT * FROM `USER_ACCOUNT` 
        LEFT OUTER JOIN `HAS_ADDITIONAL` ON USER_ACCOUNT.SSN=HAS_ADDITIONAL.SSN
        WHERE PhoneNo=$phone";
        $result = mysqli_query($conn, $query);
        $phoneRES = mysqli_query($conn, $pQuery);
        $emailRES = mysqli_query($conn, $eQuery);
        $bankRES = mysqli_query($conn, $bQuery);

        if (!$result || !$phoneRES || !$emailRES || !$bankRES) {
            echo "Error: " . mysqli_error($conn);
            exit();
        }

        $row = mysqli_fetch_array($result);
        echo "Social Security Number: " . $row["SSN"] . "<br>";
        $_SESSION["SSN"] = $row["SSN"];
        echo "Name: " . $row["Name"] . "<br>";
        
        echo "Phone Number: " . $row["PhoneNo"] . " (Primary)" . "<br>";
        echo "Balance: " . $row["Balance"] . "<br>";
        echo "Email(s):" . "<br>";
        while ($row2 = mysqli_fetch_array($emailRES)){
            echo $row2["EmailAdd"] . "<br>";
        }
        echo "<br>";
        echo "Other Phone Number(s):" . "<br>";
        while ($row4 = mysqli_fetch_array($phoneRES)){
            echo $row4["PhoneNum"] . "<br>";
        }
        echo "<br>";
        echo "Bank Information:" . "<br>";
        while ($row3 = mysqli_fetch_array($bankRES)){
            echo "Bank ID: " . $row3["BankID"] . "<br>";
            echo "Bank Account Number: " . $row3["BANumber"] . "<br>";
            echo "PBA Verfied (0-N, 1-Y): " . $row3["PBAVerified"] . "<br>";
            echo "<br>";
        }
        ?>

        <form action="/W_Main.php">
            <input type="submit" value="Main Menu" >
        </form>
        <form action="/W_UpEmail.php">
            <input type="submit" value="Add/Remove Email">
        </form>
        <form action="/W_UpPhone.php">
            <input type="submit" value="Add/Remove Phone Number">
        </form>
        <form action="/W_UpBank.php">
            <input type="submit" value="Add/Remove Bank Account">
        </form>
        <form method="post">
        <label for="edit_email">Change Name</label><br>
            <input type="text" id="name" name="Name" value=""><br>
            <input type="submit"value="Change" name="Change">
        </form>
        <?php
        if(isset($_POST["Change"])){ //ADD EMAIL
            $name = $_POST['Name'];
            $original = $row['Name'];
            $ssn = $_SESSION['SSN'];
            $record  = "UPDATE `USER_ACCOUNT` SET `Name` = '$name' Where `SSN`=$ssn";
            $result1 = mysqli_query($conn, $record);
            if (!$result1) {
                echo "Error1: " . mysqli_error($conn);
            }
        }
        ?>
    </body>
</html>