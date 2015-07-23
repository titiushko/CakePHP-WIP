<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?= $this->Html->link(__('<i class="fa fa-globe"></i> RESTAURANTE'), array('controller' => 'pages', 'action' => 'display', 'home'), array('class' => 'navbar-brand', 'escape' => FALSE)); ?>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<!--<li class="<?= @$opcion_menu['inicio']; ?>"><?= $this->Html->link(__('<i class="fa fa-home"></i> Inicio'), array('controller' => 'pages', 'action' => 'display', 'home'), array('escape' => FALSE)); ?></li>-->
				<li class="dropdown <?= @$opcion_menu['usuarios']; ?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Usuarios <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><?= $this->Html->link(__('<i class="fa fa-list-alt"></i> Lista Usuarios'), array('controller' => 'usuarios', 'action' => 'index'), array('escape' => FALSE)); ?></li>
						<li><?= $this->Html->link(__('<i class="fa fa-plus-square"></i> Nueva Usuario'), array('controller' => 'usuarios', 'action' => 'nuevo'), array('escape' => FALSE)); ?></li>
					</ul>
				</li>
				<li class="dropdown <?= @$opcion_menu['empleados']; ?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-male"></i> Empleados <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><?= $this->Html->link(__('<i class="fa fa-list-alt"></i> Lista Empleados'), array('controller' => 'empleados', 'action' => 'index'), array('escape' => FALSE)); ?></li>
						<li><?= $this->Html->link(__('<i class="fa fa-plus-square"></i> Nuevo Empleado'), array('controller' => 'empleados', 'action' => 'nuevo'), array('escape' => FALSE)); ?></li>
					</ul>
				</li>
				<li class="dropdown <?= @$opcion_menu['mesas']; ?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-coffee"></i> Mesas <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><?= $this->Html->link(__('<i class="fa fa-list-alt"></i> Lista Mesas'), array('controller' => 'mesas', 'action' => 'index'), array('escape' => FALSE)); ?></li>
						<li><?= $this->Html->link(__('<i class="fa fa-plus-square"></i> Nueva Mesa'), array('controller' => 'mesas', 'action' => 'nuevo'), array('escape' => FALSE)); ?></li>
					</ul>
				</li>
				<li class="dropdown <?= @$opcion_menu['platillos']; ?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cutlery"></i> Platillos <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><?= $this->Html->link(__('<i class="fa fa-list-alt"></i> Lista Platillos'), array('controller' => 'platillos', 'action' => 'index'), array('escape' => FALSE)); ?></li>
						<li><?= $this->Html->link(__('<i class="fa fa-plus-square"></i> Nuevo Platillo'), array('controller' => 'platillos', 'action' => 'nuevo'), array('escape' => FALSE)); ?></li>
						<li><?= $this->Html->link(__('<i class="fa fa-search"></i> Buscar Platillo'), array('controller' => 'platillos', 'action' => 'buscar'), array('escape' => FALSE)); ?></li>
						<li class="divider"></li>
						<li class="dropdown-header"><i class="fa fa-random"></i> Categorías</li>
						<li><?= $this->Html->link(__('<i class="fa fa-list-alt"></i> Lista Categorías'), array('controller' => 'categoria_platillos', 'action' => 'index'), array('escape' => FALSE)); ?></li>
						<li><?= $this->Html->link(__('<i class="fa fa-plus-square"></i> Nueva Categoría'), array('controller' => 'categoria_platillos', 'action' => 'nuevo'), array('escape' => FALSE)); ?></li>
					</ul>
				</li>
				<li class="dropdown <?= @$opcion_menu['ordenes']; ?>">
					<?= $this->Html->link(__('<i class="fa fa-archive"></i> Ordenes'), array('controller' => 'ordenes', 'action' => 'index'), array('escape' => FALSE)); ?>
				</li>
			</ul>
			<?= $this->Form->create('Platillo', array('class' => 'navbar-form navbar-left', 'role' => 'search', 'url' => array('controller' => 'platillos', 'action' => 'buscar'))); ?>
				<div class="input-group">
					<?= $this->Form->input('busqueda', array('label' => FALSE, 'div' => FALSE, 'id' => 'buscar-platillo', 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Buscar Platillo...', 'size' => 19)); ?>
					<span class="input-group-btn">
						<?= $this->Form->button(__('<i class="fa fa-search"></i> Buscar'), array('div' => FALSE, 'class' => 'btn btn-primary', 'escape' => FALSE)); ?>
					</span>
				</div>
			<?= $this->Form->end(); ?>
			<div class="nav navbar-nav navbar-right">
				<?= $this->Html->link(__('<i class="fa fa-shopping-cart"></i> Pedidos'), array('controller' => 'pedidos', 'action' => 'index'), array('class' => 'btn btn-success navbar-btn', 'escape' => FALSE)); ?>
			</div>
		</div>
	</div>
</div>
