<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        else if (empty($_POST["repeat-password"]))
        {
            apologize("You must fill in your password check.");
        }
        else if (($_POST["password"])!==($_POST["repeat-password"]))
        {
            apologize("Password and repeat password must be equal.");
        }
        else {

            // query database for user
            $rows = query("SELECT * FROM users WHERE username = ?", $_POST["username"]);

            // if we found user, apologize
            if (count($rows) == 1)
            {
                // first (and only) row
                $row = $rows[0];

                // apologize
                apologize("This username already exists. Please choose another.");
            }
            else
            {
                // create the user in the database
                $result = query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"]));
                if ($result !== false) {
                    printf("User successfully registered");

                    // remember that user's now logged in by storing user's ID in session
                    $rows = query("SELECT LAST_INSERT_ID() AS id"); 
                    $id = $rows[0]["id"];
                    $_SESSION["id"] = $row["id"];

                    // redirect to portfolio
                    redirect("/");
                }
            }
        }
    }
    else {
        // else render form
        render("register_form.php", ["title" => "Register"]);    
    }

?>
