<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["password"]))
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
            // update the user in the database
            $result = query("UPDATE users SET hash = ?", crypt($_POST["password"]));

            if ($result !== false)
                printf("Password successfully updated");

            // redirect to portfolio
            redirect("/");
        }
    }
    else {
        // else render form
        render("pw_change_form.php");    
    }

?>
