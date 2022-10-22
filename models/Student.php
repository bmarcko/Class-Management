<?php

namespace models;
use \PDO;

class Student
{
    protected $id;
    protected $first_name;
    protected $last_name;
    protected $student_number;
    protected $email;
    protected $contact_number;
    protected $program;

    protected $connection;

    public function __construct($first_name = null, $last_name = null, $student_number = null, $email = null, $contact_number = null, $program = null)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->student_number = $student_number;
        $this->email = $email;
        $this->contact_number = $contact_number;
        $this->program = $program;
    }


    public function getId()
	{
		return $this->id;
	}

	public function getFirstName()
	{
		return $this->first_name;
	}

	public function getLastName()
	{
		return $this->last_name;
	}

	public function getStudentNumber()
	{
		return $this->student_number;
	}

    public function getEmail()
	{
		return $this->email;
	}

    public function getContactNumber()
	{
		return $this->contact_number;
    }

    public function getProgram()
	{
		return $this->program;
    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getRecord($id)
	{
		try {
			$sql = 'SELECT * FROM students WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->first_name = $row['first_name'];
			$this->last_name = $row['last_name'];
            $this->student_number = $row['student_number'];
			$this->email = $row['email'];
			$this->contact_number = $row['contact_number'];
			$this->program = $row['program'];

			return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function addStudent()
	{
		try {
			$sql = "INSERT INTO students SET first_name=:first_name, last_name=:last_name, student_number=:student_number, email=:email, contact_number=:contact_number, program=:program";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':first_name' => $this->getFirstName(),
				':last_name' => $this->getLastName(),
                ':student_number' => $this->getStudentNumber(),
                ':email'=> $this->getEmail(),
                ':contact_number'=> $this->getContactNumber(),
                ':program'=> $this->getProgram(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function update($first_name, $last_name, $student_number, $email, $contact_number, $program)
	{
		try {
			$sql = 'UPDATE students SET first_name=?, last_name=?, student_number=?, email=?, contact_number=?, program=? WHERE id = ?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$first_name,
                $last_name,
				$student_number,
				$email,
				$contact_number,
				$program,
                $this->getId()

			]);
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->student_number = $student_number;
			$this->email = $email;
			$this->contact_number = $contact_number;
			$this->program = $program;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
        
	}
    public function delete()
	{
		try {
			$sql = 'DELETE FROM students WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function getAll()
    {
        try {
            $sql = 'SELECT * FROM students';
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
}

}