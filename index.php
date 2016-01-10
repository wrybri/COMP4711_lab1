<!doctype html>
<html>
    <head>
        <title>Hello COMP4711</title>
    </head>
    <body>
        <?php
             $game = new Game($_GET['board']);
             // $game->display();
            if ($game->winner('o')) {
                echo 'You win. Lucky guesses! ';
                echo '<a href="?board=---------">Replay?</a>';
            }
            else if ($game->is_draw()) {
                echo 'It\'s a draw! ';
                echo '<a href="?board=---------">Replay?</a>';
            }
            else {
                if ($game->pick_move()) {
                    echo 'I win. Muahahahaha! ';
                    echo '<a href="?board=---------">Replay?</a>';
                }
                else if ($game->is_draw()) {
                    echo 'It\'s a draw! ';
                    echo '<a href="?board=---------">Replay?</a>';
            }
            }
            
            $game->display();
            
            class Game {
                var $position;
                
                function __construct($squares) {
                    $this->position = str_split($squares);
                }
                
                function winner($token, $altPosition = "") {
                    if (!empty($altPosition))
                        $pos = $altPosition;
                    else
                        $pos = $this->position;
                    
                    // Check for winning row
                    for($row=0; $row<3; $row++) {
                    $result = true;                
                        for($col=0; $col<3; $col++)
                            if ($pos[3*$row+$col] != $token) $result = false; 
                        if ($result)
                            // Winning row
                            return true;
                    }

                    // Check for winning col
                    for($col=0; $col<3; $col++) {
                        $result = true;                    
                        for($row=0; $row<3; $row++)
                            if ($pos[3*$row+$col] != $token) $result = false; 
                        if ($result)
                            // Winning col
                            return true;
                    }

                    // Check for diagonal wins
                    if ($pos[0] == $token && $pos[4] == $token && $pos[8] == $token)
                        return true;
                    if ($pos[6] == $token && $pos[4] == $token && $pos[2] == $token)
                        return true;

                    // drop-through for non-win condition
                    return false;
                }
                
            function display() {
                echo '<table cols="3" style="font-size: large; font-weight: bold">';
                echo '<tr>'; // open the first row
                for ($pos=0; $pos<9;$pos++) {
                    echo $this->show_cell($pos);
                    if ($pos %3 == 2) echo '</tr><tr>'; // start a new row for the next square
                    }
                echo '</tr>'; // close the last row
                echo '</table>';
                }
            
            function show_cell($which) {
                $token = $this->position[$which];
                // deal with the easy case
                if ($token <> '-') return '<td>'.$token.'</td>';
                // now the hard case
                $this->newposition = $this->position; // copy the original
                $this->newposition[$which] = 'o'; // this would be their move
                $move = implode($this->newposition); // make a string from the board array
                $link = '?board='.$move; // this is what we want the link to be
                // so return a cell containing an anchor and showing a hyphen
                return '<td><a href='.$link.'>-</a></td>';
                }
                
            function is_draw() {
                for ($i = 0 ; $i <= 8 ; ++$i) {
                    if ($this->position[$i] == '-')
                        return false;
                }
                return true;
            }
                
            function pick_move() {
                // Find an immediate win condition
                for ($i = 0 ; $i <= 8 ; ++$i) {
                    if ($this->position[$i] == '-') {
                        $newposition = $this->position;
                        $newposition[$i] = 'x';
                        if ($this->winner('x', $newposition)) {
                            $this->position[$i] = 'x';
                            return true;
                        }
                    }
                }
                
                // If can't win, find a blocking move
                for ($i = 0 ; $i <= 8 ; ++$i) {
                    if ($this->position[$i] == '-') {
                        $newposition = $this->position;
                        $newposition[$i] = 'o';
                        if ($this->winner('o', $newposition)) {
                            $this->position[$i] = 'x';
                            echo 'Blocked you, fool!';
                            return false;
                        }
                    }
                }
                
                // If no win or block possible, choose random square
                while (true) {
                    $guess = rand(0,8);
                    if ($this->position[$guess] == '-') {
                        $this->position[$guess] = 'x';
                        return false;
                    }
                }
            }
        }
        ?>
    </body>
</html>

