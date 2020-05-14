<!DOCTYPE htm>
<html>
<body>
	<h1>users</h1>
<ul><?php
  require "database.php";
  require "users.php";
  $users = new Users();
  foreach ($users->get() as $u) {
  	echo "<h1>user</h1>";
    echo "<li>" . $u['name'] . "</li>";
  }
?></ul>
</body>
</html>