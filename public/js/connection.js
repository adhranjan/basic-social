setInterval(function() {
    $.ajax({
        type: "GET",
        url: urlConnection,
    }).done(function (data) {
        $("#wholeBody").removeClass("disabled");
        $( ".connectionlessTimer" ).hide();
    }).error(function (jqXHR, textStatus, errorThrown) {
        $("#wholeBody").addClass("disabled");
        $( ".connectionlessTimer" ).show();
    })
}, 5000);
