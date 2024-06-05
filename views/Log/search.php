
<div class="log-page">
	<div class="main">
		<div class="menu">
			<a class="link" href="#"> 
				<div class="img">
					<img class="img" src="/img/logo.png">
				</div>
			</a>
			
			<a class="link project" href="/project"> 
				<span>Паціенти</span>
			</a>
			<a class="link user" href="/"> 
				<span>Користувачі</span>
			</a>
			<a class="link active log" href="/log"> 
				<span>Журнал</span>
			</a>
			<a class="link exit" href="/welcome/exit"> 
				<span>Вихід</span>
			</a>
		</div>
		
		<div class="content">
			<div class="manage">
				<div class="left">
					<form class="form" method="POST" action="/log/search">
						<input class="search" type="text" name="search" required placeholder="Пошук" minlength="3">
						
						<input class="btn" type="submit" value="">
						
					</form>
				</div>
				
				<div class="right">
					<div>
						<div class="name"><?=$_SESSION['user']['name']?></div>
					</div>
				</div>
			</div>
			<div class="items">
				<div class="item">
					<p class="name">Лікар</p>
					<p class="date">Дата</p>
					<p class="about">Опис події</p>
				</div>
				
				<?php if (!empty($logs)): ?>
					<div class="data-list" >
						<?php foreach ($logs as $user): ?>	
							<div class="item">
								<p class="name">
									<span class="two"><?=$user->name;?></span>
								</p>
								<p class="date"> <?=date("d-m-Y", strtotime($user->date));?></p>
								<p class="about"><?=$user->about;?></p>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
		
			</div>
			
			<?php if ( !empty($page_quantity) ): ?>
				<?php $page++;?>
				
				<div class="pages">
					<?php if ($page !== 1): ?>
						<a class="prev" href="/log?page=<?=$page - 1;?>">
							<img src="/img/left.png">
						</a>
					<?php else: ?>
						<a class="prev" href="#">
							<img src="/img/left.png">
						</a>
					<?php endif; ?>
					
					<p class="curr"><?=$page;?></p>
					
					<?php if ($page < $page_quantity): ?>
						<a class="next" href="/log?page=<?=$page + 1;?>">
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
	

</div>











