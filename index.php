<?PHP
require_once('blog.php');

#12削除機能
// ①configを作ってDB接続値を定義
// ②htmlspecialcharについて(セキュリティ)
// ③削除機能を作る

#11編集機能
// ①編集ボタンクリックでIDを送る
// ②IDを受け取り内容を表示
// ③編集データとIDを渡す
// ④IDから探してDBを更新する

// use Blog\Dbc;  
// Dbcだけでnamespaceの意味になるという宣言

#08
// ①フォームから値を渡す
// ②フォームから値を受け取る
// ③バリデーションする(型や文字数が正しいか検証)
// ④トランザクション(送信側と受信側双方の整合性チェック)を開始
// ⑤データをDBに登録

$blog = new Blog();
// var_dump($dbc);
//取得したデータを表示
$blogData = $blog->getAll();

//htmlspecialcharをつける関数
function h($s)
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ一覧</title>
</head>

<body>
    <h2>ブログ一覧</h2>
    <p><a href="/PHP_Blog/form.html">新規作成</a></p>
    <table>
        <tr>
            <th>タイトル</th>
            <th>カテゴリNo</th>
            <th>カテゴリ</th>
            <th>投稿日時</th>
        </tr>
        <?php foreach ($blogData as $column) : ?>
            <tr>
                <td><?php echo h($column['title']) ?></td>
                <td><?php echo h($column['category']) ?></td>
                <td><?php echo h($blog->setCategoryName($column['category'])) ?></td>
                <td><?php echo h($column['post_at']) ?></td>
                <td><a href="/PHP_Blog/detail.php?id=<?php echo $column['id'] ?>">詳細</a></td>
                <td><a href="/PHP_Blog/update_form.php?id=<?php echo $column['id'] ?>">編集</a></td>
                <td><a href="/PHP_Blog/blog_delete.php?id=<?php echo $column['id'] ?>">削除</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>