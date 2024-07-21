<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['text_search'])) {
    if (isset($_POST['post_result'])) {
        if (!empty($_POST['text_search'])) {
            $text_search = trim($_POST['text_search']);
            $_SESSION['search_result'] = $text_search;
            header("Location: index.php?act=search-result");
            exit();
        }
    }
}
