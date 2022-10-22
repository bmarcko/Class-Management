<?php

include ("../init.php");
use Models\Course;


$id = $_GET['id'];
$course = new Course('');
$course->setConnection($connection);
$course = $course->getRecord($id);

$template = $mustache->loadTemplate('course/edit.mustache');
echo $template->render(compact('course'));



if (isset($_POST['save_edit'])) {
    $updated_course = new Course('');
    $updated_course->setConnection($connection);
    $updated_course->getRecord(intval($_POST['id']));
    $updated_course->update($_POST['name'], $_POST['class_code'], $_POST['description'], $_POST['teacher_id']);
    header('Location: index.php');
    exit();
}
