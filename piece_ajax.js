$(function() {
    var $good = $('.btn-good'), //いいねボタンセレクタ
        iinePostId; //投稿ID
    var $hanya = $('.btn-hanya'),
        hanyaPostId;
    var iNum, hNum, newiNum, newhNum;
    //var imageArray = [];
    var iineCount = {};
    var hanyaCount = {};
    //var iinePostId_before;
    //var hanyaPostId_before;
    $good.on('click', function(e) {
        //console.log(iineCount);
        e.stopPropagation();
        var $this = $(this);
        //カスタム属性（postid）に格納された投稿ID取得
        iinePostId = $this.parents('.post').data('postid');
        if(!iineCount[iinePostId]){
            iineCount[iinePostId] = 1;
        }else{
            iineCount[iinePostId]++;
        }
        console.log(iineCount[iinePostId]);
        iNum = $this.parents('.post').data('inum');
        if(iineCount[iinePostId] % 2 == 1){
            newiNum = iNum + 1;
        }else{
            newiNum = iNum;
        }
        console.log(iinePostId);
        $("#iineNum" + iinePostId).text(newiNum);
        //imageNum = $this.parents('.post').data('imagenum');
        $.ajax({
            type: 'POST',
            url: '../piece_ajax.php', //post送信を受けとるphpファイル
            datatype: 'json',
            data: {
                ipostId: iinePostId,
                iCount: iineCount[iinePostId]
                    //favId: 'iine'
            } //{キー:投稿ID}
        }).done(function(data) {
            ajmsg = iinePostId + ' : Ajax iine Success';
            console.log(ajmsg);
            //count++;
            //console.log(count);
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
        hanyaPostId = $this.parents('.post').data('postid');
        if(!hanyaCount[hanyaPostId]){
            hanyaCount[hanyaPostId] = 1;
        }else{
            hanyaCount[hanyaPostId]++;
        }
        hNum = $this.parents('.post').data('hnum');
        if(hanyaCount[hanyaPostId] % 2 == 1){
            newhNum = hNum + 1;
        }else{
            newhNum = hNum;
        }
        $("#hanyaNum" + hanyaPostId).text(newhNum);
        console.log(hanyaCount);
        $.ajax({
            type: 'POST',
            url: '../piece_ajax.php', //post送信を受けとるphpファイル
            data: {
                hpostId: hanyaPostId,
                hCount: hanyaCount[hanyaPostId]
                    //favId: 'hanya'
            } //{キー:投稿ID}
        }).done(function(data) {
            ajmsg = hanyaPostId + ' : Ajax hanya Success';
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
});