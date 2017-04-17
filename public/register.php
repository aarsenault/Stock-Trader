<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("../views/register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        if ( $_POST["username"] == NULL) 
        {
            apologize("You must chose a username.");
        }
        else if ( $_POST["password"] == NULL )
        {
            apologize("You must choose a password.");
        }
        else if ( $_POST["password"] != $_POST["confirmation"] )
        {
            apologize( "Passwords must match" );
        }
        
        // Insert Password into Database
        if ( ( CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT)) ) == 0)
        {
            // failed to register
            apologize( "Unsucessful registration: please try again.");
        }
        else
        {
            // succuessful Login
            $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
             $_SESSION["id"] = $rows[0]["id"];
            
            redirect("./index.php"); 
        }
        
    }

?>