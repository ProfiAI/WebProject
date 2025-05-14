<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    </head>
    <body>
        <div class="container" class="p-5 m-5">

            <br><br><br>

            <p>
                <?php
                    include("tables.php");
                    
                    $email = "";
                    $password = "";
                    $confirm_password = "";
                    $age = "";
                    $region = "";
                    $country = "";


                    if ($_SERVER["REQUEST_METHOD"] == "POST"){

                        $email = test_input($_POST["email"]);
                        $password = test_input($_POST["password"]);
                        $confirm_password = test_input($_POST["confirm_password"]);
                        $age = test_input($_POST["age"]);
                        $region = test_input($_POST["region"]);
                        $country = test_input($_POST["country"]);

                    }

                    function test_input($data) {
                        $data = trim($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }


                    function displayTable($data){
                        $display = "";
                        $display .= "  <table class='table table-hover table-striped' border=\"1\" cellpadding=\"10\">";

                        foreach ($data as $key => $value) {
                            $display .= "<tr>    <th>$key</th>              <td>".$value."</td>   </tr>";
                        }
                        $display .= "</table>";

                        return $display;
                    }

                    echo displayTable($_POST);

                    $sql = "INSERT INTO users (email, password, age, region, country) VALUES 
                    ('$email', '$password', '$age', '$region', '$country');";

                    // this just to check
                    try{
                        if(mysqli_query($conn, $sql)){
                            echo "<p> you are registered successfuly! </p>";
                        }
                    }catch(mysqli_sql_exception){
                        echo "<p> you are already registered </p>";
                    }
                    mysqli_close($conn);
                ?>
            </p>

            <p class = "p-3">
                <a class="btn btn-primary" href = "index.html"> go to Home page</a>
            </p>
        </div>
            
    </body>
</html>
