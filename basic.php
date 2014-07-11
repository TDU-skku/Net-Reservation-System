<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header("WWW-Authenticate: Basic realm=\"My Realm\"");
    header("HTTP/1.0 401 Unauthorized");
    echo "ユーザーがキャンセルボタンを押した時に送信されるテキスト\n";
    exit;
} else {
    echo "<p>こんにちは、{$_SERVER['PHP_AUTH_USER']} さん。</p>";
    echo "<p>あなたは、{$_SERVER['PHP_AUTH_PW']} をパスワードとして入力しました。</p>";
}
?>