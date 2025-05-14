<html>
    <body>

            
        <?php

            $userName = "";
            $email = "";
            $text = "";
            $page = "";
            $subscribe ="";



            if ($_SERVER["REQUEST_METHOD"] == "GET"){

                $userName = test_input($_GET["userName"]);
                $email = test_input($_GET["email"]);
                $text = test_input($_GET["Text"]);
                $page = test_input($_GET["page"]);

                $subscribe = isset($_GET["subscribe"]);

                

            }

            function test_input($data) {
                $data = trim($data);
                $data = htmlspecialchars($data);
                return $data;
            }


            echo "  <table border=\"1\" cellpadding=\"10\">
                        <tr>    <th>Full Name</th>              <td>".$userName."</td>   </tr>
                        <tr>    <th>email</th>           <td>".$email."</td>   </tr>
                        <tr>    <th>Questionnaire</th>   <td>".$text."</td>   </tr>
                        <tr>    <th>page</th>                <td>".$page."</td>   </tr>
                        <tr>    <th>subscribe</th>      <td>".$subscribe."</td>    </tr>
                        
                    </table>";


            print("<a href = \"index.html\"> go to Home page</a>");

        ?>
    </body>
</html>
