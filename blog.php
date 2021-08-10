<?php
// $blog = $_POST;

// if ($blog['publish_status'] === 'un_publish'){
//     echo '公開中の記事がありません。';
//     return;
// }

// if ($blog['publish_status'] === 'publish') {
//     foreach ($blog as $key => $value) {
//         echo '<pre>';
//         echo $key . ':'. htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
//         echo '<pre>';
//     }
// } elseif ($blog['publish_status'] === 'un_publish') {
//     echo '公開中の記事がありません。';
// } else {
//     echo '記事がありません。';
// }

// nl2br 改行をHTMLの<br>に変換


require_once('dbc.php');

class Blog extends Dbc
{
    protected $table_name = 'blog';
    // 3.カテゴリー名を表示
    // 引数 : 数字
    // 返り値 : カテゴリーの文字列
    // public static function setCategoryName($category)
    // 引数も返り値も固定の場合共通で使えるのでstaticを使ってもよい関数と言える
    function setCategoryName($category)
    {
        if ($category === 1) {
            return '日常';
        } elseif ($category === 2) {
            return 'プログラミング';
        } else {
            return 'その他';
        }
    }

    public function blogCreate($blogs)
    {
        $sql = "INSERT INTO 
    $this->table_name(title, content, category, publish_status) 
    VALUES 
    (:title, :content, :category, :publish_status)";

        $dbh = $this->dbConnect();
        $dbh->beginTransaction();   //トランザクション処理(始めますという宣言)

        try {   //アイテムをDBに新規作成
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title', $blogs['title'], \PDO::PARAM_STR);
            $stmt->bindValue(':content', $blogs['content'], \PDO::PARAM_STR);
            $stmt->bindValue(':category', $blogs['category'], \PDO::PARAM_INT);
            $stmt->bindValue(':publish_status', $blogs['publish_status'], \PDO::PARAM_INT);
            $stmt->execute();
            $dbh->commit(); //トランザクション処理(宣言することで移動成功となる)
            echo 'ブログを投稿しました';
        } catch (\PDOException $e) {
            $dbh->rollback();   //トランザクション処理(失敗した場合)
            exit($e);
        }
    }


    public function blogUpdate($blogs)
    {
        $sql = "UPDATE $this->table_name SET 
                    title = :title, content = :content, category = :category, publish_status = :publish_status
                WHERE 
                    id = :id";
        $dbh = $this->dbConnect();
        $dbh->beginTransaction();   //トランザクション処理(始めますという宣言)

        try {   //アイテムをDBに新規作成
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title', $blogs['title'], \PDO::PARAM_STR);
            $stmt->bindValue(':content', $blogs['content'], \PDO::PARAM_STR);
            $stmt->bindValue(':category', $blogs['category'], \PDO::PARAM_INT);
            $stmt->bindValue(':publish_status', $blogs['publish_status'], \PDO::PARAM_INT);
            $stmt->bindValue(':id', $blogs['id'], \PDO::PARAM_INT);
            $stmt->execute();
            $dbh->commit(); //トランザクション処理(宣言することで移動成功となる)
            echo 'ブログを更新しました';
        } catch (\PDOException $e) {
            $dbh->rollback();   //トランザクション処理(失敗した場合)
            exit($e);
        }
    }

    function blogValidate($blogs)   //ブログのバリデーション
    {
        if (empty($blogs['title'])) {
            exit('タイトルを入力してください');
        }

        if (mb_strlen($blogs['title']) > 191) { //長さを計測
            exit('タイトルは191文字以内にしてください');
        }

        if (empty($blogs['content'])) {
            exit('本文を入力してください');
        }

        if (empty($blogs['category'])) {
            exit('カテゴリーは必須です');
        }

        if (empty($blogs['publish_status'])) {
            exit('公開ステータスは必須です');
        }
    }
}

?>

<!-- <!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ</title>
</head>

<body>
    <h2><?php echo htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
    <p>投稿日:<?php echo htmlspecialchars($blog['post_at'], ENT_QUOTES, 'UTF-8'); ?></p>
    <p>カテゴリ:<?php echo htmlspecialchars($blog['category'], ENT_QUOTES, 'UTF-8'); ?></p>
    <br>
    <p><?php echo nl2br(htmlspecialchars($blog['content'], ENT_QUOTES, 'UTF-8')); ?></p>
</body>

</html> -->