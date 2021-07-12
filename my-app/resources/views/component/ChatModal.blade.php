<div class="modal  animated zoomIn" id="ChatModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="text-white m-0 p-0" id="staticBackdropLabel"><img  class='active-icon' src='images/chat_icon.svg'/> Chat with <span class="text-primary" id="ChatRightNameTitle"> </span></h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid m-0 p-0">
                    <div class="row d-none">
                        <div class="col-12">
                            <label>R.H.S</label>
                            <input id="ChatRightName" class="form-control" type="text">
                            <label>L.H.S</label>
                            <input id="ChatLeftName" class="form-control" type="text">
                            <label>R.H.S</label>
                            <input id="ChatRightPeerID" class="form-control" type="text">
                            <label>L.H.S</label>
                            <input id="ChatLeftPeerID" class="form-control" type="text">
                        </div>
                    </div>

                    <div class="row chat-body" id="chatHistory">

                    </div>


                </div>
            </div>

            <div class="row p-0 m-0">
                <div class="col-12 m-0 p-0 col-md-12 col-sm-12 col-lg-12">
                    <div class="input-group m-0 p-0">
                        <input id="ChatText" class="form-control border-radius-0" type="text">
                        <button id="ChatSend" class="btn  btn-primary border-radius-0"><i class="fa fa-paper-plane "></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


