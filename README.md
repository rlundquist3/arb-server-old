Arb Server
==========

Summer 2014

This provides the server functionality for the Lillian Anderson Arboretum Mobile App. The functions apply to the iOS version of the app and will work for Android as well, when implemented.

This will be moved to a server at the College.


/main.php
---------

This address serves as the main source for acquiring data.
```
?type=trail_points
```
returns the XML with the GPS coordinates for all trail data formatted as:
```
<trails>
<rte>
		<rtept lat=”[latitude]” lon=”[longitude]” trail=”1”>
		</rtept>
		…
	</rte>
	<rte>
		<rtept lat=”[latitude]” lon=”[longitude]” trail=”2”>
		</rtept>
		…
	</rte>
	…
</trails>
```

```
?type=arb_items
```
queries the database for currently relevant points of interest in the Arb and returns their information in XML formatted as:
```
<item><name>[name]</name><image>[image_name]</image><description>[description]</description><coords><lat>[latitude]</lat><lon>[longitude]</lon></coords><dates><start>[start_month]</start><end>[end_month]</end></dates></item>
```


/mail.php
---------

This address provides contact functionality. Sending a POST request with the parameters email, subject, and message will send the Arboretum email address an email and send a confirmation to the submitted email address.


Data
----

The /data directory contains some Arb data in xml format. This is currently only the trail data.

Other information (e.g. "Things to See") is stored in a MySQL database.


Images
------

Images for "Things to See" in the Arb are stored directly in /images (i.e. not in subfolders). Their names are stored in the database.
