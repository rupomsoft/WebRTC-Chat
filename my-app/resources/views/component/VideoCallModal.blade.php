<div class="modal  animated zoomIn" id="VideoCallModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="staticBackdropLabel"><img alt="" class='active-icon' src='{{asset('images/video_call_icon.svg')}}'/>  Video Call With <span class="text-primary" id="ChatRightNameTitleVideoCall"> </span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="row d-none">
                        <div class="col-3">
                            <label>R.H.S</label>
                            <input id="ChatRightNameVideoCall" class="form-control" type="text">
                        </div>
                        <div class="col-3">
                            <label>L.H.S</label>
                            <input id="ChatLeftNameVideoCall" class="form-control" type="text">
                        </div>
                        <div class="col-3">
                            <label>R.H.S</label>
                            <input id="ChatRightPeerIDVideoCall" class="form-control" type="text">
                        </div>
                        <div class="col-3">
                            <label>L.H.S</label>
                            <input id="ChatLeftPeerIDVideoCall" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-6">
                            <video class="w-100 video-preview" id="MakerVideo"></video>
                        </div>
                        <div class="col-6">
                            <video class="w-100 video-preview" id="ReceiverVideo"></video>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center">
                        <div class="col-6 py-4 text-center">

                            <button id="callMake" onclick="SendCallInvitation()"  class="btn"><img class="call-btn-icon" src="{{asset("images/call1.svg")}}"></button>
                            <button id="callReceive" onclick="ReceiveCall()"  class="btn d-none"><img class="call-btn-icon" src="{{asset("images/call3.svg")}}"></button>
                            <button id="callDrop" onclick="callDrop()"  class="btn "><img class="call-btn-icon" src="{{asset("images/call2.svg")}}"></button>

                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>


