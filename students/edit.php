<?php

include ("../init.php");
use Models\Student;


$id = $_GET['id'];
$student = new Student('');
$student->setConnection($connection);
$student = $student->getRecord($id);

$template = $mustache->loadTemplate('student/edit.mustache');
echo $template->render(compact('student'));



if (isset($_POST['save_edit'])) {
    $updated_student = new Student('');
    $updated_student->setConnection($connection);
    $updated_student->getRecord(intval($_POST['id']));
    $updated_student->update($_POST['first_name'], $_POST['last_name'], $_POST['student_number'], $_POST['email'], $_POST['contact_number'], $_POST['program']);
    header('Location: index.php');
    exit();
}
