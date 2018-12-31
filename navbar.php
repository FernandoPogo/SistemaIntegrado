<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">Sistema integrado de Aprendizaje </a>

    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse">  
    <?php  
    if ( isset($_SESSION["Usuario"]) ) 
    {?>
      <ul class="navbar-nav navbar-sidenav" id="Accordion">                
       <li class="nav-item" data-toggle="tooltip" data-placement="right" title="RepoComponents">
         <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#RepoCollapse" data-parent="#Accordion">
           <i class="fa fa-fw fa-github"></i>
           <span class="nav-link-text">Repositorio de Objetos de Aprendizaje </span>
         </a>
         <ul class="sidenav-second-level collapse" id="RepoCollapse">
           <li>
             <a href="Base/ConexionBD.php">Nuevo </a>
           </li>
           <li>
             <a href="buscar.php">Buscar </a>
           </li>
           <li class="nav-item"data-toggle="tooltip" data-placement="rigth" title="EstadisticaComponents">
             <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#EstadisticaCollapse" data-parent="#RepoCollapse">
               <span class="nav-link-text">Estadísticas</span>
             </a>
             <ul class="sidenav-third-level collapse" id="EstadisticaCollapse">
               <li>
                 <a href="importar.php">Puntuación </a>
               </li>
               <li>
                 <a href="importar.php">Descargas </a>
               </li>
               <li>
                 <a href="importar.php">Gráficas </a>
               </li>
             </ul>         
           </li>
         </ul>  

         <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#Accordion">
           <i class="fa fa-fw fa-stack-overflow"></i>
           <span class="nav-link-text">Comunidad de Desarrollo </span>
         </a>
         <ul class="sidenav-second-level collapse" id="collapseComponents">
           <li>
             <a href="importar.php">Nuevo </a>
           </li>
           <li>
             <a href="buscar.php">Buscar </a>
           </li>
         </ul>
       </li>

       <?php
       if ( $_SESSION["TipoUsuario"] == 'Profesor' || $_SESSION["TipoUsuario"] == 'Estudiante' ) 
       { ?>
         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Crear">
           <a class="nav-link" href="tools.php">
             <i class="fa fa-external-link"></i>
             <span class="nav-link-text">Herramientas Adicionales</span>
           </a>
         </li>
       <?php } ?>

       <?php
       if ( $_SESSION["TipoUsuario"] == 'Profesor' )  
       { ?>
         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Crear">
           <a class="nav-link" href="AyudaInProf.php">
             <i class="fa fa-fw fa-file-text-o"></i>
             <span class="nav-link-text">Ayuda</span>
           </a>
         </li>
       <?php } ?>

       <?php
       if ( $_SESSION["TipoUsuario"] == 'Estudiante' ) 
       { ?>
         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Crear">
           <a class="nav-link" href="AyudaInEstudiant.php">
             <i class="fa fa-fw fa-file-text-o"></i>
             <span class="nav-link-text">Ayuda</span>
           </a>
         </li>
       <?php } ?>

       <?php
       if ( $_SESSION["TipoUsuario"] == 'Administrador' ) 
       { ?>
         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
           <a class="nav-link" href="users.php">
             <i class="fa fa-fw fa-address-book"></i>
             <span class="nav-link-text">Usuarios</span>
           </a>
           <a class="nav-link" href="AyudaInAdmin.php">
             <i class="fa fa-fw fa-address-book"></i>
             <span class="nav-link-text">Ayuda</span>
           </a>
         </li>
       <?php } ?>
     </ul>       

     <ul class="navbar-nav sidenav-toggler">
       <li class="nav-item">
         <a class="nav-link text-center" id="sidenavToggler">
           <i class="fa fa-fw fa-angle-left"></i>
         </a>
       </li>
     </ul>
    <?php 
    } 
    else 
    { ?>
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Crear">
              <a class="nav-link" href="InfoRepoOA.php">
                <i class="fa fa-fw fa-github"></i>
                <span class="nav-link-text">Repositorio de Objetos de Aprendizaje</span>
              </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Crear">
              <a class="nav-link" href="InfoComunidadDes.php">
                <i class="fa fa-fw fa-stack-overflow"></i>
                <span class="nav-link-text">Comunidad de Desarrollo</span>
              </a>
            </li>
          </ul>
	<?php 
        } ?>

        <ul class="navbar-nav ml-auto">
        <?php
        if ( ! isset($_SESSION["Usuario"]) ) 
        {?>
          <li class="nav-item">
            <a class="nav-link" href="Log/login.php">
            <i class="fa fa-fw fa-sign-in"></i>Ingresar</a>
          </li>

	  <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#exampleModal" href="">
            <i class="fa fa-fw fa-registered" ></i>Registrarse</a>
          </li>
        <?php 
        } 
        else 
        { ?>
          <li class="nav-item">
            <a class="nav-link" href="userprof.php">
              <i class="fa fa-fw fa-user"></i>  
              <?php
              if ( $_SESSION["TipoUsuario"] == "Administrador" ) 
              {
                echo 'Administrador';
              } else {
                echo $_SESSION["NombreUsuario"];
              }  ?>  
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-fw fa-sign-out"></i>Salir</a>
          </li>    
        <?php } ?>
        </ul>
      </div>
</nav>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Seleccione el tipo de registro</div>
      <div class="modal-footer">
        <a class="btn btn-primary" href="Log/registrarProf.php">Profesor</a>
        <a class="btn btn-success" href="Log/registrarEst.php">Estudiante</a>
      </div>
    </div>
  </div>
</div>
