<?php
/**
 * @class User
 * @abstract The User class, controls access, user permissions and stores
 * the user's crsid
 * @description Not much more to say than the abstract really
 */

require_once('database.class.php');


class punt {
 	/**
     * @class User
     * @abstract The User class, controls access, user permissions and stores
     * the user's crsid
     * @description Not much more to say than the abstract really
     */

    private $pre    = PREFIXNAME;

    # User associated variables
    private $id;
    private $bookingid;
    private $name;
    private $active;
    private $available_to;
    private $available_from;

    private $booked;
    private $bookedDay;
    private $crsid;
    private $bookername;
    private $mobile = NA;
    private $from;
    private $to;

	private $database;
	private $date;

	public function __construct($id)
		{
			$this->id = $id;
			$this->database = new Database();
			$date = new DateTime();

			if ($this->exists()) {
				$this->getSQLpuntsData($date->format('Y-m-d H:i:s'));
				$this->bookednow($date->format('Y-m-d H:i:s'));
			}
		}
	public function __destruct()
		{
			unset($this->database);
		}
	public function __toString()
		{
			return $this->getValue('name');
		}

	public function getValue($val)
		{
        	return $this->$val;
    	}

    public function setValue($val, $value)
    	{
        	$this->$val = $value;
    	}

    public function getSQLpuntsData($date)
       	{
		$this->database->query('SELECT name,available_to FROM '.$this->pre.'mcrpunts_punts WHERE id=:id');
		$this->database->bind(':id', $this->id);
		$rows = $this->database->single();
    	foreach($rows as $key => $value) {
        	$this->$key = $value;
    		}

    	$this->database->query('SELECT * FROM '.$this->pre.'mcrpunts_punts WHERE id=:id
    							AND :date BETWEEN available_from AND DATE_SUB(available_to,INTERVAL 1 HOUR)');
    	$this->database->bind(':id', $this->id);
    	$this->database->bind(':date', $date);

		$this->database->resultset();
		if ($this->database->rowCount() >= 1) {
			$this->setValue('active',TRUE);
			return True;
			} else {
			$this->setValue('active',FALSE);
			return False;
			}
		}

    public function exists()
    	{
		$this->database->query('SELECT * FROM '.$this->pre.'mcrpunts_punts WHERE id=:id');
		$this->database->bind(':id', $this->id);
		$this->database->resultset();
		if ($this->database->rowCount() >= 1) {
			$this->exists = TRUE;
			return True;
		} else {
			$this->exists = FALSE;
			return False;
		}
    }

    public function bookednow($date)
    	{

    		// check bookings already started or starting within the next hour that have not already finished
    		$this->database->query('SELECT * FROM '.$this->pre.'mcrpunts_bookings WHERE puntid=:id
    								AND :date BETWEEN DATE_SUB(time_from,INTERVAL 1 HOUR) AND time_to');
    		$this->database->bind(':id', $this->id);
    		$this->database->bind(':date', $date);

			$this->database->resultset();
			if ($this->database->rowCount() >= 1) {
					$this->setValue('booked',TRUE);
					return True;
				} else {
					$this->setValue('booked',FALSE);
					return False;
				}
    	}
     public function bookedBetween($from,$to)
    	{
    		if ($from > $to) {
    			echo "Something went Wrong did you get the times back to front<br>";
    			return TRUE;
    		}

    		// check bookings already started or starting within the next hour that have not already finished
    		$this->database->query('SELECT id,booker FROM test_mcrpunts_bookings WHERE puntid=:id AND (
    								(time_from BETWEEN :from AND DATE_SUB(:to,INTERVAL 1 SECOND))
									OR
									(time_to BETWEEN DATE_ADD(:from,INTERVAL 1 SECOND) AND :to)
									OR
									(:from BETWEEN time_from AND DATE_SUB(time_to,INTERVAL 1 SECOND))
									OR
									(:to BETWEEN DATE_ADD(time_from,INTERVAL 1 SECOND) AND time_to)
									)');
    		$this->database->bind(':id', $this->id);
    		$this->database->bind(':from', $from);
    		$this->database->bind(':to', $to);
			//$this->database->debugDumpParams();

			$rows = $this->database->resultset();
			if ($this->database->rowCount() >= 1) {
					$this->setValue('booked',TRUE);
					return $rows;
				} else {
					$this->setValue('booked',False);
					return False;
				}
    	}

    public function bookedDay($date)
    	{

    		// check bookings already started or starting within the next hour that have not already finished
    		$this->database->query('SELECT * FROM '.$this->pre.'mcrpunts_bookings WHERE puntid=:id
    								AND (DATE(time_from)=:date OR DATE(time_to)=:date)');
    		$this->database->bind(':id', $this->id);
    		$this->database->bind(':date', $date);

			$rows = $this->database->resultset();
			if ($this->database->rowCount() >= 1) {
					$this->setValue('bookedDay',TRUE);
					return $rows;
				} else {
					$this->setValue('bookedDay',FALSE);
					return False;
				}
    	}

    public function BookPunt()
    	{
    		// REQUIRE CRSID, NAME, TIME_FROM, TIME_TO
    		if (isset($this->crsid,$this->bookername,$this->to,$this->from,$this->mobile))
    		{
    			//Is punt already booked between these times
    			$rows = $this->bookedBetween($this->from,$this->to);
    			if ($this->booked) {
    			    //Is user modifying an existing booking
    				echo "Punt already booked at this time<br>";
    				$countuserbookings=0;
    				foreach($rows as $myarray) {
    					if ($myarray['booker'] == $this->crsid)
    						{
    							echo "Modifying existing booking<br>";
    							$countuserbookings++;
    							if ($countuserbookings >1 ){//delete
    								$this->deletebooking($myarray['id']);
    							} else {
    								$this->bookingid = $myarray['id'];
    								$this->database->query('UPDATE '. $this->pre.'mcrpunts_bookings
    														SET puntid=:id, booker=:crsid,
    														name=:bookerName, mobile=:mobile,
    														time_from=:from, time_to=:to
 															WHERE id=:bookingid');
 									$this->database->bind(':bookingid', $this->bookingid);
 									$this->database->bind(':id', $this->id);
 									$this->database->bind(':crsid', $this->crsid);
 									$this->database->bind(':bookerName', $this->bookername);
 									$this->database->bind(':mobile', $this->mobile);
 									$this->database->bind(':from', $this->from);
 									$this->database->bind(':to', $this->to);
 									$this->database->execute();
 									mail($this->crsid,'Punt Booking Confirmation',
				     					 "Congratulations. You have successfully booked " . $this->name . " between ". $this->from . " and " . $this->to);

 								}
    						} else {
								echo "Can't book This Slot";
								return False;
							}
							//does user have multiple bookings?
						}
    			} else {
    			//If not book punt
    			$this->database->query('INSERT INTO '. $this->pre.'mcrpunts_bookings
    									(puntid, booker, name, mobile, time_from, time_to)
 										VALUES (:id,:crsid,:bookerName,:mobile,:from, :to)');
 				$this->database->bind(':id', $this->id);
 				$this->database->bind(':crsid', $this->crsid);
 				$this->database->bind(':bookerName', $this->bookername);
 				$this->database->bind(':mobile', $this->mobile);
 				$this->database->bind(':from', $this->from);
 				$this->database->bind(':to', $this->to);
 				$this->database->execute();
 				mail($this->crsid,'Punt Booking Confirmation',
				     "Congratulations. You have successfully booked " . $this->name . " between ". $this->from . " and " . $this->to);
 				}
 			} else {
 			 	echo "Something went wrong, Data missing<br>";
 			 	return False;
 			}
			return True;
    	}
    public function userBookings()
    	{
    		$this->database->query('SELECT * FROM '.$this->pre.'mcrpunts_bookings WHERE puntid=:id
    								AND booker=:crsid AND NOW() < time_to ORDER BY time_from');
    		$this->database->bind(':id', $this->id);
    		$this->database->bind(':crsid',$this->crsid);

			$rows = $this->database->resultset();
			if ($this->database->rowCount() >= 1) {
					return $rows;
				} else {
					return False;
				}
    	}
    public function deletebooking($bookingid)
    	{
    		if ($this->exists) {
 				$this->database->query('DELETE FROM '. $this->pre.'mcrpunts_bookings where id=:id AND booker=:crsid');
 				$this->database->bind(':id', $bookingid);
 				$this->database->bind(':crsid', $this->crsid);
				$this->database->execute();
 			}
    	}
    public function commit()
    	{
    	if ((!isset($this->available_to)) && (!isset($this->available_from))){echo "dates not set";return FALSE;}
    	if ($this->exists) {
 			//echo "UPDATE";//debug
 			$this->database->query('UPDATE '. $this->pre.'mcrpunts_punts SET available_to=:available_to,
 									available_from=:available_from WHERE id=:id');
		 	$this->database->bind(':id', $this->id);
		 	$this->database->bind(':available_to', $this->available_to);
		 	$this->database->bind(':available_from', $this->available_from);
			$this->database->execute();
 			}
    	}
}
?>
