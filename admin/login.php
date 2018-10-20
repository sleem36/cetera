<?php

require('../.config.php');
require('../DB.php');
require('../User.php');

$user = new User();

if(isset($_POST['login']) && isset($_POST['pass']))
{
  $user->auth($_POST['login'], $_POST['pass']);

  if($user->checkAuth())
  {
    header('Location: /admin/');
    exit;
  }
  else
    $message = 'Логин или пароль неверны';
}

?>
<!doctype html>
<html lang="ru-RU">
  <head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="/includes/admin.css" />
  </head>
  <body>
  <header>
    <h1>Авторизация</h1>
  </header>

  <section>
    <article class='art'>
      <?= $message; ?>
      <form action="" method="post">
        <div><label for="login">Логин:</label>
          <input type="text" id="login" name="login" value="" /></div>
        <div><label for="pass">Пароль:</label>
          <input type="text" id="pass" name="pass" value="" /></div>
        <div>
          <button type="submit">Войти</button>
        </div>
      </form>
    </article>
    <aside class='side'>
      <nav>
        <ul>
          <li><a href="/admin/">Административный раздел</a></li>
          <li><a href="/admin/login.php">Авторизация</a></li>
        </ul>
      </nav>
    </aside>
  </section>

  <footer>&copy; <a href="http://cetera.ru">Cetera labs</a> 2013</footer>
  </body>
</html>