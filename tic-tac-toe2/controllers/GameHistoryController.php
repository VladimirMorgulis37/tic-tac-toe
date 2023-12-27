<?php
class GameHistoryController {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function addGame($winner) {
        $this->model->addGame($winner);
    }

    public function displayHistory() {
        $history = $this->model->getGameHistory();
        $this->view->displayHistory($history);
    }
public function addGameResult($winner, $date) {
    $this->model->addGameResult($winner, $date);
    $this->displayHistory();
}

public function updateGameResult($id, $winner, $date) {
    $this->model->updateGameResult($id, $winner, $date);
    $this->displayHistory();
}
public function handleDelete() {
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $this->model->deleteGameResult($id);
        header("Location: table.php");
        exit();
    }
}
public function handleAction() {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'delete':
                $this->handleDelete();
                break;
            default:
                break;
        }
    }
}
}
?>
