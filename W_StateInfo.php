<?php
    session_start();
    //echo "Test: " . $_SESSION["email"] . " |and| " . $_SESSION["phone"] . " |and| " . $_SESSION["SSN"] . "<br>";
?>
<!DOCTYPE html>
<html>
    <title> WALLET -- STATEMENT INFORMATION</title>
    <body>

        <form method="post">
            <input type="submit" id="Month" name="TMonth" value="Totals By Month">
            <input type="submit" id="Month" name="AMonth" value="Averages By Month">
            <input type="submit" id="Month" name="MMonth" value="Maximum By Month"><br>
            <input type="text" id="DateRange" name="Date1" value="YEAR-MM-DD">
            <input type="text" id="DateRange" name="Date2" value="YEAR-MM-DD">
            <input type="submit" id="DateRange" name="TDateRange" value="Totals By Date Range">
            <input type="submit" id="DateRange" name="ADateRange" value="Averages By Date Range"><br>
            <input type="submit" id="User" name="User" value="Best User by Send/Receive"><br>
        </form>
        <form action="/W_Main.php">
            <input type="submit" value="Main Menu" >
        </form>
        <?php

        $conn = mysqli_connect("sql1.njit.edu", "hs487", "Atticus.2wsx1qaz9ol..2021");
        $db = mysqli_select_db($conn, "hs487");

        $ssn = $_SESSION["SSN"];
        $email = $_SESSION["email"];
        $phone = $_SESSION["phone"];
        
        if(isset($_POST["TMonth"])){
            /*$tSend = "SELECT * FROM `SEND_TRANSACTION`
                        WHERE `SSN`=$ssn";
            $tReceive = "SELECT * FROM `TO`
                        LEFT JOIN `SEND_TRANSACTION` ON TO.identifier=SEND_TRANSACTION.identifier
                        WHERE WHERE `identifier`='$email' OR `identifier='$phone'";*/
            //$result = mysqli_query($conn, $tMonth);
            echo "SENDING HISTORY" . "<br>";
            for($x = 1; $x < 13; $x++){ //SEND
                if($x < 10){
                    $date = '2021-0' . $x . '%';
                }else{
                    $date = '2021-' . $x . '%';
                }
                $tSend = "SELECT SUM(`AMOUNT`) AS Total 
                        FROM `SEND_TRANSACTION`
                        WHERE `SSN`=$ssn AND `Date_Time` LIKE '$date'";
                        /*GROUP BY `Date_Time`
                        HAVING `Date_Time` LIKE '$date'";*/
                $result = mysqli_query($conn, $tSend);
                if(!$result){
                    echo "Error: " . mysqli_error($conn) . "<br>";
                }
                $row = mysqli_fetch_array($result);
                echo "Date: " . $date . "<br>";
                echo "Amount: $" . $row["Total"] . "<br>" . "<br>";

            }
            echo "RECEIVED HISTORY" . "<br>";
            for($x = 1; $x < 13; $x++){ //SEND
                if($x < 10){
                    $date = '2021-0' . $x . '%';
                }else{
                    $date = '2021-' . $x . '%';
                }
                $tReceive = "SELECT SUM(`AMOUNT`) AS TotalR 
                        FROM `SEND_TRANSACTION`
                        WHERE (`identifier`='$email' OR `identifier`='$phone') AND `Date_Time` LIKE '$date'";
                        /*GROUP BY `Date_Time`
                        HAVING `Date_Time` LIKE '$date'";*/
                $result2 = mysqli_query($conn, $tReceive);
                if(!$result2){
                    echo "Error2: " . mysqli_error($conn) . "<br>";
                }
                $row = mysqli_fetch_array($result2);
                echo "Date: " . $date . "<br>";
                echo "Amount: $" . $row["TotalR"] . "<br>" . "<br>";

            }
        }elseif(isset($_POST["AMonth"])){
            /*$tSend = "SELECT * FROM `SEND_TRANSACTION`
                        WHERE `SSN`=$ssn";
            $tReceive = "SELECT * FROM `TO`
                        LEFT JOIN `SEND_TRANSACTION` ON TO.identifier=SEND_TRANSACTION.identifier
                        WHERE WHERE `identifier`='$email' OR `identifier='$phone'";*/
            //$result = mysqli_query($conn, $tMonth);
            echo "SENDING AVERAGES" . "<br>";
            for($x = 1; $x < 13; $x++){ //SEND
                if($x < 10){
                    $date = '2021-0' . $x . '%';
                }else{
                    $date = '2021-' . $x . '%';
                }
                $tSend = "SELECT AVG(`AMOUNT`) AS Total 
                        FROM `SEND_TRANSACTION`
                        WHERE `SSN`=$ssn AND `Date_Time` LIKE '$date'";
                        /*GROUP BY `Date_Time`
                        HAVING `Date_Time` LIKE '$date'";*/
                $result = mysqli_query($conn, $tSend);
                if(!$result){
                    echo "Error: " . mysqli_error($conn) . "<br>";
                }
                $row = mysqli_fetch_array($result);
                echo "Date: " . $date . "<br>";
                echo "Amount: $" . $row["Total"] . "<br>" . "<br>";

            }
            echo "RECEIVED AVERAGES" . "<br>";
            for($x = 1; $x < 13; $x++){ //SEND
                if($x < 10){
                    $date = '2021-0' . $x . '%';
                }else{
                    $date = '2021-' . $x . '%';
                }
                $tReceive = "SELECT AVG(`AMOUNT`) AS TotalR 
                        FROM `SEND_TRANSACTION`
                        WHERE (`identifier`='$email' OR `identifier`='$phone') AND `Date_Time` LIKE '$date'";
                        /*GROUP BY `Date_Time`
                        HAVING `Date_Time` LIKE '$date'";*/
                $result2 = mysqli_query($conn, $tReceive);
                if(!$result2){
                    echo "Error2: " . mysqli_error($conn) . "<br>";
                }
                $row = mysqli_fetch_array($result2);
                echo "Date: " . $date . "<br>";
                echo "Amount: $" . $row["TotalR"] . "<br>" . "<br>";

            }
        }elseif(isset($_POST["MMonth"])){
            /*$tSend = "SELECT * FROM `SEND_TRANSACTION`
                        WHERE `SSN`=$ssn";
            $tReceive = "SELECT * FROM `TO`
                        LEFT JOIN `SEND_TRANSACTION` ON TO.identifier=SEND_TRANSACTION.identifier
                        WHERE WHERE `identifier`='$email' OR `identifier='$phone'";*/
            //$result = mysqli_query($conn, $tMonth);
            echo "SENDING MAX" . "<br>";
            for($x = 1; $x < 13; $x++){ //SEND
                if($x < 10){
                    $date = '2021-0' . $x . '%';
                }else{
                    $date = '2021-' . $x . '%';
                }
                $tSend = "SELECT MAX(`AMOUNT`) AS Total 
                        FROM `SEND_TRANSACTION`
                        WHERE `SSN`=$ssn AND `Date_Time` LIKE '$date'";
                        /*GROUP BY `Date_Time`
                        HAVING `Date_Time` LIKE '$date'";*/
                $result = mysqli_query($conn, $tSend);
                if(!$result){
                    echo "Error: " . mysqli_error($conn) . "<br>";
                }
                $row = mysqli_fetch_array($result);
                echo "Date: " . $date . "<br>";
                echo "Amount: $" . $row["Total"] . "<br>" . "<br>";

            }
            echo "RECEIVED MAX" . "<br>";
            for($x = 1; $x < 13; $x++){ //SEND
                if($x < 10){
                    $date = '2021-0' . $x . '%';
                }else{
                    $date = '2021-' . $x . '%';
                }
                $tReceive = "SELECT MAX(`AMOUNT`) AS TotalR 
                        FROM `SEND_TRANSACTION`
                        WHERE (`identifier`='$email' OR `identifier`='$phone') AND `Date_Time` LIKE '$date'";
                        /*GROUP BY `Date_Time`
                        HAVING `Date_Time` LIKE '$date'";*/
                $result2 = mysqli_query($conn, $tReceive);
                if(!$result2){
                    echo "Error2: " . mysqli_error($conn) . "<br>";
                }
                $row = mysqli_fetch_array($result2);
                echo "Date: " . $date . "<br>";
                echo "Amount: $" . $row["TotalR"] . "<br>" . "<br>";

            }
        }elseif(isset($_POST["TDateRange"])){
            $date1 = $_REQUEST["Date1"] . "%";
            $date2 = $_REQUEST["Date2"] . "%";
            echo "SENDING HISTORY" . "<br>";
            $tSend = "SELECT SUM(`AMOUNT`) AS Total, DATE(`Date_Time`) AS dateNOt 
                    FROM `SEND_TRANSACTION`
                    WHERE `SSN`=$ssn AND `Date_Time` BETWEEN '$date1' AND '$date2'
                    GROUP BY DATE(`Date_Time`)";
                    //HAVING `Date_Time` LIKE '$date'";
            $result = mysqli_query($conn, $tSend);
            if(!$result){
                echo "Error: " . mysqli_error($conn) . "<br>";
            }
            while($row = mysqli_fetch_array($result)){
                echo "Date: " . $row["dateNOt"] . "<br>";
                echo "Amount: $" . $row["Total"] . "<br>" . "<br>";
            }
            

            echo "RECEIVED HISTORY" . "<br>";
            if($x < 10){
                $date = '2021-0' . $x . '%';
            }else{
                $date = '2021-' . $x . '%';
            }
            $tReceive = "SELECT SUM(`AMOUNT`) AS Total, DATE(`Date_Time`) AS dateNOt 
                        FROM `SEND_TRANSACTION`
                        WHERE (`identifier`='$email' OR `identifier`='$phone') AND `Date_Time` BETWEEN '$date1' AND '$date2'
                        GROUP BY DATE(`Date_Time`)";
                    /*GROUP BY `Date_Time`
                    HAVING `Date_Time` LIKE '$date'";*/
            $result2 = mysqli_query($conn, $tReceive);
            if(!$result2){
                echo "Error2: " . mysqli_error($conn) . "<br>";
            }
            while($row2 = mysqli_fetch_array($result)){
                echo "Date: " . $row2["dateNOt"] . "<br>";
                echo "Amount: $" . $row2["Total"] . "<br>" . "<br>";
            }

            
        }elseif(isset($_POST["ADateRange"])){
            $date1 = $_REQUEST["Date1"] . "%";
            $date2 = $_REQUEST["Date2"] . "%";
            echo "SENDING AVERAGE" . "<br>";
            $tSend = "SELECT AVG(`AMOUNT`) AS Total, DATE(`Date_Time`) AS dateNOt 
                    FROM `SEND_TRANSACTION`
                    WHERE `SSN`=$ssn AND `Date_Time` BETWEEN '$date1' AND '$date2'
                    GROUP BY DATE(`Date_Time`)";
                    //HAVING `Date_Time` LIKE '$date'";
            $result = mysqli_query($conn, $tSend);
            if(!$result){
                echo "Error: " . mysqli_error($conn) . "<br>";
            }
            while($row = mysqli_fetch_array($result)){
                echo "Date: " . $row["dateNOt"] . "<br>";
                echo "Amount: $" . $row["Total"] . "<br>" . "<br>";
            }
            

            echo "RECEIVED AVERAGE" . "<br>";
            if($x < 10){
                $date = '2021-0' . $x . '%';
            }else{
                $date = '2021-' . $x . '%';
            }
            $tReceive = "SELECT AVG(`AMOUNT`) AS Total, DATE(`Date_Time`) AS dateNOt 
                        FROM `SEND_TRANSACTION`
                        WHERE (`identifier`='$email' OR `identifier`='$phone') AND `Date_Time` BETWEEN '$date1' AND '$date2'
                        GROUP BY DATE(`Date_Time`)";
                    /*GROUP BY `Date_Time`
                    HAVING `Date_Time` LIKE '$date'";*/
            $result2 = mysqli_query($conn, $tReceive);
            if(!$result2){
                echo "Error2: " . mysqli_error($conn) . "<br>";
            }
            while($row2 = mysqli_fetch_array($result)){
                echo "Date: " . $row2["dateNOt"] . "<br>";
                echo "Amount: $" . $row2["Total"] . "<br>" . "<br>";
            }

        }elseif(isset($_POST["User"])){
            echo "BEST USER HISTORY" . "<br><br>";

            echo "HIGHEST SENDER" . "<br>";
            $tSend = "SELECT SUM(`Amount`) as MaxSend, `SSN` 
                        FROM `SEND_TRANSACTION` 
                        GROUP BY `SSN` 
                        ORDER BY MaxSend DESC";
            $result = mysqli_query($conn, $tSend);
            if(!$result){
                echo "Error1: " . mysqli_error($conn) . "<br>";
                exit();
            }
            $row = mysqli_fetch_array($result);
            echo "User SSN: " . $row["SSN"] . "<br>";
            echo "Sender Transaction Amount: " . $row["MaxSend"] . "<br>" . "<br>";
            
            echo "HIGHEST RECEIVER" . "<br>";

            $tReceive = "SELECT E.SSN as EmailSSN, P.SSN as PhoneSSN, SUM(S.Amount) as MaxReceive
                        FROM `SEND_TRANSACTION` AS S, `EMAIL` AS E, `PHONE` AS P
                        WHERE E.SSN=P.SSN and (S.identifier=E.EmailAdd OR S.identifier=P.PhoneNum)
                        GROUP BY E.SSN, P.SSN
                        ORDER BY MaxReceive DESC";
            $result2 = mysqli_query($conn, $tReceive);
            if(!$result2){
                echo "Error1: " . mysqli_error($conn) . "<br>";
                exit();
            }
            $row2 = mysqli_fetch_array($result2);
            if($row2["EmailSSN"] == ""){
                $qssn = $row2["PhoneSSN"];
            }else{
                $qssn = $row2["EmailSSN"];
            }
            echo "User SSN: " . $qssn . "<br>";
            echo "Request Transaction Amount: " . $row2["MaxReceive"] . "<br>" . "<br>";
        }
        
        ?>
    </body>
</html>