<?PHP
// use Blog\Dbc;

// #07
// ①require_onceを使ってみよう
require_once('blog.php');
// ②namespaceを設定しよう
// ③useを使おう


// #06
// 詳細画面を表示する流れ
// ①一覧画面からブログのidを送る
// GETリクエストでidをURLにつけて送る

// ②詳細ページ
// PHPの$_GETでidを取得

// ③idをもとにデータベースから記事を取得
// SELECT文でプレースホルダーを使う

// ④詳細ページに表示する
// HTMLにPHPを埋め込んで表示

$blog = new Blog();
$result = $blog->getById($_GET['id']);    //Blog\Dbc\はnamespace

//  1.データベース接続
//  引数 : なし
//  返り値 : 接続結果を返す
// function dbConnect()
// {
//     $dsn = 'mysql:host=localhost;dbname=blog_app;charset=utf8';
//     $user = 'blog_user';
//     $pass = 'blogpass';

//     try {
//         $dbh = new PDO($dsn, $user, $pass, [
//             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//             PDO::ATTR_EMULATE_PREPARES => false,    //デフォルトだとSQLインジェクションを防げないのでfalseにする
//         ]);
//         // echo '接続成功';
//     } catch (PDOException $e) {
//         echo '接続失敗' . $e->getMessage();
//         exit();
//     };

//     return $dbh;
// }


// function setCategoryName($categ)
// {
//     if ($categ['category'] === 1) {
//         return 'ブログ';
//     } elseif ($categ['category'] === 2) {
//         return '日常';
//     } else {
//         return 'その他';
//     }
// }
// var_dump($result);
?>

<!DOCTYPE html>
<html lang="ja">
<hjad>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ詳細</title>
    </ブログ詳細>

    <body>
        <h2>ブログ詳細</h2>
        <h3>タイトル：<?PHP echo $result['title'] ?></h3>
        <p>投稿日時:<?PHP echo $result['post_at'] ?></p>
        <p>カテゴリ:<?PHP echo $result['category'] ?></p>
        <p>カテゴリ:<?PHP echo $blog->setCategoryName($result['category']) ?></p>
        <hr>
        <p>本文:<?PHP echo $result['content'] ?></p>
    </body>
    <p><a href="/PHP_Basic_Course/index.php">戻る</a></p>

</html>