<?php

namespace models;
use \PDO;

class Course
{
    protected $id;
    protected $name;
    protected $class_code;
    protected $description;
	protected $teacher_id;

	protected $connection;

    public function __construct($name = null, $description = null, $class_code = null, $teacher_id = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->class_code = $class_code;
		$this->teacher_id = $teacher_id;

    }


    public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getClassCode()
	{
		return $this->class_code;
	}

	public function getTeacherId()
	{
		return $this->teacher_id;
	}

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getRecord($id)
	{
		try {
			$sql = 'SELECT * FROM classes WHERE id=:id';
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

    public function addCourse()
	{
		try {
			$sql = "INSERT INTO classes SET name=:name, description=:description, class_code=:class_code, teacher_id=:teacher_id";
			$statement = $this->connection->prepare($sql);

			return $statement->execute([
				':name' => $this->getName(),
				':description' => $this->getDescription(),
				':class_code' => $this->getClassCode(),
				':teacher_id' => $this->getTeacherId(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function update($name, $description, $class_code, $teacher_id)
	{
		try {
			$sql = 'UPDATE classes SET name=?, description=?, class_code=?, teacher_id=? WHERE id = ?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$name,
                $description,
                $class_code,
				$teacher_id,
                $this->getId()

			]);
			$this->name = $name;
			$this->description = $description;
			$this->class_code = $code;
			$this->teacher_id = $teacher_id;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

  public function delete()
	{
		try {
			$sql = 'DELETE FROM classes WHERE id=?';
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
            $sql = 'SELECT * FROM classes';
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}