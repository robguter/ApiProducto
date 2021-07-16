    
            <div id='mensaje'>
                <div>Satisfactorio</div>
                <p></p>
                <!--<button id='bCrrarM'>Cerrar</button>-->
            </div>
            <div id='error'>
                <div>Error</div>
                <p></p>
                <!--<button id='bCrrarC'>Cerrar</button>-->
            </div>
    <div class="container foot">&nbsp;</div>
    <footer>
    <div class='InfoM'>More information</div>
        <div class="container">
            <div class="row">
                <div class="col-lg-32 text-center">
                    <div class="CpCntP">
                        <div>
                            <ul>
                                <li><a href="http://www.google.co.ve" target="Otro1">Google</a></li>
                                <li><a href="http://www.lawebdelprogramador.com" target="Otro2">La web del programador</a></li>
                                <li><a href="http://www.elguille.com" target="Otro3">El guille</a></li>
                            </ul>
                        </div>
                        <div>
                            <ul>
                                <li><a href="http://cnnespanol.cnn.com/cnnvenezuela/" target="Otro4">CNN Español</a></li>
                                <li><a href="https://www.caracoltv.com/" target="Otro5">Caracol Internacional</a></li>
                                <li><a href="http://www.rctvintl.com/esp/" target="Otro6">RCTV</a></li>
                            </ul>
                        </div>
                        <div>
                            <ul class="Ultima">
                                <li><a href="https://www.facebook.com/robguter" target="otro1"><?php $this->_svg->facebook(); ?></a></li>
                                <li><a href="https://www.instagram.com/robert_gutierrez_gomez" target="otro2"><?php $this->_svg->instagram(); ?></a></li>
                                <li><a href="https://twitter.com/RobertGutierre5" target="otro3"><?php $this->_svg->twitter(); ?></a></li>
                                <li><a href="mailto:robgutgom@gmail.com"><?php $this->_svg->correo(); ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-center">
                    <div class="pie">All rights reserved & copy www.Sisterag.com.ve Copyright &COPY; <?php echo date("Y") . " " . APP_COMPANY; ?> </div>
                </div>
            </div>
        </div>
        <script type='text/javascript' src="<?php echo $_Params['ruta_js'] ?>MiScript.js"></script>
        
            <?php
            
            if (isset($this->_error)) {
                $Contn = $this->_error;
                ?>
                <script>
                    $("#error p").html("<?php echo $Contn;?> <br><p>&nbsp;</p><br>");
                    //var btn1 = document.getElementById('bCrrarC');
                    $("#error").fadeIn(1000);
                    setTimeout(function() {
                        $("#error").fadeOut(3000);
                    },4000);
                </script>
                <?php
            }
            if (isset($this->_mensaje)) {
                $Contn = $this->_mensaje;
                ?>
                <script>
                    var cMens = $("#mensaje");
                    $("#mensaje p").html("<?php echo $Contn;?> <br><p>&nbsp;</p><br>");
                    //var btn1 = document.getElementById('bCrrarM');
                    cMens.fadeIn(1000);
                    alert(cMens.prop("id"));
                    /*setTimeout(function() {
                        $("#mensaje").fadeOut(3000);
                    },4000);*/
                </script>
                <?php
            }
            ?>
            <?php
            echo "
            <script>
                strDir='" . BASE_URL . "';
                strCadE='" . PUBLIC_URLC . "';
            </script>";
            if (isset($_Params["jsg"]) && count($_Params["jsg"])) {
                for ($i = 0; $i < count($_Params["jsg"]); $i++) {
                    echo "<script type='text/javascript' src='" . $_Params['jsg'][$i] . "'></script>";
                }
            }
            ?>
    </footer>
    </body>
</html>