<?php
    session_start();
    //echo "Test: " . $_SESSION["email"] . " and " . $_SESSION["phone"] . "<br>";
?>
<!DOCTYPE html>
<html>
    <title> WALLET -- SEARCH TRANSACTIONS </title>
    <body>
    <h1> WALLET -- SEARCH TRANSACTIONS </h1>
        <form method="post">
            <input type="text" id="q" name="SSN" value="User SSN"><br>
            <input type="text" id="q" name="IdE" value="Email"><br>
            <input type="text" id="q" name="IdP" value="Phone Number"><br>
            <label for="transact">Transaction Type </label> <br>
            <label for="edit_email">Send </label> 
            <input type="radio" id="q" name="Type" value="Send"><br>
            <label for="edit_email">Request </label> 
            <input type="radio" id="q" name="Type" value="Request"><br>
            <label for="Date1">From:</label>
            <input type="text" id="q" name="Date1" value="YEAR-MM-DD"><br>
            <label for="edit_email">To:</label> 
            <input type="text" id="q" name="Date2" value="YEAR-MM-DD"><br>
            <input type="submit" id="q" name="Submit" value="Submit"><br>
        </form>
        <form action="/W_Main.php">
            <input type="submit" value="Main Menu" >
        </form>
        <?php

        $conn = mysqli_connect("sql1.njit.edu", "hs487", "Atticus.2wsx1qaz9ol..2021");
        $db = mysqli_select_db($conn, "hs487");
        //$email_q = "SELECT SSN FROM EMAIL WHERE EmailAdd=" . $_SESSION["email"];
        //$email_r = mysqli_query($conn, $email_q);
        $ssn = $_POST["SSN"];
        $phone = $_POST["IdP"];
        $email = $_POST["IdE"];
        $ask = $_POST["Type"];
        if($ask == "Send"){
            $type = "SEND_TRANSACTION";
            $id = "STid";
        }else{
            $type = "REQUEST_TRANSACTION";
            $id = "RTid";
        }
        $date1 = $_POST["Date1"] . "%";
        $date2 = $_POST["Date2"] . "%";

        //echo $ssn . " " . $phone . " " . $email . " " . $type . " " . $date1 . " " . $date2 . '<br>';
        if(($phone=="Phone Number" AND $email=="Email") OR $type == "REQUEST_TRANSACTION"){
            $query = "SELECT *
                    FROM $type
                    WHERE `SSN`=$ssn AND `Date_Time` BETWEEN '$date1' AND '$date2'";
        }elseif($phone=="Phone Number"){
            $query = "SELECT *
                    FROM $type
                    WHERE `SSN`=$ssn AND `identifier`='$email' AND `Date_Time` BETWEEN '$date1' AND '$date2'";
        }elseif($email=="Email"){
            $query = "SELECT *
                    FROM $type
                    WHERE `SSN`=$ssn AND `identifier`='$phone' AND `Date_Time` BETWEEN '$date1' AND '$date2'";
        }else{
            $query = "SELECT *
            FROM $type
            WHERE `SSN`=$ssn AND (`identifier`='$phone' OR `identifier`='$email') AND `Date_Time` BETWEEN '$date1' AND '$date2'";}
        
        $results = mysqli_query($conn, $query);
        if (!$results) {
            echo "Error1: " . mysqli_error($conn);
            exit();
        }
        while($row = mysqli_fetch_array($results)){
            echo "$id: " . $row[$id] . "<br>";
            echo "Amount: " . $row["Amount"] . "<br>";
            echo "Date and Time: " . $row["Date_Time"] . "<br>";
            echo "Memo: " . $row["Memo"] . "<br>";
            echo "SSN: " . $row["SSN"] . "<br><br>";
        }

        ?>
    </body>
</html>