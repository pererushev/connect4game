<?php

namespace User\Codewars;

/**
 * Доска: $board[column][row], row 0 — низ столбца (куда падает фишка).
 */
class Connect4
{
    private const COLS = 7;
    private const ROWS = 6;
    private const WIN_LENGTH = 4;

    private array $board = [];
    private int $currentPlayer = 2;
    private int $currentColumn = 0;
    private int $currentRow = 0;
    private bool $gameOver = false;

    public function __construct()
    {
        $this->board = array_fill(0, self::COLS, array_fill(0, self::ROWS, 0));
    }

    public function play(int $column): string
    {
        if ($this->gameOver) {
            return "Game has finished!";
        }

        $this->currentColumn = $column;

        if ($this->checkColumnFullness()) {
            return "Column full!";
        }

        $this->changePlayer();
        $this->makeMove();

        if ($this->checkWin()) {
            $this->gameOver = true;

            return "Player {$this->currentPlayer} wins!";
        }

        return "Player {$this->currentPlayer} has a turn";
    }

    private function checkColumnFullness(): bool
    {
        foreach ($this->board[$this->currentColumn] as $cell) {
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
        foreach ($this->board[$this->currentColumn] as $row => $cell) {
            if ($cell === 0) {
                $this->currentRow = $row;
                $this->board[$this->currentColumn][$row] = $this->currentPlayer;
                break;
            }
        }
    }

    private function checkWin(): bool
    {
        return $this->countInLine(0, 1) >= self::WIN_LENGTH   // вертикаль
            || $this->countInLine(1, 0) >= self::WIN_LENGTH  // горизонталь
            || $this->countInLine(1, 1) >= self::WIN_LENGTH  // ↘
            || $this->countInLine(1, -1) >= self::WIN_LENGTH; // ↗
    }

    private function countInLine(int $colDelta, int $rowDelta): int
    {
        $count = 1;

        $col = $this->currentColumn + $colDelta;
        $row = $this->currentRow + $rowDelta;
        while ($this->isInBounds($col, $row) && $this->board[$col][$row] === $this->currentPlayer) {
            $count++;
            $col += $colDelta;
            $row += $rowDelta;
        }

        $col = $this->currentColumn - $colDelta;
        $row = $this->currentRow - $rowDelta;
        while ($this->isInBounds($col, $row) && $this->board[$col][$row] === $this->currentPlayer) {
            $count++;
            $col -= $colDelta;
            $row -= $rowDelta;
        }

        return $count;
    }

    private function isInBounds(int $col, int $row): bool
    {
        return $col >= 0 && $col < self::COLS && $row >= 0 && $row < self::ROWS;
    }
}
