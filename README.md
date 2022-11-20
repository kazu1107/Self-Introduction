# Tawara屋(ECサイト)

このWebサイトでは、利用者同士が新品・中古問わず、商品を売買することを目的としています。

# 概要

出品と購入を同じアカウントで行うことができます。また、ログイン機能, 出品機能, 購入機能(クレジット決済のみ), 検索機能, サイト内BGM, お問い合わせ機能など様々な機能を実装しています。  

# 開発環境

・Docker &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Ver.20.10.17)  
・GitHub  
・Laravel &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Ver 9.25.1)  
・Ubuntu &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Ver.20.04 LTS)  
・VSCode &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Visual Studio Code)  
***
・Composer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Ver.2.4.1)  
・Laravel Breeze (Ver.1.8.0)  
・Laravel Mix  
・Laravel Sail &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Ver.1.13)  
・npm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Ver.8.18.1)  
***
・CSS  
・HTML  
・JavaScript  
・MySQL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Ver 8.0.30)  
・Node.js &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Ver.16.17.0)  
・PHP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Ver.8.1.9)  
・Tailwind CSS &nbsp;(Ver.3.0.22)  

# 使い方

1.windows にWSL2 を導入  
2.Ubuntu を導入
windows terminal を開き、windows powershell で下記コマンドを実行
``` bash
$wsl --list --online
```
Ubuntu に * がついていることを確認して、下記コマンドを実行してインストール
``` bash
$wsl --install
```

windows を再起動し、名前とパスワードを設定した後、下記コマンドを実行
``` bash
$sudo sed -i -e 's/http:\/\/archive.ubuntu.com/http:\/\/jp.archive.ubuntu.com/g' /etc/apt/sources.list
$sudo apt-get update
$sudo apt-get upgrade
$sudo apt-get clean
```
3.Docker Engine からDocker を導入(Docker Desktop でも可。その場合はUbuntu を導入する工程がこの後になります)
下記コマンドを実行し、docker を導入
> \マークは改行なので、次の行も含めて1つのコマンドとして扱う  

[参考URL](https://docs.docker.com/engine/install/ubuntu/)
``` bash
$sudo apt-get update
$sudo apt-get install \
    ca-certificates \
    curl \
    gnupg \
    lsb-release
$sudo mkdir -p /etc/apt/keyrings
$curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
$echo \
"deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu \
$(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
$sudo apt-get update
$sudo apt-get install docker-ce docker-ce-cli containerd.io docker-compose-plugin
$apt-cache madison docker-ce
```
コマンド実行後**2列目**のバージョン文字列 (例: 5:20.10.16~3-0~ubuntu-jammy) を使用して、特定のバージョンをインストールする
``` bash
$install docker-ce=<VERSION_STRING> docker-ce-cli=<VERSION_STRING> containerd.io docker-compose-plugin
```
下記コマンドを実行して動作確認
``` bash
$sudo docker run hello-world
```


4.Docker コンテナをDocker イメージとしてインストールし、プロジェクトを作成(もしくはmaster ブランチをGitHub からダウンロードしてください)
``` bash
$curl -s "https://laravel.build/[作成したいプロジェクト名]?php=81" | bash
$cd [作成したプロジェクト名]
$sail up
```
なお、上記curl コマンドの詳細は下記の通りとなります。  
``` bash
docker info > /dev/null 2>&1

# Ensure that Docker is running...
if [ $? -ne 0 ]; then
    echo "Docker is not running."

    exit 1
fi

docker run --rm \
    --pull=always \
    -v "$(pwd)":/opt \
    -w /opt \
    laravelsail/php81-composer:latest \
    bash -c "laravel new example && cd example && php ./artisan sail:install --with=mysql,redis,meilisearch,mailhog,selenium "

cd example

./vendor/bin/sail pull mysql redis meilisearch mailhog selenium
./vendor/bin/sail build

CYAN='\033[0;36m'
LIGHT_CYAN='\033[1;36m'
BOLD='\033[1m'
NC='\033[0m'

echo ""

if sudo -n true 2>/dev/null; then
    sudo chown -R $USER: .
    echo -e "${BOLD}Get started with:${NC} cd example && ./vendor/bin/sail up"
else
    echo -e "${BOLD}Please provide your password so we can make some final adjustments to your application's permissions.${NC}"
    echo ""
    sudo chown -R $USER: .
    echo ""
    echo -e "${BOLD}Thank you! We hope you build something incredible. Dive in with:${NC} cd example && ./vendor/bin/sail up"
fi
```
5.テーブルを作成
```
$sail artisan migrate
```
6.Laravel Breeze をインストール
``` php
$sail composer require laravel/breeze --dev
$sail artisan breeze:install(動作に必要なコード群を生成)
```
7.最新バージョンのLaravel にはLaravel Mix ではなくVite がデフォルトでインストールされているので、Vite をアンインストールしてLaravel Mix をインストールする
``` php
$sail npm remove vite
$sail npm remove laravel-vite-plugin
```
Vite 設定ファイル(vite.config.js)削除  
resources/views/layouts/app.balde.php と  
resources/views/layouts/guest.blade.php の  
@vite ([‘resources/css/app.css’, ‘resources/js/app.js’])を以下のように**無効**にする
``` php
<!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
```

package.json の**scripts** で、下記を削除
``` json
"dev": "vite",
"build": "vite build"
```

resources/views/js/app.js を書き替える
``` js
// import './bootstrap';
require('./bootstrap');
```

resources/views/js/bootstrap.js を書き替える
``` js
// import _ from 'lodash';
window._ = require('lodash');
 
// import axios from 'axios';
window.axios = require('axios');
 
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
```

 .env の修正をする。Vite 用の設定を削除し、Laravel Mix 用の設定を追加する  
以下をすべて削除
``` js
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```
以下をすべて追加
``` js
MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```
下記コマンドを実行
``` bash
$sail npm install laravel-mix --save-dev
```

プロジェクトファイル**直下**にwebpack.mix を作成し、下記コード追加
``` js
const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);
```

app.blade.php にリンクを追加する。  
`resources/views/layouts/app.balde.php` と
`resources/views/layouts/guest.blade.php` の  
**head タグ**内に、下記を追加する
``` php
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
 
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
```

package.json の**script** に、下記を追加する
``` json
"dev": "npm run development",
"development": "mix",
"watch": "mix watch",
"watch-poll": "mix watch -- --watch-options-poll=1000",
"hot": "mix watch --hot",
"prod": "npm run production",
"production": "mix --production"
```
下記コマンドを実行
``` php
$sail npm run dev
```
8.シンボリックリンクを作成し、storage ディレクトリにアクセスできるようにする
``` php
$sail artisan strage:link
```

9.任意の画像を1枚以上用意していただくことで商品を出品することができます


# 注意点

`Use 'docker scan' to run Snyk tests against images to find vulnerabilities and learn how to fix them`  
という文章が出てきますが、脆弱性をチェックができるという旨の文章で、エラーではありません。

`docker ps` などのコマンドでpermission denied となる場合は、下記コマンドを実行してください。
``` bash
$sudo groupadd docker
$sudo usermod -aG docker $USER　　($USERはユーザー名)
$newgrp docker (変更を有効にするために仮想マシンを再起動する必要な場合もある)
$docker run hello-world
```

Laravel Sail 起動時に**Docker is not running.** が出る場合は、下記コマンドを実行後に再度Laravel Sail を起動してください。
``` bash
$sudo service docker start
```


サイトを閲覧する際は、必ずLaravel Sail を起動し、[こちら](http://localhost/product) からアクセスしてください。

# 製作者情報

・俵谷 一帆  
・kazu0711tawa@gmail.com  

# ライセンス

"Self-Introduction" is under [MIT license](https://en.wikipedia.org/wiki/MIT_License).

# リンク
[Google スライド](https://docs.google.com/presentation/d/1v5l66i0jFuODjE_8vUWeiW5UnTABJDYy9lPuUami9UM/edit#slide=id.gc6f80d1ff_0_0)
