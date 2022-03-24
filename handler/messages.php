<?php
include('../config.php');
$indice_inicial=1;
	switch ($_REQUEST['action']) {
			case 'sendMessage':
				session_start();

				$query = $db->prepare("INSERT INTO messages SET id=?, user=?, message=?, date=?");
				$run=$query->execute([$indice_inicial,$_SESSION['user'],$_REQUEST['message'],$_SESSION['fecha'] ]);
				if ($run) {
					
					echo 1;
					exit;
				} 
				
			break;
		case "getMessage":
				$query = $db->prepare("SELECT * FROM messages");
				$run=$query->execute();
				
				$res = $query->fetchAll(PDO::FETCH_OBJ);

				$chat='';

				foreach ($res as $message) {
					$chat .= '<div class="single-message">
					<strong>'.$message->user.': </strong>'. $message->message. '<span>'.date('h:i',strtotime($message->date)) .'</span> </div>';
				}

				echo $chat;
		break;		
	}
?>