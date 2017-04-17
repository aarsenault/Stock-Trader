<?php

    // configuration
    require("../includes/config.php"); 
    
    // check name below
    
    // select all info for users
    $rows = CS50::query("SELECT * FROM histories WHERE user_id = ?", $_SESSION['id']); 
    
    // if no history, generate a blank page
    if ($rows == NULL)
    {
        // format cash to two digits    
        // $cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION['id']); 
        // $cash = number_format( $cash[0]["cash"] , 2, ".", "," ); 
        
        // echo( "<pre>" . var_dump($cash) . "</pre>" );
        // see if this works    
         render("../views/histories.php", ["title" => "History", "size" => 0] );
    
    }
    
    
    // need to pass portfolio:
    

    // $history_rows = array(); 

    $i = 0; 
    foreach ($rows as $row)
    {
    //     $history_rows[$i]["symbol"] = $row["symbol"];
    //     $history_rows[$i]["shares"] = $row["shares"]; 
        
       
    //     // get info abt current stock.
    //     $row_stock = lookup($history_rows[$i]["symbol"]);
        
    //     // TEST 
    //     //echo( "<pre>" . var_dump($row_stock) . "</pre>" );  
        
    //     $history_rows[$i]["name"] = $row_stock["name"];
        
    //     // current value
    //     $history_rows[$i]["value"] = number_format( ( $row["shares"] * $row_stock["price"] ) , 2, ".", "," ); 
    //     $history_rows[$i]["price"] = number_format( $row_stock["price"] , 2, ".", "," ); 
        
        
        $i++; 
     }
    
    
    // $cash is 1 time; $portfolio is 2D matrix, 
    // render portfolio
    
    
    
    render("../views/histories.php", ["title" => "History", "rows" => $rows, "size" => $i] );
    

?>
