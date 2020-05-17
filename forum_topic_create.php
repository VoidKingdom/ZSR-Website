<?php
//This line inserts the header to the webpage
require "header.php";
//checks if the user is logged in and has a cat id otherwise this website would throw errors
if ((!isset($_SESSION['userID'])) || ($_GET['cat'] == "")){
    header("Location: home.php");
    exit();
}
$cid = $_GET['cat'];
?>
<!--A form to process the information provided by user through topic.php -->
    <main>
        <div class="wrapper">
            <h1>Create Topic</h1>
            <div class="create">
            <form action="php/topic.php" method="post" onsubmit="getContent()">
                <h3>Topic Title</h3>
                <input type="text" name="topic_title" placeholder="Topic Title">
                <h3>Topic Content</h3>
                <div>
                    <span contenteditable='true' id='shown-textbox'>Topic Content</span>
                </div>
                <textarea id='hidden-textarea' name='topic_content' style='display:none'></textarea>
                <input type="hidden" name="cat" value="<?php echo $cid ?>"/>
                <button type="submit" name="topic-submit">Create Topic</button>
            </form>
            <script src='js/textbox.js'></script>
            </div>
        </div>
    </main>