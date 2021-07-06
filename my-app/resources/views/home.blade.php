@extends("layout.app")
@section("section")
 @include('component.ChatModal')
@include('component.activeUsers')

@endsection
@section("script")
<script>
    // Create Peer Global

    let peer = new Peer();
    let conn = null;


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


    function StartRefreshActiveUserList(){
        setInterval(function(){
            getActiveUserList();
        }, 30000);
    }


    function getActiveUserList() {
        axios.get("api/ActiveList/"+getMobileNumber())
            .then(function (res) {
                if(res.status===200){
                    $('#LoaderDiv').addClass("d-none");
                    $('#ActiveList').empty();
                    $.each(res.data,function (i,MyList){

                        if(MyList['peer_id']!==getPeerID()){
                            let activeUser="<div class='col-md-3 text-center p-1 col-lg-3 col-sm-6 col-6'>" +
                                "<div class='bg-white shadow-sm p-3'>" +
                                "<h2><i class='fa fa-user-circle'></i></h2>"+
                                "<h6>"+MyList['name']+" ("+MyList['mobile']+")"+"</h6>"+
                                "<div class='input-group w-100 d-flex justify-content-center'>" +
                                "<button data-name='"+MyList['name']+"' data-peer='"+MyList['peer_id']+"' class='btn mx-1 chat btn-light text-primary text-center'><i class='fa fa-comments'></i></button>" +
                                "<button class='btn mx-1 btn-light text-primary text-center'><i class='fa fa-phone'></i></button>" +
                                "<button class='btn mx-1 btn-light text-primary text-center' ><i class='fa fa-video'></i></button>" +
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

                        $('#ChatWith').html(name);
                        $('#ChatModal').modal("show");

                        event.preventDefault();
                    })
                }
                else {
                    $('#LoaderDiv').addClass("d-none");
                    ErrorToast("Request Fail ! Try Again");
                }
            })
            .catch(function (err) {
                $('#LoaderDiv').addClass("d-none");
                ErrorToast("Request Fail ! Try Again");
            })
    }




    let ConnectedList=[]
    function ConnectWithActiveUniqueList(OtherPeerID){
        if(!ConnectedList.includes(OtherPeerID)){
            conn= peer.connect(OtherPeerID);
            conn.on('open',function () {
                ConnectedList.push(OtherPeerID);
                console.log(ConnectedList)
            })
        }
    }






    GetReadyToReciveMessage();
    function GetReadyToReciveMessage(){
        peer.on('connection', function(conn) {
            conn.on('data', function(data){
                console.log(data);
            });
        });
    }




// Join











</script>
@endsection

