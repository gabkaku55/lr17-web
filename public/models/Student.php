<?php
class Student
{
    private $pdo;
    public $id;
    public $full_name;
    public $grade;
    public $phone;
    public $email;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public static function all(PDO $pdo)
    {
        $sql = "SELECT * FROM students";
        $query = $pdo->query($sql);
        $students = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) 
            {
            $st = new Student($pdo);
            $st->id = $row['id'];
            $st->full_name = $row['full_name'];
            $st->grade = $row['grade'];
            $st->phone = $row['phone'];
            $st->email = $row['email'];
            $students[] = $st; }
        return $students;
    }
    public static function find(PDO $pdo, $id)
    {
        $sql = "SELECT * FROM students WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindParam(":id", $id);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_OBJ);
        if ($row) 
            {
            $st = new Student($pdo);
            $st->id = $row->id;
            $st->full_name = $row->full_name;
            $st->grade = $row->grade;
            $st->phone = $row->phone;
            $st->email = $row->email;
            return $st;  }
        return null;
    }
    public function update()
    {
        $sql = "UPDATE students SET full_name = :full_name, grade = :grade, phone = :phone, email = :email 
        WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([
            ':full_name' => $this->full_name,
            ':grade' => $this->grade,
            ':phone' => $this->phone,
            ':email' => $this->email,
            ':id' => $this->id
        ]);
    }
    public function delete()
    {
        $sql = "DELETE FROM students WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':id' => $this->id]);
    }
}
