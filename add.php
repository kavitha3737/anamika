<?php
   include("conn.php");
    if(isset($_POST['name']) && $_POST['name']!="")
    {
	  //echo "<pre>";print_r($_POST);
        $name = $_POST['name'];
        $mobile = $_POST['number'];
        $mail = $_POST['mail'];
        $pwd = $_POST['pwd'];
        $gender = $_POST['gender'];
        $skill = $_POST['skills'];
        $hobby = $_POST['hobby'];
		
       if(isset($_FILES['pic']))
       {
         $fname=$_FILES['pic']['name'];
         $tmp_name=$_FILES['pic']['tmp_name'];
         $filename = str_replace(' ', '_', $fname);
         $dir = 'upload/'.time();
         $files= $dir.$filename;
         move_uploaded_file($tmp_name,$files);
         $query="INSERT INTO details (name,mobile_no,email,password,photo,gender,skills,hobbies) 
	                       VALUES('$name','$mobile','$mail','$pwd','$files','$gender','$skill','$hobby')";
	     $result = mysqli_query($conn,$query);
        
	     if($result)
	     {
	    //echo "success";
	     }
        }
    }
?>

<html>
  <head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	</head>
	<body class="bg-danger">
        <div class="container">
			<div class="form-horizontal">
			     
				<h1 class="text-primary"><center><u><i>registration form</i></u></center></h1>
				
					<form name="myform" id="myform" method="post" action="" enctype="multipart/form-data">
						<label>NAME:</label>
						<input type="text" class="form-control" name="name" id="name">
						<span id="user" class="text-danger"></span><br>
						
						<label>CONTACT NO:</label>
						<input type="number" class="form-control" name="number" id="number">
						<span id="num" class="text-danger"></span><br>
						
						<label>EMAIL:</label>
						<input type="email" class="form-control" name="mail" id="mail"  >   
						<span id="email" class="text-danger"></span><br>
						
						<label>PASSWORD:</label>
						<input type="password" class="form-control" name="pwd" id="pwd"/>
						<span id="pass" class="text-danger"></span><br>
						
						<label>PHOTO:</label>
						<input type="file" class="form-control" name="pic" id="pic"/>
						<span id="photo" class="text-danger"></span><br>
						
						<label>GENDER:</label><br>
						<input type="radio" name="gender" id="gender" value="Male"/>Male &nbsp;
						<input type="radio" name="gender" id="gender" value="Female"/>Female<br>
						<span id="person" class="text-danger"></span><br>
						
						<label>SKILLS:</label>
						<select id="skills" name="skills" class="form-control">
						    <option>---please select one---</option>
						    <option value="web design">web design</option>
						    <option value="web developement">web developement</option>
						    <option value="iot">IOT</option>
						    <option value="java">JAVA</option>
						    <option value=".net">.NET</option>
						</select>
						<span id="skill" class="text-danger"></span><br>
						
						<label>HOBBIES:</label><br>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobby" id="hobby" value="Listening to music"/> Music <br>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobby" id="hobby" value="painting"/> Painting <br>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobby" id="hobby" value="dancing"/> Dancing <br>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobby" id="hobby" value="reading novels"/> books <br>
						    <span id="like" class="text-danger"></span><br>
						<center>
						  <input type="button" onClick="return validateLogin();" id="mmmmmSS" value="submit" >
						</center>
					</form>
			</div>
		</div>
	<script>
	 
	   function validateLogin(){
		   var flag=true;
		   
		   var name = $('#name').val();
		   var contact = $('#number').val();
		   var phoneno = /^\d{10}$/;
		   var email = $('#mail').val();
		   var mail_pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		   var pwd = $('#pwd').val();
		   var profile = $('#pic').val();
		    var profilepic=/\.(gif|jpg|jpeg|tiff|png)$/i;
		   var gender = $('#gender').val();
		   var skills = $('#skills').val();
		   var hobby = $('#hobby').val();
		   
         
		   if(name=="")
		   {
			 $('#user').html('please enter your name');
			 flag=false;
		   }else
		   {
			   $('#user').html('');
		   }
		   
		   if(contact=="")
		   {
		     $('#num').html('please enter your phone number');
		     flag=false;
		   }else if(!contact.match(phoneno))
		     {
				 $('#num').html('please enter 10 digits of number');
				 flag=false;
			 }
			 else{
				 $('#num').html('');
			 }
			 
			 if(email == "")
			{
			  $('#email').html('please enter email Id');
			   flag=false;
			}
			else if(!email.match(mail_pattern))
			{
				$('#email').html('please enter valid email');
				flag=false;
			}else{
				$('#email').html('');
			} 
			   

			if(pwd=="")
			{
				$('#pass').html('please enter your password');
				flag=false;
			}
			else{
				$('#pass').html('');
			}
			
			if((myform.gender[0].checked==false) && (myform.gender[1].checked==false) )
             {
                $('#person').html("You must select male or female");
                flag=false;
             }else{
				 $('#person').html('');
			 }
			 
			 if(profile=="")
			 {
				 $('#photo').html("please upload your picture");
			 }
			 else if(!(profile.match(profilepic))) {              
              $('#photo').html('You must select an image file only'); 
			  flag=false;
			 }else{
				 $('#photo').html('');
			 }
			  
			 if(skills == "")
			 {
				 $('#skill').html("please select your skill");
				 flag=false;
			 }else{
				 $('#skill').html('');
			 }
			 
             if((myform.hobby[0].checked==false) && (myform.hobby[1].checked==false)&& (myform.hobby[2].checked==false)
				 && (myform.hobby[3].checked==false))
				 
				 {
				 $('#like').html("please select atleast one");
				 flag=false;
			    }
			 else{
				 $('#like').html('');
			 }  
			 if(flag==true)
			{
				$('#myform').submit();
			}
              
      }	   
	 
     
		
    </script>	
    </body>
