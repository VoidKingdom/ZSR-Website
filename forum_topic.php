<?php
//This line inserts the header to the webpage
require "header.php";
?>
    <main>
        <div class="wrapper">
            <?php
            require "php/dbconnect.php";
            // gets cat and topic from webadress
            $cid = $_GET['cat'];
            $tid = $_GET['topic'];
            //pulls from topics where cat and topic id match, limited to 1 incase of any database issues
            $sql = "SELECT * FROM topics WHERE cat_id='" . $cid . "' AND topic_id='" . $tid . "'LIMIT 1";
            $res = mysqli_query($connect,$sql);
            if (mysqli_num_rows($res) == 1) {
                while ($row = mysqli_fetch_assoc($res)) {
                    //changes the title to be based on topic title
                    echo '<h1>'.$row['topic_title'].'</h1>';
                    echo '<div class="posts">';
                    $views = $row['topic_views'];
                    $replies = $row['topic_replies'];
                    //pulls all posts from post databse which match the approrpiate ids
                    $sql2 = "SELECT * FROM posts WHERE cat_id='" . $cid . "' AND topic_id='" . $tid . "'";
                    $res2 = mysqli_query($connect,$sql2);
                    while ($row2 = mysqli_fetch_assoc($res2)) {
                        $date = strtotime($row2['post_date']);
                        // echos in information into a presentable format
                        echo '<div class="postreply">
                                <div>
                                    <p>'.$row2['post_content'].'</p>
                                </div>
                                <div class="userdata">
                                    <p>'.$row2['post_author'].'</p>
                                    <p>'.date('d F Y H:i', $date).'</p>
                                </div>
                            </div>';
                    }
                }
                //adds a view to the counter and updates the database
                $sql3 = "UPDATE topics SET topic_views='" . ++$views . "' WHERE cat_id='" . $cid . "' AND topic_id ='" . $tid . "' LIMIT 1";
                $res3 = mysqli_query($connect,$sql3);
                //if user is logged in then allow them to post a reply to the thread
                if (isset($_SESSION['userID'])) {
                    echo "<div class='reply'>
                            <form action='php/post.php' method='post' onsubmit='getContent()'>
                                <h3>Reply Content</h3>
                                <div>
                                    <span contenteditable='true' id='shown-textbox'>Write your response here</span>
                                </div>
                                <textarea id='hidden-textarea' name='reply' style='display:none'></textarea>
                                <input type='hidden' name='cat' value='" .$cid."'/>
                                <input type='hidden' name='topic' value='".$tid."'/>
                                <input type='hidden' name='replies' value='".$replies."'/>
                                <button type='submit' name='post_reply'>Post</button>
                            </form>
                            <script src='js/textbox.js'></script>
                        </div>";
                }
                //close div
                echo "</div>";
            }
            ?>
        </div>
    </main>