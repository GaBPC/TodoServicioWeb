@extends('layout')

@section('title','Cookies')

@section('navbar-extend')
  <div class="jumbotron" style="background-color:#D50000 ; color: white;">
    <div class="container text-center">
      <h1>Política de cookies</h1>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <h3>Navegar en esta web implicará la aceptación de la política de uso de Cookies</h3>
      <p>Las cookies son una herramienta empleada por los servidores web para almacenar y recuperar información acerca de sus visitantes. Se conforma por un fichero  de archivos pequeños de texto que se descarga en tu computadora o dispositivo al acceder a la página Web para mantener un registro de tus preferencias y recordarlas a su regreso. Las cookies permiten a la página Web, entre otras cosas, almacenar y recuperar información sobre tu número de visitas, los hábitos de navegación del usuario o de su equipo y, dependiendo de la información que contengan y de la forma en que utilice su equipo, pueden utilizarse para reconocer al usuario.</p>
      <p>Las cookies pueden ser "propias", gestionadas por el dominio al que estás accediendo y del que solicitas un determinado servicio o "cookies de terceros" enviados a tu equipo desde un dominio diferente al que se accede</p>
      <p>Todo Servicio utiliza cookies para facilitar el registro y login de usuarios, así como cookies de terceros (Framework Laravel) para la correcta gestión y visualización del contenido</p>
      <p>Google Analytics habilita en el dominio del sitio web las cookies denominadas:</p>
      <ul>
        <li>“__utma”: es necesaria para el funcionamiento de Google Analytics y tiene un período de caducidad de 2 años.</li>
        <li>“__utmz”: es utilizada para realizar la ubicación de la visita, es decir, desde dónde y cómo ha llegado el usuario a nuestra web y caduca a los 6 meses).</li>
      </ul>

      <p>Siempre puedes decidir acerca de la implantación o no, en tu dispositivo, de las cookies empleadas.  Puedes permitir, bloquear o eliminar estas cookies cuando quieras a través de las opciones de configuración de tu dispositivo, así como de tu navegador de internet. En este sentido, para ello deberás configurar tu navegador siguiendo sus instrucciones:</p>
      <ul>
        <li><a href="http://windows.microsoft.com/es-es/windows-vista/block-or-allow-cookies">Internet Explorer</a></li>
        <li><a href="http://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-que-los-sitios-we">Mozilla Firefox</a></li>
        <li><a href="https://support.google.com/chrome/answer/95647?hl=es">Google Chrome</a></li>
        <li><a href="https://support.apple.com/kb/PH21411?viewlocale=es_MX&locale=en_US">Safari</a></li>
        <li><a href="http://support.apple.com/kb/ht1677?viewlocale=es_es">Safari para IOS</a></li>
      </ul>
      <p>Las cookies son esenciales para el funcionamiento de las páginas webs, aportando innumerables ventajas en la prestación de servicios.</p>

      <h3>Más información sobre las cookies:</h3>
      <p>Puede visitar <a href="http://www.aboutcookies.org/">http://www.aboutcookies.org/</a> para leer mas datos acerca de este tema.</p>
      <p>Si desea tener un mayor control sobre la instalación de cookies, puede instalar programas o complementos a su navegador, conocidos como herramientas de “Do Not Track”, que le permitirán escoger aquellas cookies que desea permitir.</p>

      <h3>Advertencia importante sobre las cookies:</h3>
      <p>Teniendo en cuenta la forma en la que funciona Internet y los sitios web, no siempre contamos con información de las cookies que terceras partes puedan utilizar a través de nuestro sitio web.</p>
      <p>Esto se aplica especialmente a casos en los que nuestra página web contiene elementos integrados: es decir, textos, documentos, imágenes o breves películas que se almacenan en otra parte, pero se muestran en nuestro sitio web o a través del mismo. De allí la dificultad de cumplir el reglamento sobre las cookies de manera estricta.</p>
    </div>
  </div>
@endsection
