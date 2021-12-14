<?php
    session_start();
    //echo "Test: " . $_SESSION["email"] . " and " . $_SESSION["phone"] . "<br>";
?>
<!DOCTYPE html>
<html>
    <title> WALLET -- ACCOUNT INFORMATION</title>
    <body>
        <?php
        echo "SSN is: " . $_SESSION["SSN"];
        ?>

        <form action="" method="post">
            <label for="edit_email">Type Email To Add/Remove</label><br>
            <input type="text" id="email" name="edit_email"><br>
            <input type="submit"value="Add" name="Add">
            <input type="submit"value="Delete" name="Delete">
        </form>
        <form action="/W_Main.php" method="post">
            <input type="submit"value="Main Menu" name="Main Menu">
        </form>

        <?php
            $conn = mysqli_connect("sql1.njit.edu", "hs487", "Atticus.2wsx1qaz9ol..2021");
            $db = mysqli_select_db($conn, "hs487");
            if(isset($_POST["Add"])){ //ADD EMAIL
                $ssn = $_SESSION["SSN"];
                $new = $_REQUEST["edit_email"];
                $record  = "INSERT INTO `ELEC_ADDRESS`(`identifier`, `Verified`, `Type`) VALUES ('". $new . "',1,'Email Address')";
                $result1 = mysqli_query($conn, $record);
                if (!$result1) {
                    echo "Error1: " . mysqli_error($conn);
                    exit();
                }
                else{
                    $request = "INSERT INTO `EMAIL`(`EmailAdd`, `SSN`) VALUES ('" . $new . "'," . $ssn . ")";
                    $result2 = mysqli_query($conn, $request);
                    if (!$result2) {
                        echo "Error2: " . mysqli_error($conn);
                        exit();
                    }else{
                        echo "Email Has Been Added";
                        exit();
                    }
                }
                echo mysqli_error($conn);
                if($_SESSION["email"] == ""){
                    $_SESSION["email"] = $new;
                }
            }
            elseif(isset($_POST["Delete"])){ //DELETE EMAIL
                $ssn = $_SESSION["SSN"];
                $new = $_REQUEST["edit_email"];
                $del1 = "DELETE FROM `EMAIL` WHERE `EmailAdd`='$new'";
                $result1 = mysqli_query($conn, $del1);
                if (!$result1) {
                    echo "Error1: " . mysqli_error($conn);
                }
                else{
                    $del2  = "DELETE FROM `ELEC_ADDRESS` WHERE `identifier`='$new'";
                    $result2 = mysqli_query($conn, $del2);
                    if (!$result2) {
                        echo "Error2: " . mysqli_error($conn);
                    }else{
                        echo "Email Has Been Deleted";
                    }
                }
                //echo mysqli_error($conn);

            }
        ?>
    </body>
</html>