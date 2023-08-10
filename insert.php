<?php 
include('dbconnection.php');

if(isset($_POST['submit']))
  {
    
    $title=$_POST['title'];
    $price=$_POST['price'];
    $description=$_POST['description'];
    $image=$_FILES["image"]["name"];

    //Image validation
    $extension = substr($image,strlen($image)-4,strlen($image));
    $allowed_extensions = array(".jpg","jpeg",".png");
     if(!isset($_POST['cate'])){
        echo "<script>alert('Select atleast one category');</script>";
    }else if(!in_array($extension,$allowed_extensions))
    {
    echo "<script>alert('Invalid format. Only jpg / jpeg/ png format allowed1');</script>";
    }else{
        
        $cate=implode(",",$_POST['cate']);

        $imgnewfile=md5($imgfile).time().$extension;
        move_uploaded_file($_FILES["image"]["tmp_name"],"images/".$imgnewfile);
        $currentTime = date('Y-m-d H:i:sa');
        $query=mysqli_query($con, "insert into tbl_books(title,description, price, category, image,created_at) value('$title','$description', '$price', '$cate','$imgnewfile','$currentTime' )");
        if ($query) {
        echo "<script>alert('You have successfully inserted the data');</script>";
        echo "<script type='text/javascript'> document.location ='index.php'; </script>";
        } else{
        echo "<script>alert('Something Went Wrong. Please try again');</script>";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Book!</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	color: #fff;
	background: #63738a;
	font-family: 'Roboto', sans-serif;
}
.form-control {
	height: 40px;
	box-shadow: none;
	color: #969fa4;
}
.form-control:focus {
	border-color: #5cb85c;
}
.form-control, .btn {        
	border-radius: 3px;
}
.signup-form {
	width: 450px;
	margin: 0 auto;
	padding: 30px 0;
  	font-size: 15px;
}
.signup-form h2 {
	color: #636363;
	margin: 0 0 15px;
	position: relative;
	text-align: center;
}
.signup-form h2:before, .signup-form h2:after {
	content: "";
	height: 2px;
	width: 30%;
	background: #d4d4d4;
	position: absolute;
	top: 50%;
	z-index: 2;
}	
.signup-form h2:before {
	left: 0;
}
.signup-form h2:after {
	right: 0;
}
.signup-form .hint-text {
	color: #999;
	margin-bottom: 30px;
	text-align: center;
}
.signup-form form {
	color: #999;
	border-radius: 3px;
	margin-bottom: 15px;
	background: #f2f3f7;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}
.signup-form input[type="checkbox"] {
	margin-top: 3px;
}
.signup-form .btn {        
	font-size: 16px;
	font-weight: bold;		
	min-width: 140px;
	outline: none !important;
}
.signup-form .row div:first-child {
	padding-right: 10px;
}
.signup-form .row div:last-child {
	padding-left: 10px;
}    	
.signup-form a {
	color: #fff;
	text-decoration: underline;
}
.signup-form a:hover {
	text-decoration: none;
}
.signup-form form a {
	color: #5cb85c;
	text-decoration: none;
}	
.signup-form form a:hover {
	text-decoration: underline;
}  
.lbl-cls {
    color: #636363;
}
.required{
    color:red;
}
</style>
</head>
<body>
<div class="signup-form">
    <form  method="POST" enctype="multipart/form-data" >
		<h2>Create Book</h2>
        <div class="form-group">
            <label class="lbl-cls">Title <span class="required">*</span> </label>
            <input type="text" class="form-control" name="title" required="true">  
          
        </div>
        <div class="form-group">
        <label class="lbl-cls">Price <span class="required">*</span></label>
            <div class="row">
                    <div class="col"><input type="number" min=5 max=1000 class="form-control" name="price" required="true"></div>
            </div> 
        </div>

        <div class="form-group">
            <label class="lbl-cls">Description</label>
            <textarea class="form-control" name="description"></textarea>
        </div>  

        <div class="form-group">
               <label for="categories" class="lbl-cls">Categories </label><span class="required">*</span>
                <div class="col-sm-12" required="true">
                        <input type="checkbox" id="cate_1" name="cate[]" value="EBook1">
                        <label for="ebook1"> EBook1</label><br>
                        <input type="checkbox" id="cate_2" name="cate[]" value="EPub2">
                        <label for="epub2"> EPub2</label><br>
                        <input type="checkbox" id="cate_3" name="cate[]" value="Pocket Edition 3<">
                        <label for="pocket_edition">Pocket Edition 3</label><br>
                     
                </div>
                </div>
		
		
             <div class="form-group">
        	<input type="file" class="form-control" name="image"  required="true">
        	<span style="color:red; font-size:12px;">Only jpg / jpeg/ png  format allowed.</span>
        </div>      
      
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Create Book</button>
        </div>
    </form>
	
</div>
</body>
</html>