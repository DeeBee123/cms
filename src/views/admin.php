<?php
include_once "bootstrap.php";

use Models\Page;


if (isset($_GET['action']) and $_GET['action'] == 'logout') {
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['logged_in']);
    header("Location: " . "/cms/login");
}


if (isset($_GET['delete'])) {
    $page =  $entityManager->find('Models\Page', $_GET['delete']);
    $entityManager->remove($page);
    $entityManager->flush();

    echo ("<script type='text/javascript'>
    window.location.href=\"/cms/admin\";
    alert(\"Page has been deleted.\");
    </script>");
}
if (isset($_POST['title']) && isset($_POST['content'])) {

    $page = new Page();
    $page->setTitle($_POST['title']);
    $page->setContent($_POST['content']);

    $entityManager->persist($page);
    $entityManager->flush();

    echo ("<script type='text/javascript'>
    window.location.href=\"/cms/admin\";
    alert(\"Page was added successfully.\");
    </script>");
}
if (isset($_POST['update_title']) && isset($_POST['update_content'])) {
    $page = $entityManager->find('Models\Page', $_POST['update_id']);
    $page->setTitle($_POST['update_title']);
    $page->setContent($_POST['update_content']);
    $entityManager->flush();

    echo ("<script type='text/javascript'>
    window.location.href=\"/cms/admin\";
    alert(\"Page was edited successfully.\");
    </script>");
}
?>

<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="src/style/main.css">
    <link rel="stylesheet" href="src/style/global.css">
</head>
<style>
    .actionBtn {
        color: #099c95;
        margin-right: 10px;
    }
</style>

<body <?php if ($_SESSION['logged_in'] == false)  echo ("style=display:none;") ?>>
    <div class="container">
        <nav class="menu">
            <div class="main-menu">
                <a class="active">Admin</a>
                <a href="/cms/">View as User</a>
                <a href="?action=logout">Logout</a>

            </div>
        </nav>

        <article 
        <?php if (isset($_GET['edit']) || ($_GET['action']) == "add") {
                        echo ("style=\"display: none\"");
                    } ?>>
            <h1>Manage Pages</h1>
            <div class="content">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once "bootstrap.php";
                        $pages = $entityManager->getRepository('Models\Page')->findAll();
                        function checkIfNotHome($id)
                        {
                            if ($id !== 1) ("<a href=?delete=" . $id . ">DELETE</a>");
                        }
                        foreach ($pages as $page) {
                            $deleteBtn = $page->getId() === 1 ? "" : "<a class=\"actionBtn\" href=?delete=" . $page->getId() . ">DELETE</a>";

                            print("
                        <tr>
                        <td>" . $page->getTitle() . "</td>
                        <td><a class=\"actionBtn\" href=?edit=" . $page->getId() . ">EDIT</a>" . $deleteBtn . "</td>
                    </tr>
                       ");
                        }
                        ?>

                    </tbody>
                </table>
                <a href="?action=add" class="ghost-round" style="color: #243545; border-color: #243545; padding:7px 20px;">New page</a>
            </div>
        </article>

        <?php
        if (($_GET['action']) == "add") {
            print("
<article><h1>Create New Page</h1>
    <div class=\"content\">
        <form action=\"\" method=\"POST\" style=\"display: flex; flex-direction: column;\">
            <label for=\"title\">Title</label>
            <input type=\"text\" id=\"title\" name=\"title\" autocomplete=\"off\"  required>
            <label for=\"content\">Content</label>
            <textarea name=\"content\" id=\"content\" cols=\"30\" rows=\"10\" style=\"resize: none;\" required></textarea>
            <input  type=\"submit\" class=\"ghost-round create\" style=\"color: #243545; border-color: #243545; padding:0 20px; align-self: flex-start; margin-top: 7px\" value=\"Submit\">
        </form>
        <a href=\"/cms/admin\" class=\"ghost-round\" style=\"color: #243545; border-color: #243545; padding:7px 20px;\">Go back</a>
    </div>
</article>
");
        }


        ?>
        <?php
        include_once "bootstrap.php";
        if (isset($_GET['edit'])) {
            $page =  $entityManager->find('Models\Page', $_GET['edit']);
            print("
<article><h1>Edit page (id:" . $page->getId() . ")</h1>
    <div class=\"content\">
        <form action=\"\" method=\"POST\" style=\"display: flex; flex-direction: column;\">
            <input type=\"hidden\" name=\"update_id\" value=\"{$page->getId()}\">
            <label for=\"title\">Title</label>
            <input type=\"text\" id=\"title\" name=\"update_title\" autocomplete=\"off\" value=\"" . $page->getTitle() . " \">
            <label for=\"content\">Content</label>
            <textarea name=\"update_content\" id=\"content\" cols=\"30\" rows=\"10\" style=\"resize: none;\">" . $page->getContent() . "</textarea>
            <input type=\"submit\" class=\"ghost-round\" style=\"color: #243545; border-color: #243545; padding:0 20px; align-self: flex-start; margin-top: 7px\" value=\"Update\">
        </form>

        <a href=\"/cms/admin\" class=\"ghost-round\" style=\"color: #243545; border-color: #243545; padding:7px 20px;\">Go back</a>
    </div>
</article>
");
        }
        ?>

    </div>
</body>
</html>