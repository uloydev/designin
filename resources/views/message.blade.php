<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
    <style>
    #chat{
        width: 60%;
        height: 500px;
        margin-left: auto;
        margin-right: auto;
        overflow-y: scroll;
        background-color: cadetblue;
    }
    .left{
        text-align: left;
    }
    .right{
        text-align: right;
    }
    input {
        margin-left: 20%;
        width: 60%;
        height: 30px;
    }
    </style>
</head>
<body>
    <ul>
        @foreach ($sessions as $session)
        <li>
            @if (Auth::user()->role == 'agent')
            <button class="btn-chat" data-session-id="{{$session->id}}">{{$session->user->name}}</button>
            @else
            <button class="btn-chat" data-session-id="{{$session->id}}">{{$session->agent->name}}</button>                
            @endif
        </li>
        @endforeach
    </ul>
    <div id="chat">
    </div>
    <form id="chatForm">
        <input id="messageInput" type="text" name="content" placeholder="type message...">
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.btn-chat').click(function (){
    $('#chatForm').data('session-id', $(this).data('session-id'));
    fetchChat($(this).data('session-id'));
});

function fetchChat(session_id){
    $.ajax({
        type: "GET",
        url: "/message/fetch/"+session_id,
        success: function (response) {
            $('#chat').empty();
            response.messages.forEach(message => {
                if(message.sender_id == response.user_id){
                    var bubble = '<div class="right"><p>'+message.sender.name+'</p><p>'+message.content+'</p></p>';
                }else{
                    var bubble = '<div class="left"><p>'+message.sender.name+'</p><p>'+message.content+'</p></div>';
                }
                $('#chat').append(bubble);
            });
            $('#chat').scrollTop(document.getElementById('chat').scrollHeight);
        }
    });
}

$('#chatForm').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "/message/send/"+$(this).data('session-id'),
        data: $(this).serialize(),
        success: function (response) {
            // console.log(response)
            var bubble = '<div class="right"><p>'+response.message.sender.name+'</p><p>'+response.message.content+'</p></p>';
            $('#chat').append(bubble);
            $('#chat').scrollTop(document.getElementById('chat').scrollHeight);
            $('#messageInput').val('');
        }
    });
});


Echo.private('chat'+{{$session->id}})
    .listen('MsgSentEvent', (e) => {
        this.messages.push({
        message: e.message.content,
        session: e.session
        });
});
</script>
</html>
