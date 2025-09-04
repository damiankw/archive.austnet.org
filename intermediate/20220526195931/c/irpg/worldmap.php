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

<div class="w3-row-padding w3-padding-64 w3-container w3-center">

<h1>WORLD MAP</h1>
<p>[<span style="color: #D30000;">offline</span> | <span style="color: #0080FF">online</span> | <span style="color: #000000">quit</span>]</p>

<div>
    <img src="makeworldmap.php?6d2e905147d20db4b01bb41b8645f972" usemap="#world" border="0" />
    <map name="world">
        <area shape="circle" coords="794,194,5" alt="ibiza" href="playerview.php?player=ibiza" title="ibiza" />
        <area shape="circle" coords="211,79,5" alt="nicu" href="playerview.php?player=nicu" title="nicu" />
        <area shape="circle" coords="50,362,5" alt="rastajedi" href="playerview.php?player=rastajedi" title="rastajedi" />
        <area shape="circle" coords="568,512,5" alt="lx" href="playerview.php?player=lx" title="lx" />
        <area shape="circle" coords="1120,48,5" alt="SkyFire" href="playerview.php?player=SkyFire" title="SkyFire" />
        <area shape="circle" coords="597,592,5" alt="Bob" href="playerview.php?player=Bob" title="Bob" />
        <area shape="circle" coords="590,304,5" alt="damian" href="playerview.php?player=damian" title="damian" />
        <area shape="circle" coords="888,278,5" alt="grem" href="playerview.php?player=grem" title="grem" />
        <area shape="circle" coords="592,524,5" alt="electrohead" href="playerview.php?player=electrohead" title="electrohead" />
        <area shape="circle" coords="297,332,5" alt="Chunky" href="playerview.php?player=Chunky" title="Chunky" />
        <area shape="circle" coords="676,22,5" alt="decalman" href="playerview.php?player=decalman" title="decalman" />
        <area shape="circle" coords="758,493,5" alt="JedStar" href="playerview.php?player=JedStar" title="JedStar" />
        <area shape="circle" coords="535,367,5" alt="Steve" href="playerview.php?player=Steve" title="Steve" />
        <area shape="circle" coords="388,87,5" alt="Alkimiloki" href="playerview.php?player=Alkimiloki" title="Alkimiloki" />
        <area shape="circle" coords="276,28,5" alt="pr0teus1" href="playerview.php?player=pr0teus1" title="pr0teus1" />
        <area shape="circle" coords="158,595,5" alt="Octane" href="playerview.php?player=Octane" title="Octane" />
        <area shape="circle" coords="576,516,5" alt="IRCStats" href="playerview.php?player=IRCStats" title="IRCStats" />
        <area shape="circle" coords="573,514,5" alt="Lin" href="playerview.php?player=Lin" title="Lin" />
        <area shape="circle" coords="432,523,5" alt="krakhed" href="playerview.php?player=krakhed" title="krakhed" />
        <area shape="circle" coords="122,444,5" alt="tozza" href="playerview.php?player=tozza" title="tozza" />
        <area shape="circle" coords="784,18,5" alt="kiska" href="playerview.php?player=kiska" title="kiska" />
        <area shape="circle" coords="667,577,5" alt="HarshGolf" href="playerview.php?player=HarshGolf" title="HarshGolf" />
        <area shape="circle" coords="756,536,5" alt="MarkBrandon" href="playerview.php?player=MarkBrandon" title="MarkBrandon" />
        <area shape="circle" coords="319,246,5" alt="Snoopys_Gunship" href="playerview.php?player=Snoopys_Gunship" title="Snoopys_Gunship" />
        <area shape="circle" coords="98,238,5" alt="brayden" href="playerview.php?player=brayden" title="brayden" />
        <area shape="circle" coords="525,364,5" alt="HellFury" href="playerview.php?player=HellFury" title="HellFury" />
        <area shape="circle" coords="628,286,5" alt="^matty^" href="playerview.php?player=%5Ematty%5E" title="^matty^" />
        <area shape="circle" coords="643,201,5" alt="clarkos" href="playerview.php?player=clarkos" title="clarkos" />
    </map>
</div>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-20 w3-center w3-opacity">  
  <p>Updated by <a href="mailto:damian@austnet.org">damian</a> for <a href="https://www.austnet.org/">AustNet</a>. Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

</body>
</html>
