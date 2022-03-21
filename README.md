![scroll-app-top](https://user-images.githubusercontent.com/66257816/159259364-162aa12e-1d1e-43db-8894-4b1d52d1dcc6.png)

# WEB SCROLL APP
このウェブアプリは、ターゲットとなるWEBページのCSSファイルとJSファイルをローカルにダウンロードし、データとして蓄積させていくことを目的としてます。  
JSONデータをベースとして、ページのクロール対象を管理しつつ、Gitによりファイルのバージョン管理を実施するようにしています。  
管理情報となるJSONデータには直接触るのではなく、GUIからアクセスし、挙動の不備を防止。  
OUTPUTフォルダにデータが蓄積されるようにしています。  


## Language - library
- PHP  
機能面全般はPHPで記述。CRUD機能と内部処理すべて。  

- Bootstrap  
CRUDのGUIページのスタイルはほぼすべてBootstrapにて作成  


## TREE
![tree-v3](https://user-images.githubusercontent.com/66257816/159260267-f2386bc6-c5e8-4770-bfaa-a0afee9cf1fb.png)  
※Bootstrapフォルダは除外  


## 構造
### auto-commit.sh
cronにて行う、Gitへの自動コミット処理を記載しているファイル  
※プッシュは現状手動で実施

### COMMON
- data  
JSONファイルを格納。このJSONファイルを軸に機能を展開。  
PHP-CRUDフォルダ内では、JSONファイルを更新。  
PHP-SCROLLフォルダ内では、このJSONファイルを元にクロールを実行。  


### OUTPUT
スクロール結果としてファイルが格納されていくフォルダ。  
下層には、「ID + DIRNAME(例：1000_nhk)」でフォルダが生成される。  


### PHP-CRUD
GUIにて、CRUD機能を有したページを構成。  
MAMPのlocalサーバーにてページを表示。  
data内のJSONファイルを更新する。  
機能は、Create（登録・新規作成）、Read（参照）、Update（更新）、Delete（削除）と、停止実行切替からなる。  


### PHP-SCROLL
ターミナルにてMAMPのPHPでスクロールを実行。  
または、cronにて提示実行。  
OUTPUTフォルダ以下に、生成ファイルやエラー時のテキストファイルを格納。  

## クローリング対象管理
MAMPを起動し、以下のページにて管理を実施（クローンはhtdocsの直下）  
http://localhost:8888/web-scroll-app/php-crud/  

### CSSファイル / JSファイルの設定について
こちらは、可能であればhtmlファイルをクロールした際に主要なファイルを探しだすようにしたかったのですが、ご自身でファイルパスを記述する方式にしました。
理由は、ＨＴＭＬソースに記載されているCSSパス、JSパスが、大量な場合もあり、万が一関係ないファイルを抽出した場合、目的と大きく異なる結果が生まれてしまうためです。

## クロール定期実行
- cron  
cronによって、クロール処理とGitへのコミットを定期実行している。  
プッシュについては、Gitの方のエラーにひっかかってしまうため、現状手動。  
crontabに以下を記載。  
処理は、以下の順で実施。  
1. PHPでのクロール（以下、例。絶対このまま記載しないこと）  
```* * * * * php /applications/mamp/htdocs/web-scroll-app/php-scroll/index.php```
2. Gitへの自動コミット（以下、例。絶対このまま記載しないこと）  
```* * * * * sh /Applications/MAMP/htdocs/web-scroll-app/auto-commit.sh```

### cron実行上の注意事項
- cronはmacのスリープ中には実行されないため、cronで予約された処理を実行するためには、そのタイミングでスリープを解除されている必要がある。  
- MAMPでローカルサーバーを起動していないとPHP処理が行われないため、サーバーを起動しておく。  

### 設定フロー 例
- ローカル環境  
1. リポジトリをクローン  
クローンは、htdocsの直下  

- MAMP設定  
1. MAMPのapacheを自動起動に設定する  
Preferences... > General > Start servers ： チェックを入れる > OK  
2. PC起動と同時にMAMPを起動する設定を実施  
システム環境設定 > ユーザーとグループ > ログイン項目 > 鍵マークでログインパスワード入力 > 「+」ボタン　> アプリケーションの中の「MAMP.app」を選択 > 非表示ボタンにチェック > 鍵をロック  

- CRON設定  
1. ターミナル起動  
2. HOMEへ移動  
```cd ~```  
3. crontab編集画面を開く  
```crontab -e```  
4. 「I（アイ）」キーを押して「-- INSERT --」モードへ変更
5. PHPファイルの実行処理設定（例：毎週月曜日AM7:05）  
```5 7 * * 1 php /Applications/MAMP/htdocs/web-scroll-app/php-scroll/index.php```  
6. git commit 実行設定（例：毎週月曜日AM7:10）  
```10 7 * * 1 sh /Applications/MAMP/htdocs/web-scroll-app/auto-commit.sh```  
7. 「ESC」キーで「-- INSERT --」モードを終了
8. 「:wq」を入力して、保存して終了

> 参考  
> 設定内容を確認 : crontab -l  
> 設定内容をすべて削除 : crontab -r  


## クロール任意実行
任意のタイミングで実行する場合は、PHP-SCROLL直下のindex.phpファイルを直接ターミナルで実行する  
1. ターミナルを起動  
2. コマンドでPHP-SCROLLフォルダへ移動  
```cd /Applications/MAMP/htdocs/web-scroll```
3. コマンドでPHPを実行  
```php index.php```


## 課題
- 自動プッシュ  
プッシュまではなぜか自動での実施はできなかった。  
原因は現在調査中。  
- コードフォーマット機能  
よくwebアプリで見られる整形機能を実装したいが、フォーマットのルールが多岐にわたるため一旦保留。  
- 差分確認機能  
ブラウザにて、任意のファイル2つを選択し、差分をみれるようにしたい。  
