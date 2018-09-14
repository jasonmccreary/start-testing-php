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

        if (false === $result || 0 === $result->num_rows) {
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

    /**
     * @param $id
     *
     * @return array|bool
     *
     * @throws Exception
     */
    public function findById($id)
    {
        $sql = 'SELECT * FROM tasks WHERE id = ?';

        $stmt = $this->dbConnection->prepare($sql);

        if (!$stmt) {
            throw new Exception($this->dbConnection->getError());
        }

        $stmt->bind_param('i', $id);

        if (!$stmt->execute()) {
            return false;
        }

        $result = $stmt->get_result();

        $tasks = [];
        while ($data = $result->fetch_assoc()) {
            $tasks[] = new Task($data['note']);
        }

        $result->free();

        return $tasks;
    }

    /**
     * @param $note
     * @param $id
     *
     * @return bool
     *
     * @throws Exception
     */
    public function update($note, $id)
    {
        $sql = 'UPDATE tasks SET note = ? WHERE id = ?';
        $stmt = $this->dbConnection->prepare($sql);

        if (!$stmt) {
            throw new Exception($this->dbConnection->getError());
        }

        $stmt->bind_param('si', $note, $id);

        if (!$stmt->execute()) {
            return false;
        }

        return true;
    }
}
