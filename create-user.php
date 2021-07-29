<?php
use Models\User;

require_once "bootstrap.php";

$newUser = $argv[1];


$user = new User();
$user->setLevel($newUser);


$entityManager->persist($user);
$entityManager->flush();

echo "Created User with ID " . $user->getId() . "\n";