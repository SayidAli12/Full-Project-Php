<?php include ('header.php') ?>
	<div class="card mx-auto" style="width: 30%; box-shadow:0 0 50px 0 lightgrey;">
		<div class="card-body ">
		<br>	<center>
		<h4 class="card-title">User form</h4>
		</center>
		<form method="POST" action="process/process_user.php">
<label>User Name</label>
<input type="text" name="username" required  class="form-control" autocomplete="off"  required>
<label>Password</label>
<input type="password" name="password" required  class="form-control" autocomplete="off" required > 
<label>Full Name</label>
<input type="text" name="full_name" required  class="form-control" autocomplete="off" required> 
<label>Role</label>
 <select name="role" class="form-control" required>
 	<option value="">Select</option>
 	<option value="Admin">Administrator</option>
 	<option value="User">Standard User</option>
 </select><br>
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                      <label class="form-check-label" for="flexCheckDefault">
                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                      </label>
                      <br><br>
<button style="width:370px;" class="btn  btn-primary  rounded-pull" name="save" type="submit"> <i class="fa-solid fa-floppy-disk"></i> SignUp</button>
<br><br><td><a  href="view_user.php"> 
                    Already have an account?
                    <a href="login.php" >Sign in</a>
                  </a></td></div>
                  
                </div>
</form>

		</div>
	</div>

<?php include('footer.php')?>
