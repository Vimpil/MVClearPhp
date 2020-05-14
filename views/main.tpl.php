<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $pageData['title']; ?></title>
	<meta name="vieport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>
	
	<header></header>

	<div id="content">
		<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            
            <div class="account-wall">                
                <p class="text-center login-title">Admin Sign in</p>

                <?php

                    if (isset($_SESSION['role_id'])) {
                       echo $_SESSION['role_id'];
                    } else{
                        echo 'not set';
                    }

                ?>


               <form method="post" class="form-signin" id="form-signin" name="form-signin">

                            <input type="hidden" name="action" value="login"> 
                               
                                <?php if(!empty($pageData['loginError'])) :?>

                                    <p><?php echo $pageData['loginError']; ?></p>
                                
                                <?php endif; ?>
                                
                                <input type="text" name="login" class="form-control" id="login" placeholder="Логин" required autofocus>
                                
                                <input type="password" name="password" class="form-control" id="password" placeholder="Пароль" required>
                                
                                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Вход"/>
                </form>
            </div>
        </div>
    </div>
</div>
	</div>

	<footer>
		
	</footer>


	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/angular.min.js"></script>
	<script src="/js/script.js"></script>


</body>
</html>