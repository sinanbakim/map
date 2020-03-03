var data = {
    "points": [],
    "x": 4,
    "y": 4,
    "seed": 0
};

$(document).ready(function(){
    $('.cell').on('click', function() {
        data.points.push($(this).attr("id"));
        $(this).html(data.points.length);
        $(this).css("outline", "3px solid red");
        $(this).css("outline-offset", "-3px");
    });

    $('#reset').on('click', function() {
        data.points.forEach(function(item, index) {
            $('#' + item).css("outline", "none");
            $('#' + item).css("outline-offset", "none");
            $('#' + item).html("");
        });
        data.points = [];
    });

    $('#calc').on('click', function() {
        $.ajax({
            url: "api",
            method: "get",
            data: data,
            dataType: "text",
            success: function(response) {
                //$('#result').html(response);
                console.log(response);
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