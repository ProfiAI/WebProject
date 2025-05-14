<html>
     <head>
         <title>SkillMatch - profile</title>
        
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

 
         <meta name="description" content="Create your SkillMatch account to access skill learning features.">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">

         <style>
            span{
                color: red;
            }
         </style>


         <script type="text/javascript">
            function validateForm(event){

                var action = event.submitter.value;


                var email = document.Registration.email;
                var pass = document.Registration.password;
                var confirmPass = document.Registration.confirm_password;
                var age = document.Registration.age;
                var country = document.Registration.country;

                // clear previous message
                document.getElementById("invalidEmail").innerText = "";
                document.getElementById("invalidPass").innerText = "";
                document.getElementById("invalidConfirmPass").innerText = "";
                document.getElementById("missMatch").innerText = "";
                document.getElementById("invalidCountry").innerText = "";



                var incorrect = false;



                if(email.value.search(/\w{2,20}@\w{2,10}\.\w{2,5}/)==-1){
                    document.getElementById("invalidEmail").innerText = "invalid Email";
                    email.focus();
                    incorrect = true;
                }


                if(pass.value.search(/\S{5,20}/)==-1){
                    document.getElementById("invalidPass").innerText = "Invalid password";
                    pass.focus();
                    incorrect = true;
                }

                if (action === "update"){
                    if(confirmPass.value.search(/\S{5,20}/)==-1){
                        document.getElementById("invalidConfirmPass").innerText = "invalid Confirm Password";
                        confirmPass.focus();
                        incorrect = true;
                    }

                    if (pass.value != confirmPass.value){
                        document.getElementById("missMatch").innerText = "Password and Confirm Password does not match";
                        pass.focus();
                        incorrect = true;
                    }

                    if(country.value.search(/^([A-Za-z\s]{3,20})$/) == -1){
                        document.getElementById("invalidCountry").innerText ="Invalid country (must be 3-20 letters or spaces)";
                        country.focus();
                        incorrect = true;
                    }
                }


                if (incorrect){
                  return false;
                }
                

                return true;
            }

         </script>

 
     </head>
 
     <body>
 
        <ul class="nav nav-tabs justify-content-end bg-warning p-3 ">
        <div class="container-fluid justify-content-end">
            <a class="navbar-brand " href="index.html">
              <img src="logo.png" alt="skillmatch" width="40" class="d-inline-block align-text-top">SkillMatch
            </a>
        </div>

        <li class="nav-item"><a class="nav-link active" href="index.html">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="skills.html">Choose a Coach</a> </li>
        <li class="nav-item"><a class="nav-link" href="mySchedule.html">My Schedule</a></li>
        <li class="nav-item"><a class="nav-link" href="Questionnaire.html">Questionnaire</a></li>

        <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              MENU
            </button>
            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <li><a class="dropdown-item" href="profile.php">profile</a></li>
                <li><a class="dropdown-item" href="funpage.html">funpage</a></li>
                <li><a class="dropdown-item" href="payment.html">Calculation</a> </li>
                <li><a class="dropdown-item"  href="contactUS.html">Contact Us</a></li>
                <li><a class="dropdown-item" href="sign-in.html" >Sign In</a> </li>
                <li><a class="dropdown-item" href="sign-up.html">Sign Up </a> </li>
            </ul>
          </div>
    </ul> 
 
         <div class="container">
            <div class="p-2">
                <img src = "logo.png" width="15%"/>
                <p class="text-primary h1">Profile</p>
            </div>

            <!-- change action here to update have two choice
                    update profile data button and
                    delete account button that check email and password only  -->
                <form name="Registration" method="post" class ="form-control needs-validation" onsubmit="return validateForm(event)">
                    <p>
                        <label class="form-label">Email: </label>
                        <input type="email" name="email" placeholder="Enter your email" maxlength="30" class="form-control" required/>
                        <span id="invalidEmail"></span>
                    </p>
    
    
                    <p>
                        <label class="form-label" >Password: </label>
                        <input type="password" name="password" placeholder="Create a password" maxlength="30" class="form-control" required />
                        <span id= "invalidPass"></span>
                    </p>

                    <p>
                        <label class="form-label" >Confirm Password: </label>
                        <input type="password" name="confirm_password" placeholder="Repeat password" maxlength="30" class="form-control" required/>
                        <span id= "invalidConfirmPass"></span>
                        <span id="missMatch"></span>
                    </p>
    
                    <p>
                        <label class="form-label" >Your Age: </label><br/>
                        <input type="radio" name="age" value="0-15"> 0 to 15
                        <input type="radio" name="age" value="16-19" checked> 16 to 19
                        <input type="radio" name="age" value="20-29"> 20 to 29
                        <input type="radio" name="age" value="30+"> +30
                    </p>
    
    
                    <p>
                        <label class="form-label" >Your Region: </label>
                        <select name="region" class="form-select" required>
                            <option>Middle East</option>
                            <option>Southern Africa</option>
                            <option>Europe</option>
                            <option>Asia Pacific</option>
                            <option>Americas</option>
                        </select>
                    </p>
    
    
    
                    <p>
                        <label class="form-label" >Country: </label>
                        <input type="text" name="country" placeholder="Your country"/>
                        <span id="invalidCountry"></span>
                    </p>
    
                    <button type="submit" name="action" value="update" formaction="updateProfile.php" class="btn btn-success">Update Profile</button>
                    <button type="submit" name="action" value="delete" formaction="deleteAccount.php" class="btn btn-danger">Delete Account</button>

                </form>

        </div>
 
 
         <footer class="bg-dark text-white p-4 text-center">
            <a href="contactUS.html"> contact us</a>
            &copy; 2025 SkillMatch. All rights reserved.
        </footer>
 
     </body>
 </html>
