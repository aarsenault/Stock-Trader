<div>
    <table class="table table-striped">

    <thead>
        <tr>
            <th>Symbol</th>
            <th>Name</th>
            <th>Price</th>
            <th>Shares</th>
            <th>Value</th>
        </tr>
        
    </thead>

    <tbody>
    
    
        <!-- PLACE VALUES HERE -->
        <?php 
        
            for ($i = 0; $i < $size; $i++)
            {
                echo"<tr>";    
                    echo"<th> {$rows[$i]["symbol"]} </th>";
                    echo"<th> {$rows[$i]["name"]} </th>";
                    echo"<th> {$rows[$i]["price"]} </th>";
                    echo"<th> {$rows[$i]["shares"]} </th>";
                    echo"<th> {$rows[$i]["value"]} </th>";
                echo"<tr>"; 
            }
        
        ?>
    </tbody>   
    <tr>
        <td colspan="1">CASH</td>
        
        <td> <?php print("$ ". $cash); ?> </td>
    </tr>

    </tbody>

</table>
</div>
