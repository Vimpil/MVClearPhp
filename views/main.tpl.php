<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
  <title><?php echo $pageData['title']; ?></title>
	
  <meta name="vieport" content="width=device-width, initial-scale=1"><link rel="stylesheet" type="text/css" href="/lib/css/style.css">
</head>
<body>
	
	<header></header>

	<div id="content">

  <?php echo $_SESSION['role_id']; ?>
  <?php $adminLogin= ob_get_contents(); ?>


  <?php if (($_SESSION['role_id'])==3):?>
    <p >Wrong username/password.</p>
  <?php endif; ?>
            
  <!-- IF logged ADMIN -->
  <?php if (($_SESSION['role_id'])==1):?>
     
    <p class="text-center login-title">Admin</p>

    <input id='adminLogoutBtn' type="BUTTON" class="btn btn-lg btn-primary btn-block" value="Logout"/>
      
  <!-- ELSE -->
  <?php else:

    echo '<p class="text-center login-title">Admin Sign in</p>
    
    <form method="post" class="form-signin" id="form-signin" name="form-signin">
        
        <input type="hidden" name="action" value="login">';
               
                if(!empty($pageData['loginError'])){                    
                    echo '<p>';
                    echo '<p>LOGIN ERROR<p>';
                    echo $pageData['loginError'];
                    echo '</p>';                  
                }

                echo'<input type="text" name="login" class="form-control" id="login" placeholder="Логин" required autofocus>
                
                <input type="password" name="password" class="form-control" id="password" placeholder="Пароль" required>
                
                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Вход"/>
        </form>';
  endif; ?>
             

      <form method="post" class="form-signin" id="form-signin" name="form-signin">
        
      </form>

<h2>table</h2>
     

  <div class="container">  
        <h3 align="center">Make Pagination using Jquery, PHP, Ajax and MySQL</h3><br />  
        <div class="table-responsive" id="pagination_data">  
        </div>  
  </div> 
  
  </select>
  
  <?php if (($_SESSION['role_id'])==1):?>
    <p style='text-align:center'>Выбраный ID для правки:</p><div id="choosed_row" style='text-align:center'></div>
  <?php endif; ?>
  


    <p class="text-center login-title">Add task</p>
    
    <form class="form-addTask" id="form-addTask" name="form-addTask">
        
      <input type="hidden">
                 
      <input type="text" name="name" class="form-control" id="name" placeholder="Пользователь" required autofocus min="1">
                  

      <input type="email" name="email" class="form-control" id="email" placeholder="username@smth.com" required>


      <input type="text" name="task" class="form-control" id="task" placeholder="Задача" required min="1">
                  
      <input type="button" class="btn btn-lg btn-primary btn-block" value="Добавить" id='addBtn'/>

      <?php if (($_SESSION['role_id'])==1):?>
        <input type="button" class="btn btn-lg btn-primary btn-block" value="Обновить" disabled id='updateBtn'/>
        <script>
          window.role_id = 1;
        </script>
        <?php else:?>
          <script>
          window.role_id = 0;
        </script>
      <?php endif; ?>



    
    </form>

   


	</div>

	<footer>
		
	</footer>
  <script src="/lib/js/jquery.js"></script>
 <script src="/lib/js/script.js"></script>

</body>
</html>

