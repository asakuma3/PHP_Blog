<?PHP
require_once('blog.php');

$blogs = $_POST;

$blog = new Blog();
$blog->blogValidate($blogs);
$blog->blogUpdate($blogs);
?>
<p><a href="/PHP_Basic_Course/index.php">戻る</a></p>