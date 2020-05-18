<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
    <title><?php echo $pageData['title']; ?></title>
	<meta name="vieport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/lib/css/style.css">
</head>
<body>
	
	<header></header>

	<div id="content">

<?php 
  echo $_SESSION['role_id'];
 ?>
<?php $adminLogin= ob_get_contents(); ?>

            <?php if (isset($_SESSION['role_id'])):?>

              <!-- IF logged ADMIN -->
              <?php if (($_SESSION['role_id'])==1):?>
                 
                  <p class="text-center login-title">Admin</p>
                  
              <!-- ELSE -->
              <?php else:
                echo '<p class="text-center login-title">Admin Sign in</p>
                    
                <form method="post" class="form-signin" id="form-signin" name="form-signin">
                    
                        <input type="hidden" name="action" value="login">';
                           
                            if(!empty($pageData['loginError'])){
                    
                                echo '<p>';
                                echo $pageData['loginError']; 
                                echo '</p>';
                            
                            }
                            echo'
                            <input type="text" name="login" class="form-control" id="login" placeholder="Логин" required autofocus>
                            
                            <input type="password" name="password" class="form-control" id="password" placeholder="Пароль" required>
                            
                            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Вход"/>
                    </form>';
              endif; 
             else:
               echo '<p class="text-center login-title">Admin Sign in</p>
                    
                <form method="post" class="form-signin" id="form-signin" name="form-signin">
                    
                        <input type="hidden" name="action" value="login">';
                           
                            if(!empty($pageData['loginError'])){
                    
                                echo '<p>';
                                echo $pageData['loginError']; 
                                echo '</p>';
                            
                            }
                            echo'
                            <input type="text" name="login" class="form-control" id="login" placeholder="Логин" required autofocus>
                            
                            <input type="password" name="password" class="form-control" id="password" placeholder="Пароль" required>
                            
                            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Вход"/>
                    </form>';
            endif;?>


        
      <table id="myTable">
        
        <tbody>
          <tr>
              <th onclick="sortTable(0)" id="nameClick">Name</th>
              <th onclick="sortTable(1)" id="countryClick">Country</th>
              <th onclick="sortTable(1)" id="countryClick">Country</th>
          </tr>
          <tr>
            <td>Alfreds Futterkiste</td>
            <td>Germany</td>
            <td>Germany</td>
          </tr>
          <tr>
            <td>Berglunds snabbkop</td>
            <td>Sweden</td>
            <td>Sweden</td>
          </tr>
          <tr>
            <td>Berglunds snabbkop</td>
            <td>Sweden</td>
            <td>Sweden</td>
          </tr>
        </tbody>

      </table>

      <form method="post" class="form-signin" id="form-signin" name="form-signin">
        
      </form>

<h2>table</h2>
     

<div class="container">  
      <h3 align="center">Make Pagination using Jquery, PHP, Ajax and MySQL</h3><br />  
      <div class="table-responsive" id="pagination_data">  
      </div>  
</div> 
    
  <?php 
    
    echo ' $_SESSION[users] \n*************************';
    print_r ($_SESSION['users'][1]['email']);
    echo '$_SESSION[users] \n';

     ?>
    </select>

    <!-- User details -->
    <div >
     Username : <span id='suname'></span><br/>
     Name : <span id='sname'></span><br/>
     Email : <span id='semail'></span><br/>
    </div>


	</div>

	<footer>
		
	</footer>
  <script src="/lib/js/jquery.js"></script>
 <script src="/lib/js/script.js"></script>

</body>
</html>

