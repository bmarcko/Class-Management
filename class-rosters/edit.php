<?php

include ("../init.php");
use Models\ClassRoster;


$id = $_GET['id'];
$classRoster = new ClassRoster('');
$classRoster->setConnection($connection);
$classRoster = $classRoster->getRecord($id);

$template = $mustache->loadTemplate('class-roster/edit.mustache');
echo $template->render(compact('classRoster'));



if (isset($_POST['save_edit'])) {
    $updated_classRoster = new Student('');
    $updated_classRoster->setConnection($connection);
    $updated_classRoster->getRecord(intval($_POST['id']));
    $updated_classRoster->update($_POST['class_code'], $_POST['student_number'], $_POST['enrolled_at']);
    header('Location: index.php');
    exit();
}
