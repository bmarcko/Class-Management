<?php

include ("../init.php");
use Models\ClassRoster;

$template = $mustache->loadTemplate('class-roster/add.mustache');
echo $template->render();

try {
    if (isset($_POST['first_name'])) {
        $addClassRoster = new ClassRoster($_POST['class_code'], $_POST['student_number'], $_POST['enrolled_at']);
        $addClassRoster->setConnection($connection);
        $addClassRoster->addClassRoster();
        header('Location: index.php');
    }
}

catch (Exception $e) {
    error_log($e->getMessage());
}