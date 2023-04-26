<?php
    session_start();
    require_once __DIR__. "/../libraries/Database.php";
	require_once __DIR__. "/../libraries/Function.php";
	$db=new Database;
	$data =
    [
        "email" => postInput("email"),
        "password" => postInput("password"),
    ];
    $error=[];
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if(postInput('email')==null)
        {
            $error['email']="Vui lòng nhập email";
        }
        if(postInput('password')=='')
        {
            $error['password']="Vui lòng nhập mật khẩu";
        }
        //The blank is not necessarily faulty
        if(empty($error))
        {
            
            $is_check = $db->fetchOne("admin"," email = '".$data['email']."' AND password='".md5($data['password'])."'");
            if($is_check!= NULL)
            {
                $_SESSION['admin_name']=$is_check['name'];
                $_SESSION['admin_id']=$is_check['id'];
                $_SESSION['admin_avatar']=$is_check['avatar'];
                $_SESSION['admin_level']=$is_check['level'];
                $is_Permission = $db->fetchOne("Permission ","id = '".$_SESSION['admin_level']."'");
                $_SESSION['Permission_name']=$is_Permission['name'];
                $_SESSION['Permission_Dashboard']=$is_Permission['Dashboard'];
                $_SESSION['Permission_Search']=$is_Permission['search'];
                $_SESSION['Permission_Category']=$is_Permission['Category'];
                $_SESSION['Permission_Product']=$is_Permission['Product'];
                $_SESSION['Permission_Article']=$is_Permission['Article'];
                $_SESSION['Permission_Sale']=$is_Permission['Sale'];
                $_SESSION['Permission_Admin']=$is_Permission['Admin'];
                $_SESSION['Permission_Permission']=$is_Permission['Permission'];
                $_SESSION['Permission_Users']=$is_Permission['Users'];
                $_SESSION['Permission_Transaction']=$is_Permission['Transaction'];
                $_SESSION['Permission_Ratings']=$is_Permission['Ratings'];
                $_SESSION['Permission_Contacts']=$is_Permission['Contacts'];
                $_SESSION['Permission_read_pm']=$is_Permission['read_pm'];
                $_SESSION['Permission_create_pm']=$is_Permission['create_pm'];
                $_SESSION['Permission_edit_pm']=$is_Permission['edit_pm'];
                $_SESSION['Permission_delete_pm']=$is_Permission['delete_pm'];
                echo "<script>alert('Đăng nhập thành công !');location.href='/admin/'</script>'";
            }
            else
            {
                echo "<script>alert('Đăng nhập không thành công !');</script>";
            }
            
            
        }
        
    }

?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container" style="padding-top:20px;">
    <div class="row">
		<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Đăng nhập quản lý</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form" action="" method="POST">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Email..." name="email" type="text">
                            <?php if(isset($error['email'])):?>
                            <p class="text-danger">  <?php echo $error['email'] ?> </p>
                            <?php endif ?>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Mật khẩu..." name="password" type="password" value="">
                            <?php if(isset($error['password'])):?>
                            <p class="text-danger">  <?php echo $error['password'] ?> </p>
                            <?php endif ?>
                        </div>
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Đăng nhập">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>