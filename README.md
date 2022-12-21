# docker-laravel-api

Laravel REST API environment by Docker

## コンテナ起動

```bash
docker-compose up -d --build
```

## Laravel インストール

```bash
docker compose exec app bash

composer create-project --prefer-dist "laravel/laravel=8.*" .
```

インストール完了後に [http://localhost:8081/](http://localhost:8081/) にアクセスし Laravel の初期画面が表示されれば成功！

## DB 接続

`./src/.env` の `DB_CONNECTION` などの部分を以下で置き換え

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=root
DB_PASSWORD=password
```

## マイグレーション

```bash
docker compose exec app bash

php artisan migrate
```

### テーブル確認

MySQL に接続

```bash
docker-compose exec db bash

mysql -u root --password=password
```

テーブル確認

```sql
use database;

show tables;
```

以下のように Laravel のテーブルが返って来れば成功！

```txt
+------------------------+
| Tables_in_database     |
+------------------------+
| failed_jobs            |
| migrations             |
| password_resets        |
| personal_access_tokens |
| users                  |
+------------------------+
5 rows in set (0.00 sec)
```
