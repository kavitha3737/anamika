<?php
  include("conn.php");
     $id      = "";
	 $name    = "";
	 $mobile  = "";
	 $mail    = "";
	 $pwd     = "";
	 $photo   = "";
	 $gender   = "";
	 $skill   = "";
	 $hobby   = "";
	
    if(isset($_GET['id']) && $_GET['id']!="")
	{
     	$getid = $_GET['id'];
        $query2 = "SELECT * FROM details WHERE id='$getid'";
        $result2 = mysqli_query($conn,$query2);
     while($row=mysqli_fetch_array($result2))
		{
		   $id      = $row['id'];
		   $name    = $row['name'];
		   $mobile   = $row['mobile_no'];
		   $mail    = $row['email'];
		   $pwd    = $row['password'];
		   $photo = $row['photo'];	
           $gender= $row['gender'];		 
           $skill= $row['skills'];		 
           $hobby= $row['hobbies'];		 
		}
	}
?>

<?php
    if(isset($_POST['name']) && $_POST['name']!="")
    {
        $name = $_POST['name'];
        $mobile = $_POST['number'];
        $mail = $_POST['mail'];
        $pwd = $_POST['pwd'];
        $gender = $_POST['gender'];
        $skill = $_POST['skills'];
        $hobby = $_POST['hobby'];
		
      if(isset($_FILES['pic']) && ($_FILES['pic']['name']!=""))
		{
           $fname=$_FILES['pic']['name'];
           $tmp_name=$_FILES['pic']['tmp_name'];
           $filename = str_replace(' ', '_', $fname);
           $dir = 'upload/'.time();
           $files= $dir.$filename;
		   move_uploaded_file($tmp_name,$files);
		 
		   if(isset($_POST['hid_img']) && ($_POST['hid_img']!=""))
		    {
				unlink($_POST['hid_img']);
		    }
	    }else
		    {
				if(isset($_POST['hid_img']) && ($_POST['hid_img']!=""))
				{
					$files = $_POST['hid_img'];
				}			  
				else{
						$files="";
					}
			}
			
		if($_POST['hid_id']=="")
		{
           $query="INSERT INTO details (name,mobile_no,email,password,photo,gender,skills,hobbies) 
	                           VALUES('$name','$mobile','$mail','$pwd','$files','$gender','$skill','$hobby')";
	       $rel = mysqli_query($conn,$query);
        }else
		  {  
			$sel="UPDATE  details SET  name='$name',mobile_no='$mobile',email='$mail',password='$pwd',photo='$files',gender='$gender',skills='$skill',hobbies='$hobby' WHERE id='$id'";
			$rel=mysqli_query($conn,$sel);
	
		  }
		if($rel)
		{
			header("location:view.php");
			
		}else
		{
			echo mysqli_error($conn);
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
					    <input type="hidden" name="hid_id" value="<?php if(isset($_GET['id']) && ($_GET['id']!="")){echo $id;}?>"> 
						
						<label>NAME:</label>
						<input type="text" class="form-control" name="name" id="name" 
						value="<?php if(isset($_GET['id'])){echo $name ;}?>">
						<span id="user" class="text-danger"></span><br>
						
						<label>CONTACT NO:</label>
						<input type="number" class="form-control" name="number" id="number"
						value="<?php if(isset($_GET['id'])){echo $mobile;} ?>">
						<span id="num" class="text-danger"></span><br>
						
						<label>EMAIL:</label>
						<input type="email" class="form-control" name="mail" id="mail" 
							value="<?php if(isset($_GET['id'])){echo $mail;} ?>">   
						<span id="email" class="text-danger"></span><br>
						
						<label>PASSWORD:</label>
						<input type="password" class="form-control" name="pwd" id="pwd"
						value="<?php if(isset($_GET['id'])){echo $pwd;} ?>"/>
						<span id="pass" class="text-danger"></span><br>
						
						<label>PHOTO:</label>
						<input type="file" class="form-control" name="pic" id="pic"
						value="<?php if(isset($_GET['id'])){echo $photo;} ?>"/>
						<span id="photo" class="text-danger"></span><br>
						<input type="hidden" name="hid_img" id="hid_img" value="<?php if(isset($_GET['id'])){echo $photo;}?>">
						
						<label>GENDER:</label><br>
						<input  type="radio" name="gender" id="gender" value="Male"
							<?php  if($gender=='Male'){echo 'checked';} ?>>Male &nbsp;
						<input type="radio" name="gender" id="gender"  value="Female"
							<?php  if($gender=='Female'){echo 'checked';} ?>  />Female<br>
						<span id="person" class="text-danger"></span><br>
						
						<label>SKILLS:</label>
						<select id="skills" name="skills" class="form-control">
						    <option>---please select one---</option>
						    <option value="web design"<?php if($skill=='web design'){echo 'selected';}?>>web design</option>
						    <option value="web developement"<?php if($skill=='web developement'){echo 'selected';}?>>web developement</option>
						    <option value="iot"<?php if($skill=='iot'){echo 'selected';}?>>IOT</option>
						    <option value="java"<?php if($skill=='java'){echo 'selected';}?>>JAVA</option>
						    <option value=".net"<?php if($skill=='.net'){echo 'selected';}?>>.NET</option>
						</select>
						<span id="skill" class="text-danger"></span><br>
						
						<label>HOBBIES:</label><br>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobby" id="hobby" value="Listening to music"
						<?php if($hobby=="Listening to music"){echo 'checked';}?>/> Music <br>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobby" id="hobby" value="painting"
						<?php if($hobby=="painting"){echo 'checked';}?>/> Painting <br>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobby" id="hobby" value="dancing"
						<?php if($hobby=="dancing"){echo 'checked';}?>/> Dancing <br>
						&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="hobby" id="hobby" value="reading novels"
						<?php if($hobby=="reading novels"){echo 'checked';}?>/> books <br>
						    <span id="like" class="text-danger"></span><br>
						<center>
						  <input type="button" onClick="return validateLogin();" id="mmmmmSS" value="submit" >
						 
						</center>
					</form>
					<?php
					if(isset($_GET['id']) && $_GET['id']!="")
					{
						?>
					<img src="<?php if(isset($_GET['id'])){echo $photo;} ?>" width="100px" height="100px"><br>
					  <?php if(isset($_GET['id'])){echo $photo;} ?>
					  <?php
					}
                    ?>					
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
</html>  
	