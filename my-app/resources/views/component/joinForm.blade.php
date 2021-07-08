<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-5 text-center col-lg-5 col-sm-10 col-10">
            <div class="shadow-sm animated zoomIn bg-white">
                <div class="px-5 py-5">
                    <img class="w-25" src="{{asset("images/webrtc2.png")}}">
                    <input id="name" placeholder="Your Name" type="text" class="form-control mt-3">
                    <input id="mobile" placeholder="Your Mobile" type="text" class="form-control mt-3">
                    <button id="JoinBtn" class="btn w-100 btn-primary mt-3">Join Now</button>
                    <br/>
                    <br/>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#JoinBtn').on('click',function () {
       let name= $('#name').val();
       let mobile= $('#mobile').val();
       if(name.length===0){
           ErrorToast("Name Required !");
       }
       else if(!OnlyLaterRegx.test(name)){
           ErrorToast("Invalid Name!");
       }
       else if (mobile.length===0){
           ErrorToast("Mobile Number Required !");
       }
       else if(!MobileRegx.test(mobile)){
           ErrorToast("Invalid Mobile Number !");
       }
       else {
           $('#JoinBtn').html(BtnSpinner)
           axios.get("api/CheckMobileNumberIsActive/"+mobile)
               .then(function (res) {
                   $('#JoinBtn').html("Join Now");
                    if(res.status===200 && res.data===1){
                        ErrorToast("Mobile Number Busy ! Try Later");
                    }
                    else {
                        setMobileNumber(mobile)
                        setName(name);
                        window.location.href="/"
                    }
               })
               .catch(function (err) {
                   $('#JoinBtn').html("Join Now");
                   ErrorToast("Request Fail ! Try Again");
               })
       }
    })

</script>
