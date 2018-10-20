<?php
/**
 * пост подробно
 */

require('./.config.php');
require('./DB.php');
require('./Post.php');


$post = new Post($_GET['id']);

$postArchive = $post->getArchive();

?><!doctype html>
<html lang="ru-RU">
<head>
  <meta charset="UTF-8">
  <title><?=$post->params['name'];?></title>
  <link rel="stylesheet" href="/includes/style.css" />
</head>
<body>
  <header>
    <h1><?=$post->params['name'];?></h1>
  </header>

  <section>
    <article>
      <p><?= $post->params['message']; ?></p>
    </article>
    <aside>
      <nav>
        <ul>
          <li><a href="/">Последние посты</a></li>
        </ul>
        <?php
        if(!empty($postArchive))
        {
          ?>
          <h2>Архив постов</h2>
          <ul>
            <?php
            foreach($postArchive as $archiveItem)
            {
              ?><li><a href="archive.php?year=<?=$archiveItem['year'];?>&month=<?=$archiveItem['month'];?>"><?=$archiveItem['month_name'];?> <?=$archiveItem['year'];?></a></li><?
            }
            ?>
          </ul>
          <?
        }
        ?>
      </nav>
    </aside>
  </section>
  <div class="b_m"></div>
  <footer>&copy; <a href="http://cetera.ru">Cetera labs</a> 2013</footer>
</body>
</html>

