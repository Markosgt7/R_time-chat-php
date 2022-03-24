<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title>Chat</title>
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<body>
	<?php
		session_start();
		$_SESSION['user']='Marcos Sanchez';
		$_SESSION['fecha']=date("Y-m-d H:i:s");
	?>
	
	<div id="wrapper">
		<h1>Welcome to markOs chat</h1>
			<div class="chat_wrapper">	
				<div id="chat"></div>
				<form method="POST" id="messageform">	
						<textarea name="message" cols="30" rows="10" class="textarea"></textarea>
				</form>
			</div>
	</div>
	<script type="text/javascript">

		LoadChat();


		function LoadChat() {
			$.post('handler/messages.php?action=getMessage', function(response){
				//var scrollpos = $(#chat).scrollTop();
				//var scrollpos = parseInt(scrollpos) +520;
				//var scrollHeight = $('#chat').prop('scrollHeight');
				$('#chat').html(response);
				//if(scrollpos< scrollHeight){

				//}else{
					$('#chat').scrollTop($('#chat').prop('scrollHeight'));	
				//}


				
			});
		}

		$('.textarea').keyup(function(e){
			//alert(e.which)
			if (e.which == 13){				
				$('form').submit();
			}
		});

		$('form').submit(function(){
			var message= $('.textarea').val();
			$.post('handler/messages.php?action=sendMessage&message='+message, function(response){
				if(response==1){
					LoadChat();
					document.getElementById('messageform').reset();
				}
			});
			return false;
		});
	</script>

</body>
</html>