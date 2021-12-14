<?php
    session_start();
    //echo "Test: " . $_SESSION["email"] . " and " . $_SESSION["phone"] . "<br>";
?>
<!DOCTYPE html>
<html>
    <title>WALLET -- SEND MONEY</title>
    <link rel="icon" type="image/x-icon" href="wIcon.png">
    <body>
        <h1>WALLET -- SEND MONEY</h1>
        <p>Please fill in the following information to send your transaction</p>
        <form action="" method="post">
            <label for="edit_email">Amount</label><br>
            <input type="text" id="Amount" name="Amount"><br><br>
            <label for="edit_email">Memo</label><br>
            <input type="text" id="Memo" name="Memo"><br><br>
            <label for="edit_email">Phone Number or Email</label><br>
            <input type="text" id="identifier" name="identifier"><br><br>
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
            $id = $_REQUEST["identifier"];
            if(isset($_POST["Send"])){ //ADD EMAIL

                $record  = "INSERT INTO `SEND_TRANSACTION`(`STid`, `Amount`, `Date_Time`, `Memo`, `Cancel_Reason`, `identifier`, `SSN`) 
                            VALUES (NULL, $amount, CURRENT_TIMESTAMP, '$memo', '', '$id', $ssn)";
                $result1 = mysqli_query($conn, $record);
                if (!$result1) {
                    echo "Error1: " . mysqli_error($conn);
                    exit();
                }
                else{
                    echo "Transaction Has Been Sent" . "<br>";
                    $request = "UPDATE `USER_ACCOUNT` SET `Balance`=(`Balance`-$amount) WHERE `SSN`=$ssn";
                    $result2 = mysqli_query($conn, $request);
                    if (!$result2) {
                        echo "Error2: " . mysqli_error($conn);
                        exit();
                    }else{
                        echo "Balance Has Been Updated" . "<br>";
                        //$qResults = mysqli_query($conn, $query);
                        $request = "UPDATE `USER_ACCOUNT`
                        INNER JOIN `EMAIL` ON USER_ACCOUNT.SSN=EMAIL.SSN
                        INNER JOIN `PHONE` ON USER_ACCOUNT.SSN=PHONE.SSN
                        SET `Balance`=(`Balance`+ $amount)
                        WHERE `EmailAdd`='$id' OR `PhoneNum`='$id'";
                        $result2 = mysqli_query($conn, $request);
                        if (!$result2) {
                            echo "Error2: " . mysqli_error($conn);
                            exit();
                        }else{
                            echo "Transaction has been successfully received by the recipient";
                            
                        }
                    }
                }
                echo mysqli_error($conn);
            }
        ?>
    </body>
</html>