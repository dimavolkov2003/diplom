
<div class="project-page">
	<div class="main">
		<div class="menu">
			<a class="link" href="#"> 
				<div class="img">
					<img class="img" src="/img/logo.png">
				</div>
			</a>
			
			<a class="link active project" href="/project"> 
				<span>Запис</span>
			</a>
			<a class="link user" href="/"> 
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
					<form class="form" method="POST" action="/project/search">
						<input class="search" type="text" name="search" required placeholder="Пошук" minlength="3">
						
						<input class="btn" type="submit" value="">
					</form>
				</div>
				
				<div class="right">
					<div class="create-show">
						<div class="create">Створити</div>
					</div>
					<div>
						<div class="name"><?=$_SESSION['user']['name']?></div>
					</div>
				</div>
			</div>
			<div class="items">
				<div class="item">
					<p class="select"></p>
					<p class="name">Скарги паціента</p>
					<p class="author">Лікар</p>
					<p class="from">Початок</p>
					<p class="to">Виписка</p>
					<p class="status">Статус</p>
					<p class="look"></p>
				</div>
				
				<?php if (!empty($projects)): ?>
					<div class="data-list" >
						<?php foreach ($projects as $project): ?>	
							<div class="item" 
								data-status="<?=$project->status;?>" 
								data-user="<?=$project->user_id;?>" 
								data-name="<?=$project->name;?>" 
								data-des="<?=$project->description;?>" 
								data-id="<?=$project->id;?>"
							>
								<p class="select"><img src="/img/i13.png"></p>
								<p class="name"><?=$project->label;?></p>
								<p class="author"><?=$users[$project->user_id]->name ;?></p>
								<p class="from" data-date="<?=$project->date?>" ><?=date("d-m-Y", strtotime($project->date));?></p>
								<p class="to" data-date="<?=$project->deadline?>" ><?=date("d-m-Y", strtotime($project->deadline));?></p>
								<p class="status">
									<?php if ($project->status == 0): ?>
										В процесі
									<?php else: ?>
										Завершено
									<?php endif; ?>
								</p>
								<p class="look">
									<a href="/doc/view?id=<?=$project->id;?>"><img src="/img/i20.png"></a>
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
						<a class="prev" href="/project/local?page=<?=$page - 1;?>">
							<img src="/img/left.png">
						</a>
					<?php else: ?>
						<a class="prev" href="#">
							<img src="/img/left.png">
						</a>
					<?php endif; ?>
					
					<p class="curr"><?=$page;?></p>
					
					<?php if ($page < $page_quantity): ?>
						<a class="next" href="/project/local?page=<?=$page + 1;?>">
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
				<p class="name">Проект</p>
				<div class="close">
					<img src="/img/i15.png">
				</div>
			</div>
			
			<form class="data" method="POST" action="/project/proj">
				<input class="inp-id" type="text" name="id" hidden>
				
				<div class="line">
					<div class="item">
						<p class="label">Початок лікування</p>
						<input class="full inp-from" type="date" name="from" required>
					</div>
					
					<div class="item">
						<p class="label">Виписка</p>
						<input class="full inp-to" type="date" name="to" required>
					</div>
				</div>
				
				<p class="label">Скарги паціента</p>
				<input class="full inp-label" type="text" name="label" required>
				
				<p class="label">Хвороба</p>
				<input class="full inp-name" type="text" name="name" required>
				
				<p class="label">Опис</p>
				<textarea class="full moretext inp-about" name="about"></textarea>
				
				
				
				
				<p class="label">Лікар</p>
				<select class="full inp-user" name="user" required>
					<option></option>
					<?php if (!empty($users)): ?>
						<?php foreach ($users as $user): ?>	
							<option value="<?=$user->id;?>" data-lvl="<?=$user->user_level;?>" > <?=$user->name;?> </option>
						<?php endforeach; ?>
					<?php endif; ?>
				</select>
				
				<p class="label inp-audit-label">Паціент</p>
				<select class="full inp-audit" name="audit">
					<option></option>
					<?php if (!empty($users)): ?>
						<?php foreach ($users as $user): ?>	
							<option value="<?=$user->id;?>" data-lvl="<?=$user->user_level;?>" > <?=$user->name;?> </option>
						<?php endforeach; ?>
					<?php endif; ?>
				</select>
				
				<div class="line">
					<div class="item">
						<p class="label ">Статус</p>
						<select class="full inp-status" name="status">
							<option value="0" selected>Активний</option>
							<option value="1">Виконаний</option>
						</select>
					</div>
				</div>
				<input class="btn" type="submit" value="Зберегти">
			</form>
		</div>
	</div>
	
	<div class="ok-date">
		<div class="center">
			<div class="top">
				<p class="name">Проект "<span>назва</span>"</p>
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











