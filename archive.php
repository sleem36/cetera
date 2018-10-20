<?php
/*
 * архив постов по месяцам
 */

require('./.config.php');
require('./DB.php');
require('./Post.php');

$monthNames = array(1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель', 5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь');

$year = $_GET['year'];
$month = $_GET['month'];

$_GET['page'] = ($_GET['page'] <= 0 ? 1 : $_GET['page']);
$page = ($_GET['page'] - 1) * $GLOBALS['config']['post']['per_page'];

$post = new Post;
$posts = $post->GetList('*', 'DATE_FORMAT(date, "%Y") = '.$year.' AND DATE_FORMAT(date, "%c") = ' . $month, 'id DESC', $GLOBALS['config']['post']['per_page'], $page);

$postArchive = $post->getArchive();
?>
<!doctype html>
<html lang="ru-RU">
<head>
  <meta charset="UTF-8">
  <title>Архив постов. <?=$monthNames[$month];?> <?=$year;?></title>
  <link rel="stylesheet" href="/includes/style.css" />
</head>
<body>
<header>
  <h1>Архив постов. <?=$monthNames[$month];?> <?=$year;?></h1>
</header>

<section>
  <article>
    <?php
    foreach($posts as $post){?>
      <div>
        <h2>
          <a href="detail.php?id=<?= $post->params['id']; ?>">
          <?= $post->params['name']; ?>
          </a>
        </h2>
        <time><?= $post->params['date']; ?></time>
      </div>
    <?}?>
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
          foreach($postArchive as $archiveItem){?>
            <li>
              <a href="archive.php?year=<?= $archiveItem['year']; ?>&month=<?= $archiveItem['month']; ?>">
                <?= $archiveItem['month_name']; ?> 
                <?= $archiveItem['year']; ?>
              </a>
            </li>
            <?}?>
        </ul>
      <?}?>
    </nav>
  </aside>
</section>
<?include_once 'test.php';?>
<footer>&copy; <a href="http://cetera.ru">Cetera labs</a> 2013</footer>
</body>
</html>

