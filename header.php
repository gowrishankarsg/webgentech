<div class="row border-bottom">
	<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
			<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
			<form role="search" class="navbar-form-custom" >
				 <div class="form-group">
					<span class="form-control" id="date_time"></span>
					<script type="text/javascript">window.onload = date_time('date_time');</script>
				</div>
			</form>
		</div>
		<ul class="nav navbar-top-links navbar-right">
			<li>
				<span class="m-r-sm text-muted welcome-message">Welcome <?php echo $_SESSION['userName']; ?></span>
			</li>
			<li>
				<a href="logout.php">
					<i class="fa fa-sign-out"></i> Log out
				</a>
			</li>
		</ul>
	</nav>
</div>