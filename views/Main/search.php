
<div class="user-page">
	<div class="main">
		<div class="menu">
			<a class="link" href="#"> 
				<div class="img">
					<img class="img" src="/img/logo.png">
				</div>
			</a>
			
			<a class="link project" href="/project"> 
				<span>Запис</span>
			</a>
			<a class="link active user" href="/"> 
				<span>Користувачі</span>
			</a>
			<a class="link log" href="/log"> 
				<span>Журнал</span>
			</a>
			<a class="link exit" href="/welcome/exit"> 
				<span>Вихід</span>
			</a>

		</div>
		<div class="content">
			<div class="manage">
				<div class="left">
					<div class="item edit">
						Редагувати
					</div>
					<div class="item del">
						Видалити
					</div>
					<form class="form" method="POST" action="/main/search">
						<input class="search" type="text" name="search" required placeholder="Пошук" minlength="3">
						
						<input class="btn" type="submit" value="">
					</form>
				</div>
				
				<div class="right">
					<div class="create-show">
						<div class="create">Додати користувача</div>
					</div>
					<div>
						<div class="name"><?=$_SESSION['user']['name']?></div>
					</div>
				</div>
			</div>
			<div class="items">
				<div class="item">
					<p class="select"></p>
					<p class="name">П.І.Б.</p>
					<p class="login">Логін</p>
					<p class="email">E-mail</p>
					<p class="lvl">Лікування</p>
					<p class="permit">Роль</p>
				</div>
				
				<?php if (!empty($users)): ?>
					<div class="data-list" >
						<?php foreach ($users as $user): ?>	
							<div class="item" 
								data-lvl="<?=$user->user_level;?>" 
								data-id="<?=$user->id;?>"
								data-doclvl="<?=$user->doc_lvl;?>"
							>
								<p class="select"><img src="/img/i13.png"></p>
								<p class="name">
									<span class="<?=$user->u_l_img;?>"><?=$user->name;?></span>
								</p>
								<p class="login"><?=$user->login;?></p>
								<p class="email"><?=$user->email;?></p>
								<p class="lvl">
									<?php if($user->doc_lvl == 0){echo '-';}?>
									<?php if($user->doc_lvl == 1){echo 'Стаціонарне';}?>
									<?php if($user->doc_lvl == 2){echo 'Амбулаторне';}?>
									<?php if($user->doc_lvl == 3){echo 'Консультація';}?>
								</p>
								
								<p class="permit
									<?php if($user->user_level == 1){echo 'red';}?>
									<?php if($user->user_level == 3){echo 'blue';}?>
								"><span>
									<?=$user->u_l_name;?>
								</span></p>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
		
			</div>
			
			<?php if ( !empty($page_quantity) ): ?>
				<?php $page++;?>
				
				<div class="pages">
					<?php if ($page !== 1): ?>
						<a class="prev" href="/?page=<?=$page - 1;?>">
							<img src="/img/left.png">
						</a>
					<?php else: ?>
						<a class="prev" href="#">
							<img src="/img/left.png">
						</a>
					<?php endif; ?>
					
					<p class="curr"><?=$page;?></p>
					
					<?php if ($page < $page_quantity): ?>
						<a class="next" href="/?page=<?=$page + 1;?>">
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
				<p class="name">Користувач</p>
				<div class="close">
					<img src="/img/i15.png">
				</div>
			</div>
			
			<form class="data" method="POST" action="/main/user">
				<input class="inp-id" type="text" name="id" hidden>
				
				<p class="label">П.І.Б.</p>
				<input class="full inp-name" type="text" name="name" required>
				
				
				
				<div class="line">
					<div class="item">
						<p class="label">Логін</p>
						<input class="full inp-login" type="text" name="login" required >
					</div>
					<div class="item">
						<p class="label">Email</p>
						<input class="full inp-email" type="text" name="email" required >
					</div>
				</div>
				
				<div class="line">
					<div class="item">
						<p class="label">Новий пароль</p>
						<input class="full" type="password" name="passwordQ" required >
					</div>
					
					<div class="item">
						<p class="label">Підтвердити пароль</p>
						<input class="full" type="password" name="passwordW" required >
					</div>
				</div>
				
				<div class="line">
					<div class="item">
						<p class="label">Роль</p>
						<select class="full inp-access" name="access" required>
							<option value="4">Паціент</option>
							<option value="2">Лікар</option>
						</select>
					</div>
					
					<div class="item">
						<p class="label">Лікування</p>
						<select class="full inp-doc-lvl" name="doc_lvl" required>
							<option value="0"></option>
							<option value="1"> Стаціонарне </option>
							<option value="2"> Амбулаторне </option>
							<option value="3"> Консультація </option>
						</select>
					</div>
				</div>
				
				

				<input class="btn" type="submit" value="Зберегти">
			</form>
		</div>
	</div>
</div>











