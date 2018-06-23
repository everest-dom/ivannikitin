function timer(r, timer){

    r = parseInt(r);

    if(r <= 0) {
        document.cookie="sv=y";
        location.reload();
    }

    var days = Math.floor(r / 86400);

    var r2 = r - days * 86400;

    var hours = Math.floor( r2 / 3600);

    var minutes = Math.floor((r2 - (hours * 3600)) / 60);

    var seconds = Math.floor((r2 - (hours * 3600)) % 60);

    if ( days < 10 )
    {
        // $(".d .f").html('0'+days);
    }
    else
    {
        // var h1 = parseInt((days/1)%10);
        // var h2 = parseInt((days/10)%10);
        // $(".d .f").html(h2+''+h1);
    }

    var $seconds = $(timer + '__seconds'),
        $minutes = $(timer + '__minutes'),
        $hours = $(timer + '__hours');

    if ( seconds < 10 )
    {
        $seconds.html('0'+seconds);
    }
    else
    {
        var h1 = parseInt((seconds/1)%10);
        var h2 = parseInt((seconds/10)%10);
        $seconds.html(h2+''+h1);
    }

    if ( minutes < 10 )
    {
        $minutes.html('0'+minutes);
    }
    else
    {
        var h1 = parseInt((minutes/1)%10);
        var h2 = parseInt((minutes/10)%10);
        $minutes.html(h2+''+h1);
    }

    hours += days * 24;
    if ( hours < 10 )
    {
        $hours.html('0'+hours);
    }
    else
    {
        var h1 = parseInt((hours/1)%10);
        var h2 = parseInt((hours/10)%10);
        $hours.html(h2+''+h1);
    }

    setTimeout("timer("+(r-1)+", '"+timer+"');", 1000);

}