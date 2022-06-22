export function fadeIn( elem, ms )
{
    if( ! elem )
        return;

    elem.style.opacity = 0;
    elem.style.filter = "alpha(opacity=0)";
    elem.style.display = "flex";
    elem.style.visibility = "visible";

    if( ms )
    {
        var opacity = 0;
        var timer = setInterval( function() {
        opacity += 50 / ms;
        if( opacity >= 1 )
        {
            clearInterval(timer);
            opacity = 1;
        }
        elem.style.opacity = opacity;
        elem.style.filter = "alpha(opacity=" + opacity * 100 + ")";
        }, 50 );
    }
    else
    {
        elem.style.opacity = 1;
        elem.style.filter = "alpha(opacity=1)";
    }
}