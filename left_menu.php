<?php
	if(empty($_SESSION['userId']))
	{
		echo '<script type="text/javascript">
                window.location = "index.html"
              </script>';
		die;
	}	
?>

<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav metismenu" id="side-menu">
		
			<li class="nav-header" style="text-align: center;">
				<div class="dropdown profile-element"> 
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<span class="clear"><span class="block m-t-xs"> <strong class="font-bold">WEBGEN</strong></span></span>
					</a>
					<ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile">Profile</a></li>
                                <li><a href="logout">Logout</a></li>
                            </ul>
				</div>
				<div class="logo-element">
					WG
				</div>
			</li>			   			
		</ul>
	</div>
</nav>