<?php

if (isset($_POST['usersinfo'])){
	$usersinfo = $_POST['usersinfo'];
	$userarray = explode(',',$usersinfo['users']);
    foreach ($userarray as $usercrsid) {
        $target = new User($usercrsid);
        if (!$target->exists()) {$target->setDefaults();}
        if (isset($usersinfo['p_view'])){
        	switch ($userinfo['p_view']) {
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
        	switch ($userinfo['p_book']) {
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
        	switch ($userinfo['p_adm']) {
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
        	switch ($userinfo['e_view']) {
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
        	switch ($userinfo['e_book']) {
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
        	switch ($userinfo['e_adm']) {
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
        	switch ($userinfo['type']) {
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
        	switch ($userinfo['enabled']) {
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
        	switch ($userinfo['s_adm']) {
        		case "0":
        			break;
        		case "1":
        		    $target->setValue('s_adm',FALSE);
        			break;
        		case "1":
        		    $target->setValue('s_adm',TRUE);
        			break;
        	}
        }
        if (isset($usersinfo['membership'])){
        	switch ($userinfo['membership']) {
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
        		case "non_clare_associate_member":
        		    $target->setValue('mcr_member',FALSE);
        			$target->setValue('non_clare_associate_member',TRUE);
        			break;
        	}
        }
        $target->commit();
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