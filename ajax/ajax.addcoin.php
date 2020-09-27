<?php

	$returnStr = "";

	$userId = 0;
	
	if(isset($_GET['k'])&&isset($_GET['v'])){
		
		$returnStr = "KO";

		$keyCoin = $_GET['k'];
		$valueCoin = $_GET['v'];
		$courseId = 0;

		//Ch
		if(file_exists(__DIR__.'/../../../main/inc/global.inc.php')){

			require_once __DIR__.'/../../../main/inc/global.inc.php';

			if(!api_is_anonymous()){
				$user = api_get_user_info();
				$userId = $user['id'];
			}
			
			if($userId>0&&intval($valueCoin)>0){
				
				$sqlCount  = "SELECT id FROM plugin_learningcoins ";
				$sqlCount .= " WHERE learningcoins_key = '".$keyCoin."' ";
				$sqlCount .= " AND user_id = ".$userId;
				
				$resultCount = Database::query($sqlCount)->rowCount();
				
				if($resultCount==0){
					
					$sqlInsert = 'INSERT INTO plugin_learningcoins (learningcoins_key,value_coin,c_id,user_id)';
					$sqlInsert .= " VALUES ('".$keyCoin."',".intval($valueCoin).",".$courseId.",".$userId.");";
					$resultInsert = Database::query($sqlInsert);
					$returnStr = "OK";
				}

			}

		}else{

			//Mo
			if(file_exists(__DIR__.'/../../../config.php')){
				require(__DIR__.'/../../../config.php');
			}
		}
		
		
	}

	echo $returnStr;