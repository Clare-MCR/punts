<?php

if (isset($_POST['usersinfo'])){
	$usersinfo = $_POST['usersinfo'];
	$userarray = explode(',',$usersinfo['users']);
	echo "Adding/Updating users:";
    foreach ($userarray as $usercrsid) {
        $target = new User($usercrsid);
        if (!$target->exists()) {$target->setDefaults();}
        if (isset($usersinfo['p_view'])){
        	switch ($usersinfo['p_view']) {
        		case "0":
        			break;
        		case "1":
        		    $target->setValue('p_view',FALSE);
        			break;
        		case "2":
        		    $target->setValue('p_view',TRUE);
        			break;
        	}
        }
        if (isset($usersinfo['p_book'])){
        	switch ($usersinfo['p_book']) {
        		case "0":
        			break;
        		case "1":
        		    $target->setValue('p_book',FALSE);
        			break;
        		case "2":
        		    $target->setValue('p_book',TRUE);
        			break;
        	}
        }
        if (isset($usersinfo['p_adm'])){
        	switch ($usersinfo['p_adm']) {
        		case "0":
        			break;
        		case "1":
        		    $target->setValue('p_adm',FALSE);
        			break;
        		case "2":
        		    $target->setValue('p_adm',TRUE);
        			break;
        	}
        }
        if (isset($usersinfo['e_view'])){
        	switch ($usersinfo['e_view']) {
        		case "0":
        			break;
        		case "1":
        		    $target->setValue('e_view',FALSE);
        			break;
        		case "2":
        		    $target->setValue('e_view',TRUE);
        			break;
        	}
        }
        if (isset($usersinfo['e_book'])){
        	switch ($usersinfo['e_book']) {
        		case "0":
        			break;
        		case "1":
        		    $target->setValue('e_book',FALSE);
        			break;
        		case "2":
        		    $target->setValue('e_book',TRUE);
        			break;
        	}
        }
        if (isset($usersinfo['e_adm'])){
        	switch ($usersinfo['e_adm']) {
        		case "0":
        			break;
        		case "1":
        		    $target->setValue('e_adm',FALSE);
        			break;
        		case "2":
        		    $target->setValue('e_adm',TRUE);
        			break;
        	}
        }
        if (isset($usersinfo['type'])){
        	switch ($usersinfo['type']) {
        		case "0":
        			break;
        		case "1":
        		    $target->setValue('type',FALSE);
        			break;
        		case "2":
        		    $target->setValue('type',TRUE);
        			break;
        	}
        }
        if (isset($usersinfo['enabled'])){
        	switch ($usersinfo['enabled']) {
        		case "0":
        			break;
        		case "1":
        		    $target->setValue('enabled',FALSE);
        			break;
        		case "2":
        		    $target->setValue('enabled',TRUE);
        			break;
        	}
        }
        if (isset($usersinfo['s_adm'])){
        	switch ($usersinfo['s_adm']) {
        		case "0":
        			break;
        		case "1":
        		    $target->setValue('s_adm',FALSE);
        			break;
        		case "2":
        		    $target->setValue('s_adm',TRUE);
        			break;
        	}
        }
        if (isset($usersinfo['college_bill'])){
        	switch ($usersinfo['s_adm']) {
        		case "0":
        			break;
        		case "1":
        		    $target->setValue('college_bill',FALSE);
        			break;
        		case "2":
        		    $target->setValue('college_bill',TRUE);
        			break;
        	}
        }
        if (isset($usersinfo['membership'])){
        	switch ($usersinfo['membership']) {
        		case "mcr_member":
        			$target->setValue('mcr_member',TRUE);
        			break;
        		case "cra":
        		    $target->setValue('mcr_member',FALSE);
        			$target->setValue('cra',TRUE);
        			break;
        		case "associate_member":
        		    $target->setValue('mcr_member',FALSE);
        			$target->setValue('associate_member',TRUE);
        			break;
        	}
        }
        $target->commit();
        echo $target->getValue('crsid').", ";

		unset($target);
    }

} elseif (isset($_POST['deleteusers'])) {
	$deleteusers = $_POST['deleteusers'];
	$userarray = explode(',',$deleteusers['users']);
    foreach ($userarray as $usercrsid) {
        $target = new User($usercrsid);
        $target->deleteUser();
        unset($target);
        }
}



?>
