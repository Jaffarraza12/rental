var unit  = {
    init : function () {

        $(document).on("click",".make_duplicate",function () {
           unit.Duplicate($(this).data("id"))
        })
    },SaveUnit:function(id){
        url = $(".url").val()
        var nameEle = 'amenities_'+id+'[]';
        var data = {
            'id': id,
            '_token': $("[name='_token']").val(),
            'name':$("#name_"+id).val(),
            'type':$("#type_"+id).val(),
            'floor':$("#floor_"+id).val(),
            'available':$("#available_"+id).val(),
            'furnished':$("#furnished_"+id).val(),
            'amenities[]':[]
        }

        var obj = {}
        $("input[name='"+nameEle+"']:checked").each(function (ind,value) {
            data['amenities[]'].push($(this).val());
           // $.extend(data,obj)
        })
        app.postWithCallback(url, data,function (resp) {
            var json = $.parseJSON(resp);
            if(json.success){
                $("#success_"+id).text(json.success)
                $("#success_"+id).fadeIn()
            } else if(json.error) {
                $("#error_"+id).text(json.error)
                $("#error_"+id).fadeIn()
            }
        })

    },Duplicate:function(id){
        app.postWithCallback(app.baseUrl()+'/unit/duplicate/'+id, {
            '_token': $("[name='_token']").val()},function (resp) {
            var json = $.parseJSON(resp);
            if(json.success){
                $("#UnitTotal").text(json.unit_total)
                $('#attribute').DataTable().ajax.reload()

            } else if(json.error) {
                alert(json.error)
            }
        })
    }

};