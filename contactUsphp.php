<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container" class="p-5 m-5">

        <br><br><br>


            
        <?php

            $fullName = "";
            $email = "";
            $subject = "";
            $message = "";



            if ($_SERVER["REQUEST_METHOD"] == "GET"){

                $fullName = test_input($_GET["fullName"]);
                $email = test_input($_GET["email"]);
                $subject = test_input($_GET["subject"]);
                $message = test_input($_GET["message"]);
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

            echo displayTable($_GET);

        ?>

        <p class = "p-3">
            <a class="btn btn-primary" href = "index.html"> go to Home page</a>
        </p>
    </div>

    </body>
</html>
