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
      <h1>PLAYERS</h1>
      <p>Pick a player to view more information about them. [gray=offline]</p>
      
      <ol>
        <li class="w3-text-grey"><a href="playerview.php?player=electrohead">electrohead</a>, the level 206 CEO. Next level in 17 days, 02:41:02.</li>
        <li ><a href="playerview.php?player=Lin">Lin</a>, the level 201 Teacher. Next level in 11 days, 03:57:59.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=damian">damian</a>, the level 196 Geek. Next level in 14 days, 03:28:34.</li>
        <li ><a href="playerview.php?player=lx">lx</a>, the level 180 bot. Next level in 12 days, 07:48:15.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=kiska">kiska</a>, the level 149 Unassuming Civilian. Next level in 14 days, 14:21:55.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=ibiza">ibiza</a>, the level 133 Jester. Next level in 6 days, 07:39:50.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=IRCStats">IRCStats</a>, the level 128 The King Slooder. Next level in 6 days, 11:49:54.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=%5Ematty%5E">^matty^</a>, the level 109 carlton. Next level in 52 days, 04:16:08.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=brayden">brayden</a>, the level 108 mong. Next level in 153 days, 15:27:06.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=Octane">Octane</a>, the level 91 Paragon. Next level in 22 days, 17:45:17.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=grem">grem</a>, the level 85 Wizard. Next level in 7 days, 02:52:57.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=JedStar">JedStar</a>, the level 82 Shining Star. Next level in 30 days, 13:11:27.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=von">von</a>, the level 80 The VON of Austnet. Next level in 5 days, 18:28:59.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=tozza">tozza</a>, the level 76 Trojan. Next level in 1 day, 09:29:03.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=rastajedi">rastajedi</a>, the level 61 rastafarian. Next level in 9 days, 15:43:32.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=Gamebro">Gamebro</a>, the level 61 embargo. Next level in 116 days, 16:37:58.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=Bob">Bob</a>, the level 60 Builder. Next level in 16 days, 00:04:08.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=clarkos">clarkos</a>, the level 53 thegerm. Next level in 6 days, 13:18:43.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=wily">wily</a>, the level 51 skid. Next level in 3 days, 22:34:40.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=MarkBrandon">MarkBrandon</a>, the level 48 ChopperRead. Next level in 3 days, 17:27:55.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=Steve">Steve</a>, the level 48 LookatThe. Next level in 4 days, 13:53:42.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=decalman">decalman</a>, the level 42 Gremlin. Next level in 1 day, 11:23:25.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=Chunky">Chunky</a>, the level 42 Hobo. Next level in 2 days, 07:48:15.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=Snoopys_Gunship">Snoopys_Gunship</a>, the level 42 the sex gord. Next level in 3 days, 20:14:28.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=HellFury">HellFury</a>, the level 39 lady. Next level in 2 days, 19:45:55.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=SkyFire">SkyFire</a>, the level 37 Sorcerer. Next level in 2 days, 01:45:54.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=Avarice">Avarice</a>, the level 35 Phreak. Next level in 0 days, 23:30:52.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=HarshGolf">HarshGolf</a>, the level 29 LostHorizons. Next level in 0 days, 01:30:57.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=pr0teus1">pr0teus1</a>, the level 15 Boofhead. Next level in 0 days, 01:10:03.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=Bnty">Bnty</a>, the level 12 Digger of Holes. Next level in 0 days, 00:36:30.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=krakhed">krakhed</a>, the level 7 F-15_Strike_Eagle. Next level in 0 days, 00:12:18.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=Alkimiloki">Alkimiloki</a>, the level 1 mage. Next level in 0 days, 00:08:34.</li>
        <li class="w3-text-grey"><a href="playerview.php?player=nicu">nicu</a>, the level 0 mage. Next level in 0 days, 00:07:15.</li>
      </ol>
      <p>For a script to view player stats from a terminal, try <a href="scripts/idlerpg-adv.pl">this</a> perl script by <a href="/cdn-cgi/l/email-protection#187c796060796a58757d766c7974367571767d36766d">daxxar</a>.</p>

      <p>See player stats in <a href="db.php">table format</a>.</p>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-20 w3-center w3-opacity">  
  <p>Updated by <a href="/cdn-cgi/l/email-protection#3054515d59515e70514543445e55441e5f4257">damian</a> for <a href="https://www.austnet.org/">AustNet</a>. Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>
</html>
