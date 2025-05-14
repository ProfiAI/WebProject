<?php
    $servername= "localhost"; 
    $username = "root";  
    $password = "";
    $dbname= "myDataBase";

    //1- Create DB connection
    $conn = mysqli_connect($servername, $username, $password, $dbname); 

    // // 2-Check connection
    // if (!$conn) {
    //     die("Connection failed: " . mysqli_connect_error() . "<br>");
    // }else{
    //     echo "you are connected <br>";
    // }
    
    $sql= "CREATE TABLE IF NOT EXISTS `myDataBase`.`users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,  -- Increased length for hashed passwords
    `age` VARCHAR(25) NOT NULL DEFAULT '16-19',
    `region` VARCHAR(25) NOT NULL DEFAULT 'Oman',
    `country` VARCHAR(25) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`email`)
) ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `myDataBase`.`questionnaire` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(50) NOT NULL,
    `username` VARCHAR(25) NOT NULL,
    `suggestion` TEXT NOT NULL,
    `page_problem` VARCHAR(100) NOT NULL,
    `subscription` BOOLEAN NOT NULL DEFAULT FALSE,
    `submission_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `myDataBase`.`contact us` (
    `full name` VARCHAR(50) NOT NULL ,
    `email` VARCHAR(50) NOT NULL , 
    `subject` VARCHAR(25) NOT NULL , 
    `message` TEXT NOT NULL )
    ENGINE = InnoDB;

";
    // To check the connection
    // if (mysqli_multi_query($conn, $sql)) {
    //     do {
    //         // Flush results (important for multiple queries)
    //         if ($result = mysqli_store_result($conn)) {
    //             mysqli_free_result($result);
    //         }
    //     } while (mysqli_next_result($conn));
        
    //     echo "All tables created successfully! <b>";
    // } else {
    //     echo "Error creating tables: " . mysqli_error($conn);
    // }
    
    // mysqli_close($conn); // we are not closing it because we want to use it in other files.

?>







