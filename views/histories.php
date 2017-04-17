<div>
    <table class="table table-striped">

    <thead>
        <tr>
            <th>Symbol</th>
            <th>Action</th>
            <th>Shares</th>
            <th>Date / Time</th>
        </tr>
        
    </thead>

    <tbody>
    
    
        <!-- PLACE VALUES HERE -->
        <?php 
        
            for ($i = 0; $i < $size; $i++)
            {
                echo"<tr>";    
                    echo"<th> {$rows[$i]["symbol"]} </th>";
                    echo"<th> {$rows[$i]["action"]} </th>";
                    echo"<th> {$rows[$i]["shares"]} </th>";
                    echo"<th> {$rows[$i]["timestamp"]} </th>";
                echo"<tr>"; 
            }
        
        ?>
    </tbody>   
   

</table>
</div>
