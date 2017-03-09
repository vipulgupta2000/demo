<html>
<head>
<title>Service Desk Management</title>
<link rel="stylesheet" type="text/css" href="css/templateblue.css" />
	<link href="css/bootstrap.min.css" rel="stylesheet"/>
	<link href="css/style.css" rel="stylesheet"/>
</head>

<body>
<center>
    <div class="container-fluid">
        	<div id="top">
	<div id="top_left">
	<img id="img" src="images/logo.png" alt="Input Zero" />
	</div>
	<div id="top_middle">
	<font face="times new roman">Welcome To Service Desk</font>
	</div>
	</div>
        	<div class="row">
		<div class="col-md-12">
		<br/><br/><br/><br/>
                </div>
	</div>
	<div class="row" >
		<div class="col-md-4">
		</div>
		<div id="121"  style="background-image: url(images/bg.jpg)" class="col-md-4">
			<form role="form" method="POST" action="check_login.php">
				<div class="form-group">
					 
					<label for="myusername">
						UserName
					</label>
                                    <input class="form-control" name="myusername" type="text" id="myusername" size="30">
				
				</div>
				<div class="form-group">
					 
					<label for="mypassword">
						Password
					</label>
	
                                        <input class="form-control" name="mypassword" type="password" id="mypassword" size="30">
							 
					
                                </div>

				<button type="submit" class="btn btn-default">
					Submit
				</button>
                            <input id='btn' class="btn btn-default" type='submit' name='forgot_pass' value='Forgot/Reset Password' onclick="location.href='forgot_pass/index.html'"/>
			</form>
		</div>
		<div class="col-md-4">
		</div>
	</div>
</div>

	<br/><br/><br/>
	</div>

	<div id="footer">
	&copy Input Zero Technologies Pvt. Ltd.
	</div>

</div>
</center>
</body>
</html>
