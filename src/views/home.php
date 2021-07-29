<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="src/style/main.css">
    <link rel="stylesheet" href="src/style/global.css">
</head>

<body>
    <a class="ghost-round" href="/cms/login" style="padding:7px 20px;">Admin Login</a>
    <div class="container">
        <nav class="menu">
            <nav class="menu">
                <div class="main-menu">

                    <?php
                    include_once "bootstrap.php";
                    $pages = $entityManager->getRepository('Models\Page')->findAll();
                    $active = empty($_GET['p']) ? $entityManager->find('Models\Page', 1)  : $entityManager->find('Models\Page', $_GET['p']);
                    foreach ($pages as $page)
                        print("<a href=?p=" . $page->getId() . ">" . $page->getTitle() . "</a>");
                    echo ("    
                </div>
                </nav>
                </nav>
                <article>");
                    print("<h1>" . $active->getTitle() . "</h1>");
                    echo ("<div class=\"content\">");
                    print("<p>" .
                        $active->getContent()
                        . "</p>")
                    ?>

                </div>
                </article>
    </div>
</body>

</html>