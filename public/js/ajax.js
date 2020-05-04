$(document).ready(function() {
    $("#like-btn").click(function(event) {
        $.ajax({
            method: 'GET',
            url: '/status/{statusId}/like',
            data: {}
        })
        .done(function(msg){
        });
    });
});
