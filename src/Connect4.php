<?php

namespace User\Codewars;

class Connect4
{
    private $board = [];
    private $currentPlayer = 2;
    private $currentColumn = 0;
    private $currentRow = 0;
    private $winner = null;
    private $gameOver = false;

    public function __construct()
    {
        $this->board = array_fill(0, 7, array_fill(0, 6, 0));
    }
    public function play(int $column): string
    {
        if ($this->gameOver) {
            return "Game has finished!";
        }
        $this->changePlayer();
        $this->currentColumn = $column;

        if ($this->checkColumnFullness()) {
            return "Column full!";
        }
        $this->makeMove();
        if ($this->checkVerticalWin() || $this->checkHorizontalWin() || $this->checkDiagonalWin()) {
            $this->gameOver = true;
            return "Player {$this->currentPlayer} wins!";
        }
        return "Player {$this->currentPlayer} has a turn";
    }
    private function checkColumnFullness(): bool
    {
        foreach($this->board[$this->currentColumn] as $cell) {
            if ($cell === 0) {
                return false;
            }
        }
        return true;
    }
    private function changePlayer(): void
    {
        $this->currentPlayer = $this->currentPlayer === 1 ? 2 : 1;
    }
    private function makeMove(): void
    {
        foreach($this->board[$this->currentColumn] as $row => $cell) {
            if ($cell === 0) {
                $this->currentRow = $row;
                $this->board[$this->currentColumn][$row] = $this->currentPlayer;
                break;
            }
        }
    }
    private function getRow(): array
    {
        $row = [];
        foreach($this->board as $columnNumber => $columnValue) {
            $row[] = $columnValue[$this->currentRow];
        }
        return $row;
    }
    private function checkVerticalWin(): bool
    {
        $column = $this->board[$this->currentColumn];
        for ($i = 0; $i <= count($column) - 4; $i++) {
            if ($column[$i] === $this->currentPlayer
                && $column[$i + 1] === $this->currentPlayer
                && $column[$i + 2] === $this->currentPlayer
                && $column[$i + 3] === $this->currentPlayer) {
                return true;
            }
        }
        return false;
    }
    private function checkHorizontalWin(): bool
    {
        $row = $this->getRow();
        for ($i = 0; $i <= count($row) - 4; $i++) {
            if ($row[$i] === $this->currentPlayer
                && $row[$i + 1] === $this->currentPlayer
                && $row[$i + 2] === $this->currentPlayer
                && $row[$i + 3] === $this->currentPlayer) {
                return true;
            }
        }
        return false;
    }

    private function getDiagonals(): array
    {
        $result = [];
        // Ищем диагонали, идущие сверху-вниз, слева-направо (↘️)
        // Начальная строка: от 0 до ($rows - $length)
        // Начальный столбец: от 0 до ($cols - $length)
        $rows = count($this->board[0]);
        $cols = count($this->board);
        $length = 4;
        for ($col = 0; $col <= $cols - $length; $col++) {
            for ($row = 0; $row <= $rows - $length; $row++) {
                $diagonal = [];
                for ($k = 0; $k < $length; $k++) {
                    $diagonal[] = $this->board[$col + $k][$row + $k];
                }
                $result[] = $diagonal;
            }
        }

        for ($col = 0; $col <= $cols - $length; $col++) {
            for ($row = $length - 1; $row < $rows; $row++) {
                $diagonal = [];
                for ($k = 0; $k < $length; $k++) {
                    $diagonal[] = $this->board[$col + $k][$row - $k];
                }
                $result[] = $diagonal;
            }
        }
        return $result;
    }
    private function checkDiagonalWin(): bool
    {
        foreach($this->getDiagonals() as $diagonal) {
            if (implode('',$diagonal) === str_repeat($this->currentPlayer, 4)) {
                return true;
            }
        }
        return false;
    }
}