<?php

include ("../init.php");
use Models\Teacher;

$template = $mustache->loadTemplate('teacher/add.mustache');
echo $template->render();

try {
    if (isset($_POST['first_name'])) {
        $addTeacher = new Teacher($_POST['first_name'], $_POST['last_name'], $_POST['employee_number'], $_POST['email'], $_POST['contact_number']);
        $addTeacher->setConnection($connection);
        $addTeacher->addTeacher();
        header('Location: index.php');
    }
}

catch (Exception $e) {
    error_log($e->getMessage());
}