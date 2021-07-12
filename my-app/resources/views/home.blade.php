@extends("layout.app")
@section("section")
@include('component.ChatModal')
@include('component.VideoCallModal')
@include('component.activeUsers')
<audio loop id="callTune">
    <source src="{{asset("mp3/tone.mp3")}}" type="audio/mpeg">
</audio>
@endsection
@section("script")
<script>


    // Create Peer Global
    let peer = new Peer();
    let conn = null;
    // Create New Peer ID And Store
    CreatePeerIDAndStore();
    function CreatePeerIDAndStore(){
        peer.on("open",function (id) {
            setPeerID(id);
            axios.post("api/AddJoin",{
                "name":getName(),
                "mobile":getMobileNumber(),
                "peer_id":id
            }).then(function (res){
                    if(res.status===200 && res.data===1){
                        getActiveUserList();
                        StartRefreshActiveUserList();
                    }
                    else {
                        ErrorToast("Request Fail ! Try Again");
                    }
            }).catch(function (err){
                ErrorToast("Request Fail ! Try Again");
            })
        })
    }
    // Start Refreshing Active User
    // Ajax , Firebase, Socket IO
    function StartRefreshActiveUserList(){
        setInterval(function(){
            getActiveUserList();
        }, 5000);
    }
    //Get Active User List
    function getActiveUserList() {
        axios.get("api/ActiveList/"+getMobileNumber())
            .then(function (res) {
                if(res.status===200){
                    $('#LoaderDiv').addClass("d-none");
                    $('#ActiveList').empty();
                    $.each(res.data,function (i,MyList){
                        if(MyList['peer_id']!==getPeerID()){
                            let activeUser="<div class='col-md-3  text-center p-1 col-lg-3 col-sm-6 col-6'>" +
                                "<div class='bg-dark-blue shadow-sm p-3'>" +
                                "<h2><i class='fa text-white fa-user-circle'></i></h2>"+
                                "<h6 class='text-white'>"+MyList['name']+"</h6>"+
                                "<div class='input-group w-100 d-flex justify-content-center'>" +
                                "<a data-name='"+MyList['name']+"' data-peer='"+MyList['peer_id']+"' class=' mx-1 chat  text-primary text-center'><img  class='active-icon' src='images/chat_icon.svg'/></a>" +
                                "<a class='mx-1  text-primary text-center'><img class='active-icon' src='images/audio_call_icon.svg'/></a>" +
                                "<a data-name='"+MyList['name']+"' data-peer='"+MyList['peer_id']+"' class=' video-call mx-1  text-primary text-center' ><img class='active-icon' src='images/video_call_icon.svg'/></i></a>" +
                                "</div>"+
                                "</div>" +
                                "</div>"
                            $('#ActiveList').append(activeUser);
                            ConnectWithActiveUniqueList(MyList['peer_id'])
                        }

                    });



                    $('.chat').on('click',function (event) {
                        let peerid= $(this).data("peer");
                        let name= $(this).data("name");
                        $('#ChatRightNameTitle').html(name);
                        $('#ChatRightName').val(name);
                        $('#ChatRightPeerID').val(peerid);
                        $('#ChatLeftName').val(getName());
                        $('#ChatLeftPeerID').val(getPeerID());
                        $('#ChatModal').modal("show");
                        event.preventDefault();
                    })

                    $('.video-call').on('click',function (event) {
                        let peerid= $(this).data("peer");
                        let name= $(this).data("name");
                        $('#ChatRightNameTitleVideoCall').html(name);
                        $('#ChatRightNameVideoCall').val(name);
                        $('#ChatRightPeerIDVideoCall').val(peerid);

                        $('#ChatLeftNameVideoCall').val(getName());
                        $('#ChatLeftPeerIDVideoCall').val(getPeerID());

                        $('#VideoCallModal').modal("show");
                        event.preventDefault();
                    })


                }
                else {
                    $('#LoaderDiv').addClass("d-none");
                }
            })
            .catch(function (err) {
                $('#LoaderDiv').addClass("d-none");

            })
    }
    // Connected With Unique Peer ID
    let ConnectedList=[]
    function ConnectWithActiveUniqueList(OtherPeerID){
        if(!ConnectedList.includes(OtherPeerID)){
            if(OtherPeerID!==getPeerID()){
                conn= peer.connect(OtherPeerID);
                conn.on('open',function () {
                    ConnectedList.push(OtherPeerID);
                    console.log(OtherPeerID)
                })

                conn.on('connection', function(id){
                    console.log("....."+id);
                });

            }
        }
    }
    // Chat Send
    $('#ChatSend').on('click',function () {
        let ChatLeftName=$('#ChatLeftName').val();
        let ChatLeftPeerID=$('#ChatLeftPeerID').val();
        let ChatRightName=$('#ChatRightName').val();
        let ChatRightPeerID=$('#ChatRightPeerID').val();
        let ChatText=$('#ChatText').val();

        if(ChatText.length!==0){
            let conn = peer.connect(ChatRightPeerID);
            conn.on('open', function(){
                let chatObject={
                    "task":"chat",
                    "ChatLeftName":ChatLeftName,
                    "ChatLeftPeerID":ChatLeftPeerID,
                    "ChatRightName":ChatRightName,
                    "ChatRightPeerID":ChatRightPeerID,
                    "ChatText":ChatText,
                    "ChatRightNameTitle":ChatLeftName,
                }
                conn.send(chatObject);
                ChatHistory.push(chatObject);
                showChatHistory();
                ChatBodyScrollDown();
                $('#ChatText').val("");
            });

        }

    })
    function ChatBodyScrollDown() {
        var objDiv = document.getElementById("chatHistory");
        objDiv.scrollTop = objDiv.scrollHeight;
    }
    // Show Chat History
    let ChatHistory=[];
    function showChatHistory(){
        $('#chatHistory').empty();

        let LeftPeerID=$('#ChatLeftPeerID').val();

        $.each(ChatHistory,function (i,MyList){

            if(LeftPeerID===MyList['ChatLeftPeerID']){

                let ChatLeft= "<div class='col-6 float-left p-2'>" +
                    "<div class='bg-success p-2 chat-item text-white'>"+MyList['ChatText']+"</div>"+
                    "</div>";
                let EmptyDiv="<div class='col-6 p-2'></div>"
                $('#chatHistory').append(ChatLeft+EmptyDiv);

            }
            else {
                let ChatRight= "<div class='col-6 float-right p-2'>" +
                    "<div class='bg-primary p-2 chat-item text-white'>"+MyList['ChatText']+"</div>"+
                    "</div>";
                let EmptyDiv2="<div class='col-6 p-2'></div>"
                $('#chatHistory').append(EmptyDiv2+ChatRight);
            }


        })
    }











    // Play And Pause Calling Tone
    function  PlayRingTone(){
        let x = document.getElementById("callTune");
        x.play();
    }

    function  PauseRingTone(){
        let x = document.getElementById("callTune");
        x.pause();
    }

    //Play Video Preview
    function MakerVideoPreview(stream){
        let MakerVideo=document.getElementById('MakerVideo');
        MakerVideo.srcObject=stream;
        MakerVideo.play();
    }
    function ReceiverVideoPreview(stream){
        let ReceiverVideo=document.getElementById('ReceiverVideo');
        ReceiverVideo.srcObject=stream;
        ReceiverVideo.play();
    }




    //Send Call Invitation
    function SendCallInvitation(){
        let ChatLeftName=$('#ChatLeftNameVideoCall').val();
        let ChatLeftPeerID=$('#ChatLeftPeerIDVideoCall').val();
        let ChatRightName=$('#ChatRightNameVideoCall').val();
        let ChatRightPeerID=$('#ChatRightPeerIDVideoCall').val();
        let conn = peer.connect(ChatRightPeerID);
        conn.on('open', function(){
            let chatObject={
                "task":"videoCall",
                "ChatLeftName":ChatLeftName,
                "ChatLeftPeerID":ChatLeftPeerID,
                "ChatRightName":ChatRightName,
                "ChatRightPeerID":ChatRightPeerID,
                "ChatRightNameTitle":ChatLeftName,
            }
            conn.send(chatObject);
            MakeCall();
        });

    }





    //ReceiveCall
    function ReceiveCall(){
        PauseRingTone();
        let getUserMedia = navigator.getUserMedia
        getUserMedia({video: true, audio: true}, function(stream) {
            let ChatRightPeerIDVideoCall= $('#ChatRightPeerIDVideoCall').val()
            let call = peer.call(ChatRightPeerIDVideoCall, stream);
            call.on('stream', function(remoteStream) {
                 MakerVideoPreview(stream);
                ReceiverVideoPreview(remoteStream);
            });
        }, function(err) {
           alert("Error")
        });
    }


    // MakeCall
    function MakeCall(){
        let getUserMedia = navigator.getUserMedia;
        peer.on('call', function(call) {
            getUserMedia({video: true, audio: true}, function(stream) {
                call.answer(stream);
                MakerVideoPreview(stream);
                call.on('stream', function(remoteStream) {
                    ReceiverVideoPreview(remoteStream);
                });
            }, function(err) {
                alert("err");
            });
        });
    }



    // Receive Event
    GetReadyToReciveMessage();
    function GetReadyToReciveMessage(){
        peer.on('connection', function(conn) {
            conn.on('data', function(data){
                console.log(data)

                //Managing Chat Receive
                if(data['task']==="chat"){
                    $('#ChatRightNameTitle').html(data['ChatRightNameTitle']);
                    $('#ChatRightName').val(data['ChatLeftName']);
                    $('#ChatRightPeerID').val(data['ChatLeftPeerID']);
                    $('#ChatLeftName').val(data['ChatRightName']);
                    $('#ChatLeftPeerID').val(data['ChatRightPeerID']);
                    $('#ChatModal').modal("show");
                    ChatHistory.push(data);
                    showChatHistory();
                    ChatBodyScrollDown();
                }

                //Managing Call Invitation Received

                else if(data['task']==="videoCall"){
                    $('#ChatRightNameTitleVideoCall').html(data['ChatRightNameTitle']);
                    $('#ChatRightNameVideoCall').val(data['ChatLeftName']);
                    $('#ChatRightPeerIDVideoCall').val(data['ChatLeftPeerID']);
                    $('#ChatLeftNameVideoCall').val(data['ChatRightName']);
                    $('#ChatLeftPeerIDVideoCall').val(data['ChatRightPeerID']);
                    $('#VideoCallModal').modal("show");
                    PlayRingTone();
                }





            });
        });
    }






</script>
@endsection

