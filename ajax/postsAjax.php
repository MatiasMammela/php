<script src="../includes/cookie.js"></script>
<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const thread_ID = urlParams.get('id')
    console.log(thread_ID)
    $.post('posts.php?id=' + thread_ID + '', function(response) {
        let rl = response.length;
        setCookie('rl', rl, 30);
        $('.timer').html(response);
    });

    function timer() {

        $.post('posts.php?id=' + thread_ID + '', function(response) {
            let rl = response.length;
            if (getCookie('rl') == "" || getCookie('rl') == null) {
                setCookie('rl', rl, 30);
            }


            let rl_cookie = getCookie('rl');

            if (rl > rl_cookie) {
                setCookie('rl', rl, 30);
                $('.timer').html(response);
            }

        });
    }
    setInterval(function() {
        timer();
    }, 1000);
    timer();
</script>