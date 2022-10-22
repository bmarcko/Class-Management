<?php

include ("../init.php");
use Models\Course;

$course= new Course('');
$course->setConnection($connection);
$all_courses = $course->getAll();

$template = $mustache->loadTemplate('course/index.mustache');
echo $template->render(compact('all_courses'));