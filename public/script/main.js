var data = {};
var responseData = {};

$(document).ready(function(){
    data.seed = $('#seed').val();
    data.x = $('#cols').val();
    data.y = $('#rows').val();
    data.points = [];

    $('.cell').on('click', function() {
        if($(this).html()=="") {
            data.points.push($(this).attr("id"));
            $(this).html(data.points.length);
            $(this).css("outline", "3px solid red");
            $(this).css("outline-offset", "-3px");
        }
    });

    $('#reset').on('click', function() {
        // data.points.forEach(function(item, index) {
        //     $('#' + item).css("outline", "none");
        //     $('#' + item).css("outline-offset", "none");
        //     $('#' + item).html("");
        // });
        $('.cell').css("outline", "none").css("outline-offset", "none").html("");
        data.points = [];
    });

    $('#calc').on('click', function() {
        $.ajax({
            url: "/api/",
            method: "post",
            async: true,
            data: "data="+JSON.stringify(data),
            success: function(response) {
                // $('#result').html("<pre>"+response+"</pre>");
                //console.log(JSON.parse(response));
                // console.log(response);
                responseData = JSON.parse(response);
                responseData.shortestPaths.forEach(function(item, index) {
                    item.path.forEach(function(item, index) {
                        $('.row:eq(' + item[0] + ') .cell:eq(' + item[1] + ')').html(index);
                    });
                });
            }
        });
    });

    $('#seed').on('change', function() {
        data.seed = $(this).val();
    });

    $('#cols').on('change', function() {
        data.x = $(this).val();
    });

    $('#rows').on('change', function() {
        data.y = $(this).val();
    });
});