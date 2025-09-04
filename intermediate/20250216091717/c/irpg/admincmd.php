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
      <h1>ADMIN COMMANDS</h1>
      <p class="w3-text-grey">The Idle RPG is just what it sounds like: an RPG in which players idle. In addition to 
        merely gaining levels, players can find items and battle other players. However, this is all done for you; 
        you just idle. There are no set classes; you can name your character anything you like, and have its class be 
        anything you like, as well.</p>
    </div>
  </div>
</div>

<div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <p class="w3-text-grey">This is not the full list of commands for the Idle RPG bot, but only the list of admin 
        commands. For more information on the Idle RPG bot, visit <a href="http://idlerpg.net">http://idlerpg.net/</a></p>

      <p class="w3-text-grey">INFO, retrieve some fairly useless stats about the bot.</p>

      <p class="w3-text-grey">DIE, kills the bot.</p>

      <p class="w3-text-grey">HOG, summon the Hand of God spell. See the main help file.</p>

      <p class="w3-text-grey">RESTART, restarts the bot.</p>

      <p class="w3-text-grey">CHPASS &lt;char name&gt; &lt;new password&gt;, change a character's pass in the IRPG.</p>

      <p class="w3-text-grey">CHCLASS &lt;char name&gt; &lt;new class name&gt;, change a character's class in the IRPG.</p>

      <p class="w3-text-grey">CHUSER &lt;char name&gt; &lt;new char name&gt;, change a character's username in the IRPG.
     Please only use in very special circumstances; otherwise, have them form
     a new player and DEL the old one. This should not let you overwrite an
     existing account, but is untested.</p>

     <p class="w3-text-grey">PUSH &lt;char name&gt; &lt;seconds&gt;, push a player toward his goal by subtracting time
     from his next time to level. Please use this only if bot has mistakenly
     penalized someone. You could also use this to punish a user by setting
     the number of seconds to a negative number. Don't do that.</p>

     <p class="w3-text-grey">DEL &lt;char name&gt;, remove a user's account.</p>

     <p class="w3-text-grey">JUMP &lt;server[:port]&gt;, move the bot to another server.</p>

     <p class="w3-text-grey">SILENT &lt;mode&gt;, switch bot between 4 modes of silence.<br>
     - mode 0, bot sends all privmsgs.<br>
     - mode 1, only chanmsg() is disabled.<br>
     - mode 2, only privmsg()/notice() to non-channels is disabled.<br>
     - mode 3, privmsgs/notices to users and channels are disabled.</p>

     <p class="w3-text-grey">BACKUP, tell bot to copy $opts{'dbfile'} to .dbbackup/$opts{'dbfile'}TIMESTAMP</p>

     <p class="w3-text-grey">RELOADDB, force bot to reload player database file, rewriting all memory.
     RELOADDB can only be used while in pause mode.</p>

     <p class="w3-text-grey">PAUSE, toggle pause mode.</p>

     <p class="w3-text-grey">PEVAL &lt;code&gt;, execute arbitrary argument as Perl code. Queues output > 3 lines
     or >1k of text. Some useful PEVAL commands:<br>
       - Delete all accounts not logged in in 4 weeks (See also: DELOLD):<br>
         /msg bot PEVAL delete $rps{$_} for grep { time()-$rps{$_}{lastlogin} > 3600*24*7*4 && !$rps{$_}{online} } keys %rps;<br>
       - Remove one hour from everyone's clocks:<br>
         /msg bot PEVAL $rps{$_}{next} -= 3600 for keys %rps;<br>
       - List all online users, separated by commas:<br>
         /msg bot PEVAL join(', ',grep { $rps{$_}{online} } keys %rps);<br>
       - View contents of a file on remote host:<br>
         /msg bot peval `cat file`<br>
       - Turn on debug mode:<br>
         /msg bot peval $opts{debug}=1;<br>
       - Force write-out of database:<br>
         /msg bot peval writedb();</p>

      <p class="w3-text-grey">DELOLD &lt;days&gt;, remove all non-logged-in accounts inactive in the last &lt;days&gt; days.</p>

      <p class="w3-text-grey">CLEARQ, clear the outgoing message queue. Useful to use if someone floods the bot with a lot of text that it plans to respond to.</p>

      <p class="w3-text-grey">MKADMIN &lt;username&gt;, set the isadmin flag for a given username.</p>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-20 w3-center w3-opacity">  
  <p>Updated by <a href="/cdn-cgi/l/email-protection#81e5e0ece8e0efc1e0f4f2f5efe4f5afeef3e6">damian</a> for <a href="https://www.austnet.org/">AustNet</a>. Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>
</html>
