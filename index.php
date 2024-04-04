<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("location: /webpage/login_sys/login.php");
    exit;
}
$loggedin = true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit.Code</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.css" integrity="sha512-uf06llspW44/LZpHzHT6qBOIVODjWtv4MxCricRxkzvopAlSWnTf6hpZTFxuuZcuNE9CBQhqE0Seu1CoRk84nQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/theme/dracula.min.css" integrity="sha512-gFMl3u9d0xt3WR8ZeW05MWm3yZ+ZfgsBVXLSOiFz2xeVrZ8Neg0+V1kkRIo9LikyA/T9HuS91kDfc2XWse0K0A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="codemirror/lib/codemirror.js"></script>
    <script src="codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/xml/xml.min.js" integrity="sha512-LarNmzVokUmcA7aUDtqZ6oTS+YXmUKzpGdm8DxC46A6AHu+PQiYCUlwEGWidjVYMo/QXZMFMIadZtrkfApYp/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="codemirror/mode/css/css.js"></script>
    <script src="codemirror/mode/javascript/javascript.js"></script>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo+Play:wght@900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/086e514b71.js" crossorigin="anonymous"></script>
    <style>
        .CodeMirror {
            height: 480px;
            font-size: 24px;
            width: 100%;
        }

        .logo {
            margin-top: -3px;
            margin-left: 30px;
        }

        body {
            overflow-x: hidden;
        }
        .lang-item {
    margin-top: -3px;
    margin-left: 100px;
    width:90px;
    height: 25px;
}
        .navbar{
    height: 35px;
    width: 100%;
    display:flex;
    flex-wrap: wrap;
    flex-direction: column;
    align-items: center;
    background-color:#f18d2f;
}
.savebtn{
    position: absolute;
    top: -43px!important;;
    right: -140px;
}
form{
    position: absolute;
}
    </style>
</head>

<body>
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
                    <a style="color:#e62c51;" onmouseover="this.style.color='hsl(152, 76%, 45%)'" onmouseout="this.style.color='#e62c51'" class="logout" href="/webpage/login_sys/logout.php">Logout</a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="container">
        <div class="left-section">
            <ul class="tab-list">
                <li class="tab-item">
                    <a id="html-section" data-select="one" href="#" class="active">HTML</a>
                </li>
                <li class="tab-item">
                    <a id="css-section" data-select="two" href="#">CSS</a>
                </li>
                <li class="tab-item">
                    <a id="js-section" data-select="three" href="#">JS</a>
                </li>
            </ul>
            <div class="tab-content" id="tab-content">
                <div id="html-code" class="tab-pane">
                    <textarea id="html" name="html"></textarea>
                </div>
                <div id="css-code" class="tab-pane">
                    <textarea id="css" name="css"></textarea>
                </div>
                <div id="js-code" class="tab-pane">
                    <textarea id="js" name="js"></textarea>
                </div>
            </div>
        </div>
        <div class="right-section">
                <span id="opbtn"><button onclick="run()"><i class="fa-solid fa-play"></i> Output </button></span>
            <form action="/webpage/login_sys/save.php" method="POST">
                <input type="hidden" name="html_content" id="html_content">
                <input type="hidden" name="css_content" id="css_content">
                <input type="hidden" name="js_content" id="js_content">
                <span id="opbtn" class="savebtn"><button><i class="fa-regular fa-floppy-disk"></i> Save </button></span>  
            </form>
            <iframe id="output"></iframe>
        </div>
    </div>
    <script src="script.js"></script>
    <script>
        let nav = document.getElementById('navigation');

        function toggleMenu() {
            nav.classList.toggle('navigation--visible');
        }
    </script>
</body>

</html>