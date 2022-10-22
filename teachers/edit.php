<?php

include ("../init.php");
use Models\Teacher;


$id = $_GET['id'];
$teacher = new Teacher('');
$teacher->setConnection($connection);
$teacher = $teacher->getRecord($id);

$template = $mustache->loadTemplate('teacher/edit.mustache');
echo $template->render(compact('teacher'));



if (isset($_POST['save_edit'])) {
    $updated_teacher = new Teacher('');
    $updated_teacher->setConnection($connection);
    $updated_teacher->getRecord(intval($_POST['id']));
    $updated_teacher->update($_POST['first_name'], $_POST['last_name'], $_POST['employee_number'], $_POST['email'], $_POST['contact_number']);
    header('Location: index.php');
    exit();
}
