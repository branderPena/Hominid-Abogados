<!DOCTYPE html>
<html lang="es">
<head>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="../resources/css/materialize.min.css"/>
  <link type="text/css" rel="stylesheet" href="../resources/css/styles.css"/>

  <!--Vista optimizada para telefono mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Casos</title>
</head>
<header>
   <nav class="black">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo right">Logo</a>
      <a href="#" data-target="mobile-sidenav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a href="AsignarCasos.php">Asignar Casos</a></li>
        <li><a href="Casos.php">Casos Generales</a></li>
        <li><a href="agregarabogados.php">Agregar Abogados</a></li>
        <li><a href="login.php"><i class="material-icons">account_circle</i></a></li>
      </ul>
   </div>
  </nav>
  <ul class="sidenav" id="mobile-sidenav">
  <li><a href="AsignarCasos.php">Asignar Casos</a></li>
        <li><a href="Casos.php">Casos Generales</a></li>
        <li><a href="AsignarAbogados.php">Asignar Abogados</a></li>
        <li><a href="login.php"><i class="material-icons">account_circle</i>Cerrar Sesion</a></li>
        </ul>
</header>
<main>
<body>
   <div class="Container">
      <div class="Row">
         <div class="col l6 s12">
            <h3>Casos en proceso</h3><br>
            <table  class="highlight">
               <thead>
               <tr>
                  <th>Referencia</th>
                  <th>Abogado responsable</th>
                  <th>Materia</th>
                  <th>Cliente</th>
                  <th>fecha de ingreso</th>
                  <th>fecha de finalizacion</th>
                  <th>servicio requerido</th>
                  <th>Gestiones</th>
                  <th>Observaciones</th>
                  <th>Estado</th>
               </tr>
               </thead>
               <tbody>
               <tr>
                  <td>134</td>
                  <td>Federico Navas</td>
                  <td>Laboral</td>
                  <td>Borja Cardona</td>
                  <td>15/12/2020</td>
                  <td></td>
                  <td>Demanda</td>
                  <td>Solicita una cuota de 100 dolares por accidente laboral</td>
                  <td>El cliente exige una cantidad de dinero por no recibir servicio medico</td>
                  <td>En Proceso</td>
               </tr>
               <tr>
                  <td>135</td>
                  <td>Imanol Morales</td>
                  <td>Constitucional</td>
                  <td>Iñigo Toribio</td>
                  <td>20/12/2020</td>
                  <td></td>
                  <td>Divorcio</td>
                  <td>Solicita un acta de divorcio hacia su esposa por engañarlo por mas de 2 años</td>
                  <td>El cliente se encuentra indignado al ver como su esposa lo engaño con otro hombre</td>
                  <td>En proceso</td>
               </tr>
               <tr>
                  <td>136</td>
                  <td>Izan Labrador</td>
                  <td>Migratoria</td>
                  <td>Paul Perales</td>
                  <td>15/02/2020</td>
                  <td></td>
                  <td>Solicita la nacionalidad</td>
                  <td>Solicita realizar el examen de nacionalidad</td>
                  <td>El cliente desea los documento para poder quedarse en el pais</td>
                  <td>En proceso</td>
               </tr>
               </tbody>
            </table>
         </div>
         <br>
         <div class="col l6 s12">
         <h3>Casos Finalizados</h3><br>
            <table class="highlight">
               <thead>
               <tr>
                  <th>Referencia</th>
                  <th>Abogado responsable</th>
                  <th>Materia</th>
                  <th>Cliente</th>
                  <th>fecha de ingreso</th>
                  <th>fecha de finalizacion</th>
                  <th>servicio requerido</th>
                  <th>Gestiones</th>
                  <th>Observaciones</th>
                  <th>Estado</th>
               </tr>
               </thead>
               <tbody>
               <tr>
                  <td>131</td>
                  <td>Pedro Falcon</td>
                  <td>Coorporativo</td>
                  <td>Melanie Sierra</td>
                  <td>25/12/2020</td>
                  <td>19/01/2021</td>
                  <td>Demanda</td>
                  <td>Solicita una cuota de 100 dolares por accidente cometido hacia su hijo</td>
                  <td>El cliente exige una cantidad de dinero por haber traumado a su hijo con un video promocional</td>
                  <td>Finalizado</td>
               </tr>
               <tr>
                  <td>132</td>
                  <td>Noel Carreño</td>
                  <td>Constitucional</td>
                  <td>Emiliana Belda</td>
                  <td>20/12/2020</td>
                  <td>19/02/2021</td>
                  <td>Orden de alejamiento</td>
                  <td>Solicita una orde de alejamiento en contra d su ex-esposo</td>
                  <td>El cliente se encuentra sustado por el acoso a su persona</td>
                  <td>Finalizado</td>
               </tr>
               <tr>
                  <td>133</td>
                  <td>Marcelino Palazon</td>
                  <td>Laboral</td>
                  <td>Jennifer Borras</td>
                  <td>15/02/2020</td>
                  <td>25/06/2020</td>
                  <td>Solicita una orden de alejamiento hacia su jefe y una cuota de 100 por acoso sexual</td>
                  <td>Solicita una orden en contra de su jefe por acoso sexual y una compensacion de 100 dolares por daño emocional</td>
                  <td>El cliente se siente asustada por el acoso a su persona</td>
                  <td>Finalizado</td>
               </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</body>
</main>
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
</html>