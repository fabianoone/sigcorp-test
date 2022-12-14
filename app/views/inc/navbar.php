<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?php echo URLROOT; ?>">
            <?php echo APPNAME; ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
				<?php if (isset($_SESSION['user_id'])) : ?>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo URLROOT; ?>/dashboard">
							Dashboard</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="javascript:void(0);">Clients</a>
					    <div class="dropdown-menu">
                            <a href="<?php echo URLROOT; ?>/clients" class="dropdown-item">List Clients</a>
                            <a href="<?php echo URLROOT; ?>/clients/create" class="dropdown-item">Add New Client</a>
                        </div>
                    </li>
                    <li class="nav-item">
						<a class="nav-link" href="<?php echo URLROOT; ?>/products">Products</a>
                    </li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo URLROOT; ?>/pages/orders">Orders</a>
					</li>
				<?php endif; ?>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Welcome, <?php echo $_SESSION['user_name']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
                    </li>
                    <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
