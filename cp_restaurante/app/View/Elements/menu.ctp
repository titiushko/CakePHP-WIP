	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?= $this->Html->link(__('<i class="fa fa-globe"></i> RESTAURANTE'), array('controller' => 'pages', 'action' => 'display', 'home'), array('class' => 'navbar-brand', 'escape' => false)); ?>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="<?= @$opcion_menu['inicio']; ?>"><?= $this->Html->link(__('<i class="fa fa-home"></i> Inicio'), array('controller' => 'pages', 'action' => 'display', 'home'), array('escape' => false)); ?></li>
					<li class="dropdown <?= @$opcion_menu['meseros']; ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Meseros <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><?= $this->Html->link(__('<i class="fa fa-list-alt"></i> Lista Meseros'), array('controller' => 'meseros', 'action' => 'index'), array('escape' => false)); ?></li>
							<li class="divider"></li>
							<li><?= $this->Html->link(__('<i class="fa fa-plus-square"></i> Nuevo Mesero'), array('controller' => 'meseros', 'action' => 'nuevo'), array('escape' => false)); ?></li>
						</ul>
					</li>
					<li class="dropdown <?= @$opcion_menu['mesas']; ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-coffee"></i> Mesas <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><?= $this->Html->link(__('<i class="fa fa-list-alt"></i> Lista Mesas'), array('controller' => 'mesas', 'action' => 'index'), array('escape' => false)); ?></li>
							<li class="divider"></li>
							<li><?= $this->Html->link(__('<i class="fa fa-plus-square"></i> Nueva Mesa'), array('controller' => 'mesas', 'action' => 'nuevo'), array('escape' => false)); ?></li>
						</ul>
					</li>
					<li class="dropdown <?= @$opcion_menu['cocineros']; ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-male"></i> Cocineros <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><?= $this->Html->link(__('<i class="fa fa-list-alt"></i> Lista Cocineros'), array('controller' => 'cocineros', 'action' => 'index'), array('escape' => false)); ?></li>
							<li class="divider"></li>
							<li><?= $this->Html->link(__('<i class="fa fa-plus-square"></i> Nuevo Cocinero'), array('controller' => 'cocineros', 'action' => 'nuevo'), array('escape' => false)); ?></li>
						</ul>
					</li>
					<li class="dropdown <?= @$opcion_menu['platillos']; ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cutlery"></i> Platillos <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><?= $this->Html->link(__('<i class="fa fa-list-alt"></i> Lista Platillos'), array('controller' => 'platillos', 'action' => 'index'), array('escape' => false)); ?></li>
							<li class="divider"></li>
							<li><?= $this->Html->link(__('<i class="fa fa-plus-square"></i> Nueva Platillo'), array('controller' => 'platillos', 'action' => 'nuevo'), array('escape' => false)); ?></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>