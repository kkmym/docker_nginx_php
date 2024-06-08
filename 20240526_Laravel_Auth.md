# 今回の前提条件
    - 下記種類のログインがある
        - 管理/サイト運営
        - 企業
            - 営業？
        - ユーザー
    - 既存Cookieで自動ログインできる必要がある
        - ユーザーのみ？

# あらためて仕組みを俯瞰
## まずここで全体理解
- [図解] Laravel の認証周りのややこしいあれこれ。
    - https://zenn.dev/ad5/articles/48671b32c89897

## 実装レベルの話
- Laravelの認証カスタマイズに関するメモ #Laravel - Qiita
    - https://qiita.com/gunso/items/3ee57e5b011109164870
- Laravel: 認証のカスタマイズ - my notes
    - https://notes.yh1224.com/tech/a210332ea70fb99bcd607e3a21f51aa4/
- 【Laravel】認証を自作して学ぶguardとmiddleware | RE:ENGINES
    - https://re-engines.com/2020/10/05/laraval-custom-auth/
- Laravelで自作の認証を作成する - kita127のブログ
    - https://kita127.hatenablog.com/entry/2024/01/29/070320

## 認可について
- Laravel11でGate使ってUserをroleでルート分岐させるゾ
    - https://zenn.dev/369code/articles/b7840c2c32bfae
- Laravel Gate(ゲート)、Policy(ポリシー)を完全理解 | アールエフェクト
    - https://reffect.co.jp/laravel/laravel-gate-policy-understand

## とりあえずサンプル実装してみる
```
Guard
    名前 users
    config/auth.php にセットする

    └  Guard用ドライバ
            class MyApp1UsersGuard
            AppServiceProvider::boot() で登録する
                Auth::extend(); を使う
                    users という文字列と紐づける
            名前 myapp1_users_guard

    └ Guardに渡すプロバイダ
            名前 users_provider

Provider
    ドライバ
        class MyApp1UsersProvider
        AppServiceProvider::boot() で登録する
            Auth::provider(); を使う
                myapp1_users_provider という文字列と紐づける
        名前 myapp1_users_provider
```

config/auth.php の想定する状態
```
return [
    'guards' => [
        'admins' => [
            'driver' => 'myapp1_admins_guard',
            'provider' => 'admins_provider',
        ],
        'clients' => [
            'driver' => 'myapp1_clients_guard',
            'provider' => 'clients_provider',
        ]
        'users' => [
            'driver' => 'myapp1_users_guard',
            'provider' => 'users_provider',
        ],
    ],
    'providers' => [
        'admins_provider' => [
            'driver' => 'myapp1_admins_provider',
        ],
        'clients_provider' => [
            'driver' => 'myapp1_clients_provider',
        ],
        'users_provider' => [
            'driver' => 'myapp1_users_provider',
        ],
    ],
]
```