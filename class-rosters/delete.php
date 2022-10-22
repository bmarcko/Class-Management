<?php
include ("../init.php");
use Models\ClassRoster;

$id = $_GET['id'];
$classRoster = new ClassRoster('');
$classRoster->setConnection($connection);
$classRoster->getRecord($id);
$classRoster->delete();
header('Location: index.php');