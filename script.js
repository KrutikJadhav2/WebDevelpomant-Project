console.log("Starting...");

let current_song = new Audio();
let songs;
let folder;

function secondsToMinutesSeconds(seconds) {
    if (isNaN(seconds) || seconds < 0) {
        return "00:00";
    }
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = Math.floor(seconds % 60);
    const formattedMinutes = String(minutes).padStart(2, '0');
    const formattedSeconds = String(remainingSeconds).padStart(2, '0');
    return `${formattedMinutes}:${formattedSeconds}`;
}

async function getSongs(folderPath) {
    try {
        folder = folderPath;
        // Adjusted fetch path based on your file structure
        const response = await fetch(`assets/${folder}/`);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const res = await response.text();

        let div = document.createElement("div");
        div.innerHTML = res;
        let as = div.getElementsByTagName("a");

        songs = [];
        for (let index = 0; index < as.length; index++) {
            const element = as[index];
            if (element.href.endsWith("mp3")) {
                let songName = element.href.substring(element.href.lastIndexOf("/") + 1);
                songName = decodeURIComponent(songName);
                console.log("Found song:", songName);
                songs.push(songName);
            }
        }

        let songul = document.querySelector(".subcont").getElementsByTagName("ul")[0];
        songul.innerHTML = "";
        for (const song of songs) {
            songul.innerHTML += `
                <li>
                    <img src="assets/album.svg">
                    <div class="info" style="cursor:pointer;">
                        <div>${song.replace(".mp3", "")}</div>
                        <div>&copy; Music</div>
                    </div>
                    <img src="assets/play.svg" alt="" style="padding-left: 118px; cursor:pointer">
                </li>`;
        }

        Array.from(document.querySelector(".subcont").getElementsByTagName("li")).forEach(e => {
            e.addEventListener("click", element => {
                console.log("Playing:", e.querySelector(".info").firstElementChild.innerHTML);
                playMusic(e.querySelector(".info").firstElementChild.innerHTML.trim());
            });
        });

        return songs;
    } catch (error) {
        console.error("Error loading songs:", error);
        return [];
    }
}

const playMusic = (track, pause = false) => {
    try {
        // Adjusted path to match your file structure
        const audioPath = `assets/${folder}/${track}.mp3`;
        console.log("Playing audio from:", audioPath);
        current_song.src = audioPath;
        
        if (!pause) {
            current_song.play()
                .then(() => {
                    console.log("Audio started playing successfully");
                    play.src = "assets/pause.svg";
                })
                .catch(error => {
                    console.error("Error playing audio:", error);
                });
        }

        document.querySelector(".songinfo").innerHTML = track;
        document.querySelector(".songtime").innerHTML = "00:00 / 00:00";
    } catch (error) {
        console.error("Error in playMusic:", error);
    }
}

async function main() {
    try {
        // Start with the initial folder (adjusted path)
        await getSongs("songs/ncs");
        if (songs && songs.length > 0) {
            playMusic(songs[0].replace(".mp3", ""), true);
        }

        play.addEventListener("click", () => {
            if (current_song.paused) {
                current_song.play()
                    .then(() => play.src = "assets/pause.svg")
                    .catch(error => console.error("Error playing audio:", error));
            } else {
                current_song.pause();
                play.src = "assets/play.svg";
            }
        });

        // Rest of your event listeners
        current_song.addEventListener("timeupdate", () => {
            document.querySelector(".songtime").innerHTML = 
                `${secondsToMinutesSeconds(current_song.currentTime)} / ${secondsToMinutesSeconds(current_song.duration)}`;
            document.querySelector(".circle").style.left = 
                (current_song.currentTime / current_song.duration) * 100 + "%";
        });

        previous.addEventListener("click", () => {
            const index = songs.indexOf(decodeURIComponent(current_song.src.split("/").slice(-1)[0]).replace(".mp3", ""));
            if (index > 0) {
                playMusic(songs[index - 1].replace(".mp3", ""), false);
            }
        });

        next.addEventListener("click", () => {
            const index = songs.indexOf(decodeURIComponent(current_song.src.split("/").slice(-1)[0]).replace(".mp3", ""));
            if (index < songs.length - 1) {
                playMusic(songs[index + 1].replace(".mp3", ""), false);
            }
        });

        Array.from(document.getElementsByClassName("card")).forEach(e => {
            e.addEventListener("click", async item => {
                console.log("Fetching songs from folder:", item.currentTarget.dataset.folder);
                songs = await getSongs(`songs/${item.currentTarget.dataset.folder}`);
                if (songs && songs.length > 0) {
                    playMusic(songs[0].replace(".mp3", ""), false);
                }
            });
        });
    } catch (error) {
        console.error("Error in main:", error);
    }
}

main();