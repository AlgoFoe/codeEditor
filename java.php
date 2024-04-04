<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("location: /webpage/login_sys/login.php");
    exit;
}
$loggedin=true;
?>
<!DOCTYPE html>
<html lang="en" style="overflow:hidden">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit.Code</title>
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.css"
        integrity="sha512-uf06llspW44/LZpHzHT6qBOIVODjWtv4MxCricRxkzvopAlSWnTf6hpZTFxuuZcuNE9CBQhqE0Seu1CoRk84nQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/theme/dracula.min.css"
        integrity="sha512-gFMl3u9d0xt3WR8ZeW05MWm3yZ+ZfgsBVXLSOiFz2xeVrZ8Neg0+V1kkRIo9LikyA/T9HuS91kDfc2XWse0K0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="codemirror/lib/codemirror.js"></script>
    <script src="codemirror/mode/css/css.js"></script>
    <script src="codemirror/mode/javascript/javascript.js"></script>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo+Play:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/086e514b71.js" crossorigin="anonymous"></script>
</head>
<div class="navbar">
    <div class="logo cairo-play-logo">Edit.Code</div>
    <ul class="langs">
    <li class="lang-item cairo-play-logo"><a href="/webpage/login_sys/index.php">Web</a></li>
        <li class="lang-item cairo-play-logo"><a href="/webpage/login_sys/python.php">Python</a></li>
        <li class="lang-item cairo-play-logo"><a href="/webpage/login_sys/c.php">C</a></li>
        <li class="lang-item cairo-play-logo"><a href="/webpage/login_sys/cpp.php">C++</a></li>
        <li class="lang-item cairo-play-logo"><a href="/webpage/login_sys/java.php">Java</a></li>
        <?php if ($loggedin) { ?>
          <li class="lang-item cairo-play-logo">
            <a style="color:#e62c51;" class="logout" href="/webpage/login_sys/logout.php">Logout</a>
          </li>
        <?php } ?>
    </ul>
</div>
<div class="container">
    <div class="left-section">
        <ul class="tab-list">
            <li class="tab-item">
                <a id="java-section" data-select="one" class="active">JAVA</a>
            </li>
        </ul>
        <div class="tab-content" id="tab-content">
            <div id="java" class="tab-pane">
                <textarea id="code" name="java"></textarea>
            </div>
        </div>
    </div>
    <div class="right-section">
        <span id="opbtn"><button onclick="runCode()"><i class="fa-solid fa-play"></i></button> Output</span>
        <div id="result"></div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/clike/clike.min.js"
    integrity="sha512-l8ZIWnQ3XHPRG3MQ8+hT1OffRSTrFwrph1j1oc1Fzc9UKVGef5XN9fdO0vm3nW0PRgQ9LJgck6ciG59m69rvfg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="script5.js"></script>
</body>

</html>