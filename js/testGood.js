$(function() {
    var $good = $('.btn-good'), //いいねボタンセレクタ
        goodPostId; //投稿ID
    var $hanya = $('.btn-hanya'),
        goodPostId;
    $good.on('click', function(e) {
        e.stopPropagation();
        var $this = $(this);
        //カスタム属性（postid）に格納された投稿ID取得
        goodPostId = $this.parents('.post').data('postid');
        $.ajax({
            type: 'POST',
            url: 'ajaxGood.php', //post送信を受けとるphpファイル
            datatype: 'json',
            data: {
                postId: goodPostId,
                favId: 'iine'
            } //{キー:投稿ID}
        }).done(function(data) {
            ajmsg = goodPostId + ' : Ajax iine Success';
            console.log(ajmsg);

            // いいねの総数を表示
            //$this.children('span').html(data);
            // いいね取り消しのスタイル
            $this.children('i').toggleClass('far'); //空洞ハート
            // いいね押した時のスタイル
            $this.children('i').toggleClass('fas'); //塗りつぶしハート
            $this.children('i').toggleClass('active');
            $this.toggleClass('active');
        }).fail(function(msg) {
            console.log('Ajax Error');
        });
    });

    $hanya.on('click', function(e) {
        e.stopPropagation();
        var $this = $(this);
        //カスタム属性（postid）に格納された投稿ID取得
        goodPostId = $this.parents('.post').data('postid');
        $.ajax({
            type: 'POST',
            url: 'ajaxGood.php', //post送信を受けとるphpファイル
            datatype: 'json',
            data: {
                postId: goodPostId,
                favId: 'hanya'
            } //{キー:投稿ID}
        }).done(function(data) {
            ajmsg = goodPostId + ' : Ajax hanya Success';
            console.log(ajmsg);

            // いいねの総数を表示
            //$this.children('span').html(100);
            // いいね取り消しのスタイル
            $this.children('i').toggleClass('far'); //空洞ハート
            // いいね押した時のスタイル
            $this.children('i').toggleClass('fas'); //塗りつぶしハート
            $this.children('i').toggleClass('active');
            $this.toggleClass('active');
        }).fail(function(msg) {
            console.log('Ajax Error');
        });
    });
});