<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel='stylesheet' type="text/css" href='../styles/foorumi.css'>
</head>

<body>
    <?php
    include "navbar.php";
    ?>
    <div class="bodyWrap">
        <div class="bodyLeft">
            <?php
            include "../controller/threads.php";
            $threads = new threads();
            ?>
            <div class="bodyLeft-sticky">
                <form id='form' action="../controller/createPosts" method="post" enctype="multipart/form-data">
                    <h2>Create a new post</h2>
                    <label for="content">Content:</label><br>
                    <textarea name="content" placeholder="content of the post" maxlength="200" required id="content" cols="30" rows="10"></textarea><br>
                    <label for="image">Image:</label><br>
                    <input type='file' name='fileToUpload' id='fileToUpload' />
                    <button type="submit" id="id" value="<?php echo $_GET['id'] ?>" name="submit">Create</button>
                </form>
                <?php
                include "user.php";
                ?>
            </div>
        </div>
        <div class="bodyRight">
            <div class='allPosts'>
                <?php
                //aloitus postaus
                $threads->getThreadById($_GET['id']);
                foreach ($threads->getThreadById($_GET['id']) as $thread) :
                ?>
                    <div class='post' id='AP'>
                        <div class='author'>
                            <div class='author-name'>-<?php echo $thread['author']; ?>
                                <div class='id'><?php echo "AP" ?></div>
                            </div>
                            <div class='time'>
                                <button id='reply' onclick="reply('AP')">Reply</button>
                                <?php echo $thread['time']; ?>
                            </div>
                        </div>
                        <div class='content'><span id="AveragePost">
                                <div class='media'>
                                    <?php if ($thread['image'] != NULL) :
                                        if ($thread['video'] == 1) : ?>
                                            <video controls>
                                                <source src="../uploads/<?php echo $thread['image'] ?>" type='video/mp4' />
                                            </video>
                                        <?php else : ?>
                                            <img src="../uploads/<?php echo $thread['image'] ?>" />
                                    <?php endif;
                                    endif; ?>
                                </div>
                                <span>
                                    <div class='headline'><?php echo $thread['headline'] ?> </div>
                                    <div class="content-text">
                                        <?php echo $thread['content']; ?>
                                    </div>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="postReplies">
                        <span>
                            <?php
                            if ($threads->getRepliesByPostId('AP', $_GET['id']) == NULL) {
                                echo "No replies Yet";
                            } else {
                                foreach ($threads->getRepliesByPostId('AP', $_GET['id']) as $reply) :
                                    echo "/<a href=#" . $reply['id'] . ">" . $reply['id'] . "</a>/";
                                endforeach;
                            }
                            ?>
                        </span>
                    </div>
                <?php endforeach; ?>

                <?php include "../ajax/posts.php"; ?>
                <div class='timer'>
                </div>
            </div>
        </div>
        <script src="../includes/reply.js"></script>
</body>

</html>