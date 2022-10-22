<?php
include ("../init.php");
use Models\Teacher;

$id = $_GET['id'];
$teacher = new Teacher('');
$teacher->setConnection($connection);
$teacher->getRecord($id);
$teacher->delete();
header('Location: index.php');