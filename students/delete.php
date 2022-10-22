<?php
include ("../init.php");
use Models\Student;

$id = $_GET['id'];
$student = new Student('');
$student->setConnection($connection);
$student->getRecord($id);
$student->delete();
header('Location: index.php');