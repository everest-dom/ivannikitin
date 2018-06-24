<? die(); ?>
<style type="text/css">
    .comment {
        width: 800px;
        background: #fff;
        padding: 30px;
        box-sizing: border-box;
        margin-left: 50px;
    }
    .comment__form {
        overflow: hidden;
    }
    .comment__field {
        margin: 0 0 10px;
    }
    .comment__input-text {
        width: 50%;
        height: 45px;
        background: #fff;
        font-size: 16px;
        padding: 0 15px;
        box-sizing: border-box;
        border: 2px solid #ececec;
        outline: none;
        display: block;
        float: left;
        margin-right: 10px;
        font-family: 'Roboto', sans-serif;
    }
    .comment__input-textarea {
        width: 100%;
        height: 100px;
        font-size: 16px;
        padding: 10px 15px;
        box-sizing: border-box;
        border: 2px solid #ececec;
        outline: none;
        background: #fff;
        resize: vertical;
        font-family: 'Roboto', sans-serif;
    }
    .comment__input-submit {
        width: 45%;
        height: 45px;
        border: 2px solid #ececec;
        font-size: 16px;
        text-transform: uppercase;
        text-align: center;
        cursor: pointer;
        background: #fff;
        display: block;
        float: right;
        font-family: 'Roboto', sans-serif;
    }
    .comment__result {
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        margin: 10px 0;
        text-transform: uppercase;
        text-align: center;
    }
    .comment__result_success {
        color: green;
    }
    .comment__result_error {
        color: darkred;
    }
    .comment__list {
        overflow: hidden;
        width: 100%;
        border-top: 2px solid #ececec;
        padding-top: 10px;
    }
    .comment__item {
        margin: 0 0 35px;
    }
    .comment__name {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        font-family: 'Roboto', sans-serif;
    }
    .comment__text {
        font-size: 14px;
        margin: 5px 0 0;
        font-family: 'Roboto', sans-serif;
    }
    .comment__count {
        font-size: 18px;
        font-family: 'Roboto', sans-serif;
        margin: 0 0 5px;
        color: #909090;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        var $commentForm = $('.comment__form'),
            $commentList = $('.comment__list')
            $commentCount = $('.comment__count'),
            $inputName = $('.comment__input-text'),
            $inputText = $('.comment__input-textarea'),
            $inputPage = $('.comment__input-page');
        var itemHtml = '<div class="comment__item"><div class="comment__name">#NAME#</div><div class="comment__text">#TEXT#</div></div>',
            resultHtml = '<div class="comment__result #STATUS#">#TEXT#</div>';

        $.ajax({
            url: '/sys/comment/get.php',
            dataType: 'json',
            data: {
                page: 'yourstory'
            }
        }).done(function(result){
            var count = 0;
            $.each(result, function(e, val){
                count++;
                $commentList.append(itemHtml.replace('#NAME#', val.name).replace('#TEXT#', val.text));
            });
            $commentCount.find('span').text(count);
        });

        $(document).on('click', '.comment__input-submit', function(e){
            var name = $inputName.val(),
                text = $inputText.val(),
                page = $inputPage.val();
            $.ajax({
                url: '/sys/comment/add.php',
                data: {
                    name: name,
                    text: text,
                    page: page
                },
                method: 'post',
                success: function(result){
                    $('.comment__result').removeClass('comment__result_success', 'comment__result_error').html('');
                    $inputText.val('');
                    var resultText = result == 'OK' ? 'Комментарий успешно отправлен!' : result;
                    var resultStatus = result == 'OK' ? 'comment__result_success' : 'comment__result_error';
                    $commentForm.prepend(resultHtml.replace('#TEXT#', resultText).replace('#STATUS#', resultStatus));
                    $commentList.prepend(itemHtml.replace('#NAME#', name).replace('#TEXT#', text));
                    var count = parseInt($commentCount.find('span').text());
                    $commentCount.find('span').text(count + 1);
                }
            });
            return false;
        });
    });
</script>

<div class="comment">
<form class="comment__form" action="" method="post">
    <div class="comment__result"></div>
    <div class="comment__field">
        <textarea class="comment__input-textarea" name="comment" required="required" placeholder="Введите комментарий"></textarea>
    </div>
    <div class="comment_field">
        <input class="comment__input-text" required="required" type="text" name="name" placeholder="Введите Ваше имя"> <input class="comment__input-submit" type="submit" value="Отправить">
    </div>
    <input class="comment__input-page" type="hidden" name="page" value="yourstory">
</form>
<div class="comment__count"><span></span> комментариев</div>
<div class="comment__list"></div>
</div>