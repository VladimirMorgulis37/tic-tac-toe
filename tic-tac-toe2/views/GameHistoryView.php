<?php

class GameHistoryView {
    public function displayHistory($history) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Победитель</th><th>Дата игры</th><th>Действия</th></tr>";
        foreach ($history as $game) {
            echo "<tr><td>{$game['id']}</td><td>{$game['winner']}</td><td>{$game['game_date']}</td>";
            echo "<td><a href='?action=delete&id={$game['id']}'>Delete</a></td>";
        }
        echo "</table>";
    }
}
?>
