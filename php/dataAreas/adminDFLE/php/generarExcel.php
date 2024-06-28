<?php
    //include 'menu.php';
    include 'menuFinal.php';
?>
<div class="contenedor-padre-GenExcel">
            <div class="contenedor-hijo-GenExcel">
            <form class="nombreExcel" method="POST" action="genExcel1.php">
                    <div class="input-GenExcel">
                        <label for="input" id="labelExcel1">1 DFLE <?php echo(date('Y')) ?> Unid Acad CELEX</label>
                        <input id="input1-GenExcel" type="hidden" name="input1-GenExcel" value="ex1">
                    </div>
                    <div class="btn-GenExcel">
                        <button type="submit">Generar</button>
                    </div>
                </form>
            </div>
            <div class="contenedor-hijo-GenExcel">
                <form class="nombreExcel" method="POST" action="genExcel2.php">
                    <div class="input-GenExcel">
                        <label for="input" id="labelExcel2">2 DFLE <?php echo(date('Y')) ?> IDIOMAS POR NIVEL</label>
                        <input id="input2-GenExcel" type="hidden" value="ex2" name="input2-GenExcel">
                    </div>
                    <div class="btn-GenExcel">
                        <button type="submit">Generar</button>
                    </div>
                </form>
            </div>
            <div class="contenedor-hijo-GenExcel">
                <form class="nombreExcel" method="POST" action="genExcel3.php">
                    <div class="input-GenExcel">
                        <label for="input" id="labelExcel3">3 DFLE <?php echo(date('Y')) ?> ACUMULADO Y COMPARATIVO</label>
                        <input id="input3-GenExcel" type="hidden" name="input3-GenExcel" value="Ex3">
                    </div>
                    <div class="btn-GenExcel">
                        <button type="submit">Generar</button>
                    </div>
                </form> 
            </div>
        </div>
    </body>
</html>