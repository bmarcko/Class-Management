<?php

namespace models;
use \PDO;

class Teacher
{
    protected $id;
    protected $first_name;
    protected $last_name;
    protected $employee_number;
    protected $email;
    protected $contact_number;

    protected $connection;

    public function __construct($first_name = null, $last_name = null, $employee_number = null, $email = null, $contact_number = null)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->employee_number = $employee_number;
        $this->email = $email;
        $this->contact_number = $contact_number;
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

	public function getEmployeeNumber()
	{
		return $this->employee_number;
	}

    public function getEmail()
	{
		return $this->email;
	}

    public function getContactNumber()
	{
		return $this->contact_number;
    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getRecord($id)
	{
		try {
			$sql = 'SELECT * FROM teachers WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->first_name = $row['first_name'];
			$this->last_name = $row['last_name'];
            $this->employee_number = $row['employee_number'];
			$this->email = $row['email'];
			$this->contact_number = $row['contact_number'];

			return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function addTeacher()
	{
		try {
			$sql = "INSERT INTO teachers SET first_name=:first_name, last_name=:last_name, employee_number=:employee_number, email=:email, contact_number=:contact_number";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':first_name' => $this->getFirstName(),
				':last_name' => $this->getLastName(),
                ':employee_number' => $this->getEmployeeNumber(),
                ':email'=> $this->getEmail(),
                ':contact_number'=> $this->getContactNumber(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function update($first_name, $last_name, $employee_number, $email, $contact_number)
	{
		try {
			$sql = 'UPDATE teachers SET first_name=?, last_name=?, employee_number=?, email=?, contact_number=? WHERE id = ?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$first_name,
                $last_name,
				$employee_number,
				$email,
				$contact_number,
                $this->getId()

			]);
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->employee_number = $employee_number;
			$this->email = $email;
			$this->contact_number = $contact_number;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
        
	}
    public function delete()
	{
		try {
			$sql = 'DELETE FROM teachers WHERE id=?';
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
            $sql = 'SELECT * FROM teachers';
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
}

}