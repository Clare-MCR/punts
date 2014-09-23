<?php
if (isset($_POST['vessel'])){
	$vessel = $_POST['vessel'];
	switch ($vessel['puntid']) {
		case 1:
			$punt1->setValue('available_from',$vessel['from']);
			$punt1->setValue('available_to',$vessel['to']);
			$punt1->commit();
			break;
		case 2:
			$punt2->setValue('available_from',$vessel['from']);
			$punt2->setValue('available_to',$vessel['to']);
			$punt2->commit();
			break;
	}
}
if (isset($_POST['cancel'])){
	$cancel=$_POST['cancel'];
	$punt1->setValue('crsid',$cancel['crsid']);
	$punt1->deletebooking($cancel['id']);
}
?>