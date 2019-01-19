# Basic_Website
If you're interested in running a small website alongside your FakeTV setup, this is a good place to get started

Getting Started
Before even adding this to your FakeTV system, you need to make sure you have the following things completed
- Installed the apace package (version shouldn't matter)
- Installed PHP (this should be done by the previous step)
- (To make your life easier) chmod the entire /var/html/www folder (Only necessary if you don't know what you're doing)
- Aliasing folders with apache (see below)

Why/How to Alias
When using this website, it will refer to the given channel lineups you find in your /home/pi/channels/pseudo-channel_ location.  For apache to reach this section, we are going to need to alias the location.  This is simple to do
- Go to your apache etc folder (usually something like /etc/apache/), and edit your apache.conf file
- At the very bottom, you want to place a line like the following "Alias /ch01 /home/pi/channels/pseudo-channel_01/schedules"
-- ch01 will be the way you refer to your location in your web browser
-- the file loation is where the html of the actual schedule is location (this will probably not change from what I wrote)
- Repeat this step for all channels you plan to make schedules for.

To complete the Install: 
With all of this done, you should now be able to move all of these files to "var/html/www".  Then do the initial test of your website by visitng http://IP ADDRESS.  You're all set!
  NOW onto customization
  - Everywhere you see "m2tv.home.local" you need to replace with your ip address for your controller
  - You can change the .ico and .jpg with your own backgrounds
  
Common ways to solve problems:
- Check to make sure ALL folders in /var/html/www, as well as /home/pi are ALL permissions 777
- Try to restart your system

-----------------------------------------------
Improvements to be made:
- Can make it so you only have to enter your IP address once (not a bunch of times)
- Make it so permissions and aliasing is not necessary
