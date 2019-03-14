<html>
  <head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	</head>
	<body>
        <div class="container">
			<div class="form-horizontal">
			     
				 
				 
				 
				<h1 class="text-primary"><center><u><i>registration form</i></u></center></h1>
				
					<form name="myform" id="myform" method="post" action="add.php">
						<label>NAME:</label>
						<input type="text" class="form-control" name="name" id="name">
						<span id="user" class="text-danger"></span><br>
						
						<label>CONTACT NO:</label>
						<input type="number" class="form-control" name="number" id="number">
						<span id="num" class="text-danger"></span><br>
						
						<label>EMAIL:</label>
						<input type="email" class="form-control" name="mail" id="mail" required >   
						<span id="email" class="text-danger"></span><br>
						
						<label>PASSWORD:</label>
						<input type="password" class="form-control" name="pwd" id="pwd"/>
						<span id="pwd" class="text-danger"></span><br>
						
						<center>
							<button id="submit">submit</button>
						</center>
					</form>
			</div>
		</div>
	<script>
	   $(document).ready(function(){
	   $("#myform").validate({
		       rules : {
			        name : 'required',
				    number: {
				      required : true,
				      maxlength : 10,
				    }
				    mail  : {
					  required : true,
					   email   : true,
				   },
			   }
	   })
	   })
		
    </script>	
    </body>
