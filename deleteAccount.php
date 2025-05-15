<?php 
    include("tables.php");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    function test_input($data) {
        return htmlspecialchars(trim($data));
    }

    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $age = test_input($_POST["age"]);
    $region = test_input($_POST["region"]);
    $country = test_input($_POST["country"]);

    $sql = "DELETE FROM users WHERE email = '$email'";
    try{
        if (mysqli_query($conn, $sql)) {
            echo "<p style='color: green;'>Profile Deleted successfully!!</p>";
        }
    }catch(mysqli_sql_exception $e){
        echo "<p style='color: red;' Error deleting profile: " . mysqli_error($conn) . "</p>";
    }
    

    mysqli_close($conn);
?>