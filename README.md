# 飲食店予約アプリ
<img width="1437" alt="shop_all" src="https://github.com/fukumamire/todo/assets/136237535/54a24a32-84a0-4c31-a2f0-69c4943134ae">

## 作成した目的
自社で予約サービスを持ちたい。

## アプリケーションURL

開発環境：http://localhost/

phpMyAdmin:：http://localhost:8080/


## 機能一覧
会員登録
ログイン
ログアウト
ユーザー情報取得≒マイページ
ユーザー飲食店お気に入り一覧取得
ユーザー飲食店予約情報取得
飲食店一覧取得
飲食店詳細取得
飲食店お気に入り追加
飲食店お気に入り削除
飲食店予約情報追加
飲食店予約情報削除
エリアで検索する
ジャンルで検索する
店名で検索する


###　店舗一覧について
・店舗画像URLを複数DBに保存できるようになっています。


## 使用技術（実行環境）
Laravel 8.x、PHP 7.4.9、docker、laravel-fortify、javascript

## テーブル設計とER図


## テーブル定義

### users テーブル

| カラム名   | 型             | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
|------------|----------------|-------------|------------|----------|-------------|
| id         | bigint         | 〇          | 〇         | 〇       |             |
| name       | VARCHAR        |             |            | 〇       |             |
| email      | VARCHAR        |             | 〇         | 〇       |             |
| password   | VARCHAR        |             |            | 〇       |             |
| created_at | timestamp      |             |            | 〇       |             |
| updated_at | timestamp      |             |            | 〇       |             |

### shops テーブル

| カラム名   | 型               | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
|------------|------------------|-------------|------------|----------|-------------|
| id         | unsigned bigint  | 〇          | 〇         | 〇       |             |
| name       | VARCHAR          |             |            | 〇       |             |
| outline    | TEXT             |             |            |          |             |
| created_at | timestamp        |             |            |          |             |
| updated_at | timestamp        |             |            |          |             |

### shop_areas テーブル (中間テーブル)

| カラム名   | 型               | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
|------------|------------------|-------------|------------|----------|-------------|
| id         | unsigned bigint  | 〇          | 〇         | 〇       |             |
| shop_id    | unsigned bigint  |             | 〇         | 〇       | 〇           |
| area_id    | unsigned bigint  |             | 〇         | 〇       | 〇           |
| created_at | timestamp        |             |            |          |             |
| updated_at | timestamp        |             |            |          |             |

### areas テーブル

| カラム名   | 型               | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
|------------|------------------|-------------|------------|----------|-------------|
| id         | unsigned bigint  | 〇          | 〇         | 〇       |             |
| name       | VARCHAR          |             |            | 〇       |             |
| created_at | timestamp        |             |            |          |             |
| updated_at | timestamp        |             |            |          |             |

### genres テーブル

| カラム名   | 型               | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
|------------|------------------|-------------|------------|----------|-------------|
| id         | unsigned bigint  | 〇          |            | 〇       |             |
| shop_id    | INT              |             | 〇         | 〇       | 〇           |
| name       | VARCHAR          |             |            | 〇       |             |
| created_at | timestamp        |             |            |          |             |
| updated_at | timestamp        |             |            |          |             |

### shop_images テーブル

| カラム名       | 型               | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
|----------------|------------------|-------------|------------|----------|-------------|
| id             | unsigned bigint  | 〇          | 〇         | 〇       |             |
| shop_id        | INT (bigint)     |             | 〇         | 〇       | 〇           |
| shop_image_url | VARCHAR(255)     |             |            | 〇       |             |
| created_at     | timestamp        |             |            | 〇       |             |
| updated_at     | timestamp        |             |            | 〇       |             |


### bookings テーブル

| カラム名         | 型         | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
|------------------|------------|-------------|------------|----------|-------------|
| id               | INT(bigint)| 〇          |            | 〇       |             |
| user_id          | INT(bigint)|             |            | 〇       |             |
| shop_id          | INT(bigint)|             |            | 〇       |             |
| date             | DATE       |             |            | 〇       |             |
| time             | TIME       |             |            | 〇       |             |
| number_of_people | INT        |             |            | 〇       |             |
| status           | VARCHAR    |             |            | 〇       |             |
| created_at       | timestamp  |             |            |          |             |
| updated_at       | timestamp  |             |            |          |             |

### favorites テーブル

| カラム名   | 型         | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
|------------|------------|-------------|------------|----------|-------------|
| id         | INT(bigint)| 〇          | 〇         |          |             |
| user_id    | INT(bigint)|             |            | 〇       |             |
| shop_id    | INT(bigint)|             |            | 〇       |             |
| created_at | timestamp  |             |            |          |             |
| updated_at | timestamp  |             |            |          |             |


# 環境構築
## Dockerビルド

1. git@github.com:fukumamire/Booking-restaurant.gitconfirmation-test-contact-form.git
2. DockerDesktopアプリを立ち上げる
3. docker-compose up -d --build

## Laravel環境構築
1. ```docker-compose exec php bash```
2. ```composer install```
3. 必要に応じて.envファイルを作成し作成した際は以下の環境変数を追加
``` DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass 
```
4. アプリケーションキーの作成
``` php artisan key:generate```

5. マイグレーションの実行
``` php artisan migrate ```

