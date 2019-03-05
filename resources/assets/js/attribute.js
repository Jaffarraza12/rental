var attribute  = {
    init : function () {
        html =   '<div class="row getThisHtml"><div class="colLeft"><div class="form-group form-md-line-input input-icon-lg has-success"><div class="input-icon"><input name="option_name[]" type="text" placeholder="Option Name" class="form-control" /><label for="form_control_1">Option Name</label><span class="help-block">Option will appear at the time of inserting attribute .</span><i class="fa fa-bell-o"></i></div></div></div><div class="colIcon"><h3><i class="removeOpt fa fa-remove"></i></h3></div><div class="clearfix"></div></div>';
        $(".Addpt").click(function () {
            $(".loadHere").append(html)
            parent.resizeIframe(this)
        })

        $("#attribute_type").change(function(){
            val = $(this).val()
            if(val=='multi'){
                $("#load_attribute").fadeIn("slow")
                parent.resizeIframe(this)
            } else {
                $("#load_attribute").fadeOut("slow")
                parent.resizeIframe(this)

            }

        })

        $(document).on("click",".removeOpt",function () {
                if($(this).data("id")){
                    id = $(this).data("id")
                    url = $(".url").val()
                    app.postWithCallback(url+'/'+id, {
                        'id': id,
                        '_token': $("[name='_token']").val()
                    }, function () {
                        $("#option_"+id).remove()
                    })
                } else {
                    $(this).parent().parent().parent().remove()

                }
        })

    }

};