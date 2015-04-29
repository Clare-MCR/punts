<?php
/**
 * @class User
 * @abstract The User class, controls access, user permissions and stores
 * the user's crsid
 * @description Not much more to say than the abstract really
 */

require_once('database.class.php');

class genericItem {

    /* @class genericItem
     * @abstract A class which contains nothing but the basic functions for
     * getting and setting values
     * @description Pretty much a superclass purely to provide getter and
     * setter functions for the rest of the system
     */
	    # Standard get and set functions to control internal vars
    function getValue($val) {
        return $this->$val;
    }

    function setValue($val, $value) {
        $this->$val = $value;
    }

}


class User {
 	/**
     * @class User
     * @abstract The User class, controls access, user permissions and stores
     * the user's crsid
     * @description Not much more to say than the abstract really
     */

    private $pre    = PREFIXNAME;

    # User associated variables
    private $id;
    private $crsid;
    private $e_view;
    private $e_book;
    private $e_adm;
    private $s_adm;
    private $p_view;
    private $p_book;
    private $p_adm;
    private $type;
    private $enabled;

    private $name;
    private $exists;
	private $permissions;
	private $mobile;

	private $cra;
	private $mcr_member;
	private $associate_member;
	private $non_clare_associate_member;

	private $database;

	/**
	 * Check If user exists in Database
	 * If exists get Data from Database
	 */
	public function __construct($crsid)
	{
		$this->crsid = $crsid;
		$this->database = new Database();
		if ($this->exists()) {
			$this->getSQLuserData($crsid);
			$this->has_perm();
			$this->getName();
		}

	}
	public function __destruct()
	{
		unset($this->database);
	}
	public function __toString()
	{
		$string = $this->getValue(crsid) ;
		return $string;

	}

	# Standard get and set functions to control internal vars
    public function getValue($val) {
        return $this->$val;
    }

    public function setValue($val, $value) {
        $this->$val = $value;
    }

    # Checks whether a user has a given permission
    public function has_perm()
    {
    	if($this->getValue('enabled') && $this->getValue('p_view')) {
    		$this->setValue('permissions',TRUE);
    		return TRUE;
    	} else {
    		$this->setValue('permissions',FALSE);
    		return FALSE;
    	}
    }

    # Checks whether the user exists already.
    public function getSQLuserData($crsid)
    {
		$this->database->query('SELECT e_view,e_book,e_adm,p_view, p_book, p_adm, s_adm,
								mcr_member, associate_member, cra,
								non_clare_associate_member, type, enabled
								FROM '. $this->pre.'access WHERE crsid=:crsid');
		$this->database->bind(':crsid', $crsid);
		$rows = $this->database->single();
    	foreach($rows as $key => $value) {
        	$this->$key = (bool)$value;
    		}
    	$this->database->query('SELECT id FROM '. $this->pre.'access WHERE crsid=:crsid');
		$this->database->bind(':crsid', $crsid);
		$rows = $this->database->single();
    	foreach($rows as $key => $value) {
        	$this->$key = $value;
    		}

    	// look for mobile number
    	$this->database->query('SELECT mobile FROM '. $this->pre.'mcrpunts_bookings
    							WHERE booker=:crsid ORDER BY id DESC LIMIT 1');
		$this->database->bind(':crsid', $crsid);
		$rows = $this->database->single();
		if ($this->database->rowCount() == 1) {
			foreach($rows as $key => $value) {
        		$this->$key = $value;
        		}
    		} else {
    			$this->mobile='NA';
    		}
    	}
	//Lookup user name
	public function getName()
		{
			$ds = ldap_connect("ldap.lookup.cam.ac.uk");
    		$lsearch = ldap_search($ds, "ou=people,o=University of Cambridge,dc=cam,dc=ac,dc=uk", "uid=" . $this->crsid. "");
    		$info = ldap_get_entries($ds, $lsearch);

    		$this->name = $info[0]["cn"][0];
    		if ($this->name == "") {
            		$this->name = $this->crsid;
    		}
		}

    public function exists() {
		$this->database->query('SELECT * FROM '. $this->pre.'access WHERE crsid=:crsid');
		$this->database->bind(':crsid', $this->crsid);
		$this->database->resultset();
		if ($this->database->rowCount() >= 1) {
			$this->exists = TRUE;
			return True;
		} else {
			$this->exists = FALSE;
			return False;
		}
    }

 	public function commit() {

 		if ($this->exists) {
 			//echo "UPDATE";//debug
 			$this->database->query('UPDATE '. $this->pre.'access SET e_view=:e_view,
 									e_book=:e_book, e_adm=:e_adm, s_adm=:s_adm,
 									p_view=:p_view, p_book=:p_book, p_adm=:p_adm,
 									enabled=:enabled, type=:type, cra=:cra,
 									mcr_member=:mcr_member, associate_member=:associate_member,
 									non_clare_associate_member=:non_clare_associate_member
 									WHERE id=:id AND crsid=:crsid');
		 	$this->database->bind(':id', $this->id);
 		} else {
 			//echo "INSERT";//debug
 			$this->database->query('INSERT INTO '. $this->pre.'access (crsid, e_view, e_book, e_adm, s_adm,
 									p_view, p_book, p_adm, enabled, type, cra,
 									mcr_member, associate_member, non_clare_associate_member)
 									VALUES (:crsid,:e_view,:e_book,:e_adm,:s_adm,:p_view,
 									:p_book,:p_adm,:enabled,:type,:cra,:mcr_member,
 									:associate_member, :non_clare_associate_member)');

 		}
 		$this->database->bind(':crsid', $this->crsid);
 		$this->database->bind(':e_view', $this->e_view);
 		$this->database->bind(':e_book', $this->e_book);
 		$this->database->bind(':e_adm', $this->e_adm);
 		$this->database->bind(':s_adm', $this->s_adm);
 		$this->database->bind(':p_view', $this->p_view);
 		$this->database->bind(':p_book', $this->p_book);
 		$this->database->bind(':p_adm', $this->p_adm);
 		$this->database->bind(':enabled', $this->enabled);
 		$this->database->bind(':type', $this->type);
 		$this->database->bind(':cra', $this->cra);
 		$this->database->bind(':mcr_member', $this->mcr_member);
 		$this->database->bind(':associate_member', $this->associate_member);
 		$this->database->bind(':non_clare_associate_member', $this->non_clare_associate_member);
		$this->database->execute();

 	}

 	public function deleteUser()
 		{
 			//IF exist
 			if ($this->exists) {
 				$this->database->query('DELETE FROM '. $this->pre.'access where id=:id AND crsid=:crsid');
 				$this->database->bind(':id', $this->id);
 				$this->database->bind(':crsid', $this->crsid);
				$this->database->execute();
 				}
 		}

	public function setDefaults() {
 		$this->e_view = FALSE;
 		$this->e_book = FALSE;
 		$this->e_adm = FALSE;
 		$this->s_adm = FALSE;
 		$this->p_view = TRUE;
 		$this->p_book = TRUE;
 		$this->p_adm = FALSE;
 		$this->enabled = TRUE;
 		$this->type = TRUE;
 		$this->cra = FALSE;
 		$this->mcr_member = TRUE;
 		$this->associate_member = FALSE;
 		$this->non_clare_associate_member = FALSE;
 	}

}
?>