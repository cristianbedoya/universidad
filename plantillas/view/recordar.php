
<link rel="stylesheet" type="text/css"  href="<?php echo base_url('extens/css/style.css');?>" />
<script type="text/javascript" src="<?php echo base_url('extens/js/cufon-yui.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('extens/js/arial.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('extens/js/cuf_run.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('extens/js/jquery.min.js');?>"></script>

      <script language="JavaScript">
      $(document).ready(function(){
      $("#formulario").submit(function(e){
        $.ajax({
          url: $(this).attr("action"),
          type: $(this).attr("method"),
          data: $(this).serialize(),
          success: function(data){
            muestra_oculta("respuesta");
            $("#respuesta").html(data);
            console.log(data);
          }
        });
        e.preventDefault();
        return false;
      });
    });
       function muestra_oculta(id) {
                if (document.getElementById) { //se obtiene el id
                    var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
                    el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
                }
            }
            window.onload = function() {/*hace que se cargue la función lo que predetermina que div estará oculto hasta llamar a la función nuevamente*/
        //muestra_oculta('datos');/* "contenido_a_mostrar" es el nombre que le dimos al DIV */
                muestra_oculta('respuesta');
                
            }
</script>



        <title>InfoAcudientes | Estudiante</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/arial.js"></script>
        <script type="text/javascript" src="js/cuf_run.js"></script>
    </head>
<body>
<div class="main">
  <div class="menu_nav">
    <div class="menu_nav_resize">
      <ul>
        
        
        <li><?php echo anchor('home/close','inicio'); ?></li>
        
      </ul>
    <div class="clr"></div>
  </div>
  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <h1><a href="#">Recordar Contraseña</a></h1>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="article">
          <h2>Contraseña</h2>
          <p>Sera enviado un mensaje a su correo con la contraseña</p>
        <?php

        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
      //Salida: Viernes 24 de Febrero del 2012

        ?>


        </div>
        <div class="article">

          <form id="formulario" action="<?php echo base_url("admin/recordar_contra");?>" method="post">
            <ol>
              <li>
                <label for="correo">Correo</label>
                <input id="correo" name="correo" class="text" type="email" required />
              </li>
               <li>
                <input class="boton" type="submit" value="enviar">
                <div class="clr"></div>
              </li>
            </ol>
            <?php
           if($this->uri->segment(1)=="mensaje" and $this->uri->segment(2)=="enviado")
           {
           ?>
            <div class="correcto">El mensaje se envío correctamente</div>
           <?php
           }
           ?>
          </form>
          <div id="respuesta" name="respuesta" class="enviado">
          </div>
        </div>
      </div>
      <div class="sidebar">
        
        

      </div>
      <div class="clr"></div>
    </div>
  </div>
  
</body>
</html>

