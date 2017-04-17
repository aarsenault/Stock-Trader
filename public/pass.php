<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    // else if user reached page via POST (as by submitting a form via POST)
    
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("../views/pass_form.php");
    }    
    elseif ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        if ( $_POST["password"] == NULL) 
        {
            apologize("You enter your old password for verification.");
        }
        else if ( $_POST["newpassword"] == NULL )
        {
            apologize("You must choose a new password.");
        }
        
        
        
        $rows = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);

        // if we found user, check password
        if (count($rows) != 1)
        {
            apologize("error accessing password database");
        }
        
        $row = $rows[0];

        // compare hash of user's input against hash that's in database
        if (false == password_verify($_POST["password"], $row["hash"]))
        { 
            apologize( "Passwords you entered is not correct" );
        }
        
        // Insert new pass into Database
        if ( ( CS50::query("UPDATE users SET hash= ? WHERE id = ?",  password_hash($_POST['newpassword'], PASSWORD_DEFAULT), $_SESSION['id']  ) ) == 0)
        {
            // failed to register
            apologize( "Unsucessful password change");
        }
        else
        {
            redirect("./index.php");
        }
        
    }

?>