<?php

// namespace Blog\Dbc;

//#10
// ①staticを使ってみる
// ②アクセス修飾子をつける
// ③コンストラクタを理解する
// ④継承を使ってみる

require_once('env.php');

class Dbc
{
    protected $table_name;

    // function __construct($table_name){
    //     $this->table_name = $table_name;
    // }
    // 関数一つに一つの機能のみを持たせる
    // 1.データベース接続
    // 引数 : なし
    // 返り値 : 接続結果を返す
    protected function dbConnect()
    {
        $host = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

        try {
            $dbh = new \PDO($dsn, $user, $pass, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_EMULATE_PREPARES => false,    //デフォルトだとSQLインジェクションを防げないのでfalseにする
            ]);
            // echo '接続成功';
        } catch (\PDOException $e) {
            echo '接続失敗' . $e->getMessage();
            exit();
        };

        return $dbh;
    }

    // 2.データを取得する
    // 引数 : なし
    // 返り値 : 取得したデータ
    public function getAll()
    {
        $dbh = $this->dbConnect();  //同じファイル内で定義された関数を使うときthisを使う
        //①SQLの準備
        $sql = "SELECT * FROM $this->table_name";
        //②SQLの実行
        $stmt = $dbh->query($sql);
        //③SQLの結果を受け取る
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
        // var_dump($result);
        $dbh = null;    //データベースを閉じる
    }




    // var_dump(setCategoryName(2));   //テスト用

    // 引数: $id
    // 返り値: $result
    public function getById($id)   //ブログ詳細を取得する関数
    {
        if (empty($id)) {
            exit('IDが不正です');
        }
        $dbh = $this->dbConnect();

        // SQL準備
        $stmt = $dbh->prepare("SELECT * From $this->table_name WHERE id = :id"); //:idの部分がプレースホルダー
        $stmt->bindValue(':id', (int)$id, \PDO::PARAM_INT);  //文字列をintに直す
        // SQL実行
        $stmt->execute();
        // 結果を取得
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$result) {
            exit('ブログがありません');
        }
        return $result;
    }

    function delete($id)
    {
        if (empty($id)) {
            exit('IDが不正です');
        }
        $dbh = $this->dbConnect();

        // SQL準備
        $stmt = $dbh->prepare("DELETE From $this->table_name WHERE id = :id"); //:idの部分がプレースホルダー
        $stmt->bindValue(':id', (int)$id, \PDO::PARAM_INT);  //文字列をintに直す
        // SQL実行
        $stmt->execute();
        echo 'ブログを削除しました';

        // return $result;
    }
}
