var player, time_update_interval;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('playercustom', {
        width: 720,
        height: 405,
        videoId: 'RniOqW9bVE8',
        playerVars: {
            controls: 0,
            showinfo: 0,
            modestbranding: 0,
            rel: 0,
            autoplay: 1
        },
        events: {
            onReady: initialize
        }
    });
}

function initialize(){
    player.playVideo();
    // Clear any old interval.
    clearInterval(time_update_interval);

    var currentTime;

    // Start interval to update elapsed time display and
    // the elapsed part of the progress bar every second.
    time_update_interval = setInterval(function () {
        currentTime = player.getCurrentTime();
        if(currentTime >= 570)
            $('.hideinfo').removeClass('hide');
    }, 1000);
}