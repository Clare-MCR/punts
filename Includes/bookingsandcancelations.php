<?php
if (isset($_POST['booking'])){
	$booking = $_POST['booking'];
	$from = new DateTime($booking['startdate']. " ". $booking['starttime']);
	if (isset($booking['duration'])){
		$to = clone $from;
		$timesplit=preg_split("/:/",$booking['duration']);
		$to->add(new DateInterval("PT".$timesplit[0]."H".$timesplit[1]."M"));
	} else {
		$to = new DateTime($booking['enddate']. " ". $booking['endtime']);
	}
	if ($booking['puntid']==1){
		$punt1->setValue('crsid',$user->getValue('crsid'));
		$punt1->setValue('bookername',$booking['name']);
		$punt1->setValue('mobile',$booking['mobile']);
		$punt1->setValue('from',$from->format('Y-m-d H:i:s'));
		$punt1->setValue('to',$to->format('Y-m-d H:i:s'));
	} else {
		$punt2->setValue('crsid',$user->getValue('crsid'));
		$punt2->setValue('bookername',$booking['name']);
		$punt2->setValue('mobile',$booking['mobile']);
		$punt2->setValue('from',$from->format('Y-m-d H:i:s'));
		$punt2->setValue('to',$to->format('Y-m-d H:i:s'));
	}
	$_SESSION['puntid'] = $booking['puntid'];
	$_SESSION['date'] = $from->format('Y-m-d H:i:s');
}

if (isset($_POST['cancel'])){
	$cancel=$_POST['cancel'];
	$punt1->setValue('crsid',$user->getValue('crsid'));
	$punt1->deletebooking($cancel['id']);
}



?>