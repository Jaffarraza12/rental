var app  = {
    init : function () {

    },
    baseUrl:function()
    {
        return "http://localhost/rental";
    },
    postWithCallback:function(url,  data, callback)
    {
        $.ajax(url, {
            type: 'POST',
            data: data,
            success: function( resp ) {
                callback(resp);
            },
            error: function( req, status, err ) {
                alert('something went wrong', status, err );
            }
        });
    },
    deleteWithCallback:function(url,  data, callback)
    {
        $.ajax(url, {
            type: 'DELETE',
            data: data,
            success: function( resp ) {
                console.log(resp)
                callback(resp);
            },
            error: function( req, status, err ) {
               // alert('something went wrong', status, err );
            }
        });
    },
    getWithCallback:function(url, data, callback)
    {
        $.ajax(url, {
            type: 'GET',
            data: data,
            success: function( resp ) {
                callback(resp);
            },
            error: function( req, status, err ) {
                alert('something went wrong', status, err );
            }
        });
    }, popUp : function (url,elem) {
        $.magnificPopup.open({
            items: {
                src: url ,
            },type: 'iframe',
            callbacks: {
                close: function () {
                    elem.ajax.reload()
                }


            }
        });
    }
};