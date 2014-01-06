$(document).ready(function() {
    $(".addFriend").click(function() {
        var data = {};
        
        user_to = $(this).attr('id');
        data['user_to'] = user_to;
        $.post(
            location.protocol + '//' + location.host + '/TennisCity/friendships/add', data,
            function(data) {
                if (data == '0') {
                    $('#' + user_to).find('span').attr('class', 'glyphicon glyphicon-star');
                }
                
            }
        );
    });
});