# PS3 Games Manager

<b>PS3 Games Manager version 0.42c (beta)</b> is a manager application for the <b>Playstation 3</b>, that features a lot of new functions and makes managing your games a totally new experience.

The software is written in <b>PHP</b> and <b>Javascript</b>, runs on Apache webserver (or any other webserver supporting <b>PHP</b> and running on <b>Linux</b>) and uses <b>Webman APIs</b> to control the <b>PS3</b> remotely from any computer browser and any mobile device.

<b>FEATURES</b>

- Automatic recognition of the game ISO files and automatic download of the CD cover and all the game details from Metacritic (Game name, Release date, Score, Description, Publisher, Developer, Category)
- Very nice web graphic interface and extremely easy to use.
- Mobile access fully working in PORTRAIT mode. This is tested on a Samsung Galaxy (S5, S7, Tab), iPhones (4, 4s, 5s, 6s, 7, 7 plus), iPad Air. Tested on the latest IOS 10.0.2 with Safari, Google Chrome and Firefox.
- Launch and Umount games straight from the web interface.
- Reboot and Shutdown the PS3 from the web interface.
- Enable disable game data for external USB drive connected to the PS3.
- Real Time Monitoring of the following values:
  PS3 Uptime, Game Currently Mounted, Actual Playing Time, webMAN Version, PS3 Firmware Version, PS3 Free Memory, CPU temp, Internal PS3 hd free space, USB external PS3 hd free space, Total number of games ISOs added.
- Automatically keeps track of the amount of times you play a game and count each time adding a IOS style badge to the CD cover displayed on the web page search results.
= Ajax js interface to search for game name, description, category, publisher, developer in real time.
- Order results by Metacritic Score, Last played Games, Date Added Games, Games Never Played Yet, Name and Random selection.
- Easy configuration and installation.
- Voice recognition (English only so far).
- Lots more features to come.

<b>REQUIREMENTS</b>

- LAMP environment (Linux+MySQL+Apache+PHP) in a VM (VirtualBox or VmWare) or on a real machine.
- Network share folder containing the PS3 ISO files and PS3NetSrv++ for Linux or PS3NetSrv for Windows to share the files with the PS3.
- PS3 modded with CFW and webMAN MOD 1.45.00+ installed.
- PS3 accessible via the internal network.
- A lot of joy of playing :)


Working Demo: <b><a href="http://ps3-demo.fazionet.com/index.php" target="_blank">PS3 Games Manager Website</a></b></center>

It took a lot of hours of work to develop this application.
If you like it please <a href="http://ps3-demo.fazionet.com/download.php"><b>donate</b></a> something to help me improving it.

Developed by <b>Francesco Fazio</b>.
