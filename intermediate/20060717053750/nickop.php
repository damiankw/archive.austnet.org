<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
  <title>AustNet.org :: NickOP</title>
  <script type="text/javascript"></script>
  <style type="text/css" title="currentStyle" media="screen">
    @import "austnet.css";
  </style>
</head>
<body id="austnet">
  <div id="container">
    <div id="header">
    </div>
    <div id="content">
      <div class="wrapper">
      <ul id="tabnav">
        <li><a href="services.php">Services</a></li>
        <li><a href="asd.php">ASD</a></li>
        <li><a href="chanop.php">ChanOP</a></li>
        <li><a href="loveop.php">LoveOP</a></li>
        <li class="current"><a href="nickop.php">NickOP</a></li>
        <li><a href="noteop.php">NoteOP</a></li>
      </ul>
      <p><strong>NickOP</strong></p>
      <p><strong>What is NickOP ?</strong><br />NickOP provides the totally transparent option of allowing you to use your favourite nickname anytime you want and even allows you to set a URL so other users know your e-mail and home page addresses. The nickname operator server (NickOP) controls who has authorisation to use certain nicknames. Upon connecting to any AustNet server, your nickname is validified with NickOP's databases and if you do not own it, you are given the option to authenticate yourself or your nickname will be changed by force. NickOP has speedy registration facilities and provides secure ownership enforcement.</p>
      <p><strong>What is registration?</strong><br />Nickname registration with NickOP essentially allows you to &quot;own&quot; that nickname. Registration entails creating a password that is individual to you and that cannot be guessed. With this password, you are able to authenticate your identify, register channels, receive operator status on channels, send notes to other users, and much more. Registration effectively secures your identity on the AustNet network and allows you to be added to channel access lists and be included in many other online databases.</p>
      <p><strong>Why bother registering?</strong><br />If you do not register your nickname, you are not able to register a channel, you are not able to be on a channel access list, nor are you able to use many of the AustNet service's wide range of commands. Registration allows the services to authenticate your identity at all times, and provides a secure method of chatting on AustNet.</p>
      <p><strong>How do I register my nickname?</strong><br />Registration is an easy process, simply type the following command while you are connected to an AustNet server:<br />/msg NickOP register [password] [email address]<br />Ensure that your password is not easily guessed and is very individual. While every precaution is taken from other people &quot;hacking&quot; your nickname, it is your responsibility to choose a secure password for future use. Write this password down and store it in a safe place. It is not recommended that you add your password to your script, as one day someone else may see this script and hence have access to your nickname. Please remember that passwords are case sensitive.<br />Your e-mail address is required in case you forget your password, in which case it will be e-mailed to you upon request from an ASD administrator. If you use a fake or non-existant e-mail address, you run the risk of losing your nickname if you forget your password. However, there is no need to use a fake email address as it is not publically available using the default nick settings.</p>
      <p><strong>How do I identify?</strong><br />When you identify, you essentially &quot;sign on&quot; to the services, allowing you to execute high level channel commands, send notes to other users, and many other commands. To identify, simply type:<br />/msg nickop@austnet.org identify [password]<br />Ensure that you include the &quot;nickop@austnet.org&quot; address when identifying.</p>
      <p><strong>How do I change my password?</strong><br />You should change your password on a regular basis. To do so, simply type the following command:<br />/msg NickOP set password [new password]<br />Remember that your password is the key to your nickname. It should be difficult to guess by other users. For a guide on choosing passwords, follow this link.</p>
      <p><strong>How do I set the kill option on?</strong><br />By default, when you register a nickname, the kill option is off. If you wish it to be active, you will need to type the following command. By setting this option on, you are ensuring that no one will be able to use this nickname even when you are not on IRC.<br />/msg NickOP set kill on</p>
      <p><strong>What is a userhost?</strong><br />A userhost is simply our IRC identity. A userhost comprises of your user name (using identd) and a domain (specified by your ISP).<br />For example, the userhost lawrence@vw-8463.ozemail.com.au comprises of a user name &quot;lawrence&quot; and a domain &quot;vw-8463.ozemail.com.au&quot;. When you connect to an AustNet server, your userhost is cross-referenced against the userhosts in NickOP's database. If they match, you can continue to IRC. If they do not match, you will need to identify otherwise your nickname will be forcibly changed to another.</p>
      <p><strong>Nickop will not let me identify, what will I do?</strong><br />Ensure that you are typing the<br />/msg nickop@austnet.org identify [password]<br />command including the &quot;nickop@austnet.org&quot; address. If, however, NickOP replies that your password is invalid, you may need to recover your password.</p>
      <p><strong>I'm using another ISP (or userhost) what do I do?</strong><br />Identify with NickOP:<br />/msg nickop@austnet.org identify [password]<br />Add your new userhost to the database:<br />/msg nickop@austnet.org host add [userhost]<br />Remove a userhost from the database:<br />/msg nickop@austnet.org host del [userhost]<br />List the userhosts in the database:<br />/msg nickop@austnet.org host list<br />An example userhost for lawrence@vw-8463.ozemail.com.au is lawrence@*.ozemail.com.au; If you need help with this, join #Help and ask assistance on how to make yourself a usermask.</p>
      <p><strong>How can I configure my nickname?</strong><br />NickOP has the added option of configuring your nickname so other people will know your e-mail and web page addresses.</p>
      <p>To change your E-Mail address:<br />/msg NickOP set email [address]<br />To allow users to see your E-Mail address:<br />/msg NickOP set showemail on<br />To change your E-Mail address:<br />/msg NickOP set email [address]<br />To have services query you instead of notice you:<br />/msg NickOP set usemsg on<br />To set your web page address:<br />/msg NickOP set url [address]</p>
      <p><strong>I have lost my password, help!</strong><br />If you are certain that you have lost your nickname password, you can recover it through the following methods:<br />While connected to an AustNet server:<br />Simply /join #ASD and ask for help from a services administrator. They will be able to recover your password through services and e-mail it to the address you set on NickOP when registering.<br />Via e-mail:<br />Mail services@austnet.org requesting recovery of your nickname; Ensure that you provide your userhost mask that you use online, the nickname you forgot the password for, and the e-mail address set for it.</p>
      <p><strong>I think someone knows my password!</strong><br />If you are finding that /msg NickOP info [nickname] returns that your nickname was recently used when you know that it has not been, or someone is using the kill command through NickOP to disconnect you, you should attempt to change your password. If you cannot, contact #asd for help.</p>
      <p><strong>How do I kill my &quot;ghost&quot;?</strong><br />If for some reason you have a ghost connected to AustNet caused by lag from your ISP, you can easily remove this ghost via NickOP. The same applies if someone is using your nickname and you do not have the kill option set active. To kill your registered nickname:<br />/msg nickop@austnet.org kill [nickname] [password]</p>
      <p>For more help on NickOp, ask online in #asd or contact &#115;&#101;&#114;&#118;&#105;&#099;&#101;&#115;&#064;&#097;&#117;&#115;&#116;&#110;&#101;&#116;&#046;&#111;&#114;&#103;</p>
      </div>
    </div>
    <div id="news">
<a href="http://www.austnet.org/news.php?action=fullnews&id=2">New US Server, shadow.*</a>, by Trip posted on 06 April, 2006<br />
<br /><a href="http://www.austnet.org/news.php?action=fullnews&id=1">The new AustNet.org web site is here</a>, by Austnet posted on 14 September, 2005<br />
<br />    </div>
    <div id="navMenu">
      <div id="navMenu2">
        <div id="lselect">
          <ul>
            <li><a href="index.php" title="Home" accesskey="a">Home</a></li>
            <li><a href="about_us.php" title="About Us" accesskey="b">About Us</a></li>
            <li><a href="contact_us.php" title="Contact Us" accesskey="c">Contact Us</a></li>
            <li><a href="servers.php" title="Servers" accesskey="d">Servers</a></li>
            <li><a href="austnet_board.php" title="Administration" accesskey="e">Administration</a></li>
            <li><a href="routing.php" title="Routing" accesskey="f">Routing</a></li>
            <li><a href="services.php" title="Services" accesskey="g">Services</a></li>
            <li><a href="#" title="Support" accesskey="h">Support</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div id="footer">
    <a href="index.php" title="Home">Home</a> &nbsp;&nbsp;
    <a href="user_agreement.php" title="User Agreement">User Agreement</a> &nbsp;&nbsp;
    <a href="privacy.php" title="Privacy">Privacy</a> &nbsp;&nbsp;
    <a href="about_us.php" title="About Us">About Us</a> &nbsp;&nbsp;
    <a href="contact_us.php" title="Contact Us">Contact Us</a> 
  </div>
  <div id="copyright">
    <span>Copyright &copy; 2006 AustNet. All rights reserved.</span>
  </div>  
  <div id="fixDiv1"><span></span></div>
  <div id="fixDiv2"><span></span></div>
  <div id="fixDiv3"><span></span></div>
</body>
</html>
