<?php
header("Content-Type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/complaints.book/css/bootstrap.css" rel="stylesheet">
    <link href="/complaints.book/css/font-awesome.css" rel="stylesheet">

	<link href="/complaints.book/css/style.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
  </head>
  <body>
      
    <div class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
                    <span class="sr-only">Відкрити навігацію</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">Лототип</a>
            </div>
            <div class="collapse navbar-collapse" id="responsive-menu">
                <ul class="nav navbar-nav">
                    <li><a href="/complaints.book/index/">Книга скарг</a></li>
                </ul>
                <form action="" method="post" class="navbar-form navbar-right ">
                    <?php 
                    $auth = new Authorize_Base();
                    if($auth->Guest){?>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Логін" name="us[login]"  value="">
					</div>
					<div class="form-group">
                        <input type="password" class="form-control" placeholder="Пароль" name="us[pass]" value="">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-sign-in"></i> Вхідi
                        
                    </button>
                    <?php }else{ ?> 
                    <button type="submit" class="btn btn-primary" name="ex[exit]" >
                        <i class="fa fa-sign-out"></i> <?=$auth->getName()?>
                    </button>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
        
      
      

<div class="container">
    <?php
        include ($contentPage);
    ?>
</div>
	  
<div class="navbar-static-bottom navbar-default row-fluid">
	<div class="navbar-inner">
		<div class="container">
			<br>
			<p><?=date('Y',time())?></p>
		</div>
	</div>
</div>
	  
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/complaints.book/js/bootstrap.js"></script>
	<script src="/complaints.book/js/js.js"></script>
	
	<script type="text/javascript" src="/complaints.book/js/jquery-latest.js"></script>
	<script type="text/javascript" src="/complaints.book/js/jquery.tablesorter.js"></script>
	
	</body>
</html>