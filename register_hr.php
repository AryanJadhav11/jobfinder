





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Register Your Company</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="nunito-font.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="style_owner.css"/>
</head>
<body class="form-v6">
	<div class="page-content"  style="background-color:#fb246a">
		<div class="form-v6-content">
			<div class="form-left">
				<img src="https://img.freepik.com/free-vector/business-leader-consulting-hr-expert_1262-21207.jpg?w=996&t=st=1712147692~exp=1712148292~hmac=ec8d5c00588fdccc2d6d1820c5c0a663c2e8e7c2972a7c244a989c6e17ea1c1e" alt="form" width="500px"height="530px">
			</div>
			<form class="form-detail" action="com_req_modal.php" method="post">
				<h2>Register Your Company</h2>
				<div class="form-row">
					<input type="text" name="full-name" id="full-name" class="input-text" placeholder="Company Name" required>
				</div>
                <div class="form-row">
					<input type="text" name="hrname" id="hrname" class="input-text" placeholder="HR Name" required>
				</div>
				<div class="form-row">
					<input type="text" name="your-email" id="your-email" class="input-text" placeholder="Email Address of company" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
				</div>
				<div class="form-row">
					<input type="text" name="hremail" id="hremail" class="input-text" placeholder="Email Address of HR" required>
				</div>
				<div class="form-row">
					<input type="text" name="pos" id="pos" class="input-text" placeholder="Position of HR" required>
				</div>
                <div class="form-row">	
					<input type="number" name="num"  id="num"  placeholder="Contact no. of HR"  required>
				  </div>
				<div class="form-row">	
					<input type="text" name="insta"  id="insta"  placeholder="Instagram handle of company"  required>
				  </div>

				<div class="form-row-last">
					<input type="submit" name="register"  style="background-color:#fb246a"class="register" value="Register">
				</div>
			</form>
		</div>
	</div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>