<?php

include ("../init.php");
use Models\ClassRoster;

$classRoster= new ClassRoster('');
$classRoster->setConnection($connection);
$all_classRosters = $classRoster->getAll();

$template = $mustache->loadTemplate('class-roster/index.mustache');
echo $template->render(compact('all_classRosters'));