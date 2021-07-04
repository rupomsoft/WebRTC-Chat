<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 text-center col-lg-6 col-sm-10 col-10">
            <div class="shadow-sm bg-white">
                <div class="p-5">
                    <h4>JOIN NOW</h4>
                    <input id="name" placeholder="Your Name" type="text" class="form-control mt-2">
                    <input id="mobile" placeholder="Your Mobile" type="text" class="form-control mt-2">
                    <button id="JoinBtn" class="btn w-100 btn-primary mt-2">Join Now</button>
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
       else if (mobile.length===0){
           ErrorToast("Mobile Required !");
       }
       else {
            setMobileNumber(mobile)
            setName(name);
            window.location.href="/"
       }
    })

</script>
