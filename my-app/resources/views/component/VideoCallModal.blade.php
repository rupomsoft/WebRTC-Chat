<div class="modal  animated zoomIn" id="VideoCallModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fa fa-video"></i>  Video Call With <span class="text-primary" id="ChatRightNameTitleVideoCall"> </span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
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


                        <div class="col-6">
                            <button onclick="SendCallInvitation()"  class="btn  mt-1 w-100 btn-primary">Make Call Invitation</button>
                        </div>

                        <div class="col-6">
                            <button onclick="ReceiveCall()"  class="btn  mt-1 w-100 btn-primary">Receive Call Invitation</button>
                        </div>

                        <div class="col-6">
                            <video class="w-100" id="MakerVideo"></video>
                        </div>

                        <div class="col-6">
                            <video class="w-100" id="ReceiverVideo"></video>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


