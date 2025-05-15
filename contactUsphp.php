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


            class ContactData {
                public $data;
            
                function __construct($get) {
                    $this->data = ["Full Name" => $get["fullName"],
                        "Email" => $get["email"],
                        "Subject" => $get["subject"],
                        "Message" => $get["message"]];
                }

                
            
                function getTableData() {
                    return $this->data;}

                
                function getDBValues() {
                    return [$this->data["Full Name"],
                        $this->data["Email"],
                        $this->data["Subject"],
                        $this->data["Message"]];
                }
            }

            $fullName = "";
            $email = "";
            $subject = "";
            $message = "";

            if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET)){
                $contact = new ContactData($_GET);
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
                echo displayTable($contact->getTableData());

                
                list($fullName, $email, $subject, $message) = $contact->getDBValues();
                $sql = "INSERT INTO `contact us` (`full name`, email, subject, message) 
                        VALUES ('$fullName', '$email', '$subject', '$message')";

                try {
                    if(mysqli_query($conn, $sql)){
                        echo "<p>Submitted successfully!</p>";
                    }
                } catch(mysqli_sql_exception $e) {
                    echo "<p>NOT Submitted $e</p>";
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
