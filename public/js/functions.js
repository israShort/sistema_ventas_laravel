function msgShow(msg, status) {
    $('#msg').addClass(`alert alert-${status}`);
    $('#msg').html(msg);
}