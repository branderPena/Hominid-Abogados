
<!DOCTYPE html>
<html>

<head>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="../resources/css/materialize.min.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="../resources/css/Acasos.css" media="screen,projection" />

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Asignacion de Casos</title>
</head>

<body>
  <header>
    <nav class="black">
     <div class="nav-wrapper">
       <a href="#" class="brand-logo right">Logo</a>
       <a href="#" data-target="mobile-sidenav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
       <ul id="nav-mobile" class="left hide-on-med-and-down">
         <li><a href="AsignarCasos.php">Asignar Casos</a></li>
         <li><a href="Casos.php">Casos Generales</a></li>
         <li><a href="AsignarAbogados.php">Asignar Abogados</a></li>
         <li><a href="login.php"><i class="material-icons">account_circle</i></a></li>
       </ul>
    </div>
   </nav>
   <ul class="sidenav" id="mobile-sidenav">
   <li><a href="AsignarCasos.php">Asignar Casos</a></li>
         <li><a href="Casos.php">Casos Generales</a></li>
         <li><a href="agregarabogados.php">Agregar Abogados</a></li>
         <li><a href="login.php"><i class="material-icons">account_circle</i>Cerrar Sesion</a></li>
         </ul>
 </header>
    
        <!--Ubicacion del Main-->
       <main>
         <div class="container"> 
            <h2> Asignacion de casos</h2>

            <div class="row">
                <form class="col s12">
                  <div class="row">
                    <div class="input-field col s6">
                      <input id="icon_prefix" type="text" class="validate">
                      <label for="icon_prefix">Abogado responsable</label>
                    
                  </div>
                  </div>
         </div>
         <div class="row">
          <label>Materia</label>
          <select class="browser-default">
            <option value="" disabled selected>Materia</option>
            <option value="1">Cooperativo</option>
            <option value="2">Laboral</option>
            <option value="3">Migratorio</option>
            <option value="4">Constitucional</option>
          </select>
         </div>

         <div class="row">
          <form class="col s12">
            <div class="row">
              <div class="input-field col s6">
                <input id="icon_prefix" type="text" class="validate">
                <label for="icon_prefix">Cliente</label>
              
            </div>

            <form class="col s12">
              <div class="row">
                <div class="input-field col s6">
                  <input  type="text" class="datepicker" id="fecha">
                  <label for="icon_prefix">Fecha Ingreso</label>
                </div>
              </div>
            </div>
   </div>

   <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <input id="icon_prefix" type="text" class="validate">
          <label for="icon_prefix">Fecha Finalizacion</label>
        
      </div>

      <form class="col s12">
        <div class="row">
          <div class="input-field col s6">
            <input id="icon_prefix" type="text" class="validate">
            <label for="icon_prefix">Servicio Requerido</label>
          </div>
        </div>
      </div>
</div>

<div class="row">
  <form class="col s12">
    <div class="row">
      <div class="input-field col s6">
        <input id="icon_prefix" type="text" class="validate">
        <label for="icon_prefix">Gestiones</label>
      
    </div>

    <form class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <input id="icon_prefix" type="text" class="validate">
          <label for="icon_prefix">Obeservaciones</label>
        </div>
      </div>
    </div>
    
</div>
<div class="row">
  <label>Estado-Estatus</label>
  <select class="browser-default">
    <option value="" disabled selected>Estado-Estatus</option>
    <option value="1">Finalizado</option>
    <option value="2">En proceso</option>
    <option value="3">Proyecto</option>
  </select>
 </div>
 
 <div>
<button class="btn waves-effect waves-light" type="submit" name="action">Agregar
  <i class="material-icons right">add_circle</i>
</button>

<button class="btn waves-effect waves-light" type="submit" name="action">Actualizar
  <i class="material-icons right">cached</i>
</button>

<button class="btn waves-effect waves-light" type="submit" name="action"> Eliminar
  <i class="material-icons right">delete</i>
</button>

<button class="btn waves-effect waves-light" type="submit" name="action">Mostrar
  <i class="material-icons right">remove_red_eye</i>
</button>
</div>
</div>
         
   </main>
</body>
<footer class="page-footer black">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">Hominid Abogados</h5>
            <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">
        © 2021 Hominid Abogados, Derechos reservados
        </div>
      </div>
    </footer>

  <!--JavaScript at end of body for optimized loading-->
  <script type="text/javascript" src="../resources/js/materialize.min.js"></script>
  <script type="text/javascript" src="../app/controllers/initialization.js"></script>
