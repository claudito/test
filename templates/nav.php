
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo PATH; ?>"><i class="fa fa-cube titulo-nav"></i>Aplicación de Costos </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
     
      <?php 

      $menu  =  new Menu('?','?');
      $lista_menu  = $menu -> lista();
    
      foreach ($lista_menu as $key_lista_menu => $value_lista_menu) 
      {
      echo '<li class="dropdown">';
      echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'. $value_lista_menu['NOMBRE'].'<span class="caret"></span></a>';
      echo '<ul class="dropdown-menu">';
       
      $submenu  =  new Submenu('?','?','?','?');
      $lista_sub_menu = $submenu->lista_menu($value_lista_menu['ID'],$_SESSION[KEY.USUARIO]);
      foreach ($lista_sub_menu as $key_lista_sub_menu => $value_lista_sub_menu)
      {
      
      if ($value_lista_sub_menu['ESTADO']==1) 
      {

         $ruta = RUTA.$value_lista_sub_menu['URL'].'.php';
         #$ruta = RUTA.str_replace('/', '\\', $value_lista_sub_menu['URL']).'.php';
         if (is_readable($ruta)) 
         {
           echo '<li><a href="'.PATH.$value_lista_sub_menu['URL'].'">'.$value_lista_sub_menu['NOMBRE'].'</a></li>';
         }
         else
         {
            echo '<li ><a href="'.PATH.'pages/no-existe">'.$value_lista_sub_menu['NOMBRE'].'</a></li>';
         }
      }
      else
      {
      echo '<li class="disabled"><a href="#">'.$value_lista_sub_menu['NOMBRE'].'</a></li>';
      }


      }
      echo'</ul>';
      echo '</li>';
      }


       ?>
    
      </ul>
     <!-- 
       <form class="navbar-form navbar-left" method="GET">
        <div class="form-group">
          <input type="text" name="codigo" class="form-control" placeholder="Ingrese el Código" required="">
          <button class="btn btn-primary">Buscar</button>
        </div>
   
      </form>

      -->
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="glyphicon glyphicon-user text-success"></i> <?php echo $_SESSION[KEY.NOMBRES]; ?></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo PATH; ?>pages/ayuda">Ayuda</a></li>
           
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo PATH ?>procesos/logout">Salir</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>