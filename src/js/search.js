 $(function() {
    $("#searchInput").on('input', function() {
        var temp = $(this).val();
        $("#menu div.searchOn button").each(function() {
            var value = $(this).attr("value");
            $(this).removeClass("hide");
            if(value.toLowerCase().indexOf(temp) != 0) {
                $(this).addClass("hide");
            }
        });
    });
});