$(document).ready(function () {


    /*Edit category*/
    $(".btnEditCategory").click(function () {

        let categoryId=$(this).attr("categoryId");
        let data = new FormData();
        data.append("categoryId", categoryId);

        $.ajax({
            url:"ajax/CategoryAjax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {

                $("#editCategory").val(response['category']);

            }

        })
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


        
    });

    $(".btnDeleteCategory").click(function () {

        let confirmOk=confirm("Do you wish to delete category");

        let categoryId=$(this).attr("categoryId");

        if (confirmOk.true){
            let data = new FormData();
            data.append("categoryId", categoryId);

            $.ajax({
                url:"ajax/CategoryAjax.php",
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {

                    if (response === "Ok"){

                        alert("Category deleted")

                    }

                }

            })

        }

    });

});

