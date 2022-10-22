<?php

include ("../init.php");
use Models\Course;

$template = $mustache->loadTemplate('course/add.mustache');
echo $template->render();

try {
    if (isset($_POST['name'])) {
        $addCourse = new Course($_POST['name'], $_POST['class_code'], $_POST['description'], $_POST['teacher_id']);
        $addCourse->setConnection($connection);
        $addCourse->addCourse();
        header('Location: index.php');
    }
}

catch (Exception $e) {
    error_log($e->getMessage());
}