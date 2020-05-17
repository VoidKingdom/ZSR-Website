<?php
require "header.php";
//checks if the user is allowed access to this page
if (!substr($_SESSION['userID'], 0, 1)==3){
    header("Location: home.php");
    exit();
}
?>
    <main>
        <div class="wrapper">
            <h1>Create News Post</h1>
            <div class="create">
                <!-- A form for the user to input information before having it process through news.php -->
                <form action="php/news.php" method="post" onsubmit="getContent()">
                    <h3>News Title</h3>
                    <input type="text" name="news_title" placeholder="Topic Title">
                    <h3>Topic Content</h3>
                    <div>
                        <span contenteditable='true' id='shown-textbox'>Topic Content</span>
                    </div>
                    <textarea id='hidden-textarea' name='news_content' style='display:none'></textarea>
                    <button type="submit" name="news-submit">Create News Post</button>
                </form>
                <script src='js/textbox.js'></script>
            </div>
        </div>
    </main>
