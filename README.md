punts
=====


PHP Punt booking code for Clare College MCR.
Standalone version

requires 3 MySQL databases: access, mcrpunts\_punts, mcrpunts\_bookings

	access: database with details of user permissions
        	1.	id	int(11)			No	None	AUTO_INCREMENT	 Change Change	 Drop Drop	More Show more actions
	      	2.	crsid	varchar(10)	latin1_swedish_ci		Yes	NULL		 Change Change	 Drop Drop	More Show more actions
	      	3.	e_view	int(1)			Yes	NULL		 Change Change	 Drop Drop	More Show more actions
	      	4.	e_book	int(1)			Yes	NULL		 Change Change	 Drop Drop	More Show more actions
	      	5.	e_adm	int(1)			Yes	NULL		 Change Change	 Drop Drop	More Show more actions
	      	6.	p_view	int(1)			Yes	NULL		 Change Change	 Drop Drop	More Show more actions
  	    	7.	p_book	int(1)			Yes	NULL		 Change Change	 Drop Drop	More Show more actions
	      	8.	p_adm	int(1)			Yes	NULL		 Change Change	 Drop Drop	More Show more actions
	      	9.	s_adm	int(1)			Yes	NULL		 Change Change	 Drop Drop	More Show more actions
	      	10.	mcr_member	int(1)			Yes	0		 Change Change	 Drop Drop	More Show more actions
	      	11.	associate_member	int(1)			Yes	0		 Change Change	 Drop Drop	More Show more actions
	      	12.	cra	int(1)			Yes	0		 Change Change	 Drop Drop	More Show more actions
	      	13.	non_clare_associate_member	int(1)			Yes	0		 Change Change	 Drop Drop	More Show more actions
	      	14.	type	int(1)			Yes	NULL		 Change Change	 Drop Drop	More Show more actions
	      	15.	enabled	int(1)			Yes	NULL		 Change Change	 Drop Drop	More Show more actions	
	      
	mcrpunts\_punts: information on punts (currently only 2 punts supported)
        	1.	id	int(10)		UNSIGNED	No	None	AUTO_INCREMENT	 Change Change	 Drop Drop	More Show more actions
	      	2.	name	varchar(50)	latin1_swedish_ci		Yes	NULL		 Change Change	 Drop Drop	More Show more actions
	      	3.	available_from	datetime			Yes	NULL		 Change Change	 Drop Drop	More Show more actions
	      	4.	available_to	datetime			Yes	NULL		 Change Change	 Drop Drop	More Show more actions
	      
	mcrpunts\_bookings: information on punts bookings
	      	1.	id	        int(10)		UNSIGNED	No	None	AUTO_INCREMENT	 Change Change	 Drop Drop	More Show more actions
	      	2.	puntid	    int(10)		UNSIGNED	No	None		 Change Change	 Drop Drop	More Show more actions
	      	3.	booker	    varchar(10)	latin1_swedish_ci		Yes	NULL		 Change Change	 Drop Drop	More Show more actions
	      	4.	name	varchar(30)	latin1_swedish_ci		Yes	NULL		 Change Change	 Drop Drop	More Show more actions
	      	5.	mobile	varchar(20)	latin1_swedish_ci		Yes	NULL		 Change Change	 Drop Drop	More Show more actions
	      	6.	time_from	datetime			Yes	NULL		 Change Change	 Drop Drop	More Show more actions
	      	7.	time_to	datetime			Yes	NULL		 Change Change	 Drop Drop	More Show more actions
