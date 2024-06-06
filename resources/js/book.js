import $ from 'jquery';
import '@ksedline/turnjs';

if($('#logo-book').length > 0) {

    $('#logo-book').turn({
        width: 800,
        height: 465,
        autoCenter: true,
        display: "single",
        gradients: true,
        zoom: true,
        when: {
            turning: function (e, page, view) {
                var audio = document.getElementById("audio");
                audio.play();
            }
        }
    });

    $('.book-prev-page').on('click', function () {
        $("#logo-book").turn("previous");
    });

    $('.book-next-page').on('click', function () {
        $("#logo-book").turn("next");
    });
}

$(document).ready(function(){
    if ($('input.numInput.cur-year').length > 0) {
        $('input.numInput.cur-year').unbind('keyup change input paste').bind('keyup change input paste',function(e){
            let $this = $(this);
            let val = $this.val();
            let valLength = val.length;
            if(valLength > 4){
                $this.val($this.val().substring(0, 4));
            }
        });
    }
});
