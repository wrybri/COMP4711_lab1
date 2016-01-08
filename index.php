<!doctype html>
<html>
    <head>
        <title>Hello COMP4711</title>
    </head>
    <body>
        <?php
            $temp = 'Jim';
            echo 'Hi, my name is ';
            echo $temp . '<br>';
            $temp = 'geek';
            echo "I am a: ";
            echo $temp . '<br>';
            $temp = 10;
            echo 'My level is ';
            echo $temp . '<br>';
            
            $name = 'Jim';
            $what = 'geek';
            $level = 10;
            echo '<br>Hi, my name is '.$name,'. and I am a level '.$level.'
            '.$what;
            
            $hoursworked = $_GET['hours'];
            $rate = 12;
            $total = $hoursworked * $rate;
            echo '<br>You owe me $'.$total;
            
            
            
            if ($hoursworked > 40) {
            $total = $hoursworked * $rate * 1.5;
            } else {
            $total = $hoursworked * $rate;
            }
            echo '<br>(calculated value:)<br>';
            echo ($total > 0) ? 'You owe me $'.$total : "You're welcome";
            
            // tic-tac-toe stuff
            // $position = $_GET['board'];
            // $squares = str_split($position);
            echo '<br>Board is: ' . $_GET['board'] . '<br>';
            if (winner('x', $_GET['board']))
                    echo 'x wins!';
            else if (winner('o', $_GET['board']))
                    echo 'o wins!';
            else
                    echo 'it\'s a draw!';
            
            function winner($token, $position) {
                
                // Check for winning row
                for($row=0; $row<3; $row++) {
                $result = true;                
                    for($col=0; $col<3; $col++)
                        if ($position[3*$row+$col] != $token) $result = false; 
                    if ($result)
                        // Winning row
                        return true;
                }
                
                // Check for winning col
                for($col=0; $col<3; $col++) {
                $result = true;                    
                    for($row=0; $row<3; $row++)
                        if ($position[3*$row+$col] != $token) $result = false; 
                    if ($result)
                        // Winning col
                        return true;
                }
                
                // Check for diagonal wins
                if ($position[0] == $token && $position[4] == $token && $position[8] == $token)
                    return true;
                if ($position[6] == $token && $position[4] == $token && $position[2] == $token)
                    return true;
                
                // drop-through for non-win condition
                return false;
            }
            
        ?>
    </body>
</html>

