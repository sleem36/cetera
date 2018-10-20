<?php
/**
 * добавление/редактирование поста
 */

require('../.config.php');
require('../DB.php');
require('../Post.php');
require('../User.php');

$user = new User();
if(!$user->checkAuth())
{
  header('Location: /admin/login.php');
  exit;
}

$post = new Post($_GET['id']);

// сохранить пост
if(isset($_POST['save']))
{
  if($post->id == 0){
    $result = $post->Add($_POST);
    $sql = "SELECT MAX(id) FROM post";
    $mysqli = $post->select($sql);
    $last = $mysqli[0]['MAX(id)'];
    $href =  "http://yii.loc";
    header('Location: '.$href.'/detail.php?id='.$last);    
}
  else
    $result = $post->Update($_POST);

  if(!$result)
    $message = '<div class="error">Пост не сохранен</div>';
  else
    $message = '<div class="ok">Пост сохранен</div>';
}
?>
<!doctype html>
<html lang="ru-RU">
  <head>
    <meta charset="UTF-8">
    <title>Редактирование поста</title>
    <link rel="stylesheet" href="/includes/admin.css" />
  </head>
  <body>
  <header>
    <h1>Редактирование поста</h1>
  </header>

  <section>
    <article class='art'>
      <?= $message; ?>
      <form action="" method="post">
        <input type="hidden" name="save" value="1" />
        <div><label for="name">Название:</label>
          <input type="text" id="name" name="name" value="<?= $post->params['name']; ?>" /></div>
        <div><label for="message">Сообщение:</label>
          <textarea name="message" id="message" cols="30" rows="10"><?= $post->params['message']; ?></textarea>
        </div>
        <div>
          <button type="submit">Сохранить</button>
        </div>
      </form>
    </article>
    <aside class='side'>
      <nav>
        <ul>
          <li><a href="/admin/">Административный раздел</a></li>
          <li><a href="post_list.php">Список постов</a></li>
        </ul>
      </nav>
    </aside>
  </section>

  <footer>&copy; <a href="http://cetera.ru">Cetera labs</a> 2013</footer>
  </body>
</html>

