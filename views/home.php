<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="../styles/foorumi.css" />
</head>

<body>
    <?php
    include "navbar.php";
    ?>
    <div class='bodyWrap'>
        <div class="bodyLeft">
            <div class="bodyLeft-sticky">
                <form action="../controller/createThreads" method="post" enctype="multipart/form-data">
                    <h2>Create a new thread</h2>
                    <label for="headline">Headline:</label>
                    <input autocomplete="off" type="text" required placeholder="Headline" name="headline" /><br>
                    <label for="content">Content:</label><br>
                    <textarea name="content" placeholder="Content of the thread" maxlength="200" required id="content" cols="30" rows="10"></textarea><br>
                    <label for="image">Image:</label><br>
                    <input type='file' name='fileToUpload' id='fileToUpload' />
                    <input type="submit" name="submit" value="Create" />
                </form>
                <?php include "../controller/threads.php";
                include "user.php";
                $threads = new threads(); ?>
            </div>
        </div>
        <div class="bodyRight">
            <?php

            //Display all Threads
            echo "<div class='threads'>";
            echo "<h2><u>Threads</u></h2>";
            if (!$threads->getAllThreads()) {
                echo "No threads found";
            } else {
                foreach ($threads->getAllThreads() as $thread) {
                    echo "<div class='thread'>";
                    echo "<a href='thread?id=" . $thread['id'] . "'>";
                    echo "<div class='author'>";
                    echo "<div class='author-name'>";
                    echo "-" . $thread['author'];
                    echo "</div>";
                    echo "<div class='time'>" . $thread['time'] . "</div>";
                    echo "</div>";
                    echo "</a>";
                    echo "<div class='thread-wrap'>";
                    echo "<div class='content'>";
                    echo "<div class='media'>";
                    if ($thread['image'] != NULL) {
                        if ($thread['video'] == 1) {
                            echo "<video controls>";
                            echo "<source src='../uploads/" . $thread['image'] . "' type='video/mp4' />";
                            echo "</video>";
                        } else {
                            echo "<img src='../uploads/" . $thread['image'] . "'>";
                        }
                    }
                    echo "</div>";
                    echo "<span><div class='headline'>" . $thread['headline'] . "</div>";
                    echo $thread['content'];
                    echo "</span>";
                    echo "</div>";
                    if ($threads->getPostsByThreadId($thread['id']) == NULL) {
                        echo "<a href='thread?id=" . $thread['id'] . "'><div class='replies'>0 replies</div></a>";
                    } else {
                        echo "<a href='thread?id=" . $thread['id'] . "'><div class='replies'>See all " . count($threads->getPostsByThreadId($thread['id']))  . " replies</div></a>";
                    }
                    echo "</div>";
                    echo "</div>";
                }
            }
            echo "</div>";




            ?>
        </div>
    </div>
</body>


</html>