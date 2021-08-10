<?PHP

require_once('blog.php');

$blog = new Blog();
$result = $blog->delete($_GET['id']);
?>

<p><a href="/PHP_Basic_Course/index.php">戻る</a></p>