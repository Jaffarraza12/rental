var building  = {
    init : function () {
        html = '<div class="new"><div class="dns"><div class="col-lg-3 col-md-3"><div class="form-group"><div class="input-icon  right"><label>Contact Person</label><input type="text" name="contact_person[]" class="form-control" ></div></div></div><div class="col-lg-3 col-md-3"><div class="form-group"><div class="input-icon  right"><label>Designation</label><input type="text" name="contact_designation[]" class="form-control" ><span class="help-message">Ex:Manager</span></div></div></div><div class="col-lg-3 col-md-3"><div class="form-group"><div class="input-icon  right"> <label >Email</label><input type="email" class="form-control"/><span class="help-message">Ex:adam@example.com</span></div></div></div><div class="col-lg-3 col-md-3"><div class="form-group"><div class="input-icon  right"><label>Phone </label><input type="text" name="phone[]" class="form-control" placeholder=""></div></div></div><div class="clearfix"></div><div class="col-lg-3 col-md-3"><div class="form-group"><div class="input-icon  right"><label>Phone 2</label><input type="text" name="phone_2[]" class="form-control" placeholder=""></div></div></div><div class="romava"><a class="removeContact"><icon class="fa fa-remove"></icon></a></div><div class="col-lg-3 col-md-3"><div class="form-group">   <div class="input-icon  right"><label >Cell </label><input type="text" name="contact_cell[]" class="form-control" /></div></div></div><div class="col-lg-3 col-md-3"><div class="form-group"> <div class="input-icon  right">            <label >FAX </label>   <input type="contact_cell[]" class ="form-control" /></div></div></div><div class="clearfix"></div></div><div class="clearfix"></div>'
        $(".addContact").click(function () {
            $(".loadMore").append(html)
            parent.resizeIframe(this)
        })

        $(document).on("change","#building",function(){
            $("#lease_profile").fadeOut();            
            parent.resizeIframe(this)

        })

        $(document).on("change","#building_type",function(){
                parent.resizeIframe()
                if($(this).val() == "Indiviual House"){
                    $(".building_type_unit").fadeIn();
                } else {
                    $(".building_type_unit").fadeOut();
                }
        })

        $(document).on("change","#building_type_unit",function(){
            if($(this).val() == "Single Tenant"){
                $("#unit").val(1)
                $(".unit_no").fadeOut();
            } else {
                $(".unit_no").fadeIn();            }
        })

        $(document).on("change","#unit",function(){

            building.GetBuilding()
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
        $(document).on("click",".removeContact",function () {
                if($(this).data("id")){
                    id = $(this).data("id")
                    url =  app.baseUrl()+ "/building/remove-contact/"+id
                    app.postWithCallback(url, {
                        'id': id,
                        '_token': $("[name='_token']").val()
                    }, function () {
                        $("#contact_"+id).remove()
                    })
                } else {
                    $(this).parent().parent().remove()

                }
        })

    },GetBuilding:function () {
        building_id = $('#building').val()
        app.getWithCallback(app.baseUrl()+'/building/get/'+building_id,[],function (resp) {
                var json = $.parseJSON(resp);
                var html = '<h3><icon class="fa fa-building"></icon> '+json["name"]+'</h3><h5><icon class="fa fa-square"></icon> '+$("#unit option:selected").text()+' </h5><h5><icon class="fa fa-user-md"></icon> '+json["manager"]+'</h5><h5><icon class="fa fa-phone"></icon> '+ json["phone"]+'</h5><h5><icon class="fa fa-location-arrow"></icon> '+ json["address"]+'</h5><div class="margin-top-10 margin-bottom-10 clearfix">'
                $(".building_detail").html(html)
                $("#lease_profile").fadeIn();
                parent.resizeIframe();
            }
        )
    }

};