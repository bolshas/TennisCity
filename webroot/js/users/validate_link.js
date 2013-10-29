$(document).ready(function() {
    $('#validateLink').click(function() {
        window.location = window.location.pathname + "/" + $('#validation').val();
    })
});