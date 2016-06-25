# PS3-Manager

[ FOR THOSE THAT HAVE DOWNLOADED THE VERSIONS 0.30 OR 0.31, PLEASE DELETE IT AND DOWNLOAD THIS ONE (0.33) ! THERE WAS A BUG THAT PREVENTED IT TO WORK ]

<b>PS3 Games Manager version 0.33 (beta)</b> is a totally new and revolutionary manager application for the <b>Playstation 3</b>, that features a lot of new functions and makes managing your games a totally new experience.

The software is written in <b>PHP</b> and <b>Javascript</b>, runs on Apache webserver (or any other webserver supporting <b>PHP</b> and running on <b>Linux</b>) and uses <b>Webman APIs</b> to control the <b>PS3</b> remotely from any computer browser and any mobile device.

It completely eliminates the need to use <b>Webman</b> or <b>Multiman</b> with the joypad to launch games from the <b>PS3</b> itself.

A version that will be able to run on a <b>Windows</b> webserver supporting PHP will be also released soon.

A brief list of the features is:

- Automatic recognition of the game ISO fle and automatic download of the CD cover and all the game details from Metacritic (Game name, Release date, Score, Description, Publisher, Developer, Category)
- Very nice web graphic interface and extremely easy to use.
- Launch and Umount games straight from the web interface.
- Reboot and Shutdown the PS3 from the web interface.
- Enable disable game data for external USB drive connected to the PS3.
- Monitors and displays CPU temp, Internal PS3 hd free space, USB external PS3 hd free space, Total number of games ISOs added.

- Automatically keeps track of every time you play a game and counts the times adding a IOS style badge to the CD cover displayed on the web page search results.
- Ajax js interface to search for game name, description, category, publisher, developer in real time.
- Order results by Metacritic Score, Last played Games, Date Added Games, Games Never Played Yet, Name and Random selection.
- Easy configuration and installation.
- Voice recognition (English only so far).
- Lots more features to come.

Requirements:

- <b>LAMP environment (Linux+MySQL+Apache+PHP)</b> in a VM or on a real machine.
- Network share folder containing the PS3 ISO files and <b>PS3Netsrv++</b> to share the files with the PS3.
- PS3 modded and <b>Webman</b> installed.
- PS3 accessible via the internal network.
- A lot of joy of playing :)

Working Demo: <b><a href="http://ps3-demo.fazionet.com/index.php" target="_blank">PS3 Games Manager Website</a></b></center>

It took a lot of hours of work to develop this application.
If you like it please <a href="http://ps3-demo.fazionet.com/download.php"><b>donate</b></a> something to help me improving it.

Developed by <b>Francesco Fazio</b>.
