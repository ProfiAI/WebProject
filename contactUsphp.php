<html>
    <body>

            
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


            echo "  <table border=\"1\" cellpadding=\"10\">
            <a href = \"index.html\"> go to Home page</a>
                        <tr>    <th>Full Name</th>              <td>".$fullName."</td>   </tr>
                        <tr>    <th>email</th>           <td>".$email."</td>   </tr>
                        <tr>    <th>subject</th>   <td>".$subject."</td>   </tr>
                        <tr>    <th>message</th>                <td>".$message."</td>   </tr>
                        
                    </table>";

        ?>
    </body>
</html>
