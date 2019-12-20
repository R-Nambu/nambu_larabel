$(document).on('click', '.js-like', function() {
    let diaryId = $(this).siblings('.diary-id').val();
    let $clickedBtn = $(this);
    like(diaryId, $clickedBtn)
})

function like(diaryId, $clickedBtn){
    // どこにポストやゲットをするか
    $.ajax({
        url: `diary/${diaryId}/like`,
        type: 'POST',
        dataType: 'json',
        // LaravelではCSRF対策として、tokenを送信しないとエラーが発生します。
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    // ポスト＆ゲットした後にどんな処理をするか
    .then(
        function (data) {
            changeLikeBtn($clickedBtn);

            let num = Number($clickedBtn.siblings('.js-like-num').text());
            $clickedBtn.siblings('.js-like-num').text(num + 1);
        },
        function (error) {
            console.log(error);
          }
    )
}



$(document).on('click', '.js-dislike', function() {
    let diaryId = $(this).siblings('.diary-id').val();
    let $clickedBtn = $(this);
    dislike(diaryId, $clickedBtn);
  })

function dislike(diaryId, $clickedBtn) {
    $.ajax({
        url:  `diary/${diaryId}/dislike`,
        type: 'POST',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    .then(
        function (data) {
            changeLikeBtn($clickedBtn);

            let num = Number($clickedBtn.siblings('.js-like-num').text());
            $clickedBtn.siblings('.js-like-num').text(num - 1);
        },
        function (error) {
            console.log(error);
        }
    )
}


// いいねを付けたり、外したり
function changeLikeBtn(btn) {
    btn.toggleClass('far').toggleClass('fas');
    btn.toggleClass('js-like').toggleClass('js-dislike');
}