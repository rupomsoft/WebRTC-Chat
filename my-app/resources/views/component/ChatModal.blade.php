<div class="modal  animated zoomIn" id="ChatModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fa fa-comments"></i> Chat with <span class="text-primary" id="ChatRightNameTitle"> </span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <label>R.H.S</label>
                            <input id="ChatRightName" class="form-control" type="text">
                            <label>L.H.S</label>
                            <input id="ChatLeftName" class="form-control" type="text">
                            <label>R.H.S</label>
                            <input id="ChatRightPeerID" class="form-control" type="text">
                            <label>L.H.S</label>
                            <input id="ChatLeftPeerID" class="form-control" type="text">
                            <input id="ChatText" class="form-control" type="text">
                            <button id="ChatSend" class="btn mt-1 w-100 btn-primary">Send</button>
                        </div>
                        <div  class="col-6">
                              <div class="chat-body" id="chatHistory">

                              </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


