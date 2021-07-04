<div class="container-fluid">
    <div id="ActiveList" class="row">

    </div>
</div>

<script>
    getActiveUserList();
    setInterval(function(){
        getActiveUserList();
    }, 40000);
    function getActiveUserList() {

        axios.get("api/ActiveList/"+getMobileNumber())
            .then(function (res) {
                if(res.status===200){
                    $('#ActiveList').empty();
                    $.each(res.data,function (i,MyList){
                        let activeUser="<div class='col-md-3 text-center p-1 col-lg-3 col-sm-6 col-6'>" +
                            "<div class='bg-white shadow-sm p-3'>" +
                            "<h2><i class='fa fa-user-circle'></i></h2>"+
                            "<h6>"+MyList['name']+" ("+MyList['mobile']+")"+"</h6>"+
                            "<div class='input-group w-100 d-flex justify-content-center'>" +
                            "<button class='btn mx-1 btn-light text-primary text-center'><i class='fa fa-comments'></i></button>" +
                            "<button class='btn mx-1 btn-light text-primary text-center'><i class='fa fa-phone'></i></button>" +
                            "<button class='btn mx-1 btn-light text-primary text-center' ><i class='fa fa-video'></i></button>" +
                            "</div>"+
                            "</div>" +
                            "</div>"
                        $('#ActiveList').append(activeUser);
                    });
                }
                else {
                    ErrorToast("Request Fail ! Try Again");
                }
            })
            .catch(function (err) {
                ErrorToast("Request Fail ! Try Again");
            })
    }
</script>
