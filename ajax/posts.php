<?php
if (!$threads->getPosts()) :
    echo "No replies Yet";
else :
    foreach ($threads->getPosts() as $Post) : ?>
        <div class='post' id="<?php echo $Post['id'] ?>">
            <div class='author'>
                <div class='author-name'>
                    - <?php echo $Post['author']; ?>
                    <div class='id'><?php echo $Post['id'] ?></div>
                </div>
                <div class='time'>
                    <button id='reply' onclick="reply(<?php echo $Post['id']; ?>)">Reply</button>
                    <?php echo $Post['time']; ?>
                </div>
            </div>
            <div class='content'><span id="AveragePost">
                    <div class='media'>
                        <?php
                        if ($Post['ytcode'] != 0) : ?>
                            <iframe width='560' height='315' src="https://www.youtube.com/embed/<?php echo $Post['ytcode'] ?>" frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
                            <?php endif;
                        if ($Post['image'] != NULL) :
                            if ($Post['video'] == 1) : ?> <video controls>
                                    <source src=" ../uploads/<?php echo $Post['image'] ?>" type='video/mp4' />
                                </video>
                            <?php else : ?>
                                <img src="../uploads/<?php echo $Post['image'] ?>" />
                        <?php endif;
                        endif; ?>
                    </div>
                    <div class="content-text">
                        <?php
                        //if content contains /  / then wrap the number inside in a tags
                        $content = $Post['content'];
                        //if content contains [ ] then wrap the number inside in a tags and leave the [ ] out
                        $content = preg_replace('/\[([0-9]+)\]/', '<a href="#$1">[$1]</a>', $content);

                        //if content contains AP then wrap the "AP" in a tags
                        $content = preg_replace('/AP/', '<a href="#$0">$0</a>', $content);

                        echo $content;




                        ?>
                    </div>
                </span>
            </div>
        </div>
        <div class="postReplies">
            <span>
                <?php
                if (!$threads->getRepliesByPostId($Post['id'], $_GET['id'])) {
                } else {
                    foreach ($threads->getRepliesByPostId($Post['id'], $_GET['id']) as $reply) :
                        echo "/<a href=#" . $reply['id'] . ">" . $reply['id'] . "</a>/";
                    endforeach;
                }
                ?>
            </span>
        </div>
<?php endforeach;
endif; ?>