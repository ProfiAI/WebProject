<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
    <div class="container p-5 m-5">
        <br><br><br>
                
        <?php
            include("tables.php");

            $userName = "";
            $email = "";
            $text = "";
            $page = "";
            $subscribe = "";

            if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET)){
                $userName = test_input($_GET["userName"]);
                $email = test_input($_GET["email"]);
                $text = test_input($_GET["Text"]);
                $page = test_input($_GET["page"]);
                $subscribe = isset($_GET["subscribe"]) ? 1 : 0; // Convert to 1 or 0 for database
            }

            function test_input($data) {
                $data = trim($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            function displayTable($data){
                $display = "";
                $display .= "<table class='table table-hover table-striped' border='1' cellpadding='10'>";

                foreach ($data as $key => $value) {
                    $display .= "<tr><th>$key</th><td>".$value."</td></tr>";
                }
                $display .= "</table>";

                return $display;
            }

            if (!empty($_GET)) {
                echo displayTable($_GET);

                $sql = "INSERT INTO `questionnaire` (username, email, suggestion, page_problem, subscription) VALUES 
                    ('$userName', '$email', '$text', '$page', '$subscribe')";

                try {
                    if(mysqli_query($conn, $sql)){
                        echo "<p>Submited successfully!</p>";
                    }
                } catch(mysqli_sql_exception $e) {
                    echo "<p>Error $e</p>";
                }
                mysqli_close($conn);
            }
        ?>

        <p class="p-3">
            <a class="btn btn-primary" href="index.html">go to Home page</a>
        </p>
    </div>
    </body>
</html>
