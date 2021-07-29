<?php
use Models\Page;

require_once "bootstrap.php";

$newPageTitle = $argv[1];
$newPageContent = $argv[2];

$page = new Page();
$page->setTitle($newPageTitle);
$page->setContent($newPageContent);

$entityManager->persist($page);
$entityManager->flush();

echo "Created Page with ID " . $page->getId() . "\n";