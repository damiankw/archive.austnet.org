<!DOCTYPE html>
<html lang="en">
<title>IdleRPG - AustNet Chat Network</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="include/idlerpg.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="include/idlerpg.js"></script>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-blue-grey w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-blue-grey" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Game Info</a>
    <a href="admincmd.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Admin Commands</a>
    <a href="players.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Player Info</a>
    <a href="worldmap.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">World Map</a>
    <a href="quest.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Quest Info</a>
    <a href="https://www.austnet.org/" class="w3-hide-small" target="_new"><img src="images/idlerpg.png" align="right" style="padding-right:10px;"></a>
    <a href="https://www.austnet.org/" class="w3-hide-large" target="_new"><img src="images/idlerpg.png" style="padding-left: 10px;"></a>
</div>

  <!-- Navbar on small screens -->
  <div id="mobilenav" class="w3-bar-block w3-blue-grey w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large">Game Info</a>
    <a href="admincmd.php" class="w3-bar-item w3-button w3-padding-large">Admin Commands</a>
    <a href="players.php" class="w3-bar-item w3-button w3-padding-large">Player Info</a>
    <a href="worldmap.php" class="w3-bar-item w3-button w3-padding-large">World Map</a>
    <a href="quest.php" class="w3-bar-item w3-button w3-padding-large">Quest Info</a>
  </div>
</div>
<div class="w3-row-padding w3-padding-64 w3-container">
    <div class="w3-content">
        <div class="w3-twothird">
            <h1>Current Quest</h1>
            <p><b>Quest:</b> To setup a trade route through the mountains to the neighboring land of Qwok and arrange correspondence with their leader, Cuincey-Love Vikk'l
.</p>
            <p><b>Goals:</b></p>
            <ul>
                <li>Starting goal: 235 x 125 [COMPLETE]</li>
                <li>Finishing goal: 430 x 60</li>
            </ul>

            <p><b>Player #1:</b> <a href="playerview.php?player=kiska">kiska</a> [Currently: 253 x 107]<br>
            <p><b>Player #2:</b> <a href="playerview.php?player=lx">lx</a> [Currently: 249 x 111]<br>
            <p><b>Player #3:</b> <a href="playerview.php?player=Lin">Lin</a> [Currently: 262 x 98]<br>
            <p><b>Player #4:</b> <a href="playerview.php?player=Gamebro">Gamebro</a> [Currently: 259 x 101]<br>
        </div>
    </div>
</div>

<div class="w3-row-padding w3-padding-64 w3-container w3-light-grey">
    <div class="w3-content">
        <h2>Quest Map</h2>
        <p>[Questers are shown in blue, current goal in red]</p>
        <div id="map"><img class="w3-image" src="makequestmap.php" usemap="#quest" border="0" /></div>
        <map id="quest" name="quest">
                <area shape="circle" coords="253,107,6" alt="kiska" href="playerview.php?player=kiska" />
                <area shape="circle" coords="249,111,6" alt="lx" href="playerview.php?player=lx" />
                <area shape="circle" coords="262,98,6" alt="Lin" href="playerview.php?player=Lin" />
                <area shape="circle" coords="259,101,6" alt="Gamebro" href="playerview.php?player=Gamebro" />
        </map>
    </div>
</div>
</div>
<!-- Footer -->
<footer class="w3-container w3-padding-20 w3-center w3-opacity">  
  <p>Updated by <a href="/cdn-cgi/l/email-protection#3a5e5b57535b547a5b4f494e545f4e1455485d">damian</a> for <a href="https://www.austnet.org/">AustNet</a>. Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>
</html>
