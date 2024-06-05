<div class="doc-page">
	<div class="main">
		<div class="menu">
			<a class="link" href="#"> 
				<div class="img">
					<img class="img" src="/img/logo.png">
				</div>
			</a>
			

			<a class="link active" href="/log"> 
				<span>Інформація</span>
			</a>
			<a class="link exit" href="/welcome/exit"> 
				<span>Вихід</span>
			</a>
		</div>
		
		<div class="content">
			<div class="manage">
				<div class="left">

				</div>
				
				<div class="right">

					
			
					<div>
						<div class="name"><?=$_SESSION['user']['name']?></div>
					</div>
				
				</div>
			</div>
			<div class="items">
				<div class="item <?php if ( $_SESSION['user']['user_level'] > 2 ){ echo 'fix';} ?>">
					<p class="select"></p>
					<p class="name">Назва</p>
					<p class="name">Зауваження</p>
					<p class="name">Опис</p>
					<p class="load"></p>
				</div>
				
				<?php if (!empty($docs)): ?>
					<div class="data-list" >
						<?php foreach ($docs as $doc): ?>	
							<div class="item <?php if($_SESSION['user']['user_level'] > 2 ){echo 'fix';} ?>" 
								data-status="<?=$doc->status;?>" 
								data-user="<?=$doc->user_id;?>" 
								data-name="<?=$doc->name;?>" 
								data-des="<?=$doc->description;?>" 
								data-words="<?=$doc->keywords;?>" 
								data-doclvl="<?=$doc->doc_lvl;?>" 
								data-id="<?=$doc->id;?>"
							>
								<p class="select"><img src="/img/i13.png"></p>
						
								<p class="name"><?=$doc->name;?></p>
								<p class="name"><?=$doc->keywords;?></p>
								<p class="name"><?=$doc->description;?></p>


								<p class="load">
									<a href="/<?=$doc->url;?>" target="_blank"><img src="/img/i20.png"></a>
								</p>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
		
			</div>
			
			<?php if ( !empty($page_quantity) ): ?>
				<?php $page++;?>
				
				<div class="pages">
					<?php if ($page !== 1): ?>
						<a class="prev" href="/doc/view?page=<?=$page - 1;?>">
							<img src="/img/left.png">
						</a>
					<?php else: ?>
						<a class="prev" href="#">
							<img src="/img/left.png">
						</a>
					<?php endif; ?>
					
					<p class="curr"><?=$page;?></p>
					
					<?php if ($page < $page_quantity): ?>
						<a class="next" href="/doc/view?page=<?=$page + 1;?>">
							<img src="/img/right.png">
						</a>
					<?php else: ?>
						<a class="next" href="#">
							<img src="/img/right.png">
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			
		</div>
	</div>
	
	
	<div class="pop-up">
		<div class="center">
			<div class="top">
				<p class="name">Документ</p>
				<div class="close">
					<img src="/img/i15.png">
				</div>
			</div>
			
			<form class="data" method="POST" action="/doc/file" enctype="multipart/form-data">
				<input class="inp-id" type="text" name="id" hidden>
				<input class="inp-proj-id" type="text" name="proj_id" hidden value="<?=(int)$_GET['id']?>">
				
				
				<p class="label">Назва</p>
				<input class="full inp-name" type="text" name="name" required>
				
				<p class="label">Опис</p>
				<textarea class="full moretext inp-about" name="about"></textarea>
				
				<p class="label">Зауваження</p>
				<input class="full inp-words" type="text" name="words" required>
				

				<input type="hidden" name="MAX_FILE_SIZE" value="51200000" />
				<input class="load inp-load" name="load" type="file" required>
				
				
				<input class="btn" type="submit" value="Зберегти">
			</form>
		</div>
	</div>
	
	
	<div class="alert">
		<div class="center">
			<div class="top">
				<p class="name">Увага!</p>
				<div class="close">
					<img src="/img/i15.png">
				</div>
			</div>
			
			<div class="text">
				<p>Спроба надати доступ користувачеві нижчого рівня до <p>
				<p>документу з вищем рівнем доступу<p>
				<p>Підтвердіть дію<p>
			</div>
			
			<span class="like-btn"> Підтвердити</span>
		</div>
	</div>
	
	<div class="ok-date">
		<div class="center">
			<div class="top">
				<p class="name">Документ "<span>назва</span>"</p>
				<div class="close">
					<img src="/img/i15.png">
				</div>
			</div>
			<div class="bottom">
				<form class="data">
					<input class="full" type="date" >
				</form>
				
				<span class="like-btn"> Підтвердити</span>
			</div>
		</div>
	</div>
</div>











