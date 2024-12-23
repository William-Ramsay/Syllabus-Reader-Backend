<?php

class courseController
{
    public PDO $pdo;
    public function __construct()
    {
        $this->pdo = connectdb();
    }
    public function getAllCourses()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Course");

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCourse()
    {
        $stmt = $this->pdo->prepare('CALL Course(?) ');
        $stmt->execute(['CS101']);
        return $stmt->fetchAll();
    }
    public function getUserTasks()
    {
        $stmt = $this->pdo->prepare('CALL');
    }
}
