<html>
    <body>

            
        <?php

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


            echo "  <table border=\"1\" cellpadding=\"10\">
            <a href = \"index.html\"> go to Home pagex</a>
                        <tr>    <th>Email</th>              <td>".$email."</td>   </tr>
                        <tr>    <th>Password</th>           <td>".$password."</td>   </tr>
                        <tr>    <th>Confirm password</th>   <td>".$confirm_password."</td>   </tr>
                        <tr>    <th>Age</th>                <td>".$age."</td>   </tr>
                        <tr>    <th>Region</th>             <td>".$region."</td>   </tr>
                        <tr>    <th>Country</th>            <td>".$country."</td>   </tr>
                    </table>";

        ?>
    </body>
</html>
