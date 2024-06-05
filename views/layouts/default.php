<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Heal</title>
		
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Alegreya&display=swap" rel="stylesheet">
		
		<link href="/public/css/main.css" rel="stylesheet">
    </head>

    <body>
		<?php if (isset($_SESSION['error'])): ?>
			<div class="user-msg"><p><?=$_SESSION['error'];?></p></div>
		<?php endif; ?>
		<?php unset($_SESSION['error']); ?>
		
		<div class="wrap">
			<?=$content;?>
		</div>
		
		<script src="/public/js/jquery.js"></script>
		<script src="/public/js/js.js"></script>
		
		<script>
			let user_level_id = <?=$_SESSION['user']['user_level']?>;
			let user_curr_id = <?=$_SESSION['user']['id']?>;
		</script>
    </body>
</html>













