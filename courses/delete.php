<?php
include ("../init.php");
use Models\Course;

$id = $_GET['id'];
$class = new Course('');
$class->setConnection($connection);
$class->getRecord($id);
$class->delete();
header('Location: index.php');