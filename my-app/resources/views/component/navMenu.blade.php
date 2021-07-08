<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img class="nav-logo" src="{{asset("images/webrtc.png")}}"> Peer Chat</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
            </ul>
            <form class="d-flex">
               <span> <i class="fa fa-user-alt"></i><span class="mx-2" id="userName"></span></span>
                <a href="{{"/join"}}" class="mx-1"><i class="fa fa-sign-out-alt"></i>Exit</a>
            </form>
        </div>
    </div>
</nav>
