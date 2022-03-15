![scrollapp-view](https://media.gh-news.nhk.or.jp/user/7/files/3d490a80-a39e-11ec-9217-624b9d161f3d)

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
![tree](https://media.gh-news.nhk.or.jp/user/7/files/9ec6a480-a3b1-11ec-93a3-a5038eb5c306)  
※Bootstrapフォルダは除外  

## 構造
### autopush.sh
cronにて行う、Gitへの自動プッシュ処理を記載しているファイル

### COMMON
- data  
JSONファイルを格納。このJSONファイルを軸に機能を展開。  
PHP-CRUDフォルダ内では、JSONファイルを更新。  
PHP-SCROLLフォルダ内では、このJSONファイルを元にスクレイピングを実行。  

### OUTPUT
スクロール結果としてファイルが格納されていくフォルダ。  
下層には、「ID + DIRNAME(例：1000_nhk)」でフォルダが生成される。

### PHP-CRUD
GUIにて、CRUD機能を有したページを構成。  
MAMPのlocalサーバーにてページを表示。  
data内のJSONファイルを更新する。  
機能は、Create（登録・新規作成）、Read（参照）、Update（更新）、Delete（削除）と、一時停止からなる。  

### PHP-SCROLL
ターミナルにてMAMPのPHPでスクロールを実行。
または、cronにて提示実行。  
OUTPUTフォルダ以下に、生成ファイルやエラー時のテキストファイルを格納。


## クロール定期実行
- cron  
cronによって、スクロール処理とGitへのコミットプッシュを定期実行している。  
crontabに以下を記載。  
処理は、以下の順で実施。  
  1. PHPでのスクロール（以下、例。絶対このまま記載しないこと）  
  ```* * * * * php /applications/mamp/htdocs/web-scroll-app/php-scroll/index.php```
  1. Gitへの自動コミットプッシュ（以下、例。絶対このまま記載しないこと）  
  ```* * * * * sh /Applications/MAMP/htdocs/web-scroll-app/autopush.sh```
  
## クロール任意実行
任意のタイミングで実行する場合は、PHP-SCROLL直下のindex.phpファイルを直接ターミナルで実行する
1. ターミナルを起動  
1. コマンドでPHP-SCROLLフォルダへ移動  
```cd /Applications/MAMP/htdocs/web-scroll```
1. コマンドでPHPを実行  
```php index.php```


## 課題
- コードフォーマット機能  
よくwebアプリで見られる整形機能を実装したいが、フォーマットのルールが多岐にわたるため一旦保留。  
- 差分確認機能  
ブラウザにて、任意のファイル2つを選択し、差分をみれるようにしたい。  
