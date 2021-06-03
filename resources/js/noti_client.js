var pusher = new Pusher(key, {
    encrypted: true,
    cluster: "ap1"
});
var channel = pusher.subscribe('NotificationEvent');
channel.bind('send-message', function(data) {
    var newNotificationHtml = `
    <a class="dropdown-item" href="#">
        <span>Your request ${data.book} was accepted</span><br>
    </a>
    `;
    $('.menu-notification').prepend(newNotificationHtml);
});

$('#navbarDropdown').click(function(){ 
    var _token = $('input[name="_token"]').val(); 
    $.ajax({
        url:"/notification", 
        method:"POST", 
        data:{ _token:_token},
        success:function(data){ }
    });
});
