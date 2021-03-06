var currentPlaylist = new Array();
var shuffledPlaylist = new Array();
var tempPlaylist = new Array();
var audioElement;
var mousedown = false;
// index of the currently playing song
let currentIndex = 0;
let repeat = false;
let shuffle = false;
var userLoggedIn;

const openPage = (url) => {
    if (url.indexOf("?") == -1) {
        url = url + "?";
    }

    const encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
    $("#mainContent").load(encodedUrl);
    $("body").scrollTop(0);
    history.pushState(null, null, url);
}

const formatTime = (duration) => {
    const time = Math.round(duration);
    const minutes = Math.floor(time / 60);
    const seconds = time - (minutes * 60);
    let extraZero = "";

    if (seconds < 10) {
        extraZero = "0";
    }

    return minutes + ":" + extraZero + seconds;
}

const updateTimeProgressBar = (audio) => {
    $(".progressTime.current").text(formatTime(audio.currentTime));
    $(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));

    const progress = audio.currentTime / audio.duration * 100;
    $(".playbackBar .progress").css("width", progress + "%");
}

const updateVolumeProgressBar = audio => {
    const volume = audio.volume * 100;
    $(".volumeBar .progress").css("width", volume + "%");
}

function Audio() {
    this.currentlyPlaying;
    this.audio = document.createElement("audio");

    this.audio.addEventListener("ended", function() {
        nextSong();
    })

    this.audio.addEventListener("canplay", function() {
        const duration = formatTime(this.duration);
        $(".progressTime.remaining").text(duration);
    })

    this.audio.addEventListener("timeupdate", function() {
        if (this.duration) {
            updateTimeProgressBar(this);
        }
    })

    this.audio.addEventListener("volumechange", function() {
        updateVolumeProgressBar(this);
    })

    this.setTrack = (track) => {
        this.audio.src = track.path;
        this.currentlyPlaying = track;
    };

    this.play = () => {
        this.audio.play();
    }

    this.pause = () => {
        this.audio.pause();
    }

    this.setTime = (seconds) => {
        this.audio.currentTime = seconds;
    }
}
