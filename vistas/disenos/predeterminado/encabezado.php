<!DOCTYPE HTML>
<html lang='es'>
    <head>
        <title><?php echo APP_NAME; ?></title>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1' />
        <META content='Robert Gutiérrez, API, PHP, Programación, Apache, Visual, MySQL, JSON, JQuery, CSS, Sisterag, Robert' name='title'>
        <META http-equiv='title' content='Robert Gutiérrez, API, PHP, Programación, Apache, Visual, MySQL, JSON, JQuery, CSS, Sisterag, Robert'>
        <META content='Robert Gutiérrez, API, PHP, Programación, Apache, Visual, MySQL, JSON, JQuery, CSS, Sisterag, Robert' name='description'>
        <META content='Robert Gutiérrez, API, PHP, Programación, Apache, Visual, MySQL, JSON, JQuery, CSS, Sisterag, Robert' name='keywords'>
        <META content='Sisterag 2008' name='copyright'>
        <META content='Ing. Robert Antonio Gutiérrez Gómez' name='AUTHOR'>
        <META name='Author' content='Ing. Robert Antonio Gutiérrez Gómez'>
        <META name='Registro' content='Programación, MySQL'>
        <META name='description' content='Puppies sale, sitios Roberts, redes, mantenimiento y reparación de computadoras'>
        <META name='keywords' content='Robert Gutiérrez, API, PHP, Programación, Apache, Visual, MySQL, JSON, JQuery, CSS, Sisterag, Robert'>
        <META name='title' content='sisterag.com.ve, Made by Robert Gutierrez, Programmer - Analyst'>
        <link rel="icon" type="image/png" href="<?php echo $_Params['ruta_img']; ?>logo.png" />
        <link rel="stylesheet" type="text/css" href="<?php echo $_Params['ruta_css']; ?>bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $_Params['ruta_css']; ?>bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $_Params['ruta_css']; ?>font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $_Params['ruta_css']; ?>jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $_Params['ruta_css']; ?>estiloA.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $_Params['ruta_css']; ?>nav.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $_Params['ruta_css']; ?>normalize.css" />
        <?php
            if (isset($_Params["js"]) && count($_Params["js"])) {
                for ($i = 0; $i < count($_Params["js"]); $i++) {
                    echo "<script type='text/javascript' src='" . $_Params['js'][$i] . "'></script>";
                }
            }
        ?>
    </head>
    <body>
        <header class="page-header">
            <div class="center-contents">
                <div>
                    <a class="logo" href="<?php echo BASE_URL ?>" title=""><img src="<?php echo $_Params['ruta_img']; ?>SRG_F.jpg" ></a>
                    <span class="toggle-nav">Menu</span>
                </div>			
                <nav class="page-nav collapse">
                    <ul>
                        <?php
                        if (isset($_Params["menup"])):
                            for($i = 0;$i < count($_Params["menup"]);$i++):
                                ?>
                                <li><a href="<?php echo $_Params['menup'][$i]['enlace'] ?>" title=""><i class="<?php echo $_Params['menup'][$i]['icono'] ?>" aria-hidden="true"></i><?php echo $_Params['menup'][$i]['titulo'] ?></a></li>
                                <?php
                            endfor;
                        endif;
                        ?>
                        
                        <li class="dropdown drop-account" style="list-style: none;">
                            <a href="#" class="account" style="color:#4E4E4E; font-weight: 200; font-size: 14pt; text-decoration: none;" 
                            class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cuenta <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php
                                    if (isset($_Params["menu"])):
                                        for($i = 0;$i < count($_Params["menu"]);$i++):
                                            ?>
                                            <li><a href="<?php echo $_Params['menu'][$i]['enlace'] ?>"><i class="<?php echo $_Params['menu'][$i]['icono'] ?>" aria-hidden="true"></i><?php echo $_Params['menu'][$i]['titulo'] ?></a></li>
                                            <?php
                                        endfor;
                                    endif;
                                ?>
                            </ul>
                        </li>
                        <?php
                            if ( Session::get('usuario') ) {
                        ?>
                        <li title="My Info"><a href="<?php echo BASE_URL ?>myinfo" title=""><i class="fa fa-user" aria-hidden="true"></i><?php echo ' ' . Session::get('usuario') ?></a></li>
                        <?php
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="row" id='Social'>
            <a href='https://www.facebook.com/robguter' target='face'><img src="<?php echo $_Params['ruta_img']; ?>facebook.svg" /></a>
            <a href='https://twitter.com/RobertGutierre5' target='twit'><img src="<?php echo $_Params['ruta_img']; ?>twitter.svg" /></a>
            <a href='https://www.instagram.com/robert_gutierrez_gomez' target='inst'><img src="<?php echo $_Params['ruta_img']; ?>instagram.svg" /></a>
        </div>