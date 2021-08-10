<?PHP

// use Blog\Dbc;

require_once('blog.php');
$blogs = $_POST;

$blog = new Blog();
$blog->blogValidate($blogs);
$blog->blogCreate($blogs);
// var_dump($blogs);
?>
<p><a href="/PHP_Basic_Course/index.php">戻る</a></p>