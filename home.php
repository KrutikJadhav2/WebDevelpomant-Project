<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_home.css">
    <link rel="stylesheet" href="utility.css">
    <script src="script.js"></script>
    <title>Home</title>
</head>
<body>
    <div class="container flex bgblack">
        <div class="left border">
            <div class="home bggray rounded">
                <div class="logo items-center" style="font-weight: 600;"><img class="invert" src="assets/logo.svg" alt="logo" width="30px"><h1>Music Player</h1></div>
                <ul>
                    <li class="items-center" style="list-style-type: none; cursor: pointer"><img src="assets/home.svg" alt="home">Home</li>
                    <li class="items-center" style="list-style-type: none; cursor: pointer;"><img src="assets/search.svg" alt="home">Search</li>
                </ul>
            </div>
            <div class="library bggray rounded">
                <div class="heading" style="cursor: pointer;">
                    <img src="assets/lib.svg" alt="lib" width="20px">
                    <h3 >Your Library</h3>
                </div>
                <div class="subcont">
                    <ul>
                    </ul>
                </div>
            </div>
        </div>
        <div class="right border">
            <div class="header bggray rounded">
                <h2 style="padding-top: 6px; color: white;">Welcome,</h2>
                <div>
                    <button class="button">Sign Up</button>
                    <button class="button">Login</button>
                </div>
            </div>
            <div class="content-org rounded">
                <div class="full_play">
                    <h2>Music Playlists</h2>
                    <div class="cardcont">
                        <div data-folder="cs" class="card">
                            <img src="assets/play1.jpeg">
                            <h3>Happy Hits!</h3>
                            <p>Hits to boost your mood and fill you with happiness!</p>
                        </div>
                        <div  data-folder="ncs" class="card">
                            <img src="assets/play2.jpg">
                            <h3>Calming Acoustics!</h3>
                            <p>Keep calm with nstrumental acoustics and enjoy!</p>
                        </div>
                        <div data-folder="3" class="card">
                            <img src="assets/play3.jpeg">
                            <h3>Happy Hits!</h3>
                            <p>Hits to boost your mood and fill you with happiness!</p>
                        </div>
                        <div  data-folder="4" class="card">
                            <img src="assets/play4.jpg">
                            <h3>Calming Acoustics!</h3>
                            <p>Keep calm with nstrumental acoustics and enjoy!</p>
                        </div>
                        <div data-folder="5" class="card">
                            <img src="assets/play5.jpg">
                            <h3>Happy Hits!</h3>
                            <p>Hits to boost your mood and fill you with happiness!</p>
                        </div>
                        <div data-folder="6" class="card">
                            <img src="assets/play6.jpeg">
                            <h3>Happy Hits!</h3>
                            <p>Hits to boost your mood and fill you with happiness!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div class="playbar">
        <div class="songinfo"></div>
        <div class="songbtn">
            <img id="previous" src="assets/back.svg" alt="">
            <img id="play" src="assets/play.svg" alt="">
            <img id="next" src="assets/next.svg" alt="">
        </div>
        <div class="songtime"></div><br>
    </div> 
    <div class="seekbar">
        <div class="circle"></div>
    </div>
</body>
</html>