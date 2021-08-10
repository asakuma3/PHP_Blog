<?PHP
require_once('blog.php');

$blog = new Blog();
$result = $blog->getById($_GET['id']);    //Blog\Dbc\はnamespace

$id = $result['id'];
$title = $result['title'];
$content = $result['content'];
$category = (int)$result['category'];
$publish_status = $result['publish_status'];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogForm</title>
</head>

<body>
    <h2>ブログ更新フォーム</h2>
    <form action="/PHP_Blog/blog_update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>" />
        <p>ブログタイトル</p>
        <input type="text" name="title" value="<?php echo $title ?>">
        <p>ブログ本文:</p>
        <textarea name="content" id="content" cols="30" rows="10"><?PHP echo $content ?></textarea>
        <br>
        <p>カテゴリ</p>
        <select name="category">
            <option value='1'><?PHP if ($category === 1) echo "selected" ?>日常</option>
            <option value='2'><?PHP if ($category === 2) echo "selected" ?>プログラミング</option>
        </select>
        <br>
        <input type="radio" name="publish_status" value='1' <?PHP if ($publish_status === 1) echo "checked" ?>>公開
        <input type="radio" name="publish_status" value='2' <?PHP if ($publish_status === 2) echo "checked" ?>>非公開
        <br>
        <input type="submit" value="送信">
    </form>
    <p><a href="/PHP_Blog/index.php">戻る</a></p>

</body>

</html>