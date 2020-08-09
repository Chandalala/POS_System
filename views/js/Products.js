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

    /*Edit product*/
    $(".btnEditProduct").click(function () {


        let productId=$(this).attr("productId");
        let data = new FormData();
        data.append("productId", productId);

        $.ajax({
            url:"ajax/ProductAjax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {


                $("#edit_productCode").val(response['code']);
                $("#edit_product_description").val(response['description']);
                $("#edit_product_quantity").val(response['stock']);
                $("#edit_sale_price").val(response['sale_price']);
                $("#edit_purchase_price").val(response['purchase_price']);

                let category = $("#edit_productCategory");

                category.html(response['category']);
                category.val(response['category']);

                $("#edit_currentImage").val(response['image']);

                if (response['image'] !== ""){

                    let imageUrl = $("#editImage");
                    imageUrl.attr("src", response['image']);

                }
            }
        })
    });

    /*Activate product*/
    let stockButton = $(".btnStock");

    let stockStatus=function () {

        let productStock = $(this).html("productStock");

        if (productStock > 100){
            stockButton.removeClass('btn-success');
            stockButton.addClass('btn-danger');
        }
        else {
            stockButton.removeClass('btn-danger');
            stockButton.addClass('btn-success');
        }

    };

    stockStatus();

    $("#product_description").change(function () {

        $(".alert").remove();

        let product_description = $(this).val();

        let data = new FormData();
        data.append("product_description", product_description);

        $.ajax({
            url:"ajax/ProductAjax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {

                if (response){
                    $("#product_description").before('<div class="alert alert-warning">Product description exists</div>');
                    $("product_description").val("")
                }

            }

        });

    });

    $(".btnDeleteProduct").click(function () {

        let confirmOk=confirm("Do you wish to delete product");

        let productId=$(this).attr("productId");

        if (confirmOk.true){
            let data = new FormData();
            data.append("productId", productId);

            $.ajax({
                url:"ajax/ProductAjax.php",
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {

                    if (response === "Ok"){

                        alert("Product deleted")

                    }

                }

            })

        }

    });

});

