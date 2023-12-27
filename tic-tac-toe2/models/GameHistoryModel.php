<?php

class GameHistoryModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addGame($winner) {
        $this->history[] = array('winner' => $winner, 'date' => date('Y-m-d H:i:s'));
    }
public function addGameResult($winner, $date) {
    $insertQuery = "INSERT INTO game_history (winner, game_date) VALUES (?, ?)";
    $result = $this->conn->query($insertQuery);
}

public function getGameHistory() {
    $selectQuery = "SELECT * FROM game_history";
    $result = $this->conn->query($selectQuery);

    $history = array();
    while ($row = $result->fetch_assoc()) {
        $history[] = $row;
    }

    return $history;
}
public function deleteGameResult($id) {
    $sql = "DELETE FROM game_history WHERE id = $id";
    $result = $this->conn->query($sql);
}
}
?>
