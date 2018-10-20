<?php
/**
 * список постов
 * удаление постов
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

$_GET['page'] = ($_GET['page'] <= 0 ? 1 : $_GET['page']);
$page = ($_GET['page'] - 1) * $GLOBALS['config']['post']['per_page'];

$post = new Post;

// удалить посты
if(isset($_POST['save']) && isset($_POST['delete']))
{
  $postDelete = new Post($_POST['delete']);
           foreach($_POST[delete] as $chkval)
            {
                $result = $postDelete->Delete($chkval);
            }
  if(!$result)
    $message = '<div class="error">Пост не удален</div>';
  else
    $message = '<div class="ok">Пост удален</div>';
}
$posts = $post->GetList('*', '', 'id DESC', $GLOBALS['config']['post']['per_page'], $page);
?>
<!doctype html>
<html lang="ru-RU">
  <head>
    <meta charset="UTF-8">
    <title>Список постов</title>
    <link rel="stylesheet" href="/includes/admin.css" />
  </head>
  <body>
  <header>
    <h1>Список постов</h1>
  </header>

  <section>
    <article class='art'>
      <?= $message; ?>
      <form action="" method="post">
        <input type="hidden" name="save" value="1" />
        <table>
          <thead>
          <tr>
            <th>#</th>
            <th>Название</th>
            <th>Дата</th>
            <th><label>Выбрать <br /> <input type="checkbox" id="deleteAll" value="" /></label></th>
          </tr>
          </thead>
          <?php
          foreach($posts as $post){?>
            <tr>
              <td><?= $post->params['id']; ?></td>
              <td><a href="post_edit.php?id=<?= $post->params['id']; ?>"><?= $post->params['name']; ?></a></td>
              <td><?= $post->params['date']; ?></td>
              <td><input class="inp-del" type="checkbox" name="delete[]" value="<?= $post->params['id']; ?>" /></td>
            </tr>
          <?}?>
          <tfoot>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>
              <button type="submit">Удалить</button>
            </td>
          </tr>
          </tfoot>
        </table>
      </form>
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


<?php
  $all = "SELECT count(*) FROM `post`";
  $counts = $post->select($all);
  $count_all = $counts[0]['count(*)'];
  $count = 4;// Количество записей на странице
  /* Входные параметры */
  $count_pages = ceil($count_all/$count);
  if($_GET[page]){$active = $_GET[page];}else{$active = 1;}
  $count_show_pages = 3;
  $url = $_SERVER[SCRIPT_NAME];
  $url_page = $_SERVER[SCRIPT_NAME]."?page=";
  if ($count_pages > 1) { // Всё это только если количество страниц больше 1
    /* Дальше идёт вычисление первой выводимой страницы и последней (чтобы текущая страница была где-то посредине, если это возможно, и чтобы общая сумма выводимых страниц была равна count_show_pages, либо меньше, если количество страниц недостаточно) */
    $left = $active - 1;
    $right = $count_pages - $active;
    if ($left < floor($count_show_pages / 2)) $start = 1;
    else $start = $active - floor($count_show_pages / 2);
    $end = $start + $count_show_pages - 1;
    if ($end > $count_pages) {
      $start -= ($end - $count_pages);
      $end = $count_pages;
      if ($start < 1) $start = 1;
    }
?>
  <!-- Дальше идёт вывод Pagination -->
  <div id="pagination" style="text-align: center">
    <span>Страницы: </span>
    <?php if ($active != 1) { ?>
      <a href="<?=$url?>" title="Первая страница">&lt;&lt;&lt;</a>
      <a href="<?php if ($active == 2) { ?><?=$url?><?php } else { ?><?=$url_page.($active - 1)?><?php } ?>" title="Предыдущая страница">&lt;</a>
    <?php } ?>
    <?php for ($i = $start; $i <= $end; $i++) { ?>
      <?php if ($i == $active) { ?><span><?=$i?></span><?php } else { ?><a href="<?php if ($i == 1) { ?><?=$url?><?php } else { ?><?=$url_page.$i?><?php } ?>"><?=$i?></a><?php } ?>
    <?php } ?>
    <?php if ($active != $count_pages) { ?>
      <a href="<?=$url_page.($active + 1)?>" title="Следующая страница">&gt;</a>
      <a href="<?=$url_page.$count_pages?>" title="Последняя страница">&gt;&gt;&gt;</a>
    <?php } ?>
  </div>
<?php } ?>

  <footer>&copy; <a href="http://cetera.ru">Cetera labs</a> 2013</footer>
  <script type="text/javascript" src="http://yandex.st/jquery/2.0.3/jquery.min.js"></script>
  <script type="text/javascript" src="/includes/admin.js?num=1"></script>
  </body>
</html>