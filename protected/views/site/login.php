
<div class="content">


	<form class="login-form" method="post">
		<h3 class="form-title font-green">Sign In</h3>
                			<?php if (isset ( $_SESSION ['FAIL_MESSAGE'] )) {?>
				<div class="alert alert-danger">
			<button class="close" data-close="alert"></button>
			<span><?php echo $_SESSION ['FAIL_MESSAGE'];?></span>
		</div>
				<?php unset ( $_SESSION ['FAIL_MESSAGE'] );} else {?>
				<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span> Enter any username and password. </span>
		</div>
			<?php }?>
			
                <div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<input class="form-control form-control-solid placeholder-no-fix"
				type="text" autocomplete="off" placeholder="Username"
				name="UsersLogin[username]" />
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<input class="form-control form-control-solid placeholder-no-fix"
				type="password" autocomplete="off" placeholder="Password"
				name="UsersLogin[password]" />
		</div>
		<div class="form-actions">
			<button type="submit" class="btn green uppercase">Login</button>
			<!-- 			<label class="rememberme check mt-checkbox mt-checkbox-outline"> <input -->
			<!-- 				type="checkbox" name="remember" value="1" />Remember <span></span> -->
			<!-- 			</label>  -->
			
<?php echo CHtml::link('ลืมรหัสผ่าน',array('Site/ForgotPassword'),array('class'=>'forget-password'));?>

			
			<a href="javascript:;" id="forget-password" class="forget-password">

			</a>
		</div>

		<div class="create-account">
			<p>
			<i class="fa fa-bar-chart"></i>
<?php echo CHtml::link('สถิติความปลอดภัย',array('Site/'),array('class'=>'uppercase'));?>
			
<!-- 				<a href="javascript:;" id="register-btn" class="uppercase">ลงทะเบียนใช้งาน</a> -->
			</p>
		</div>




	</form>


</div>
