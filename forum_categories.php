<?php
//This line inserts the header to the webpage
require "header.php";
?>
    <main>
        <div class="wrapper">
            <?php
            include("php/dbconnect.php");
            $cid = $_GET['cat'];
            //checks if the user is logged in and only presents them with the option to create a topic if they are
            if (isset($_SESSION['userID'])) {
                $logged = "<a href='forum_topic_create.php?cat=".$cid."'>Create Topic</a>";
            } else {
                $logged = "";
            }
            $sql = "SELECT * FROM categories WHERE cat_id='".$cid."' LIMIT 1;";
            $res = mysqli_query($connect, $sql);
            //only continues if the cat id exists in the database
            if (mysqli_num_rows($res) == 1) {
                $row = mysqli_fetch_assoc($res);
                //uses the title in the database as the h1
                echo "<h1>".$row['cat_title']."</h1>";
                $sql2 = "SELECT * FROM topics WHERE cat_id='".$cid."' ORDER BY topic_reply DESC";
                $res2 = mysqli_query($connect,$sql2);
                //gets all the topics in the catagory
                if (mysqli_num_rows($res2) > 0){
                    //adds a header and creates a table
                    echo"<h2>Posts</h2>";
                    echo"<div class='thread'>";
                    while ($row2 = mysqli_fetch_assoc($res2)){
                        //initilise variables
                        $tid = $row2['topic_id'];
                        $title = $row2['topic_title'];
                        $views = $row2['topic_views'];
                        $replies = $row2['topic_replies'];
                        //converts the dates so they can be formatted
                        $posted = strtotime($row2['topic_reply']);
                        $date = strtotime($row2['topic_date']);
                        $author = $row2['topic_author'];
                        $lasteruser = $row2['topic_last_user'];
                        $html = "forum_topic.php?cat=".$cid."&topic=".$tid;
                        //adds a table row with the data provided in the current row
                        echo '<div class="content">
                                    <div onclick="window.location="'.$html.';">
                                        <a href ="forum_topic.php?cat='.$cid.'&topic='.$tid.'">'.$title.'</a>
                                        <p>'.$author.' - '.date('d F Y H:i', $posted).'</p>
                                    </div>
                                    <dl onclick="window.location="'.$html.'">
                                        <dt>Replies</dt>
                                        <dd>'.$replies.'</dd><br/>
                                        <dt>Views</dt>
                                        <dd>'.$views.'</dd>
                                    </dl>
                                    <div onclick="window.location="'.$html.'">
                                        <p>'.date('d F Y H:i', $date).'</p>
                                        <p>'.$lasteruser.'</p>
                                    </div>
                                </div>';
                    }
                    //closes div and give option to return of create post
                    echo "</div>";
                    echo "<a href='forum_front.php'>Return to Categories</a>".$logged;
                } else {
                    echo "<a href='forum_front.php'>Return to Categories</a>".$logged;
                }
            } else {
                echo "<a href='forum_front.php'>Return to Categories</a>".$logged;
            }
            ?>
        </div>
    </main>