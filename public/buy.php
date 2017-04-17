<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("../views/buy_form.php", ["title" => "Buy"] );
    }
  
  
    elseif($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        
           
        // Check if stock exists
        if( ( $_SESSION["stock_buy"] = lookup($_POST["stock"]) ) == false )
        {
            apologize( "Symbol does not match any known stock. Please try again.");
        }
        
        elseif ( (is_int((int) $_POST["shares"]) && ($_POST["shares"] > 0) ) == FALSE )
        {
            apologize("You must enter a positive number of shares, without fractions");
        }
        
        // Stock exists and positive number of shares
        // do I need this line? 
        // $curr_stock = CS50::query("SELECT shares FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION['id'], $_POST["stock"] ); 
        
        $curr_cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION['id'] );
        $value = $_POST["shares"] * $_SESSION["stock_buy"]["price"]; 
        
        //echo( "<pre>" . var_dump($curr_cash) . "</pre>" );
        
        if( $value > $curr_cash[0]['cash'] )
        {
            apologize("You don't currently have that much cash");
        }
        else
        {   
            
             // If 
            if ( NULL == (CS50::query( "SELECT * FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION['id'], $_POST["stock"]) ) )
            {
                // Add row 
                if ( 1 != CS50::query( "INSERT IGNORE INTO portfolios (user_id, symbol, shares)  values(?,?, 0)", $_SESSION['id'], $_POST['stock'] ))
                {
                    apologize("Error adding stocks");
                }
                
                
                
            }
        
            
            
            // Increase stocks
            CS50::query("UPDATE portfolios SET shares = (shares + ?) WHERE user_id = ? AND symbol = ? ", $_POST["shares"], $_SESSION['id'], $_POST["stock"] ); 
            
           
                           
            // Reduce cash
            CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $value, $_SESSION['id'] );
            
            // get time stamp and insert into histories
            CS50::query( "INSERT IGNORE INTO histories (user_id, symbol, shares, action, timestamp) values(?,?,?,'BUY ', now()  )", $_SESSION['id'], $_POST['stock'], $_POST['shares']);
                
         
            
           

            
              
            redirect("./index.php"); 
            //render("../views/test2.php");
        }    
    }
        

?>