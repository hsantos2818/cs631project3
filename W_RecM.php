<?php
    session_start();
    //echo "Test: " . $_SESSION["email"] . " and " . $_SESSION["phone"] . "<br>";
?>
<!DOCTYPE html>
<html>
    <title>WALLET -- REQUEST MONEY</title>
    <link rel="icon" type="image/x-icon" href="wIcon.png">
    <body>
        <h1>WALLET -- REQUEST MONEY</h1>
        <p>Please fill in the following information to request your transaction</p>
        <form action="" method="post">
            <label for="edit_email">Amount</label><br>
            <input type="text" id="Amount" name="Amount"><br><br>

            <label for="edit_email">Memo</label><br>
            <input type="text" id="Memo" name="Memo"><br><br>

            <label for="edit_email">Send To? (Phone Number/Email)</label><br>
            <input type="text" id="identifier" name="identifier"><br><br>

            <label for="edit_email">From?</label><br>
            <label for="edit_email">Phone </label> 
            <input type="radio" id="phone" name="with" value="Phone Number"><br>
            <label for="edit_email">Email </label> 
            <input type="radio" id="email" name="with" value="Email"><br><br>
            
            <label for="edit_email">Percentage</label><br>
            <input type="text" id="Percentage" name="Percentage"><br><br>
            <input type="submit"value="Send" name="Send">
        </form>
        <form action="/W_Main.php">
            <input type="submit"value="Main Menu" >
        </form>
        
        <?php
            $conn = mysqli_connect("sql1.njit.edu", "hs487", "Atticus.2wsx1qaz9ol..2021");
            $db = mysqli_select_db($conn, "hs487");
            $ssn = $_SESSION["SSN"];
            $amount = $_REQUEST["Amount"];
            $memo = $_REQUEST["Memo"];
            $answer = $_POST["with"];
            if($answer == "Email"){
                $idFrom = $_SESSION["email"];
            }else{
                $idFrom = $_SESSION["phone"];
            }
            $idTo = $_REQUEST["identifier"];
            $idFrom = $_SESSION["email"];
            $percent = $_REQUEST["Percentage"];
            $rand = rand(0, 1000000);
            if(isset($_POST["Send"])){ //ADD EMAIL
                $request = "INSERT INTO `REQUEST_TRANSACTION`(`RTid`, `Amount`, `Date_Time`, `Memo`, `SSN`)
                            VALUES ($rand, $amount, CURRENT_TIMESTAMP, '$memo', $ssn)";
                $result2 = mysqli_query($conn, $request);
                if (!$result2) {
                    echo "Error1: " . mysqli_error($conn);
                    exit();
                }
                else{
                    $record  = "INSERT INTO `FROM`(`RTid`, `identifier`, `Percentage`) 
                             VALUES ($rand, '$idFrom', $percent)";
                    $result1 = mysqli_query($conn, $record);
                    if (!$result1) {
                        echo "Error2: " . mysqli_error($conn);
                        exit();
                    }
                    $record  = "INSERT INTO `TO`(`RTid`, `identifier`) 
                             VALUES ($rand, '$idTo')";
                    $result2 = mysqli_query($conn, $record);
                    if (!$result2) {
                        echo "Error3: " . mysqli_error($conn);
                        exit();
                    }
                }
            }
            echo "<br>";
            echo "Request History:" . "<br>";

            $inbox = "SELECT rt.RTid, rt.Amount, rt.Date_Time, rt.Memo, FROM.identifier
                    FROM `REQUEST_TRANSACTION` AS rt
                    INNER JOIN `TO` ON rt.RTid=TO.RTid
                    INNER JOIN `FROM` ON rt.RTid=FROM.RTid
                    WHERE rt.SSN=$ssn";
            $rInbox = mysqli_query($conn, $inbox);
            if (!$rInbox) {
                echo "Error4: " . mysqli_error($conn);
                exit();
            }
            while($row = mysqli_fetch_array($rInbox)){
                echo "RTid: " . $row["RTid"] . "<br>";
                echo "Amount: " . $row["Amount"] . "<br>";
                echo "Date/Time: " . $row["Date_Time"] . "<br>";
                echo "Memo: " . $row["Memo"] . "<br>";
                echo "From: " . $row["identifier"] . "<br><br>";
            }
        ?>
    </body>
</html>