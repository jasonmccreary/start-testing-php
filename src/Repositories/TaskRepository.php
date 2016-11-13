<?php

namespace StartTestingPHP\Repositories;

use Exception;
use StartTestingPHP\Models\Task;

class TaskRepository
{
    private $dbConnection;

    public function __construct(\mysqli $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function all()
    {
        $result = $this->dbConnection->query('SELECT note FROM tasks ORDER BY created DESC');

        if ($result === false || $result->num_rows === 0) {
            return [];
        }

        $tasks = [];
        while ($data = $result->fetch_assoc()) {
            $tasks[] = new Task($data['note']);
        }

        $result->free();

        return $tasks;
    }

    public function create($note)
    {
        $sql = 'INSERT INTO tasks (note, created) VALUES (?, NOW())';
        $stmt = $this->dbConnection->prepare($sql);
        if (!$stmt) {
            throw new Exception($this->dbConnection->getError());
        }

        $stmt->bind_param('s', $note);

        if (!$stmt->execute()) {
            return false;
        }

        $stmt->close();

        return new Task($note);
    }
}