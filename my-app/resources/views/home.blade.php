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
                                "<div class='bg-white shadow-sm p-3'>" +
                                "<h2><i class='fa fa-user-circle'></i></h2>"+
                                "<h6>"+MyList['name']+" ("+MyList['mobile']+")"+"</h6>"+
                                "<div class='input-group w-100 d-flex justify-content-center'>" +
                                "<button data-name='"+MyList['name']+"' data-peer='"+MyList['peer_id']+"' class='btn mx-1 chat btn-light text-primary text-center'><i class='fa fa-comments'></i></button>" +
                                "<button class='btn mx-1 btn-light text-primary text-center'><i class='fa fa-phone'></i></button>" +
                                "<button data-name='"+MyList['name']+"' data-peer='"+MyList['peer_id']+"' class='btn video-call mx-1 btn-light text-primary text-center' ><i class='fa fa-video'></i></button>" +
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
                $('#ChatText').val("");
            });
            ChatBodyScrollDown();
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
        $.each(ChatHistory,function (i,MyList){
            let ChatLeft="<p><span class='text-dark'>"+MyList['ChatLeftName']+"<span>:<span class='text-primary'>"+MyList['ChatText']+"<span></p>";
            $('#chatHistory').append(ChatLeft);
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

