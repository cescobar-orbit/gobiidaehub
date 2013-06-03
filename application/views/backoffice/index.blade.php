
<!DOCTYPE html>
<html lang="sp">
    <head>
        <test:estilo></test:estilo>
        <meta charset="iso-8859-1">
        <title>EFX</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="EFX Login">
        <meta name="author" content="Excelsys">
        
              {{ HTML::style('css/applications.css');}}
	     {{ Asset::container('bootstrapper')->styles() }}
         {{ Asset::container('bootstrapper')->scripts() }}
       
        

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
          <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="/ico/favicon.ico">
        <change:cambiar>
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
        </change:cambiar>
    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand"></a>
                </div>
            </div>
        </div>
        <div class="container-fluid">  
            <div class="row-fluid">
                <form class="form-horizontal well" id="loginForm" name="loginForm" action="/login.do" method="POST">
                    <legend>Iniciar sesi&oacute;n</legend>
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Usuario</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-user"></i></span>
                                <input type="text" id="inputEmail" placeholder="Usuario" name='j_username'>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputPassword">Contrase�a</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-lock"></i></span>
                                <input type="password" id="inputPassword" placeholder="Contrase�a" name='j_password'>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-primary" name="login" value="Login">Iniciar sesi&oacute;n&raquo;</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row-fluid">
                <div class="span4">
                    <h2>iOS</h2>
                    <p> Descargue la aplicaci�n iOS a trav�s de iTunes AppStore o de TestFlight</p>
                    <p>
                        <a href="https://itunes.apple.com/us/app/excelsys-smartbanking/id562212782?l=es&mt=8">
                            <img alt="App Store" src="img/store-appstore.png" />
                        </a>
                    </p>
                </div><!--/span-->
                <div class="span4">
                    <h2>Blackberry</h2>
                    <p> Sigue este enlace desde tu navegador m�vil para descargar e instalar la aplicaci�n Blackberry</p>
                    <p>
                        <a href="http://appworld.blackberry.com/webstore/content/133266/?lang=en">
                            <img alt="App Store" src="img/store-bbappworld.png" />
                        </a>
                    </p>
                </div><!--/span-->
                <div class="span4">
                    <h2>Android</h2>
                    <p> Sigue este enlace desde tu navegador m�vil para descargar e instalar la aplicaci�n Android</p>
                    <p>
                        <a href="http://play.google.com/store/apps/details?id=net.excelsys.str"> 
                            <img alt="Android app on Google Play" src="http://developer.android.com/images/brand/en_app_rgb_wo_45.png" /> 
                        </a>
                    </p> 
                    <!--     <a href="http://play.google.com/store/apps/details?id=net.excelsys.str" class="btn btn-info">Descargar aplicaci�n para Android &raquo;</a></p> -->
                </div><!--/span-->
            </div><!--/row-->
            <li>{{  HTML::link('backoffice/app/login','Backoffice') }}</li>
            <hr>
            <a href='http://www.excelsys.net' class='footer'></a>
        </div>



    </body>
</html>
