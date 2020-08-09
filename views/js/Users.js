$(document).ready(function () {

    $(".newImage").change(function () {
        let image = this.files[0];

        if (image["type"] !== "image/jpeg" && image["type"] !== "image/png"){

            $(".newImage").val("");

            //sweetalert
            alert("Invalid image format");
        }
        else if (image["size"] > 1000000000) {
            //sweetalert
            alert("File too large");
        }
        else {
            let imageData = new FileReader();
            imageData.readAsDataURL(image);

            $(imageData).on("load", function (event) {

                let imageRoot = event.target.result;

                $(".preview").attr("src", imageRoot);

            })
        }
    });

    /*Edit user*/
    $(".btnEditUser").click(function () {

        let userId=$(this).attr("userId");
        let data = new FormData();
        data.append("userId", userId);

        $.ajax({
            url:"ajax/UserAjax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {

                $("#editName").val(response['name']);
                $("#editSurname").val(response['surname']);
                $("#editUsername").val(response['username']);


                let profile = $("#editProfile");

                profile.html(response['profile']);
                profile.val(response['profile']);

                $("#currentPassword").val(response['password']);

                $("#currentImage").val(response['picture']);


                if (response['picture'] !== ""){

                    let imageUrl = $("#editImage");
                    imageUrl.attr("src", response['picture']);


                }



            }

        })
    });

    /*Activate user*/
    $(".btnActivate").click(function () {

        let userId = $(this).attr("userId");
        let userStatus = $(this).attr("userStatus");

        let data = new FormData();
        data.append("userId", userId);
        data.append("userStatus", userStatus);


        $.ajax({
            url:"ajax/UserAjax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {

                if (response === 'ok') {

                    if (userStatus === 0){
                        $(this).removeClass('btn-success');
                        $(this).addClass('btn-danger');
                        $(this).html('De-activated');
                        $(this).attr('userStatus',1)


                    }
                    else {
                        $(this).removeClass('btn-danger');
                        $(this).addClass('btn-success');
                        $(this).html('Activated');
                        $(this).attr('userStatus',0)

                    }
                }
                else {

                }

            }

        });

    });

    $("#username").change(function () {

        $(".alert").remove();

        let username = $(this).val();

        let data = new FormData();
        data.append("username", username);

        $.ajax({
            url:"ajax/UserAjax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {

                if (response){
                    $("#username").before('<div class="alert alert-warning">Username exists</div>')
                    $("username").val("")
                }

            }


        });


        
    })

    $(".btnDeleteUser").click(function () {

        let confirmOk=confirm("Do you wish to delete user");

        let userId=$(this).attr("userId");

        if (confirmOk.true){
            let data = new FormData();
            data.append("userId", userId);

            $.ajax({
                url:"ajax/UserAjax.php",
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {

                    if (response === "Ok"){

                        alert("User deleted")

                    }

                }

            })

        }

    });

});

