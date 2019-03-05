var sub_users  = {
    init : function () {
        $(document).on("change","#building",function () {
            work_order.GetUnits($(this).val())
            work_order.fillFields($(this).val())

        })
    },GetUnits:function(id){
        $("#unit").find('option').remove()
        if(id) {
            app.getWithCallback(app.baseUrl() + "/unit/get/" + id,
                {
                    'free':true
                },function (resp) {
                    var json = $.parseJSON(resp);
                    $("#unit").append('<option value="">Select Unit</option>')
                    $.each(json, function (i, v) {
                        $("#unit").append('<option value="' + v.value  + '">' + v.label + '</option>')
                    })
                })
        }
    },fillFields:function (id) {
        app.getWithCallback(app.baseUrl()+'/building/get/'+id,[],function (resp) {
                var json = $.parseJSON(resp)
                $("input[name='address']").val(json.address)



            }
        )
    }

};