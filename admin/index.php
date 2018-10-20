<?php
require('../.config.php');
require('../DB.php');
require('../User.php');

$user = new User();
if(!$user->checkAuth())
  {
    header('Location: /admin/login.php');
    exit;
  }
?>
<!doctype html>
<html lang="ru-RU">
  <head>
    <meta charset="UTF-8">
    <title>Административный раздел</title>
    <link rel="stylesheet" href="/includes/admin.css" />
  </head>
  <body>
    <header>
      <h1>Административный раздел</h1>
    </header>

    <section>
      <article class='art'>
        <ul>
          <li><a href="post_list.php">Список постов <br />≡</a></li>
          <li><a href="post_edit.php">Создать пост <br />&#10548;</a></li>
        </ul>
      </article>
      <aside class='side'>
        <nav>
          <ul>
            <li><a href="/admin/">Административный раздел</a></li>
            <li><a href="post_edit.php">Создать пост</a></li>
          </ul>
        </nav>
      </aside>
    </section>

    <footer>&copy; <a href="http://cetera.ru">Cetera labs</a> 2013</footer>
    <script type="text/javascript" src="http://yandex.st/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="/includes/admin.js"></script>
  </body>
</html>