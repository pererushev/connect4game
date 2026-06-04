<?php

require __DIR__ . '/vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use User\Codewars\Connect4;

class MyTest extends TestCase
{
    public function testSampleTests() {
        $game = new Connect4();
        $this->assertSame("Player 1 has a turn", $game->play(0), "Should return 'Player 1 has a turn'");
        $this->assertSame("Player 2 has a turn", $game->play(0), "Should return 'Player 2 has a turn'");
        
        $game = new Connect4();
        $this->assertSame("Player 1 has a turn", $game->play(0), "Should return 'Player 1 has a turn'");
        $this->assertSame("Player 2 has a turn", $game->play(1), "Should return 'Player 2 has a turn'");
        $this->assertSame("Player 1 has a turn", $game->play(0), "Should return 'Player 1 has a turn'");
        $this->assertSame("Player 2 has a turn", $game->play(1), "Should return 'Player 2 has a turn'");
        $this->assertSame("Player 1 has a turn", $game->play(0), "Should return 'Player 1 has a turn'");
        $this->assertSame("Player 2 has a turn", $game->play(1), "Should return 'Player 2 has a turn'");
        $this->assertSame("Player 1 wins!", $game->play(0), "Should return 'Player 1 wins!'");
        
        $game = new Connect4();
        $this->assertSame("Player 1 has a turn", $game->play(4), "Should return 'Player 1 has a turn'");
        $this->assertSame("Player 2 has a turn", $game->play(4), "Should return 'Player 2 has a turn'");
        $this->assertSame("Player 1 has a turn", $game->play(4), "Should return 'Player 1 has a turn'");
        $this->assertSame("Player 2 has a turn", $game->play(4), "Should return 'Player 2 has a turn'");
        $this->assertSame("Player 1 has a turn", $game->play(4), "Should return 'Player 1 has a turn'");
        $this->assertSame("Player 2 has a turn", $game->play(4), "Should return 'Player 2 has a turn'");
        $this->assertSame("Column full!", $game->play(4), "Should return 'Column full!'");
        
        $game = new Connect4();
        $this->assertSame("Player 1 has a turn", $game->play(1), "Should return 'Player 1 has a turn'");
        $this->assertSame("Player 2 has a turn", $game->play(1), "Should return 'Player 2 has a turn'");
        $this->assertSame("Player 1 has a turn", $game->play(2), "Should return 'Player 1 has a turn'");
        $this->assertSame("Player 2 has a turn", $game->play(2), "Should return 'Player 2 has a turn'");
        $this->assertSame("Player 1 has a turn", $game->play(3), "Should return 'Player 1 has a turn'");
        $this->assertSame("Player 2 has a turn", $game->play(3), "Should return 'Player 2 has a turn'");
        $this->assertSame("Player 1 wins!", $game->play(4), "Should return 'Player 1 wins!'");
        $this->assertSame("Game has finished!", $game->play(4), "Should return 'Game has finished!'");
      }
}

?>