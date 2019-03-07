<?php
require_once(__DIR__.'/../auth/fn.php');
require_once(__DIR__.'/../auth/go_connect.php');
$ready_modules = getPortalMods($mysqli);
?>
	
	<div class="navbar-default sidebar" role="navigation">
	    <div class="sidebar-nav navbar-collapse">
	        <ul class="nav" id="side-menu">
		        <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <p><strong>peachIO is a nonprofit tech-social startup lab focused on creating and facilitating projects, products, and multi-media that work toward more personal approaches to business and increase visibility for marginalized groups</strong></p>
                    </div>
                </li>
		        <li>
	                <a href="https://go.peachio.co/page/dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
	            </li>
	            <!-- <li>
	                <a href="https://go.peachio.co/page/directory.php"><i class="fa fa-book fa-fw"></i> Directory</a>
	            </li> -->
	            
				<!-- These are modules based on the User's assigned permissions -->
				<?php foreach($_SESSION['user']['pitsportalmodules'] as $user_module){
					foreach($ready_modules as $available_module){
						if($user_module == $available_module['modid']){
							if($available_module['haschildren'] == 0 && $available_module['parent'] == 'top'){ ?>
								<li>
					                <a href="https://go.peachio.co<?php print $available_module['url']; ?>"><i class="fa <?php print $available_module['icon']; ?> fa-fw"></i> <?php print $available_module['friendly']; ?></a>
					            </li>
							<?php }
							if($available_module['haschildren'] == 1 && $available_module['parent'] == 'top'){ ?>
								<li>
								<a href="#m"><i class="fa <?php print $available_module['icon']; ?> fa-fw"></i> <?php print $available_module['friendly']; ?><span class="fa arrow"></span></a>
									<ul class="nav nav-second-level collapse" aria-expanded="false">
							<?php foreach($ready_modules as $available_sub){
								if($available_sub['parent'] == $available_module['portal_access_name']){?>
									<li><a href="https://go.peachio.co/page/<?php print $available_sub['url']; ?>"><?php print $available_sub['friendly']; ?></a></li>
								<?php }
								} ?>
								</ul></li>
							<?php }
						}
					}
				} ?>
				
				<!-- These are modules based on if the user is a Manager/Director -->
	            <?php if($_SESSION['user']['associate']['managerdirector'] == 1){ ?>
					<li><a href="#m"><i class="fa fa-sliders fa-fw"></i> Management<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level collapse" aria-expanded="false">
							<li><a href="https://go.peachio.co/page/management/dashboard.php">Dashboard</a></li>
							<!-- <li><a href="https://go.peachio.co/page/management/associates.php">Associates</a></li> -->
							<!-- <li><a href="https://go.peachio.co/page/management/users.php">Users</a></li> -->
						</ul></li>
				<?php } ?>
	        </ul>
	    </div>
	</div>
</nav>