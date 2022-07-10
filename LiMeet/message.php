<?php
	session_start();
	$bd = new PDO('mysql:host=sql102.epizy.com;dbname=epiz_31248537_LiMeet', 'epiz_31248537', 'r4IVikgYxfS');
	var_dump($_SESSION);

	if ($_SESSION['id'] == null){
		header('Location: /');
	}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			include_once('../_head/meta.php');
		?>
        <title>Messages | Daewen</title>
        <?php
			include_once('../_head/link.php');
			include_once('../_head/script.php');
		?>
	</head>
	<body>
		<?php
			include_once('../menu.php');
		?>
		<div class="container">		
			<div class="row">
				<div class="col-12 col-md-12 col-xl-12" style="margin: 20px 0">
					<div class="signin__body">
						<h1>Messages</h1>
						<div id="msg" class="messages__body">
							<?php
							if($nombre_message['NbMessage'] > $nombre_total_message){
							?>
							<div class="messages__btn">
								<button id="voir-plus" class="messages__btn__seemore">Voir plus</button>
							</div>
							<div id="voir-plus-message"></div>
							<?php
								}
							
								$var_garder_id = (int) 0;
								
								foreach($info_message as $im){
																		
									if($var_garder_id <> $im['id_from'] && $im['id_from'] == $_SESSION['id']){
										if($var_garder_id > 0){										
											echo '</div>';
										}
										echo '<div class="messages__msg messages__miens">';
									}elseif($var_garder_id <> $im['id_from']){
										if($var_garder_id > 0){
											echo '</div>';
										}
										echo '<div class="messages__msg messages__siens">';
									}
									
									$var_garder_id = $im['id_from'];
									
							?>
							
								<div class="messages__message">
									<?= nl2br($im['message']) ?>
								</div>
							<?php
								}
								
								if(count($info_message) > 0){
									echo '</div>';	
								}
							?>
							<div id="message-recept"></div>						
						</div>
						<div style="margin-top: 10px">
				        	<form method="post">
								<div style="display: flex; flex-direction: row;">
					            <textarea class="autoExpand" rows="1" data-min-rows="1" name="texte" id="message" class="msg" placeholder="Envoyer votre message" style="border: none;overflow: none; resize: none; width: 100%; outline: none; padding: 0 5px; border: 1px solid #eee; border-radius: 6px; max-height: 300px"></textarea>
					            <div style="font-size: 2rem">
						            <button id="envoi" type="submit" style="border: none; color: #3498db; background: transparent; outline: none"><i class="bi bi-send"></i></button>
					            </div>	   
								</div>
					        </form>	
			        	</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			include_once('../_footer/footer.php');
		?>
		<script>
			$(document).ready(function(){
				document.getElementById('msg').scrollTop = document.getElementById('msg').scrollHeight;		
				
				$('#envoi').click(function(e){
					e.preventDefault();
					 
					var guid;
					var message;
					
					guid = <?= json_encode($get_guid, JSON_UNESCAPED_UNICODE); ?>;
					message = encodeURIComponent($('#message').val());
					message = message.trim();
									
					$('#message').val(null);
					
					if(guid != "" && message != ""){
					    $.ajax({
					    	url : '<?= URL ?>_ajax/send_message',
							type : 'POST',
							dataType : "html",
							data: {message: message, guid: guid},
							
							success : function(data){
					        	$("#message-recept").append(data);
								document.getElementById('msg').scrollTop = document.getElementById('msg').scrollHeight;
							},
							
							error : function(e, xhr, s){
								let error = e.responseJSON;
								if(e.status == 403 && typeof error !== 'undefined'){
									alert('Erreur 403');
								}else if(e.status == 404){
									alert('Erreur 404');
								}else if(e.status == 401){
									alert('Erreur 401');
								}else{
									alert('Erreur Ajax');
								}
							}
					    });
					}
				});
				
				var chargement_message_auto = 0;
				
				chargement_message_auto = clearInterval(chargement_message_auto);
				
				chargement_message_auto = setInterval(chargerMessageAuto, 2000);
				
				function chargerMessageAuto(){
					
					var guid = <?= json_encode($get_guid, JSON_UNESCAPED_UNICODE); ?>;
					
					if(guid != ""){
						$.ajax({
							url : '<?= URL ?>_ajax/charger_message',
							method : 'POST',
							dataType : 'html',
							data : {guid: guid},
							
							success : function(data){
								if(data.trim() != ""){
									$('#message-recept').append(data);	
									document.getElementById('msg').scrollTop = document.getElementById('msg').scrollHeight; 
								}
							},
							
							error : function(e, xhr, s){
								let error = e.responseJSON;
								if(e.status == 403 && typeof error !== 'undefined'){
									alert('Erreur 403');
								}else if(e.status == 404){
									alert('Erreur 404');
								}else if(e.status == 401){
									alert('Erreur 401');
								}else{
									alert('Erreur Ajax');
								}
							}
						});
					}
				}
				
				<?php
					if($nombre_message['NbMessage'] > $nombre_total_message){
				?>
				
				var req = 0;
				
				$('#voir-plus').click(function(){
					var guid;
					
					req += <?= $nombre_total_message ?>;
					guid = <?= json_encode($get_guid, JSON_UNESCAPED_UNICODE); ?>;
					
					$.ajax({
						url : '<?= URL ?>_ajax/voir-plus-message',
						method : 'POST',
						dataType : 'html',
						data : {limit: req, guid: guid},
						
						success : function(data){
							$(data).hide().appendTo('#voir-plus-message').fadeIn(2000);	
							document.getElementById('voir-plus-message').removeAttribute('id');
						},
						
						error : function(e, xhr, s){
							let error = e.responseJSON;
							if(e.status == 403 && typeof error !== 'undefined'){
								alert('Erreur 403');
							}else if(e.status == 404){
								alert('Erreur 404');
							}else if(e.status == 401){
								alert('Erreur 401');
							}else{
								alert('Erreur Ajax');
							}
						}
					});					
				});

				<?php
					}
				?>
			});
		</script>
	</body>
</html>