var tenant  = {
    init : function () {
      //  parent.resizeIframe();
        tenant.unitfield($('#building').val())
        $(document).on("change","#building",function () {
            $("#lease_profile").fadeOut();
            $("#unit,#unit_show").val("");
            tenant.unitfield($(this).val())
        });
        $(document).on("click",".addOccupantHtml",function () {
            var occupant_html = '<div><div class="form-group col-md-3 col-lg-3"><div class="input-icon input-icon-lg right"><i class="fa fa-text-width"></i><input type="text" name="occupant_name[]" placeholder="Occupant Name" class="form-control" /></div></div><div class="form-group col-md-3 col-lg-3"><div class="input-icon input-icon-lg right"><i class="fa fa-connectdevelop"></i><input type="text" name="relation[]"  placeholder="Relation" class="form-control" /></div></div><div class="form-group col-md-5 col-lg-5"><div class="input-icon input-icon-lg right"><i class="fa fa-comment-o"></i><input type="text" name="comment[]" placeholder="Summary" class="form-control" /></div> </div><div class="form-group col-md-1 col-lg-1"><icon class="fa fa-remove pointer removeOccupant"></icon></div></div><div class="clearfix"></div></div>'
            $(".OccupantHtml").append(occupant_html)
        })

        $(document).on("change","#applicant_type",function () {
            tenant.showApplicantForm($(this).val())
        })


        $(document).on("click",".save-applicant",function (){
            tenant.saveApplicant()
        })


        $(document).on("click",".removeOccupant",function () {
            if($(this).data("id")){

            } else {
                $(this).parent().parent().remove()
            }
        });


        $(document).on("click",".addPetHtml",function () {
            var pet_html = '<div><div class="form-group col-md-5 col-lg-5"><div class="input-icon input-icon-lg right"><i class="icon-ghost"></i><input type="text" name="pet_type[]"  placeholder="Pet Type" class="form-control" /></div></div><div class="form-group col-md-5 col-lg-5"><div class="input-icon input-icon-lg right"><i class="fa fa-comment-o"></i><input name="pet_commnet[]" placeholder="Comment" class="form-control" /></div></div><div class="form-group col-md-1 col-lg-1"><i class="fa fa-remove pointer removePet"></i></div></div><div class="clearfix"></div></div>'
            $(".PetHtml").append(pet_html)
            if($(".LEASE_AGREEMENT").length){
        //        parent.resizeIframe();
            }
        })

        $(document).on("click",".removePet",function () {
            if($(this).data("id")){

            } else {
                $(this).parent().parent().remove()
            }
            if($(".LEASE_AGREEMENT").length){
          //      parent.resizeIframe();
            }
        });

        $(document).on("click",".addVehicleHtml",function () {
            var vehicle_html = '<div><div class="form-group col-md-3 col-lg-3"><div class="input-icon input-icon-lg right"><i class="fa fa-automobile"></i><input type="text"  placeholder= "Make" class="form-control"/></div></div><div class="form-group col-md-4 col-lg-4"><div class="input-icon input-icon-lg right"><i class="fa fa-cab"></i><input type="text"  placeholder="Model" class="form-control" /></div></div><div class="form-group col-md-4 col-lg-4"><div class="input-icon input-icon-lg right"><i class="fa fa-tag"></i><input type="text" placeholder="tag" class="form-control" /> </div></div><div class="form-group col-md-1 col-lg-1"><i class="fa fa-remove pointer removeVehicle"></i></div><div class="clearfix"></div></div>'
            $(".VehicleHtml").append(vehicle_html)
            if($(".LEASE_AGREEMENT").length){
            //    parent.resizeIframe();
            }
        })

        $(document).on("click",".removeVehicle",function () {
            if($(this).data("id")){

            } else {
                $(this).parent().parent().remove()
            }
            if($(".LEASE_AGREEMENT").length){
              ///  parent.resizeIframe();
            }
        });

        $(document).on("click",".addIncomeHtml",function () {
            var income_html = '<div><div class="form-group col-md-3 col-lg-3"><div class="input-icon input-icon-lg right"><i class="fa fa-industry"></i><input type="text" name="employer_name[]" class="form-control" placeholder="Employer"></div></div><div class="form-group col-md-2 col-lg-2"><div class="input-icon input-icon-lg right"<i class="fa fa-user-md"></i><input type="text" name="role[]" class="form-control" placeholder="Role"></div></div><div class="form-group col-md-2 col-lg-2"><div class="input-icon input-icon-lg right"><i class="fa fa-phone"></i><input type="text" name="employer_phone[]" class="form-control" placeholder="Phone no"></div></div><div class="form-group col-md-2 col-lg-2"><div class="input-icon input-icon-lg right"><i class="fa fa-clock-o"></i><input type="text" name="duration[]" class="form-control" placeholder="Duration"></div></div><div class="form-group col-md-2 col-lg-2"><div class="input-icon input-icon-lg right"><i class="fa fa-money"></i><input type="text" name="income[]" class="form-control" placeholder="Earning Amount"></div></div><div class="form-group col-md-1 col-lg-1"><i class="fa fa-remove pointer removeIncome"></i> </div><div class="clearfix"></div></div>'
            $(".IncomeHtml").append(income_html)
            if($(".LEASE_AGREEMENT").length){
            //    parent.resizeIframe();
            }
        })

        $(document).on("click",".addDocumentHtml",function () {
            var document_html = '<div><div class="form-group col-md-5 col-lg-5"><div class="input-icon input-icon-lg right"><input type="file" name="file[]"></div></div><div class="form-group col-md-6 col-lg-6"><div class="input-icon input-icon-lg right"><input type="text" name="file_comment[]" class="form-control" placeholder="Comments"></div></div><div class="form-group col-md-1 col-lg-1"><icon class="fa fa-remove pointer removeDocument"></icon></div><div class="clearfix"></div></div>'
            $(".DocumentHtml").append(document_html)
            if($(".LEASE_AGREEMENT").length){
              //  parent.resizeIframe();
            }
        })

        $(document).on("click",".removeDocument",function () {
            if($(this).data("id")){

            } else {
                ///$(this).parent().parent().remove()
            }
            if($(".LEASE_AGREEMENT").length){
                //parent.resizeIframe();
            }
        });

        $(document).on("click",".removeIncome",function () {
            if($(this).data("id")){

            } else {
                $(this).parent().parent().remove()
            }
            if($(".LEASE_AGREEMENT").length){
               // parent.resizeIframe();
            }
        });

        $(document).on("click",".removeExp",function () {
            if($(this).data("id")){

            } else {
                $(this).parent().parent().remove()
            }
            if($(".LEASE_AGREEMENT").length){
               // parent.resizeIframe();
            }
        });


        $(document).on("click",".addExpHtml",function () {
            var exp_html = $(".exp_html").html()
            $(".AppendOtherExp").append(exp_html);
            if($(".LEASE_AGREEMENT").length) {
                //parent.resizeIframe();
            }
        });





    },unitfield:function (id) {
        $( "#unit_show" ).autocomplete({
            source: app.baseUrl()+"/unit/get/"+id
            ,select:function( event, ui ) {
                app.getWithCallback(app.baseUrl()+'/building/get/'+id+'/'+ui.item.value,[],function (resp) {
                    var json = $.parseJSON(resp);
                    if(!$(".mega-menu").length) {
                        var html = '<h3><icon class="fa fa-building"></icon> '+json["name"]+'</h3>' +
                            '<h5><icon class="fa fa-square"></icon> ' + ui.item.label + ' </h5>' +
                            '<h5>Unit Type : ' + json['type']+ ' </h5>' +
                            '<h5>Furnished : ' + json['furnished']+ ' </h5>' +
                            '<h5>No of Bedroom : ' + json['no_bedroom']+ ' </h5>' +
                            '<h5>Allow Multi Tenants : ' + json['multi_tenant']+ ' </h5>' +
                            '<h5><icon class="fa fa-location-arrow"></icon> '+ json["address"]+'</h5>' +
                            '<div class="margin-top-10 margin-bottom-10 clearfix">'
                        $(".building_detail").html(html)
                    }
                })
                if($("#applicant_id").val()){
                    $("#lease_profile").fadeIn();
                }

                $("#unit_show").val(ui.item.label)
                $("#unit_id").val(ui.item.value)

                return false;
            }
        });
    },showApplicantForm:function (val) {
        if(val==1){
            $(".applicant_field").fadeIn("slow")
            $(".applicant_form").fadeOut("fast",function () {
             //   parent.resizeIframe();
            })
            //parent.resizeIframe();
        } else if (val ==2 ){
            $(".applicant_field").fadeOut("fast")
            $("#lease_profile").fadeOut("fast")
            $(".applicant_form").fadeIn("fast",function () {
               // parent.resizeIframe();
            })


        }
    },saveApplicant:function () {
        app.postWithCallback(
            app.baseUrl()+'/applicant/add',
            $(".app_form").serialize()
            ,function (resp) {
                json = $.parseJSON(resp)
                if(json['success']){
                    $(".applicant_form").fadeOut("slow",function () {
                        $("#applicant_id").val(json['applicant_id'])
                        $("#applicant").val(json['applicant_name'])
                        $(".applicant_detail").html("")
                        tenant.getApplicant(json['applicant_id'])
                        $(".applicant_field").fadeIn("fast")
                    });
                } else if(json['error']){
                    console.log(json['error'])
                }

            }
        )
    },getApplicant:function (id) {
        app.getWithCallback(app.baseUrl()+"/applicant/detail/"+id,[],function (resp) {
            var json =$.parseJSON(resp);
            var html='<h3><icon class="fa fa-user"></icon> ' + json["name"] +'</h3><h5><icon class="fa fa-clipboard"></icon> Status:' + json["profile"]+ '</h5><h5><icon class="fa fa-money"></icon> Lease Preference: ' + json["lease_perfer"]+'</h5><h5><icon class="fa fa-envelope"></icon> '+ json['email']+'</h5><h5><icon class="fa fa-phone"></icon> '+ json["phone"]+'</h5><div class="margin-top-10 margin-bottom-10 clearfix"></div>'
            $(".applicant_detail").html(html)

        })
    }

};