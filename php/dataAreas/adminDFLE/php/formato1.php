<?php

    //include 'menu.php';
    include 'menuFinal.php';
?>
<script src="../scripts/UCelexS.js" async defer></script>
<body>
    <div  id="contpadre">
        <form id="DataCelex" method="post" action="">
            <div id="contheader">
                <select id="SelectNivel" name="selectNivelA">
                    <option disabled selected>Selecciona el Nivel</option>
                    <option value="contDtMS">Media Superior</option>
                    <option value="contDTS">Superior</option>
                    <option value="contDtCI">Centro de Investigación</option>
                    <option value="contDtCVDR">Centro de Vinculación y Desarrollo Regional</option>
                </select>
                <div id="ViewNivel">
                    <span id="resultado">data</span>
                </div>
            </div>
            <div id="contbody">
                <div id="contEncabezado">
                    <div id="ContUA">Unidad Academica</div>
                    <div id="ContUAcelex">Unidades Academicas que cuentas con Celex</div>
                    <div id="SupA">Supervisión Academica al Celex</div>
                    <div id="Total">Total de Supervisiones Realizadas</div>
                    <div id="Trim1">Trim 1</div>
                    <div id="Trim2">Trim 2</div>
                    <div id="Trim3">Trim 3</div>
                    <div id="Trim4">Trim 4</div>
                    <div id="Trim1S">Trim 1</div>
                    <div id="Trim2S">Trim 2</div>
                    <div id="Trim3S">Trim 3</div>
                    <div id="Trim4S">Trim 4</div>
                
                </div>
                <div id="contDtMS" class="contDtMS">
                    <div id="ConCecyt1">CECyT 1</div>
                    <div id="ConCecyt2">CECyT 2</div>
                    <div id="ConCecyt3">CECyT 3</div>
                    <div id="ConCecyt4">CECyT 4</div>
                    <div id="ConCecyt5">CECyT 5</div>
                    <div id="ConCecyt6">CECyT 6</div>
                    <div id="ConCecyt7">CECyT 7</div>
                    <div id="ConCecyt8">CECyT 8</div>
                    <div id="ConCecyt9">CECyT 9</div>
                    <div id="ConCecyt10">CECyT 10</div>
                    <div id="ConCecyt11">CECyT 11</div>
                    <div id="ConCecyt12">CECyT 12</div>
                    <div id="ConCecyt13">CECyT 13</div>
                    <div id="ConCecyt14">CECyT 14</div>
                    <div id="ConCecyt15">CECyT 15</div>
                    <div id="ConCecyt16">CECyT 16</div>
                    <div id="ConCecyt17">CECyT 17</div>
                    <div id="ConCecyt18">CECyT 18</div>
                    <div id="ConCecyt19">CECyT 19</div>
                    <div id="ConCet1">CET 1</div>
                    <div id="Total1">Total</div>

                    <div id="ConCecyt1Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt1Trim1X" value="1"></div>
                    <div id="ConCecyt2Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt2Trim1X" value="1"></div>
                    <div id="ConCecyt3Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt3Trim1X" value="1"></div>
                    <div id="ConCecyt4Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt4Trim1X" value="1"></div>
                    <div id="ConCecyt5Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt5Trim1X" value="1"></div>
                    <div id="ConCecyt6Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt6Trim1X" value="1"></div>
                    <div id="ConCecyt7Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt7Trim1X" value="1"></div>
                    <div id="ConCecyt8Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt8Trim1X" value="1"></div>
                    <div id="ConCecyt9Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt9Trim1X" value="1"></div>
                    <div id="ConCecyt10Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt10Trim1X" value="1"></div>
                    <div id="ConCecyt11Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt11Trim1X" value="1"></div>
                    <div id="ConCecyt12Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt12Trim1X" value="1"></div>
                    <div id="ConCecyt13Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt13Trim1X" value="1"></div>
                    <div id="ConCecyt14Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt14Trim1X" value="1"></div>
                    <div id="ConCecyt15Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt15Trim1X" value="1"></div>
                    <div id="ConCecyt16Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt16Trim1X" value="1"></div>
                    <div id="ConCecyt17Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt17Trim1X" value="1"></div>
                    <div id="ConCecyt18Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt18Trim1X" value="1"></div>
                    <div id="ConCecyt19Trim1" class="Trim1MS"><input type="checkbox" name="Cecyt19Trim1X" value="1"></div>
                    <div id="ConCet1Trim1" class="Trim1MS"><input type="checkbox" name="Cet1Trim1X" value="1"></div>
                    <div id="TotalTrim1" class="Trim1MST" name="TotalTrim1X"></div>
                    
                    <div id="ConCecyt1Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt2Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt2Trim2X" value="1"></div>
                    <div id="ConCecyt3Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt3Trim2X" value="1"></div>
                    <div id="ConCecyt4Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt4Trim2X" value="1"></div>
                    <div id="ConCecyt5Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt5Trim2X" value="1"></div>
                    <div id="ConCecyt6Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt6Trim2X" value="1"></div>
                    <div id="ConCecyt7Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt7Trim2X" value="1"></div>
                    <div id="ConCecyt8Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt8Trim2X" value="1"></div>
                    <div id="ConCecyt9Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt9Trim2X" value="1"></div>
                    <div id="ConCecyt10Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt10Trim2X" value="1"></div>
                    <div id="ConCecyt11Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt11Trim2X" value="1"></div>
                    <div id="ConCecyt12Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt12Trim2X" value="1"></div>
                    <div id="ConCecyt13Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt13Trim2X" value="1"></div>
                    <div id="ConCecyt14Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt14Trim2X" value="1"></div>
                    <div id="ConCecyt15Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt15Trim2X" value="1"></div>
                    <div id="ConCecyt16Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt16Trim2X" value="1"></div>
                    <div id="ConCecyt17Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt17Trim2X" value="1"></div>
                    <div id="ConCecyt18Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt18Trim2X" value="1"></div>
                    <div id="ConCecyt19Trim2" class="Trim2MS"><input type="checkbox" name="Cecyt19Trim2X" value="1"></div>
                    <div id="ConCet1Trim2" class="Trim2MS"><input type="checkbox" name="Cet1Trim2X" value="1"></div>
                    <div id="TotalTrim2" class="Trim2MST" name="TotalTrim2X"></div>
                    
                    <div id="ConCecyt1Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt1Trim3X" value="1"></div>
                    <div id="ConCecyt2Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt2Trim3X" value="1"></div>
                    <div id="ConCecyt3Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt3Trim3X" value="1"></div>
                    <div id="ConCecyt4Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt4Trim3X" value="1"></div>
                    <div id="ConCecyt5Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt5Trim3X" value="1"></div>
                    <div id="ConCecyt6Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt6Trim3X" value="1"></div>
                    <div id="ConCecyt7Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt7Trim3X" value="1"></div>
                    <div id="ConCecyt8Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt8Trim3X" value="1"></div>
                    <div id="ConCecyt9Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt9Trim3X" value="1"></div>
                    <div id="ConCecyt10Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt10Trim3X" value="1"></div>
                    <div id="ConCecyt11Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt11Trim3X" value="1"></div>
                    <div id="ConCecyt12Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt12Trim3X" value="1"></div>
                    <div id="ConCecyt13Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt13Trim3X" value="1"></div>
                    <div id="ConCecyt14Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt14Trim3X" value="1"></div>
                    <div id="ConCecyt15Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt15Trim3X" value="1"></div>
                    <div id="ConCecyt16Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt16Trim3X" value="1"></div>
                    <div id="ConCecyt17Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt17Trim3X" value="1"></div>
                    <div id="ConCecyt18Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt18Trim3X" value="1"></div>
                    <div id="ConCecyt19Trim3" class="Trim3MS"><input type="checkbox" name="Cecyt19Trim3X" value="1"></div>
                    <div id="ConCet1Trim3" class="Trim3MS"><input type="checkbox" name="Cet1Trim3X" value="1"></div>
                    <div id="TotalTrim3" class="Trim3MST" name="Cet1Trim3X"></div>
                    
                    <div id="ConCecyt1Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt1Trim4X" value="1"></div>
                    <div id="ConCecyt2Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt2Trim4X" value="1"></div>
                    <div id="ConCecyt3Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt3Trim4X" value="1"></div>
                    <div id="ConCecyt4Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt4Trim4X" value="1"></div>
                    <div id="ConCecyt5Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt5Trim4X" value="1"></div>
                    <div id="ConCecyt6Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt6Trim4X" value="1"></div>
                    <div id="ConCecyt7Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt7Trim4X" value="1"></div>
                    <div id="ConCecyt8Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt8Trim4X" value="1"></div>
                    <div id="ConCecyt9Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt9Trim4X" value="1"></div>
                    <div id="ConCecyt10Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt10Trim4X" value="1"></div>
                    <div id="ConCecyt11Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt11Trim4X" value="1"></div>
                    <div id="ConCecyt12Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt12Trim4X" value="1"></div>
                    <div id="ConCecyt13Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt13Trim4X" value="1"></div>
                    <div id="ConCecyt14Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt14Trim4X" value="1"></div>
                    <div id="ConCecyt15Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt15Trim4X" value="1"></div>
                    <div id="ConCecyt16Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt16Trim4X" value="1"></div>
                    <div id="ConCecyt17Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt17Trim4X" value="1"></div>
                    <div id="ConCecyt18Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt18Trim4X" value="1"></div>
                    <div id="ConCecyt19Trim4" class="Trim4MS"><input type="checkbox" name="Cecyt19Trim4X" value="1"></div>
                    <div id="ConCet1Trim4" class="Trim4MS"><input type="checkbox" name="Cet1Trim4X" value="1"></div>
                    <div id="TotalTrim4" class="Trim4MST" name="TotalTrim4X"></div>
                    
                    <div id="ConCecyt1Trim1S" class="Trim1SMS SumMDS1"><input type="checkbox" name="Cecyt1Trim1SX" value="1"></div>
                    <div id="ConCecyt2Trim1S" class="Trim1SMS SumMDS2"><input type="checkbox" name="Cecyt2Trim1SX" value="1"></div>
                    <div id="ConCecyt3Trim1S" class="Trim1SMS SumMDS3"><input type="checkbox" name="Cecyt3Trim1SX" value="1"></div>
                    <div id="ConCecyt4Trim1S" class="Trim1SMS SumMDS4"><input type="checkbox" name="Cecyt4Trim1SX" value="1"></div>
                    <div id="ConCecyt5Trim1S" class="Trim1SMS SumMDS5"><input type="checkbox" name="Cecyt5Trim1SX" value="1"></div>
                    <div id="ConCecyt6Trim1S" class="Trim1SMS SumMDS6"><input type="checkbox" name="Cecyt6Trim1SX" value="1"></div>
                    <div id="ConCecyt7Trim1S" class="Trim1SMS SumMDS7"><input type="checkbox" name="Cecyt7Trim1SX" value="1"></div>
                    <div id="ConCecyt8Trim1S" class="Trim1SMS SumMDS8"><input type="checkbox" name="Cecyt8Trim1SX" value="1"></div>
                    <div id="ConCecyt9Trim1S" class="Trim1SMS SumMDS9"><input type="checkbox" name="Cecyt9Trim1SX" value="1"></div>
                    <div id="ConCecyt10Trim1S" class="Trim1SMS SumMDS10"><input type="checkbox" name="Cecyt10Trim1SX" value="1"></div>
                    <div id="ConCecyt11Trim1S" class="Trim1SMS SumMDS11"><input type="checkbox" name="Cecyt11Trim1SX" value="1"></div>
                    <div id="ConCecyt12Trim1S" class="Trim1SMS SumMDS12"><input type="checkbox" name="Cecyt12Trim1SX" value="1"></div>
                    <div id="ConCecyt13Trim1S" class="Trim1SMS SumMDS13"><input type="checkbox" name="Cecyt13Trim1SX" value="1"></div>
                    <div id="ConCecyt14Trim1S" class="Trim1SMS SumMDS14"><input type="checkbox" name="Cecyt14Trim1SX" value="1"></div>
                    <div id="ConCecyt15Trim1S" class="Trim1SMS SumMDS15"><input type="checkbox" name="Cecyt15Trim1SX" value="1"></div>
                    <div id="ConCecyt16Trim1S" class="Trim1SMS SumMDS16"><input type="checkbox" name="Cecyt16Trim1SX" value="1"></div>
                    <div id="ConCecyt17Trim1S" class="Trim1SMS SumMDS17"><input type="checkbox" name="Cecyt17Trim1SX" value="1"></div>
                    <div id="ConCecyt18Trim1S" class="Trim1SMS SumMDS18"><input type="checkbox" name="Cecyt18Trim1SX" value="1"></div>
                    <div id="ConCecyt19Trim1S" class="Trim1SMS SumMDS19"><input type="checkbox" name="Cecyt19Trim1SX" value="1"></div>
                    <div id="ConCet1Trim1S" class="Trim1SMS SumCetMDS1"><input type="checkbox" name="Cet1Trim1SX" value="1"></div>
                    <div id="TotalTrim1S" class="Trim1SMST" name="TotalTrim1SX"></div>
                    
                    <div id="ConCecyt1Trim2S" class="Trim2SMS SumMDS1"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt2Trim2S" class="Trim2SMS SumMDS2"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt3Trim2S" class="Trim2SMS SumMDS3"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt4Trim2S" class="Trim2SMS SumMDS4"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt5Trim2S" class="Trim2SMS SumMDS5"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt6Trim2S" class="Trim2SMS SumMDS6"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt7Trim2S" class="Trim2SMS SumMDS7"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt8Trim2S" class="Trim2SMS SumMDS8"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt9Trim2S" class="Trim2SMS SumMDS9"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt10Trim2S" class="Trim2SMS SumMDS10"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt11Trim2S" class="Trim2SMS SumMDS11"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt12Trim2S" class="Trim2SMS SumMDS12"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt13Trim2S" class="Trim2SMS SumMDS13"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt14Trim2S" class="Trim2SMS SumMDS14"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt15Trim2S" class="Trim2SMS SumMDS15"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt16Trim2S" class="Trim2SMS SumMDS16"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt17Trim2S" class="Trim2SMS SumMDS17"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt18Trim2S" class="Trim2SMS SumMDS18"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCecyt19Trim2S" class="Trim2SMS SumMDS19"><input type="checkbox" name="Cecyt1Trim2SX" value="1"></div>
                    <div id="ConCet1Trim2S" class="Trim2SMS SumCetMDS1"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="TotalTrim2S" class="Trim2SMST" name="Cecyt1Trim2X"></div>
                    
                    <div id="ConCecyt1Trim3S" class="Trim3SMS SumMDS1"><input type="checkbox" name="Cecyt1Trim3SX" value="1"></div>
                    <div id="ConCecyt2Trim3S" class="Trim3SMS SumMDS2"><input type="checkbox" name="Cecyt2Trim3SX" value="1"></div>
                    <div id="ConCecyt3Trim3S" class="Trim3SMS SumMDS3"><input type="checkbox" name="Cecyt3Trim3SX" value="1"></div>
                    <div id="ConCecyt4Trim3S" class="Trim3SMS SumMDS4"><input type="checkbox" name="Cecyt4Trim3SX" value="1"></div>
                    <div id="ConCecyt5Trim3S" class="Trim3SMS SumMDS5"><input type="checkbox" name="Cecyt5Trim3SX" value="1"></div>
                    <div id="ConCecyt6Trim3S" class="Trim3SMS SumMDS6"><input type="checkbox" name="Cecyt6Trim3SX" value="1"></div>
                    <div id="ConCecyt7Trim3S" class="Trim3SMS SumMDS7"><input type="checkbox" name="Cecyt7Trim3SX" value="1"></div>
                    <div id="ConCecyt8Trim3S" class="Trim3SMS SumMDS8"><input type="checkbox" name="Cecyt8Trim3SX" value="1"></div>
                    <div id="ConCecyt9Trim3S" class="Trim3SMS SumMDS9"><input type="checkbox" name="Cecyt9Trim3SX" value="1"></div>
                    <div id="ConCecyt10Trim3S" class="Trim3SMS SumMDS10"><input type="checkbox" name="Cecyt10Trim3SX" value="1"></div>
                    <div id="ConCecyt11Trim3S" class="Trim3SMS SumMDS11"><input type="checkbox" name="Cecyt11Trim3SX" value="1"></div>
                    <div id="ConCecyt12Trim3S" class="Trim3SMS SumMDS12"><input type="checkbox" name="Cecyt12Trim3SX" value="1"></div>
                    <div id="ConCecyt13Trim3S" class="Trim3SMS SumMDS13"><input type="checkbox" name="Cecyt13Trim3SX" value="1"></div>
                    <div id="ConCecyt14Trim3S" class="Trim3SMS SumMDS14"><input type="checkbox" name="Cecyt14Trim3SX" value="1"></div>
                    <div id="ConCecyt15Trim3S" class="Trim3SMS SumMDS15"><input type="checkbox" name="Cecyt15Trim3SX" value="1"></div>
                    <div id="ConCecyt16Trim3S" class="Trim3SMS SumMDS16"><input type="checkbox" name="Cecyt16Trim3SX" value="1"></div>
                    <div id="ConCecyt17Trim3S" class="Trim3SMS SumMDS17"><input type="checkbox" name="Cecyt17Trim3SX" value="1"></div>
                    <div id="ConCecyt18Trim3S" class="Trim3SMS SumMDS18"><input type="checkbox" name="Cecyt18Trim3SX" value="1"></div>
                    <div id="ConCecyt19Trim3S" class="Trim3SMS SumMDS19"><input type="checkbox" name="Cecyt19Trim3SX" value="1"></div>
                    <div id="ConCet1Trim3S" class="Trim3SMS SumCetMDS1"><input type="checkbox" name="Cet1Trim3SX" value="1"></div>
                    <div id="TotalTrim3S" class="Trim3SMST" name="TotalTrim3SX"></div>
                    
                    <div id="ConCecyt1Trim4S" class="Trim4SMS SumMDS1"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt2Trim4S" class="Trim4SMS SumMDS2"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt3Trim4S" class="Trim4SMS SumMDS3"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt4Trim4S" class="Trim4SMS SumMDS4"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt5Trim4S" class="Trim4SMS SumMDS5"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt6Trim4S" class="Trim4SMS SumMDS6"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt7Trim4S" class="Trim4SMS SumMDS7"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt8Trim4S" class="Trim4SMS SumMDS8"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt9Trim4S" class="Trim4SMS SumMDS9"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt10Trim4S" class="Trim4SMS SumMDS10"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt11Trim4S" class="Trim4SMS SumMDS11"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt12Trim4S" class="Trim4SMS SumMDS12"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt13Trim4S" class="Trim4SMS SumMDS13"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt14Trim4S" class="Trim4SMS SumMDS14"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt15Trim4S" class="Trim4SMS SumMDS15"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt16Trim4S" class="Trim4SMS SumMDS16"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt17Trim4S" class="Trim4SMS SumMDS17"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt18Trim4S" class="Trim4SMS SumMDS18"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCecyt19Trim4S" class="Trim4SMS SumMDS19"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="ConCet1Trim4S" class="Trim4SMS SumCetMDS1"><input type="checkbox" name="Cecyt1Trim2X" value="1"></div>
                    <div id="TotalTrim4S" class="Trim4SMST" name="Cecyt1Trim2X"></div>
                    
                    <div id="ConCecyt1T" class="TotalCecyt1" name="Cecyt1TX"></div>
                    <div id="ConCecyt2T" class="TotalCecyt2" name="Cecyt2TX"></div>
                    <div id="ConCecyt3T" class="TotalCecyt3" name="Cecyt3TX"></div>
                    <div id="ConCecyt4T" class="TotalCecyt4" name="Cecyt4TX"></div>
                    <div id="ConCecyt5T" class="TotalCecyt5" name="Cecyt5TX"></div>
                    <div id="ConCecyt6T" class="TotalCecyt6" name="Cecyt6TX"></div>
                    <div id="ConCecyt7T" class="TotalCecyt7" name="Cecyt7TX"></div>
                    <div id="ConCecyt8T" class="TotalCecyt8" name="Cecyt8TX"></div>
                    <div id="ConCecyt9T" class="TotalCecyt9" name="Cecyt9TX"></div>
                    <div id="ConCecyt10T" class="TotalCecyt10" name="Cecyt10TX"></div>
                    <div id="ConCecyt11T" class="TotalCecyt11" name="Cecyt11TX"></div>
                    <div id="ConCecyt12T" class="TotalCecyt12" name="Cecyt12TX"></div>
                    <div id="ConCecyt13T" class="TotalCecyt13" name="Cecyt13TX"></div>
                    <div id="ConCecyt14T" class="TotalCecyt14" name="Cecyt14TX"></div>
                    <div id="ConCecyt15T" class="TotalCecyt15" name="Cecyt15TX"></div>
                    <div id="ConCecyt16T" class="TotalCecyt16" name="Cecyt16TX"></div>
                    <div id="ConCecyt17T" class="TotalCecyt17" name="Cecyt17TX"></div>
                    <div id="ConCecyt18T" class="TotalCecyt18" name="Cecyt18TX"></div>
                    <div id="ConCecyt19T" class="TotalCecyt19" name="Cecyt19TX"></div>
                    <div id="ConCet1T" class="TotalCet1" name="Cet1TX"></div>
                    <div id="Total1T" class="TotalMDT" name="Total1TX"></div>
                </div>
                <div id="contDTS" class="contDTS" style="display: none;">
                    <div id="ConCICSma">CICS Milpa Alta</div>
                    <div id="ConCICSst">CICS Santo Tomas</div>
                    <div id="ConENBA">ENBA</div>
                    <div id="ConENCB">ENCB</div>
                    <div id="ConENMH">ENMH</div>
                    <div id="ConESCAst">ESCA Santo Tomás</div>
                    <div id="ConESCAt">ESCA Tepepan</div>
                    <div id="ConESCOM">ESCOM</div>
                    <div id="ConESE">ESE</div>
                    <div id="ConESEO">ESEO</div>
                    <div id="ConESFEM">ESFEM</div>
                    <div id="ConESIAtec">ESIA Tecamaclaco</div>
                    <div id="ConESIAt">ESIA Ticoman</div>
                    <div id="ConESIAz">ESIA Zacatenco</div>
                    <div id="ConESIMEa">ESIME Azcapotzalco</div>
                    <div id="ConESIMEc">ESIME Culhuacan</div>
                    <div id="ConEsimet">ESIME Ticomán</div>
                    <div id="ConESIMEz">ESIME Zacatenco</div>
                    <div id="ConESIQUIE">ESIQUIE</div>
                    <div id="ConESIT">ESIT</div>
                    <div id="ConESM">ESM</div>
                    <div id="ConEST">EST</div>
                    <div id="ConUPIBI">UPIBI</div>
                    <div id="ConUPIEM">UPIEM</div>
                    <div id="ConUPIIC">UPIIC</div>
                    <div id="ConUPIICSA">UPIICSA</div>
                    <div id="ConUPIIG">UPIIG</div>
                    <div id="ConUPIIH">UPIIH</div>
                    <div id="ConUPIIP">UPIIP</div>
                    <div id="ConUPIIT">UPIIT</div>
                    <div id="ConUPIITA">UPIITA</div>
                    <div id="ConUPIIZ">UPIIZ</div>
                    <div id="Total2">Total</div>
                
                    
                    <div id="ConCICSmaTrim1" class="Trim1S"><input type="checkbox" name="CICSmaTrim1X" value="1"></div>
                    <div id="ConCICSstTrim1" class="Trim1S"><input type="checkbox" name="CICSstTrim1X" value="1"></div>
                    <div id="ConENBATrim1" class="Trim1S"><input type="checkbox" name="ENBATrim1X" value="1"></div>
                    <div id="ConENCBTrim1" class="Trim1S"><input type="checkbox" name="ENCBTrim1X" value="1"></div>
                    <div id="ConENMHTrim1" class="Trim1S"><input type="checkbox" name="ENMHTrim1X" value="1"></div>
                    <div id="ConESCAstTrim1" class="Trim1S"><input type="checkbox" name="ESCAstTrim1X" value="1"></div>
                    <div id="ConESCAtTrim1" class="Trim1S"><input type="checkbox" name="ESCAtTrim1X" value="1"></div>
                    <div id="ConESCOMTrim1" class="Trim1S"><input type="checkbox" name="ESCOMTrim1X" value="1"></div>
                    <div id="ConESETrim1" class="Trim1S"><input type="checkbox" name="ESETrim1X" value="1"></div>
                    <div id="ConESEOTrim1" class="Trim1S"><input type="checkbox" name="ESEOTrim1X" value="1"></div>
                    <div id="ConESFEMTrim1" class="Trim1S"><input type="checkbox" name="ESFEMTrim1X" value="1"></div>
                    <div id="ConESIAtecTrim1" class="Trim1S"><input type="checkbox" name="ESIAtecTrim1X" value="1"></div>
                    <div id="ConESIAtTrim1" class="Trim1S"><input type="checkbox" name="ESIAtTrim1X" value="1"></div>
                    <div id="ConESIAzTrim1" class="Trim1S"><input type="checkbox" name="ESIAzTrim1X" value="1"></div>
                    <div id="ConESIMEaTrim1" class="Trim1S"><input type="checkbox" name="ESIMEaTrim1X" value="1"></div>
                    <div id="ConESIMEcTrim1" class="Trim1S"><input type="checkbox" name="ESIMEcTrim1X" value="1"></div>
                    <div id="ConESIMEtTrim1" class="Trim1S"><input type="checkbox" name="ESIMEtTrim1X" value="1"></div>
                    <div id="ConESIMEzTrim1" class="Trim1S"><input type="checkbox" name="ESIMEzTrim1X" value="1"></div>
                    <div id="ConESIQUIETrim1" class="Trim1S"><input type="checkbox" name="ESIQUIETrim1X" value="1"></div>
                    <div id="ConESITTrim1" class="Trim1S"><input type="checkbox" name="ESITTrim1X" value="1"></div>
                    <div id="ConConESMTrim1" class="Trim1S"><input type="checkbox" name="ConESMTrim1X" value="1"></div>
                    <div id="ConESTTrim1" class="Trim1S"><input type="checkbox" name="ESTTrim1X" value="1"></div>
                    <div id="ConUPIBITrim1" class="Trim1S"><input type="checkbox" name="UPIBITrim1X" value="1"></div>
                    <div id="ConUPIEMTrim1" class="Trim1S"><input type="checkbox" name="UPIEMTrim1X" value="1"></div>
                    <div id="ConUPIICTrim1" class="Trim1S"><input type="checkbox" name="UPIICTrim1X" value="1"></div>
                    <div id="ConUPIICSATrim1" class="Trim1S"><input type="checkbox" name="UPIICSATrim1X" value="1"></div>
                    <div id="ConUPIIGTrim1" class="Trim1S"><input type="checkbox" name="UPIIGTrim1X" value="1"></div>
                    <div id="ConUPIIHTrim1" class="Trim1S"><input type="checkbox" name="UPIIHTrim1X" value="1"></div>
                    <div id="ConUPIIPTrim1" class="Trim1S"><input type="checkbox" name="UPIIPTrim1X" value="1"></div>
                    <div id="ConUPIITTrim1" class="Trim1S"><input type="checkbox" name="UPIITTrim1X" value="1"></div>
                    <div id="ConUPIITATrim1" class="Trim1S"><input type="checkbox" name="UPIITATrim1X" value="1"></div>
                    <div id="ConUPIIZTrim1" class="Trim1S"><input type="checkbox" name="UPIIZTrim1X" value="1"></div>
                    <div id="Total2Trim1" class="Trim1ST" name="Total2Trim1X"></div>
                    
                    <div id="ConCICSmaTrim2" class="Trim2S"><input type="checkbox" name="CICSmaTrim2X" value="1"></div>
                    <div id="ConCICSstTrim2" class="Trim2S"><input type="checkbox" name="CICSstTrim2X" value="1"></div>
                    <div id="ConENBATrim2" class="Trim2S"><input type="checkbox" name="ENBATrim2X" value="1"></div>
                    <div id="ConENCBTrim2" class="Trim2S"><input type="checkbox" name="ENCBTrim2X" value="1"></div>
                    <div id="ConENMHTrim2" class="Trim2S"><input type="checkbox" name="ENMHTrim2X" value="1"></div>
                    <div id="ConESCAstTrim2" class="Trim2S"><input type="checkbox" name="ESCAstTrim2X" value="1"></div>
                    <div id="ConESCAtTrim2" class="Trim2S"><input type="checkbox" name="ESCAtTrim2X" value="1"></div>
                    <div id="ConESCOMTrim2" class="Trim2S"><input type="checkbox" name="ESCOMTrim2X" value="1"></div>
                    <div id="ConESETrim2" class="Trim2S"><input type="checkbox" name="ESETrim2X" value="1"></div>
                    <div id="ConESEOTrim2" class="Trim2S"><input type="checkbox" name="ESEOTrim2X" value="1"></div>
                    <div id="ConESFEMTrim2" class="Trim2S"><input type="checkbox" name="ESFEMTrim2X" value="1"></div>
                    <div id="ConESIAtecTrim2" class="Trim2S"><input type="checkbox" name="ESIAtecTrim2X" value="1"></div>
                    <div id="ConESIAtTrim2" class="Trim2S"><input type="checkbox" name="ESIAtTrim2X" value="1"></div>
                    <div id="ConESIAzTrim2" class="Trim2S"><input type="checkbox" name="ESIAzTrim2X" value="1"></div>
                    <div id="ConESIMEaTrim2" class="Trim2S"><input type="checkbox" name="ESIMEaTrim2X" value="1"></div>
                    <div id="ConESIMEcTrim2" class="Trim2S"><input type="checkbox" name="ESIMEcTrim2X" value="1"></div>
                    <div id="ConESIMEtTrim2" class="Trim2S"><input type="checkbox" name="ESIMEtTrim2X" value="1"></div>
                    <div id="ConESIMEzTrim2" class="Trim2S"><input type="checkbox" name="ESIMEzTrim2X" value="1"></div>
                    <div id="ConESIQUIETrim2" class="Trim2S"><input type="checkbox" name="ESIQUIETrim2X" value="1"></div>
                    <div id="ConESITTrim2" class="Trim2S"><input type="checkbox" name="ESITTrim2X" value="1"></div>
                    <div id="ConConESMTrim2" class="Trim2S"><input type="checkbox" name="ConESMTrim2X" value="1"></div>
                    <div id="ConESTTrim2" class="Trim2S"><input type="checkbox" name="ESTTrim2X" value="1"></div>
                    <div id="ConUPIBITrim2" class="Trim2S"><input type="checkbox" name="UPIBITrim2X" value="1"></div>
                    <div id="ConUPIEMTrim2" class="Trim2S"><input type="checkbox" name="UPIEMTrim2X" value="1"></div>
                    <div id="ConUPIICTrim2" class="Trim2S"><input type="checkbox" name="UPIICTrim2X" value="1"></div>
                    <div id="ConUPIICSATrim2" class="Trim2S"><input type="checkbox" name="UPIICSATrim2X" value="1"></div>
                    <div id="ConUPIIGTrim2" class="Trim2S"><input type="checkbox" name="UPIIGTrim2X" value="1"></div>
                    <div id="ConUPIIHTrim2" class="Trim2S"><input type="checkbox" name="UPIIHTrim2X" value="1"></div>
                    <div id="ConUPIIPTrim2" class="Trim2S"><input type="checkbox" name="UPIIPTrim2X" value="1"></div>
                    <div id="ConUPIITTrim2" class="Trim2S"><input type="checkbox" name="UPIITTrim2X" value="1"></div>
                    <div id="ConUPIITATrim2" class="Trim2S"><input type="checkbox" name="UPIITATrim2X" value="1"></div>
                    <div id="ConUPIIZTrim2" class="Trim2S"><input type="checkbox" name="UPIIZTrim2X" value="1"></div>
                    <div id="Total2Trim2" class="Trim2ST" name="Total2Trim2X"></div>
                    
                    <div id="ConCICSmaTrim3" class="Trim3S"><input type="checkbox" name="CICSmaTrim3X" value="1"></div>
                    <div id="ConCICSstTrim3" class="Trim3S"><input type="checkbox" name="CICSstTrim3X" value="1"></div>
                    <div id="ConENBATrim3" class="Trim3S"><input type="checkbox" name="ENBATrim3X" value="1"></div>
                    <div id="ConENCBTrim3" class="Trim3S"><input type="checkbox" name="ENCBTrim3X" value="1"></div>
                    <div id="ConENMHTrim3" class="Trim3S"><input type="checkbox" name="ENMHTrim3X" value="1"></div>
                    <div id="ConESCAstTrim3" class="Trim3S"><input type="checkbox" name="ESCAstTrim3X" value="1"></div>
                    <div id="ConESCAtTrim3" class="Trim3S"><input type="checkbox" name="ESCAtTrim3X" value="1"></div>
                    <div id="ConESCOMTrim3" class="Trim3S"><input type="checkbox" name="ESCOMTrim3X" value="1"></div>
                    <div id="ConESETrim3" class="Trim3S"><input type="checkbox" name="ESETrim3X" value="1"></div>
                    <div id="ConESEOTrim3" class="Trim3S"><input type="checkbox" name="ESEOTrim3X" value="1"></div>
                    <div id="ConESFEMTrim3" class="Trim3S"><input type="checkbox" name="ESFEMTrim3X" value="1"></div>
                    <div id="ConESIAtecTrim3" class="Trim3S"><input type="checkbox" name="ESIAtecTrim3X" value="1"></div>
                    <div id="ConESIAtTrim3" class="Trim3S"><input type="checkbox" name="ESIAtTrim3X" value="1"></div>
                    <div id="ConESIAzTrim3" class="Trim3S"><input type="checkbox" name="ESIAzTrim3X" value="1"></div>
                    <div id="ConESIMEaTrim3" class="Trim3S"><input type="checkbox" name="ESIMEaTrim3X" value="1"></div>
                    <div id="ConESIMEcTrim3" class="Trim3S"><input type="checkbox" name="ESIMEcTrim3X" value="1"></div>
                    <div id="ConESIMEtTrim3" class="Trim3S"><input type="checkbox" name="ESIMEtTrim3X" value="1"></div>
                    <div id="ConESIMEzTrim3" class="Trim3S"><input type="checkbox" name="ESIMEzTrim3X" value="1"></div>
                    <div id="ConESIQUIETrim3" class="Trim3S"><input type="checkbox" name="ESIQUIETrim3X" value="1"></div>
                    <div id="ConESITTrim3" class="Trim3S"><input type="checkbox" name="ESITTrim3X" value="1"></div>
                    <div id="ConConESMTrim3" class="Trim3S"><input type="checkbox" name="ConESMTrim3X" value="1"></div>
                    <div id="ConESTTrim3" class="Trim3S"><input type="checkbox" name="ESTTrim3X" value="1"></div>
                    <div id="ConUPIBITrim3" class="Trim3S"><input type="checkbox" name="UPIBITrim3X" value="1"></div>
                    <div id="ConUPIEMTrim3" class="Trim3S"><input type="checkbox" name="UPIEMTrim3X" value="1"></div>
                    <div id="ConUPIICTrim3" class="Trim3S"><input type="checkbox" name="UPIICTrim3X" value="1"></div>
                    <div id="ConUPIICSATrim3" class="Trim3S"><input type="checkbox" name="UPIICSATrim3X" value="1"></div>
                    <div id="ConUPIIGTrim3" class="Trim3S"><input type="checkbox" name="UPIIGTrim3X" value="1"></div>
                    <div id="ConUPIIHTrim3" class="Trim3S"><input type="checkbox" name="UPIIHTrim3X" value="1"></div>
                    <div id="ConUPIIPTrim3" class="Trim3S"><input type="checkbox" name="UPIIPTrim3X" value="1"></div>
                    <div id="ConUPIITTrim3" class="Trim3S"><input type="checkbox" name="UPIITTrim3X" value="1"></div>
                    <div id="ConUPIITATrim3" class="Trim3S"><input type="checkbox" name="UPIITATrim3X" value="1"></div>
                    <div id="ConUPIIZTrim3" class="Trim3S"><input type="checkbox" name="UPIIZTrim3X" value="1"></div>
                    <div id="Total2Trim3" class="Trim3ST" name="Total2Trim3X"></div>
                
                    <div id="ConCICSmaTrim4" class="Trim4S"><input type="checkbox" name="CICSmaTrim4X" value="1"></div>
                    <div id="ConCICSstTrim4" class="Trim4S"><input type="checkbox" name="CICSstTrim4X" value="1"></div>
                    <div id="ConENBATrim4" class="Trim4S"><input type="checkbox" name="ENBATrim4X" value="1"></div>
                    <div id="ConENCBTrim4" class="Trim4S"><input type="checkbox" name="ENCBTrim4X" value="1"></div>
                    <div id="ConENMHTrim4" class="Trim4S"><input type="checkbox" name="ENMHTrim4X" value="1"></div>
                    <div id="ConESCAstTrim4" class="Trim4S"><input type="checkbox" name="ESCAstTrim4X" value="1"></div>
                    <div id="ConESCAtTrim4" class="Trim4S"><input type="checkbox" name="ESCAtTrim4X" value="1"></div>
                    <div id="ConESCOMTrim4" class="Trim4S"><input type="checkbox" name="ESCOMTrim4X" value="1"></div>
                    <div id="ConESETrim4" class="Trim4S"><input type="checkbox" name="ESETrim4X" value="1"></div>
                    <div id="ConESEOTrim4" class="Trim4S"><input type="checkbox" name="ESEOTrim4X" value="1"></div>
                    <div id="ConESFEMTrim4" class="Trim4S"><input type="checkbox" name="ESFEMTrim4X" value="1"></div>
                    <div id="ConESIAtecTrim4" class="Trim4S"><input type="checkbox" name="ESIAtecTrim4X" value="1"></div>
                    <div id="ConESIAtTrim4" class="Trim4S"><input type="checkbox" name="ESIAtTrim4X" value="1"></div>
                    <div id="ConESIAzTrim4" class="Trim4S"><input type="checkbox" name="ESIAzTrim4X" value="1"></div>
                    <div id="ConESIMEaTrim4" class="Trim4S"><input type="checkbox" name="ESIMEaTrim4X" value="1"></div>
                    <div id="ConESIMEcTrim4" class="Trim4S"><input type="checkbox" name="ESIMEcTrim4X" value="1"></div>
                    <div id="ConESIMEtTrim4" class="Trim4S"><input type="checkbox" name="ESIMEtTrim4X" value="1"></div>
                    <div id="ConESIMEzTrim4" class="Trim4S"><input type="checkbox" name="ESIMEzTrim4X" value="1"></div>
                    <div id="ConESIQUIETrim4" class="Trim4S"><input type="checkbox" name="ESIQUIETrim4X" value="1"></div>
                    <div id="ConESITTrim4" class="Trim4S"><input type="checkbox" name="ESITTrim4X" value="1"></div>
                    <div id="ConConESMTrim4" class="Trim4S"><input type="checkbox" name="ConESMTrim4X" value="1"></div>
                    <div id="ConESTTrim4" class="Trim4S"><input type="checkbox" name="ESTTrim4X" value="1"></div>
                    <div id="ConUPIBITrim4" class="Trim4S"><input type="checkbox" name="UPIBITrim4X" value="1"></div>
                    <div id="ConUPIEMTrim4" class="Trim4S"><input type="checkbox" name="UPIEMTrim4X" value="1"></div>
                    <div id="ConUPIICTrim4" class="Trim4S"><input type="checkbox" name="UPIICTrim4X" value="1"></div>
                    <div id="ConUPIICSATrim4" class="Trim4S"><input type="checkbox" name="UPIICSATrim4X" value="1"></div>
                    <div id="ConUPIIGTrim4" class="Trim4S"><input type="checkbox" name="UPIIGTrim4X" value="1"></div>
                    <div id="ConUPIIHTrim4" class="Trim4S"><input type="checkbox" name="UPIIHTrim4X" value="1"></div>
                    <div id="ConUPIIPTrim4" class="Trim4S"><input type="checkbox" name="UPIIPTrim4X" value="1"></div>
                    <div id="ConUPIITTrim4" class="Trim4S"><input type="checkbox" name="UPIITTrim4X" value="1"></div>
                    <div id="ConUPIITATrim4" class="Trim4S"><input type="checkbox" name="UPIITATrim4X" value="1"></div>
                    <div id="ConUPIIZTrim4" class="Trim4S"><input type="checkbox" name="UPIIZTrim4X" value="1"></div>
                    <div id="Total2Trim4" class="Trim4ST" name="Total2Trim4X"></div>
                    
                    <div id="ConCICSmaTrim1S" class="Trim1SS SumSS1"><input type="checkbox" name="CICSmaTrim1SX" value="1"></div>
                    <div id="ConCICSstTrim1S" class="Trim1SS SumSS2"><input type="checkbox" name="CICSstTrim1SX" value="1"></div>
                    <div id="ConENBATrim1S" class="Trim1SS SumSS3"><input type="checkbox" name="ENBATrim1SX" value="1"></div>
                    <div id="ConENCBTrim1S" class="Trim1SS SumSS4"><input type="checkbox" name="ENCBTrim1SX" value="1"></div>
                    <div id="ConENMHTrim1S" class="Trim1SS SumSS5"><input type="checkbox" name="ENMHTrim1SX" value="1"></div>
                    <div id="ConESCAstTrim1S" class="Trim1SS SumSS6"><input type="checkbox" name="ESCAstTrim1SX" value="1"></div>
                    <div id="ConESCAtTrim1S" class="Trim1SS SumSS7"><input type="checkbox" name="ESCAtTrim1SX" value="1"></div>
                    <div id="ConESCOMTrim1S" class="Trim1SS SumSS8"><input type="checkbox" name="ESCOMTrim1SX" value="1"></div>
                    <div id="ConESETrim1S" class="Trim1SS SumSS9"><input type="checkbox" name="ESETrim1SX" value="1"></div>
                    <div id="ConESEOTrim1S" class="Trim1SS SumSS10"><input type="checkbox" name="ESEOTrim1SX" value="1"></div>
                    <div id="ConESFEMTrim1S" class="Trim1SS SumSS11"><input type="checkbox" name="ESFEMTrim1SX" value="1"></div>
                    <div id="ConESIAtecTrim1S" class="Trim1SS SumSS12"><input type="checkbox" name="ESIAtecTrim1SX" value="1"></div>
                    <div id="ConESIAtTrim1S" class="Trim1SS SumSS13"><input type="checkbox" name="ESIAtTrim1SX" value="1"></div>
                    <div id="ConESIAzTrim1S" class="Trim1SS SumSS14"><input type="checkbox" name="ESIAzTrim1SX" value="1"></div>
                    <div id="ConESIMEaTrim1S" class="Trim1SS SumSS15"><input type="checkbox" name="ESIMEaTrim1SX" value="1"></div>
                    <div id="ConESIMEcTrim1S" class="Trim1SS SumSS16"><input type="checkbox" name="ESIMEcTrim1SX" value="1"></div>
                    <div id="ConESIMEtTrim1S" class="Trim1SS SumSS17"><input type="checkbox" name="ESIMEtTrim1SX" value="1"></div>
                    <div id="ConESIMEzTrim1S" class="Trim1SS SumSS18"><input type="checkbox" name="ESIMEzTrim1SX" value="1"></div>
                    <div id="ConESIQUIETrim1S" class="Trim1SS SumSS19"><input type="checkbox" name="ESIQUIETrim1SX" value="1"></div>
                    <div id="ConESITTrim1S" class="Trim1SS SumSS20"><input type="checkbox" name="ESITTrim1SX" value="1"></div>
                    <div id="ConConESMTrim1S" class="Trim1SS SumSS21"><input type="checkbox" name="ConESMTrim1SX" value="1"></div>
                    <div id="ConESTTrim1S" class="Trim1SS SumSS22"><input type="checkbox" name="ESTTrim1SX" value="1"></div>
                    <div id="ConUPIBITrim1S" class="Trim1SS SumSS23"><input type="checkbox" name="UPIBITrim1X" value="1"></div>
                    <div id="ConUPIEMTrim1S" class="Trim1SS SumSS24"><input type="checkbox" name="UPIEMTrim1SX" value="1"></div>
                    <div id="ConUPIICTrim1S" class="Trim1SS SumSS25"><input type="checkbox" name="UPIICTrim1SX" value="1"></div>
                    <div id="ConUPIICSATrim1S" class="Trim1SS SumSS26"><input type="checkbox" name="UPIICSATrim1SX" value="1"></div>
                    <div id="ConUPIIGTrim1S" class="Trim1SS SumSS27"><input type="checkbox" name="UPIIGTrim1SX" value="1"></div>
                    <div id="ConUPIIHTrim1S" class="Trim1SS SumSS28"><input type="checkbox" name="UPIIHTrim1SX" value="1"></div>
                    <div id="ConUPIIPTrim1S" class="Trim1SS SumSS29"><input type="checkbox" name="UPIIPTrim1SX" value="1"></div>
                    <div id="ConUPIITTrim1S" class="Trim1SS SumSS30"><input type="checkbox" name="UPIITTrim1SX" value="1"></div>
                    <div id="ConUPIITATrim1S" class="Trim1SS SumSS31"><input type="checkbox" name="UPIITATrim1SX" value="1"></div>
                    <div id="ConUPIIZTrim1S" class="Trim1SS SumSS32"><input type="checkbox" name="UPIIZTrim1SX" value="1"></div>
                    <div id="Total2Trim1S" class="Trim1SST" name="Total2Trim1SX"></div>
                    
                    <div id="ConCICSmaTrim2S" class="Trim2SS SumSS1"><input type="checkbox" name="CICSmaTrim2SX" value="1"></div>
                    <div id="ConCICSstTrim2S" class="Trim2SS SumSS2"><input type="checkbox" name="CICSstTrim2SX" value="1"></div>
                    <div id="ConENBATrim2S" class="Trim2SS SumSS3"><input type="checkbox" name="ENBATrim2SX" value="1"></div>
                    <div id="ConENCBTrim2S" class="Trim2SS SumSS4"><input type="checkbox" name="ENCBTrim2SX" value="1"></div>
                    <div id="ConENMHTrim2S" class="Trim2SS SumSS5"><input type="checkbox" name="ENMHTrim2SX" value="1"></div>
                    <div id="ConESCAstTrim2S" class="Trim2SS SumSS6"><input type="checkbox" name="ESCAstTrim2SX" value="1"></div>
                    <div id="ConESCAtTrim2S" class="Trim2SS SumSS7"><input type="checkbox" name="ESCAtTrim2SX" value="1"></div>
                    <div id="ConESCOMTrim2S" class="Trim2SS SumSS8"><input type="checkbox" name="ESCOMTrim2SX" value="1"></div>
                    <div id="ConESETrim2S" class="Trim2SS SumSS9"><input type="checkbox" name="ESETrim2SX" value="1"></div>
                    <div id="ConESEOTrim2S" class="Trim2SS SumSS10"><input type="checkbox" name="ESEOTrim2SX" value="1"></div>
                    <div id="ConESFEMTrim2S" class="Trim2SS SumSS11"><input type="checkbox" name="ESFEMTrim2SX" value="1"></div>
                    <div id="ConESIAtecTrim2S" class="Trim2SS SumSS12"><input type="checkbox" name="ESIAtecTrim2SX" value="1"></div>
                    <div id="ConESIAtTrim2S" class="Trim2SS SumSS13"><input type="checkbox" name="ESIAtTrim2SX" value="1"></div>
                    <div id="ConESIAzTrim2S" class="Trim2SS SumSS14"><input type="checkbox" name="ESIAzTrim2SX" value="1"></div>
                    <div id="ConESIMEaTrim2S" class="Trim2SS SumSS15"><input type="checkbox" name="ESIMEaTrim2SX" value="1"></div>
                    <div id="ConESIMEcTrim2S" class="Trim2SS SumSS16"><input type="checkbox" name="ESIMEcTrim2SX" value="1"></div>
                    <div id="ConESIMEtTrim2S" class="Trim2SS SumSS17"><input type="checkbox" name="ESIMEtTrim2SX" value="1"></div>
                    <div id="ConESIMEzTrim2S" class="Trim2SS SumSS18"><input type="checkbox" name="ESIMEzTrim2SX" value="1"></div>
                    <div id="ConESIQUIETrim2S" class="Trim2SS SumSS19"><input type="checkbox" name="ESIQUIETrim2SX" value="1"></div>
                    <div id="ConESITTrim2S" class="Trim2SS SumSS20"><input type="checkbox" name="ESITTrim2SX" value="1"></div>
                    <div id="ConConESMTrim2S" class="Trim2SS SumSS21"><input type="checkbox" name="ConESMTrim2SX" value="1"></div>
                    <div id="ConESTTrim2S" class="Trim2SS SumSS22"><input type="checkbox" name="ESTTrim2SX" value="1"></div>
                    <div id="ConUPIBITrim2S" class="Trim2SS SumSS23"><input type="checkbox" name="UPIBITrim2SX" value="1"></div>
                    <div id="ConUPIEMTrim2S" class="Trim2SS SumSS24"><input type="checkbox" name="UPIEMTrim2SX" value="1"></div>
                    <div id="ConUPIICTrim2S" class="Trim2SS SumSS25"><input type="checkbox" name="UPIICTrim2SX" value="1"></div>
                    <div id="ConUPIICSATrim2S" class="Trim2SS SumSS26"><input type="checkbox" name="UPIICSATrim2SX" value="1"></div>
                    <div id="ConUPIIGTrim2S" class="Trim2SS SumSS27"><input type="checkbox" name="UPIIGTrim2SX" value="1"></div>
                    <div id="ConUPIIHTrim2S" class="Trim2SS SumSS28"><input type="checkbox" name="UPIIHTrim2SX" value="1"></div>
                    <div id="ConUPIIPTrim2S" class="Trim2SS SumSS29"><input type="checkbox" name="UPIIPTrim2SX" value="1"></div>
                    <div id="ConUPIITTrim2S" class="Trim2SS SumSS30"><input type="checkbox" name="UPIITTrim2SX" value="1"></div>
                    <div id="ConUPIITATrim2S" class="Trim2SS SumSS31"><input type="checkbox" name="UPIITATrim2SX" value="1"></div>
                    <div id="ConUPIIZTrim2S" class="Trim2SS SumSS32"><input type="checkbox" name="UPIIZTrim2SX" value="1"></div>
                    <div id="Total2Trim2S" class="Trim2SST" name="Total2Trim2SX"></div>
                    
                    <div id="ConCICSmaTrim3S" class="Trim3SS SumSS1"><input type="checkbox" name="CICSmaTrim3SX" value="1"></div>
                    <div id="ConCICSstTrim3S" class="Trim3SS SumSS2"><input type="checkbox" name="CICSstTrim3SX" value="1"></div>
                    <div id="ConENBATrim3S" class="Trim3SS SumSS3"><input type="checkbox" name="ENBATrim3SX" value="1"></div>
                    <div id="ConENCBTrim3S" class="Trim3SS SumSS4"><input type="checkbox" name="ENCBTrim3SX" value="1"></div>
                    <div id="ConENMHTrim3S" class="Trim3SS SumSS5"><input type="checkbox" name="ENMHTrim3SX" value="1"></div>
                    <div id="ConESCAstTrim3S" class="Trim3SS SumSS6"><input type="checkbox" name="ESCAstTrim3SX" value="1"></div>
                    <div id="ConESCAtTrim3S" class="Trim3SS SumSS7"><input type="checkbox" name="ESCAtTrim3SX" value="1"></div>
                    <div id="ConESCOMTrim3S" class="Trim3SS SumSS8"><input type="checkbox" name="ESCOMTrim3SX" value="1"></div>
                    <div id="ConESETrim3S" class="Trim3SS SumSS19"><input type="checkbox" name="ESETrim3SX" value="1"></div>
                    <div id="ConESEOTrim3S" class="Trim3SS SumSS10"><input type="checkbox" name="ESEOTrim3SX" value="1"></div>
                    <div id="ConESFEMTrim3S" class="Trim3SS SumSS11"><input type="checkbox" name="ESFEMTrim3SX" value="1"></div>
                    <div id="ConESIAtecTrim3S" class="Trim3SS SumSS12"><input type="checkbox" name="ESIAtecTrim3SX" value="1"></div>
                    <div id="ConESIAtTrim3S" class="Trim3SS SumSS13"><input type="checkbox" name="ESIAtTrim3SX" value="1"></div>
                    <div id="ConESIAzTrim3S" class="Trim3SS SumSS14"><input type="checkbox" name="ESIAzTrim3SX" value="1"></div>
                    <div id="ConESIMEaTrim3S" class="Trim3SS SumSS15"><input type="checkbox" name="ESIMEaTrim3SX" value="1"></div>
                    <div id="ConESIMEcTrim3S" class="Trim3SS SumSS16"><input type="checkbox" name="ESIMEcTrim3SX" value="1"></div>
                    <div id="ConESIMEtTrim3S" class="Trim3SS SumSS17"><input type="checkbox" name="ESIMEtTrim3SX" value="1"></div>
                    <div id="ConESIMEzTrim3S" class="Trim3SS SumSS18"><input type="checkbox" name="ESIMEzTrim3SX" value="1"></div>
                    <div id="ConESIQUIETrim3S" class="Trim3SS SumSS19"><input type="checkbox" name="ESIQUIETrim3SX" value="1"></div>
                    <div id="ConESITTrim3S" class="Trim3SS SumSS20"><input type="checkbox" name="ESITTrim3SX" value="1"></div>
                    <div id="ConConESMTrim3S" class="Trim3SS SumSS21"><input type="checkbox" name="ConESMTrim3SX" value="1"></div>
                    <div id="ConESTTrim3S" class="Trim3SS SumSS22"><input type="checkbox" name="ESTTrim3SX" value="1"></div>
                    <div id="ConUPIBITrim3S" class="Trim3SS SumSS23"><input type="checkbox" name="UPIBITrim3SX" value="1"></div>
                    <div id="ConUPIEMTrim3S" class="Trim3SS SumSS24"><input type="checkbox" name="UPIEMTrim3SX" value="1"></div>
                    <div id="ConUPIICTrim3S" class="Trim3SS SumSS25"><input type="checkbox" name="UPIICTrim3SX" value="1"></div>
                    <div id="ConUPIICSATrim3S" class="Trim3SS SumSS26"><input type="checkbox" name="UPIICSATrim3SX" value="1"></div>
                    <div id="ConUPIIGTrim3S" class="Trim3SS SumSS27"><input type="checkbox" name="UPIIGTrim3SX" value="1"></div>
                    <div id="ConUPIIHTrim3S" class="Trim3SS SumSS28"><input type="checkbox" name="UPIIHTrim3SX" value="1"></div>
                    <div id="ConUPIIPTrim3S" class="Trim3SS SumSS29"><input type="checkbox" name="UPIIPTrim3SX" value="1"></div>
                    <div id="ConUPIITTrim3S" class="Trim3SS SumSS30"><input type="checkbox" name="UPIITTrim3SX" value="1"></div>
                    <div id="ConUPIITATrim3S" class="Trim3SS SumSS31"><input type="checkbox" name="UPIITATrim3SX" value="1"></div>
                    <div id="ConUPIIZTrim3S" class="Trim3SS SumSS32"><input type="checkbox" name="UPIIZTrim3SX" value="1"></div>
                    <div id="Total2Trim3S" class="Trim3SST" name="Total2Trim3SX"></div>
                
                    <div id="ConCICSmaTrim4S" class="Trim4SS SumSS1"><input type="checkbox" name="CICSmaTrim4SX" value="1"></div>
                    <div id="ConCICSstTrim4S" class="Trim4SS SumSS2"><input type="checkbox" name="CICSstTrim4SX" value="1"></div>
                    <div id="ConENBATrim4S" class="Trim4SS SumSS3"><input type="checkbox" name="ENBATrim4SX" value="1"></div>
                    <div id="ConENCBTrim4S" class="Trim4SS SumSS4"><input type="checkbox" name="ENCBTrim4SX" value="1"></div>
                    <div id="ConENMHTrim4S" class="Trim4SS SumSS5"><input type="checkbox" name="ENMHTrim4SX" value="1"></div>
                    <div id="ConESCAstTrim4S" class="Trim4SS SumSS6"><input type="checkbox" name="ESCAstTrim4SX" value="1"></div>
                    <div id="ConESCAtTrim4S" class="Trim4SS SumSS7"><input type="checkbox" name="ESCAtTrim4SX" value="1"></div>
                    <div id="ConESCOMTrim4S" class="Trim4SS SumSS8"><input type="checkbox" name="ESCOMTrim4SX" value="1"></div>
                    <div id="ConESETrim4S" class="Trim4SS SumSS9"><input type="checkbox" name="ESETrim4SX" value="1"></div>
                    <div id="ConESEOTrim4S" class="Trim4SS SumSS10"><input type="checkbox" name="ESEOTrim4SX" value="1"></div>
                    <div id="ConESFEMTrim4S" class="Trim4SS SumSS11"><input type="checkbox" name="ESFEMTrim4SX" value="1"></div>
                    <div id="ConESIAtecTrim4S" class="Trim4SS SumSS12"><input type="checkbox" name="ESIAtecTrim4SX" value="1"></div>
                    <div id="ConESIAtTrim4S" class="Trim4SS SumSS13"><input type="checkbox" name="ESIAtTrim4SX" value="1"></div>
                    <div id="ConESIAzTrim4S" class="Trim4SS SumSS14"><input type="checkbox" name="ESIAzTrim4SX" value="1"></div>
                    <div id="ConESIMEaTrim4S" class="Trim4SS SumSS15"><input type="checkbox" name="ESIMEaTrim4SX" value="1"></div>
                    <div id="ConESIMEcTrim4S" class="Trim4SS SumSS16"><input type="checkbox" name="ESIMEcTrim4SX" value="1"></div>
                    <div id="ConESIMEtTrim4S" class="Trim4SS SumSS17"><input type="checkbox" name="ESIMEtTrim4SX" value="1"></div>
                    <div id="ConESIMEzTrim4S" class="Trim4SS SumSS18"><input type="checkbox" name="ESIMEzTrim4SX" value="1"></div>
                    <div id="ConESIQUIETrim4S" class="Trim4SS SumSS19"><input type="checkbox" name="ESIQUIETrim4SX" value="1"></div>
                    <div id="ConESITTrim4S" class="Trim4SS SumSS20"><input type="checkbox" name="ESITTrim4SX" value="1"></div>
                    <div id="ConConESMTrim4S" class="Trim4SS SumSS21"><input type="checkbox" name="ConESMTrim4SX" value="1"></div>
                    <div id="ConESTTrim4S" class="Trim4SS SumSS22"><input type="checkbox" name="ESTTrim4SX" value="1"></div>
                    <div id="ConUPIBITrim4S" class="Trim4SS SumSS23"><input type="checkbox" name="UPIBITrim4SX" value="1"></div>
                    <div id="ConUPIEMTrim4S" class="Trim4SS SumSS24"><input type="checkbox" name="UPIEMTrim4SX" value="1"></div>
                    <div id="ConUPIICTrim4S" class="Trim4SS SumSS25"><input type="checkbox" name="UPIICTrim4SX" value="1"></div>
                    <div id="ConUPIICSATrim4S" class="Trim4SS SumSS26"><input type="checkbox" name="UPIICSATrim4SX" value="1"></div>
                    <div id="ConUPIIGTrim4S" class="Trim4SS SumSS27"><input type="checkbox" name="UPIIGTrim4SX" value="1"></div>
                    <div id="ConUPIIHTrim4S" class="Trim4SS SumSS28"><input type="checkbox" name="UPIIHTrim4SX" value="1"></div>
                    <div id="ConUPIIPTrim4S" class="Trim4SS SumSS29"><input type="checkbox" name="UPIIPTrim4SX" value="1"></div>
                    <div id="ConUPIITTrim4S" class="Trim4SS SumSS30"><input type="checkbox" name="UPIITTrim4SX" value="1"></div>
                    <div id="ConUPIITATrim4S" class="Trim4SS SumSS31"><input type="checkbox" name="UPIITATrim4SX" value="1"></div>
                    <div id="ConUPIIZTrim4S" class="Trim4SS SumSS32"><input type="checkbox" name="UPIIZTrim4SX" value="1"></div>
                    <div id="Total2Trim4S" class="Trim4SST" name="Total2Trim4SX"></div>
                    
                    <div id="ConCICSmaT" class="TotalS1" name=""></div>
                    <div id="ConCICSstT" class="Total2" name=""></div>
                    <div id="ConENBAT" class="TotalS3" name=""></div>
                    <div id="ConENCBT" class="TotalS4" name=""></div>
                    <div id="ConENMHT" class="TotalS5" name=""></div>
                    <div id="ConESCAstT" class="TotalS6" name=""></div>
                    <div id="ConESCAtT" class="TotalS7" name=""></div>
                    <div id="ConESCOMT" class="TotalS8" name=""></div>
                    <div id="ConESET" class="TotalS9" name=""></div>
                    <div id="ConESEOT" class="TotalS10" name=""></div>
                    <div id="ConESFEMT" class="TotalS11" name=""></div>
                    <div id="ConESIAtecT" class="TotalS12" name=""></div>
                    <div id="ConESIAtT" class="TotalS13" name=""></div>
                    <div id="ConESIAzT" class="TotalS14" name=""></div>
                    <div id="ConESIMEaT" class="TotalS15" name=""></div>
                    <div id="ConESIMEcT" class="TotalS16" name=""></div>
                    <div id="ConEsimetT" class="TotalS17" name=""></div>
                    <div id="ConESIMEzT" class="TotalS18" name=""></div>
                    <div id="ConESIQUIET" class="TotalS19" name=""></div>
                    <div id="ConESITT" class="TotalS20" name=""></div>
                    <div id="ConESMT" class="TotalS21" name=""></div>
                    <div id="ConESTT" class="TotalS22" name=""></div>
                    <div id="ConUPIBIT" class="TotalS23" name=""></div>
                    <div id="ConUPIEMT" class="TotalS24" name=""></div>
                    <div id="ConUPIICT" class="TotalS25" name=""></div>
                    <div id="ConUPIICSAT" class="TotalS26" name=""></div>
                    <div id="ConUPIIGT" class="TotalS27" name=""></div>
                    <div id="ConUPIIHT" class="TotalS28" name=""></div>
                    <div id="ConUPIIPT" class="TotalS29" name=""></div>
                    <div id="ConUPIITT" class="TotalS30" name=""></div>
                    <div id="ConUPIITAT" class="TotalS31" name=""></div>
                    <div id="ConUPIIZT" class="TotalS32" name=""></div>
                    <div id="Total2T" class="TotalST" name=""></div>

                </div>
                <div id="contDtCI" class="contDtCI" style="display: none;">
                    <div id="CICIC">CIC</div>
                    <div id="CICITEDI">CITEDI</div>
                    <div id="CICICATAL">CICATA LEGARIA</div>
                    <div id="CICICATAA">CICATA ALTAMIRA</div>
                    <div id="CICICATAQ">CICATA QUERÉTARO</div>
                    <div id="CICICATAM">CICATA MORELOS</div>
                    <div id="CIBAT">CIBA TLAXCALA</div>
                    <div id="CIITEC">CIITEC</div>
                    <div id="CIDETEC">CIDETEC</div>
                    <div id="CMPL">CMPL</div>
                    <div id="CICIMAR">CICIMAR</div>
                    <div id="CIIEMAD">CIIEMAD</div>
                    <div id="CEPROBI">CEPROBI</div>
                    <div id="CIIDIRD">CIIDIR DURANGO</div>
                    <div id="CIIDIRM">CIIDIR MICHOACÁN</div>
                    <div id="CIIDIRO">CIIDIR OAXACA</div>
                    <div id="CIIDIRS">CIIDIR SINALOA</div>
                    <div id="CBG">CBD</div>
                    <div id="CIECAS">CIECAS</div>
                    <div id="Total3">Total</div>

                    <div id="CICICTrim1" class="Trim1CI"><input type="checkbox" name="CICICTrim1X" value="1"></div>
                    <div id="CICITEDITrim1" class="Trim1CI"><input type="checkbox" name="CICITEDITrim1X" value="1"></div>
                    <div id="CICICATALTrim1" class="Trim1CI"><input type="checkbox" name="CICICATALTrim1X" value="1"></div>
                    <div id="CICICATAATrim1" class="Trim1CI"><input type="checkbox" name="CICICATAATrim1X" value="1"></div>
                    <div id="CICICATAQTrim1" class="Trim1CI"><input type="checkbox" name="CICICATAQTrim1X" value="1"></div>
                    <div id="CICICATAMTrim1" class="Trim1CI"><input type="checkbox" name="CICICATAMTrim1X" value="1"></div>
                    <div id="CIBATTrim1" class="Trim1CI"><input type="checkbox" name="CIBATTrim1X" value="1"></div>
                    <div id="CIITECTrim1" class="Trim1CI"><input type="checkbox" name="CIITECTrim1X" value="1"></div>
                    <div id="CIDETECTrim1" class="Trim1CI"><input type="checkbox" name="CIDETECTrim1X" value="1"></div>
                    <div id="CMPLTrim1" class="Trim1CI"><input type="checkbox" name="CMPLTrim1X" value="1"></div>
                    <div id="CICIMARTrim1" class="Trim1CI"><input type="checkbox" name="CICIMARTrim1X" value="1"></div>
                    <div id="CIIEMADTrim1" class="Trim1CI"><input type="checkbox" name="CIIEMADTrim1X" value="1"></div>
                    <div id="CEPROBITrim1" class="Trim1CI"><input type="checkbox" name="CEPROBITrim1X" value="1"></div>
                    <div id="CIIDIRDTrim1" class="Trim1CI"><input type="checkbox" name="CIIDIRDTrim1X" value="1"></div>
                    <div id="CIIDIRMTrim1" class="Trim1CI"><input type="checkbox" name="CIIDIRMTrim1X" value="1"></div>
                    <div id="CIIDIROTrim1" class="Trim1CI"><input type="checkbox" name="CIIDIROTrim1X" value="1"></div>
                    <div id="CIIDIRSTrim1" class="Trim1CI"><input type="checkbox" name="CIIDIRSTrim1X" value="1"></div>
                    <div id="CBGTrim1" class="Trim1CI"><input type="checkbox" name="CBGTrim1X" value="1"></div>
                    <div id="CIECASTrim1" class="Trim1CI"><input type="checkbox" name="CIECASTrim1X" value="1"></div>
                    <div id="Total3Trim1" class="Trim1CIT"></div>
                    
                    <div id="CICICTrim2" class="Trim2CI"><input type="checkbox" name="CICICTrim2X" value="1"></div>
                    <div id="CICITEDITrim2" class="Trim2CI"><input type="checkbox" name="CICITEDITrim2X" value="1"></div>
                    <div id="CICICATALTrim2" class="Trim2CI"><input type="checkbox" name="CICICATALTrim2X" value="1"></div>
                    <div id="CICICATAATrim2" class="Trim2CI"><input type="checkbox" name="CICICATAATrim2X" value="1"></div>
                    <div id="CICICATAQTrim2" class="Trim2CI"><input type="checkbox" name="CICICATAQTrim2X" value="1"></div>
                    <div id="CICICATAMTrim2" class="Trim2CI"><input type="checkbox" name="CICICATAMTrim2X" value="1"></div>
                    <div id="CIBATTrim2" class="Trim2CI"><input type="checkbox" name="CIBATTrim2X" value="1"></div>
                    <div id="CIITECTrim2" class="Trim2CI"><input type="checkbox" name="CIITECTrim2X" value="1"></div>
                    <div id="CIDETECTrim2" class="Trim2CI"><input type="checkbox" name="CIDETECTrim2X" value="1"></div>
                    <div id="CMPLTrim2" class="Trim2CI"><input type="checkbox" name="CMPLTrim2X" value="1"></div>
                    <div id="CICIMARTrim2" class="Trim2CI"><input type="checkbox" name="CICIMARTrim2X" value="1"></div>
                    <div id="CIIEMADTrim2" class="Trim2CI"><input type="checkbox" name="CIIEMADTrim2X" value="1"></div>
                    <div id="CEPROBITrim2" class="Trim2CI"><input type="checkbox" name="CEPROBITrim2X" value="1"></div>
                    <div id="CIIDIRDTrim2" class="Trim2CI"><input type="checkbox" name="CIIDIRDTrim2X" value="1"></div>
                    <div id="CIIDIRMTrim2" class="Trim2CI"><input type="checkbox" name="CIIDIRMTrim2X" value="1"></div>
                    <div id="CIIDIROTrim2" class="Trim2CI"><input type="checkbox" name="CIIDIROTrim2X" value="1"></div>
                    <div id="CIIDIRSTrim2" class="Trim2CI"><input type="checkbox" name="CIIDIRSTrim2X" value="1"></div>
                    <div id="CBGTrim2" class="Trim2CI"><input type="checkbox" name="CBGTrim2X" value="1"></div>
                    <div id="CIECASTrim2" class="Trim2CI"><input type="checkbox" name="CIECASTrim2X" value="1"></div>
                    <div id="Total3Trim2" class="Trim2CIT"></div>
                    
                    <div id="CICICTrim3" class="Trim3CI"><input type="checkbox" name="CICICTrim3X" value="1"></div>
                    <div id="CICITEDITrim3" class="Trim3CI"><input type="checkbox" name="CICITEDITrim3X" value="1"></div>
                    <div id="CICICATALTrim3" class="Trim3CI"><input type="checkbox" name="CICICATALTrim3X" value="1"></div>
                    <div id="CICICATAATrim3" class="Trim3CI"><input type="checkbox" name="CICICATAATrim3X" value="1"></div>
                    <div id="CICICATAQTrim3" class="Trim3CI"><input type="checkbox" name="CICICATAQTrim3X" value="1"></div>
                    <div id="CICICATAMTrim3" class="Trim3CI"><input type="checkbox" name="CICICATAMTrim3X" value="1"></div>
                    <div id="CIBATTrim3" class="Trim3CI"><input type="checkbox" name="CIBATTrim3X" value="1"></div>
                    <div id="CIITECTrim3" class="Trim3CI"><input type="checkbox" name="CIITECTrim3X" value="1"></div>
                    <div id="CIDETECTrim3" class="Trim3CI"><input type="checkbox" name="CIDETECTrim3X" value="1"></div>
                    <div id="CMPLTrim3" class="Trim3CI"><input type="checkbox" name="CMPLTrim3X" value="1"></div>
                    <div id="CICIMARTrim3" class="Trim3CI"><input type="checkbox" name="CICIMARTrim3X" value="1"></div>
                    <div id="CIIEMADTrim3" class="Trim3CI"><input type="checkbox" name="CIIEMADTrim3X" value="1"></div>
                    <div id="CEPROBITrim3" class="Trim3CI"><input type="checkbox" name="CEPROBITrim3X" value="1"></div>
                    <div id="CIIDIRDTrim3" class="Trim3CI"><input type="checkbox" name="CIIDIRDTrim3X" value="1"></div>
                    <div id="CIIDIRMTrim3" class="Trim3CI"><input type="checkbox" name="CIIDIRMTrim3X" value="1"></div>
                    <div id="CIIDIROTrim3" class="Trim3CI"><input type="checkbox" name="CIIDIROTrim3X" value="1"></div>
                    <div id="CIIDIRSTrim3" class="Trim3CI"><input type="checkbox" name="CIIDIRSTrim3X" value="1"></div>
                    <div id="CBGTrim3" class="Trim3CI"><input type="checkbox" name="CBGTrim3X" value="1"></div>
                    <div id="CIECASTrim3" class="Trim3CI"><input type="checkbox" name="CIECASTrim3X" value="1"></div>
                    <div id="Total3Trim3" class="Trim3CIT"></div>
                    
                    <div id="CICICTrim4" class="Trim4CI"><input type="checkbox" name="CICICTrim4X" value="1"></div>
                    <div id="CICITEDITrim4" class="Trim4CI"><input type="checkbox" name="CICITEDITrim4X" value="1"></div>
                    <div id="CICICATALTrim4" class="Trim4CI"><input type="checkbox" name="CICICATALTrim4X" value="1"></div>
                    <div id="CICICATAATrim4" class="Trim4CI"><input type="checkbox" name="CICICATAATrim4X" value="1"></div>
                    <div id="CICICATAQTrim4" class="Trim4CI"><input type="checkbox" name="CICICATAQTrim4X" value="1"></div>
                    <div id="CICICATAMTrim4" class="Trim4CI"><input type="checkbox" name="CICICATAMTrim4X" value="1"></div>
                    <div id="CIBATTrim4" class="Trim4CI"><input type="checkbox" name="CIBATTrim4X" value="1"></div>
                    <div id="CIITECTrim4" class="Trim4CI"><input type="checkbox" name="CIITECTrim4X" value="1"></div>
                    <div id="CIDETECTrim4" class="Trim4CI"><input type="checkbox" name="CIDETECTrim4X" value="1"></div>
                    <div id="CMPLTrim4" class="Trim4CI"><input type="checkbox" name="CMPLTrim4X" value="1"></div>
                    <div id="CICIMARTrim4" class="Trim4CI"><input type="checkbox" name="CICIMARTrim4X" value="1"></div>
                    <div id="CIIEMADTrim4" class="Trim4CI"><input type="checkbox" name="CIIEMADTrim4X" value="1"></div>
                    <div id="CEPROBITrim4" class="Trim4CI"><input type="checkbox" name="CEPROBITrim4X" value="1"></div>
                    <div id="CIIDIRDTrim4" class="Trim4CI"><input type="checkbox" name="CIIDIRDTrim4X" value="1"></div>
                    <div id="CIIDIRMTrim4" class="Trim4CI"><input type="checkbox" name="CIIDIRMTrim4X" value="1"></div>
                    <div id="CIIDIROTrim4" class="Trim4CI"><input type="checkbox" name="CIIDIROTrim4X" value="1"></div>
                    <div id="CIIDIRSTrim4" class="Trim4CI"><input type="checkbox" name="CIIDIRSTrim4X" value="1"></div>
                    <div id="CBGTrim4" class="Trim4CI"><input type="checkbox" name="CBGTrim4X" value="1"></div>
                    <div id="CIECASTrim4" class="Trim4CI"><input type="checkbox" name="CIECASTrim4X" value="1"></div>
                    <div id="Total3Trim4" class="Trim4CIT"></div>
                    
                    <div id="CICICTrim1S" class="Trim1CIS SumCIS1"><input type="checkbox" name="CICICTrim1SX" value="1"></div>
                    <div id="CICITEDITrim1S" class="Trim1CIS SumCIS2"><input type="checkbox" name="CICITEDITrim1SX" value="1"></div>
                    <div id="CICICATALTrim1S" class="Trim1CIS SumCIS3"><input type="checkbox" name="CICICATALTrim1SX" value="1"></div>
                    <div id="CICICATAATrim1S" class="Trim1CIS SumCIS4"><input type="checkbox" name="CICICATAATrim1SX" value="1"></div>
                    <div id="CICICATAQTrim1S" class="Trim1CIS SumCIS5"><input type="checkbox" name="CICICATAQTrim1SX" value="1"></div>
                    <div id="CICICATAMTrim1S" class="Trim1CIS SumCIS6"><input type="checkbox" name="CICICATAMTrim1SX" value="1"></div>
                    <div id="CIBATTrim1S" class="Trim1CIS SumCIS7"><input type="checkbox" name="CIBATTrim1SX" value="1"></div>
                    <div id="CIITECTrim1S" class="Trim1CIS SumCIS8"><input type="checkbox" name="CIITECTrim1SX" value="1"></div>
                    <div id="CIDETECTrim1S" class="Trim1CIS SumCIS9"><input type="checkbox" name="CIDETECTrim1SX" value="1"></div>
                    <div id="CMPLTrim1S" class="Trim1CIS SumCIS10"><input type="checkbox" name="CMPLTrim1SX" value="1"></div>
                    <div id="CICIMARTrim1S" class="Trim1CIS SumCIS11"><input type="checkbox" name="CICIMARTrim1SX" value="1"></div>
                    <div id="CIIEMADTrim1S" class="Trim1CIS SumCIS12"><input type="checkbox" name="CIIEMADTrim1SX" value="1"></div>
                    <div id="CEPROBITrim1S" class="Trim1CIS SumCIS13"><input type="checkbox" name="CEPROBITrim1SX" value="1"></div>
                    <div id="CIIDIRDTrim1S" class="Trim1CIS SumCIS14"><input type="checkbox" name="CIIDIRDTrim1SX" value="1"></div>
                    <div id="CIIDIRMTrim1S" class="Trim1CIS SumCIS15"><input type="checkbox" name="CIIDIRMTrim1SX" value="1"></div>
                    <div id="CIIDIROTrim1S" class="Trim1CIS SumCIS16"><input type="checkbox" name="CIIDIROTrim1SX" value="1"></div>
                    <div id="CIIDIRSTrim1S" class="Trim1CIS SumCIS17"><input type="checkbox" name="CIIDIRSTrim1SX" value="1"></div>
                    <div id="CBGTrim1S" class="Trim1CIS SumCIS18"><input type="checkbox" name="CBGTrim1SX" value="1"></div>
                    <div id="CIECASTrim1S" class="Trim1CIS SumCIS19"><input type="checkbox" name="CIECASTrim1SX" value="1"></div>
                    <div id="Total3Trim1S" class="Trim1CIST"></div>
                    
                    <div id="CICICTrim2S" class="Trim2CIS SumCIS1"><input type="checkbox" name="CICICTrim2SX" value="1"></div>
                    <div id="CICITEDITrim2S" class="Trim2CIS SumCIS2"><input type="checkbox" name="CICITEDITrim2SX" value="1"></div>
                    <div id="CICICATALTrim2S" class="Trim2CIS SumCIS3"><input type="checkbox" name="CICICATALTrim2SX" value="1"></div>
                    <div id="CICICATAATrim2S" class="Trim2CIS SumCIS4"><input type="checkbox" name="CICICATAATrim2SX" value="1"></div>
                    <div id="CICICATAQTrim2S" class="Trim2CIS SumCIS5"><input type="checkbox" name="CICICATAQTrim2SX" value="1"></div>
                    <div id="CICICATAMTrim2S" class="Trim2CIS SumCIS6"><input type="checkbox" name="CICICATAMTrim2SX" value="1"></div>
                    <div id="CIBATTrim2S" class="Trim2CIS SumCIS7"><input type="checkbox" name="CIBATTrim2SX" value="1"></div>
                    <div id="CIITECTrim2S" class="Trim2CIS SumCIS8"><input type="checkbox" name="CIITECTrim2SX" value="1"></div>
                    <div id="CIDETECTrim2S" class="Trim2CIS SumCIS9"><input type="checkbox" name="CIDETECTrim2SX" value="1"></div>
                    <div id="CMPLTrim2S" class="Trim2CIS SumCIS10"><input type="checkbox" name="CMPLTrim2SX" value="1"></div>
                    <div id="CICIMARTrim2S" class="Trim2CIS SumCIS11"><input type="checkbox" name="CICIMARTrim2SX" value="1"></div>
                    <div id="CIIEMADTrim2S" class="Trim2CIS SumCIS12"><input type="checkbox" name="CIIEMADTrim2SX" value="1"></div>
                    <div id="CEPROBITrim2S" class="Trim2CIS SumCIS13"><input type="checkbox" name="CEPROBITrim2SX" value="1"></div>
                    <div id="CIIDIRDTrim2S" class="Trim2CIS SumCIS14"><input type="checkbox" name="CIIDIRDTrim2SX" value="1"></div>
                    <div id="CIIDIRMTrim2S" class="Trim2CIS SumCIS15"><input type="checkbox" name="CIIDIRMTrim2SX" value="1"></div>
                    <div id="CIIDIROTrim2S" class="Trim2CIS SumCIS16"><input type="checkbox" name="CIIDIROTrim2SX" value="1"></div>
                    <div id="CIIDIRSTrim2S" class="Trim2CIS SumCIS17"><input type="checkbox" name="CIIDIRSTrim2SX" value="1"></div>
                    <div id="CBGTrim2S" class="Trim2CIS SumCIS18"><input type="checkbox" name="CBGTrim2SX" value="1"></div>
                    <div id="CIECASTrim2S" class="Trim2CIS SumCIS19"><input type="checkbox" name="CIECASTrim2SX" value="1"></div>
                    <div id="Total3Trim2S" class="Trim2CIST" ></div>
                    
                    <div id="CICICTrim3S" class="Trim3CIS SumCIS1"><input type="checkbox" name="CICICTrim3SX" value="1"></div>
                    <div id="CICITEDITrim3S" class="Trim3CIS SumCIS2"><input type="checkbox" name="CICITEDITrim3SX" value="1"></div>
                    <div id="CICICATALTrim3S" class="Trim3CIS SumCIS3"><input type="checkbox" name="CICICATALTrim3SX" value="1"></div>
                    <div id="CICICATAATrim3S" class="Trim3CIS SumCIS4"><input type="checkbox" name="CICICATAATrim3SX" value="1"></div>
                    <div id="CICICATAQTrim3S" class="Trim3CIS SumCIS5"><input type="checkbox" name="CICICATAQTrim3SX" value="1"></div>
                    <div id="CICICATAMTrim3S" class="Trim3CIS SumCIS6"><input type="checkbox" name="CICICATAMTrim3SX" value="1"></div>
                    <div id="CIBATTrim3S" class="Trim3CIS SumCIS7"><input type="checkbox" name="CIBATTrim3SX" value="1"></div>
                    <div id="CIITECTrim3S" class="Trim3CIS SumCIS8"><input type="checkbox" name="CIITECTrim3SX" value="1"></div>
                    <div id="CIDETECTrim3S" class="Trim3CIS SumCIS9"><input type="checkbox" name="CIDETECTrim3SX" value="1"></div>
                    <div id="CMPLTrim3S" class="Trim3CIS SumCIS10"><input type="checkbox" name="CMPLTrim3SX" value="1"></div>
                    <div id="CICIMARTrim3S" class="Trim3CIS SumCIS11"><input type="checkbox" name="CICIMARTrim3SX" value="1"></div>
                    <div id="CIIEMADTrim3S" class="Trim3CIS SumCIS12"><input type="checkbox" name="CIIEMADTrim3SX" value="1"></div>
                    <div id="CEPROBITrim3S" class="Trim3CIS SumCIS13"><input type="checkbox" name="CEPROBITrim3SX" value="1"></div>
                    <div id="CIIDIRDTrim3S" class="Trim3CIS SumCIS14"><input type="checkbox" name="CIIDIRDTrim3SX" value="1"></div>
                    <div id="CIIDIRMTrim3S" class="Trim3CIS SumCIS15"><input type="checkbox" name="CIIDIRMTrim3SX" value="1"></div>
                    <div id="CIIDIROTrim3S" class="Trim3CIS SumCIS16"><input type="checkbox" name="CIIDIROTrim3SX" value="1"></div>
                    <div id="CIIDIRSTrim3S" class="Trim3CIS SumCIS17"><input type="checkbox" name="CIIDIRSTrim3SX" value="1"></div>
                    <div id="CBGTrim3S" class="Trim3CIS SumCIS18"><input type="checkbox" name="CBGTrim3SX" value="1"></div>
                    <div id="CIECASTrim3S" class="Trim3CIS SumCIS19"><input type="checkbox" name="CIECASTrim3SX" value="1"></div>
                    <div id="Total3Trim3S" class="Trim3CIST"></div>
                    
                    <div id="CICICTrim4S" class="Trim4CIS SumCIS1"><input type="checkbox" name="CICICTrim4SX" value="1"></div>
                    <div id="CICITEDITrim4S" class="Trim4CIS SumCIS2"><input type="checkbox" name="CICITEDITrim4SX" value="1"></div>
                    <div id="CICICATALTrim4S" class="Trim4CIS SumCIS3"><input type="checkbox" name="CICICATALTrim4SX" value="1"></div>
                    <div id="CICICATAATrim4S" class="Trim4CIS SumCIS4"><input type="checkbox" name="CICICATAATrim4SX" value="1"></div>
                    <div id="CICICATAQTrim4S" class="Trim4CIS SumCIS5"><input type="checkbox" name="CICICATAQTrim4SX" value="1"></div>
                    <div id="CICICATAMTrim4S" class="Trim4CIS SumCIS6"><input type="checkbox" name="CICICATAMTrim4SX" value="1"></div>
                    <div id="CIBATTrim4S" class="Trim4CIS SumCIS7"><input type="checkbox" name="CIBATTrim4SX" value="1"></div>
                    <div id="CIITECTrim4S" class="Trim4CIS SumCIS8"><input type="checkbox" name="CIITECTrim4SX" value="1"></div>
                    <div id="CIDETECTrim4S" class="Trim4CIS SumCIS9"><input type="checkbox" name="CIDETECTrim4SX" value="1"></div>
                    <div id="CMPLTrim4S" class="Trim4CIS SumCIS10"><input type="checkbox" name="CMPLTrim4SX" value="1"></div>
                    <div id="CICIMARTrim4S" class="Trim4CIS SumCIS11"><input type="checkbox" name="CICIMARTrim4SX" value="1"></div>
                    <div id="CIIEMADTrim4S" class="Trim4CIS SumCIS12"><input type="checkbox" name="CIIEMADTrim4SX" value="1"></div>
                    <div id="CEPROBITrim4S" class="Trim4CIS SumCIS13"><input type="checkbox" name="CEPROBITrim4SX" value="1"></div>
                    <div id="CIIDIRDTrim4S" class="Trim4CIS SumCIS14"><input type="checkbox" name="CIIDIRDTrim4SX" value="1"></div>
                    <div id="CIIDIRMTrim4S" class="Trim4CIS SumCIS15"><input type="checkbox" name="CIIDIRMTrim4SX" value="1"></div>
                    <div id="CIIDIROTrim4S" class="Trim4CIS SumCIS16"><input type="checkbox" name="CIIDIROTrim4SX" value="1"></div>
                    <div id="CIIDIRSTrim4S" class="Trim4CIS SumCIS17"><input type="checkbox" name="CIIDIRSTrim4SX" value="1"></div>
                    <div id="CBGTrim4S" class="Trim4CIS SumCIS18"><input type="checkbox" name="CBGTrim4SX" value="1"></div>
                    <div id="CIECASTrim4S" class="Trim4CIS SumCIS19"><input type="checkbox" name="CIECASTrim4SX" value="1"></div>
                    <div id="Total3Trim4S" class="Trim4CIST"></div>
                    
                    <div id="CICICT" class="ToyalCI1"></div>
                    <div id="CICITEDIT" class="ToyalCI2"></div>
                    <div id="CICICATALT" class="ToyalCI3"></div>
                    <div id="CICICATAAT" class="ToyalCI4"></div>
                    <div id="CICICATAQT" class="ToyalCI5"></div>
                    <div id="CICICATAMT" class="ToyalCI6"></div>
                    <div id="CIBATT" class="ToyalCI7"></div>
                    <div id="CIITECT" class="ToyalCI8"></div>
                    <div id="CIDETECT" class="ToyalCI9"></div>
                    <div id="CMPLT" class="ToyalCI10"></div>
                    <div id="CICIMART" class="ToyalCI11"></div>
                    <div id="CIIEMADT" class="ToyalCI12"></div>
                    <div id="CEPROBIT" class="ToyalCI13"></div>
                    <div id="CIIDIRDT" class="ToyalCI14"></div>
                    <div id="CIIDIRMT" class="ToyalCI15"></div>
                    <div id="CIIDIROT" class="ToyalCI16"></div>
                    <div id="CIIDIRST" class="ToyalCI17"></div>
                    <div id="CBGTT" class="ToyalCI18"></div>
                    <div id="CIECASTT" class="ToyalCI19"></div>
                    <div id="Total3T" class="ToyalCIT"></div>
                </div>
                <div id="contDtCVDR" class="contDtCVDR" style="display: none;">
                    <div id="CVDRCJ">CVDR CAJEME</div>
                    <div id="CVDRCH">CVDR CAMPECHE</div>
                    <div id="CVDRCN">CVDR CANCÚN</div>
                    <div id="CVDRCL">CVDR CULIACAN</div>
                    <div id="CVDRD">CVDR DURANGO</div>
                    <div id="CVDRLM">CVDR LOS MOCHIS</div>
                    <div id="CVDRMZ">CVDR MAZATLÁN</div>
                    <div id="CVDRMR">CVDR MORELIA</div>
                    <div id="CVDROX">CVDR OAXACA</div>
                    <div id="CVDRTM">CVDR TAMPICO</div>
                    <div id="CVDRTJ">CVDR TIJUANA</div>
                    <div id="CVDRTX">CVDR TLAXCALA</div>
                    <div id="CVDRCHI">CVDR CHIHUAHUA</div>
                    <div id="CVDRV">CVDR VERACRUZ</div>
                    <div id="CVDRG">CVDR GUANAJUATO</div>
                    <div id="CVDRP">CVDR PUEBLA</div>
                    <div id="Total4">Total</div>

                    <div id="CVDRCJTrim1" class="Trim1CVDR"><input type="checkbox" name="CVDRCJTrim1X" value="1"></div>
                    <div id="CVDRCHTrim1" class="Trim1CVDR"><input type="checkbox" name="CVDRCHTrim1X" value="1"></div>
                    <div id="CVDRCNTrim1" class="Trim1CVDR"><input type="checkbox" name="CVDRCNTrim1X" value="1"></div>
                    <div id="CVDRCLTrim1" class="Trim1CVDR"><input type="checkbox" name="CVDRCLTrim1X" value="1"></div>
                    <div id="CVDRDTrim1" class="Trim1CVDR"><input type="checkbox" name="CVDRDTrim1X" value="1"></div>
                    <div id="CVDRLMTrim1" class="Trim1CVDR"><input type="checkbox" name="CVDRLMTrim1X" value="1"></div>
                    <div id="CVDRMZTrim1" class="Trim1CVDR"><input type="checkbox" name="CVDRMZTrim1X" value="1"></div>
                    <div id="CVDRMRTrim1" class="Trim1CVDR"><input type="checkbox" name="CVDRMRTrim1X" value="1"></div>
                    <div id="CVDROXTrim1" class="Trim1CVDR"><input type="checkbox" name="CVDROXTrim1X" value="1"></div>
                    <div id="CVDRTMTrim1" class="Trim1CVDR"><input type="checkbox" name="CVDRTMTrim1X" value="1"></div>
                    <div id="CVDRTJTrim1" class="Trim1CVDR"><input type="checkbox" name="CVDRTJTrim1X" value="1"></div>
                    <div id="CVDRTXTrim1" class="Trim1CVDR"><input type="checkbox" name="CVDRTXTrim1X" value="1"></div>
                    <div id="CVDRCHITrim1" class="Trim1CVDR"><input type="checkbox" name="CVDRCHITrim1X" value="1"></div>
                    <div id="CVDRVTrim1" class="Trim1CVDR"><input type="checkbox" name="CVDRVTrim1X" value="1"></div>
                    <div id="CVDRGTrim1" class="Trim1CVDR"><input type="checkbox" name="CVDRGTrim1X" value="1"></div>
                    <div id="CVDRPTrim1" class="Trim1CVDR"><input type="checkbox" name="CVDRPTrim1X" value="1"></div>
                    <div id="Total4Trim1" class="Trim1CVDRT"></div>
                    
                    <div id="CVDRCJTrim2" class="Trim2CVDR"><input type="checkbox" name="CVDRCJTrim2X" value="1"></div>
                    <div id="CVDRCHTrim2" class="Trim2CVDR"><input type="checkbox" name="CVDRCHTrim2X" value="1"></div>
                    <div id="CVDRCNTrim2" class="Trim2CVDR"><input type="checkbox" name="CVDRCNTrim2X" value="1"></div>
                    <div id="CVDRCLTrim2" class="Trim2CVDR"><input type="checkbox" name="CVDRCLTrim2X" value="1"></div>
                    <div id="CVDRDTrim2" class="Trim2CVDR"><input type="checkbox" name="CVDRDTrim2X" value="1"></div>
                    <div id="CVDRLMTrim2" class="Trim2CVDR"><input type="checkbox" name="CVDRLMTrim2X" value="1"></div>
                    <div id="CVDRMZTrim2" class="Trim2CVDR"><input type="checkbox" name="CVDRMZTrim2X" value="1"></div>
                    <div id="CVDRMRTrim2" class="Trim2CVDR"><input type="checkbox" name="CVDRMRTrim2X" value="1"></div>
                    <div id="CVDROXTrim2" class="Trim2CVDR"><input type="checkbox" name="CVDROXTrim2X" value="1"></div>
                    <div id="CVDRTMTrim2" class="Trim2CVDR"><input type="checkbox" name="CVDRTMTrim2X" value="1"></div>
                    <div id="CVDRTJTrim2" class="Trim2CVDR"><input type="checkbox" name="CVDRTJTrim2X" value="1"></div>
                    <div id="CVDRTXTrim2" class="Trim2CVDR"><input type="checkbox" name="CVDRTXTrim2X" value="1"></div>
                    <div id="CVDRCHITrim2" class="Trim2CVDR"><input type="checkbox" name="CVDRCHITrim2X" value="1"></div>
                    <div id="CVDRVTrim2" class="Trim2CVDR"><input type="checkbox" name="CVDRVTrim2X" value="1"></div>
                    <div id="CVDRGTrim2" class="Trim2CVDR"><input type="checkbox" name="CVDRGTrim2X" value="1"></div>
                    <div id="CVDRPTrim2" class="Trim2CVDR"><input type="checkbox" name="CVDRPTrim2X" value="1"></div>
                    <div id="Total4Trim2" class="Trim2CVDRT"></div>
                    
                    <div id="CVDRCJTrim3" class="Trim3CVDR"><input type="checkbox" name="CVDRCJTrim3X" value="1"></div>
                    <div id="CVDRCHTrim3" class="Trim3CVDR"><input type="checkbox" name="CVDRCHTrim3X" value="1"></div>
                    <div id="CVDRCNTrim3" class="Trim3CVDR"><input type="checkbox" name="CVDRCNTrim3X" value="1"></div>
                    <div id="CVDRCLTrim3" class="Trim3CVDR"><input type="checkbox" name="CVDRCLTrim3X" value="1"></div>
                    <div id="CVDRDTrim3" class="Trim3CVDR"><input type="checkbox" name="CVDRDTrim3X" value="1"></div>
                    <div id="CVDRLMTrim3" class="Trim3CVDR"><input type="checkbox" name="CVDRLMTrim3X" value="1"></div>
                    <div id="CVDRMZTrim3" class="Trim3CVDR"><input type="checkbox" name="CVDRMZTrim3X" value="1"></div>
                    <div id="CVDRMRTrim3" class="Trim3CVDR"><input type="checkbox" name="CVDRMRTrim3X" value="1"></div>
                    <div id="CVDROXTrim3" class="Trim3CVDR"><input type="checkbox" name="CVDROXTrim3X" value="1"></div>
                    <div id="CVDRTMTrim3" class="Trim3CVDR"><input type="checkbox" name="CVDRTMTrim3X" value="1"></div>
                    <div id="CVDRTJTrim3" class="Trim3CVDR"><input type="checkbox" name="CVDRTJTrim3X" value="1"></div>
                    <div id="CVDRTXTrim3" class="Trim3CVDR"><input type="checkbox" name="CVDRTXTrim3X" value="1"></div>
                    <div id="CVDRCHITrim3" class="Trim3CVDR"><input type="checkbox" name="CVDRCHITrim3X" value="1"></div>
                    <div id="CVDRVTrim3" class="Trim3CVDR"><input type="checkbox" name="CVDRVTrim3X" value="1"></div>
                    <div id="CVDRGTrim3" class="Trim3CVDR"><input type="checkbox" name="CVDRGTrim3X" value="1"></div>
                    <div id="CVDRPTrim3" class="Trim3CVDR"><input type="checkbox" name="CVDRPTrim3X" value="1"></div>
                    <div id="Total4Trim3" class="Trim3CVDRT"></div>
                    
                    <div id="CVDRCJTrim4" class="Trim4CVDR"><input type="checkbox" name="CVDRCJTrim4X" value="1"></div>
                    <div id="CVDRCHTrim4" class="Trim4CVDR"><input type="checkbox" name="CVDRCHTrim4X" value="1"></div>
                    <div id="CVDRCNTrim4" class="Trim4CVDR"><input type="checkbox" name="CVDRCNTrim4X" value="1"></div>
                    <div id="CVDRCLTrim4" class="Trim4CVDR"><input type="checkbox" name="CVDRCLTrim4X" value="1"></div>
                    <div id="CVDRDTrim4" class="Trim4CVDR"><input type="checkbox" name="CVDRDTrim4X" value="1"></div>
                    <div id="CVDRLMTrim4" class="Trim4CVDR"><input type="checkbox" name="CVDRLMTrim4X" value="1"></div>
                    <div id="CVDRMZTrim4" class="Trim4CVDR"><input type="checkbox" name="CVDRMZTrim4X" value="1"></div>
                    <div id="CVDRMRTrim4" class="Trim4CVDR"><input type="checkbox" name="CVDRMRTrim4X" value="1"></div>
                    <div id="CVDROXTrim4" class="Trim4CVDR"><input type="checkbox" name="CVDROXTrim4X" value="1"></div>
                    <div id="CVDRTMTrim4" class="Trim4CVDR"><input type="checkbox" name="CVDRTMTrim4X" value="1"></div>
                    <div id="CVDRTJTrim4" class="Trim4CVDR"><input type="checkbox" name="CVDRTJTrim4X" value="1"></div>
                    <div id="CVDRTXTrim4" class="Trim4CVDR"><input type="checkbox" name="CVDRTXTrim4X" value="1"></div>
                    <div id="CVDRCHITrim4" class="Trim4CVDR"><input type="checkbox" name="CVDRCHITrim4X" value="1"></div>
                    <div id="CVDRVTrim4" class="Trim4CVDR"><input type="checkbox" name="CVDRVTrim4X" value="1"></div>
                    <div id="CVDRGTrim4" class="Trim4CVDR"><input type="checkbox" name="CVDRGTrim4X" value="1"></div>
                    <div id="CVDRPTrim4" class="Trim4CVDR"><input type="checkbox" name="CVDRPTrim4X" value="1"></div>
                    <div id="Total4Trim4" class="Trim4CVDRT"></div>
                    
                    <div id="CVDRCJTrim1S" class="Trim1SCVDR SumCVDRS1"><input type="checkbox" name="CVDRCJTrim1SX" value="1"></div>
                    <div id="CVDRCHTrim1S" class="Trim1SCVDR SumCVDRS2"><input type="checkbox" name="CVDRCHTrim1SX" value="1"></div>
                    <div id="CVDRCNTrim1S" class="Trim1SCVDR SumCVDRS3"><input type="checkbox" name="CVDRCNTrim1SX" value="1"></div>
                    <div id="CVDRCLTrim1S" class="Trim1SCVDR SumCVDRS4"><input type="checkbox" name="CVDRCLTrim1SX" value="1"></div>
                    <div id="CVDRDTrim1S" class="Trim1SCVDR SumCVDRS5"><input type="checkbox" name="CVDRDTrim1SX" value="1"></div>
                    <div id="CVDRLMTrim1S" class="Trim1SCVDR SumCVDRS6"><input type="checkbox" name="CVDRLMTrim1SX" value="1"></div>
                    <div id="CVDRMZTrim1S" class="Trim1SCVDR SumCVDRS7"><input type="checkbox" name="CVDRMZTrim1SX" value="1"></div>
                    <div id="CVDRMRTrim1S" class="Trim1SCVDR SumCVDRS8"><input type="checkbox" name="CVDRMRTrim1SX" value="1"></div>
                    <div id="CVDROXTrim1S" class="Trim1SCVDR SumCVDRS9"><input type="checkbox" name="CVDROXTrim1SX" value="1"></div>
                    <div id="CVDRTMTrim1S" class="Trim1SCVDR SumCVDRS10"><input type="checkbox" name="CVDRTMTrim1SX" value="1"></div>
                    <div id="CVDRTJTrim1S" class="Trim1SCVDR SumCVDRS11"><input type="checkbox" name="CVDRTJTrim1SX" value="1"></div>
                    <div id="CVDRTXTrim1S" class="Trim1SCVDR SumCVDRS12"><input type="checkbox" name="CVDRTXTrim1SX" value="1"></div>
                    <div id="CVDRCHITrim1S" class="Trim1SCVDR SumCVDRS13"><input type="checkbox" name="CVDRCHITrim1SX" value="1"></div>
                    <div id="CVDRVTrim1S" class="Trim1SCVDR SumCVDRS14"><input type="checkbox" name="CVDRVTrim1SX" value="1"></div>
                    <div id="CVDRGTrim1S" class="Trim1SCVDR SumCVDRS15"><input type="checkbox" name="CVDRGTrim1SX" value="1"></div>
                    <div id="CVDRPTrim1S" class="Trim1SCVDR SumCVDRS16"><input type="checkbox" name="CVDRPTrim1SX" value="1"></div>
                    <div id="Total4Trim1S" class="Trim1SCVDRT"></div>
                    
                    <div id="CVDRCJTrim2S" class="Trim2SCVDR SumCVDRS1"><input type="checkbox" name="CVDRCJTrim2SX" value="1"></div>
                    <div id="CVDRCHTrim2S" class="Trim2SCVDR SumCVDRS2"><input type="checkbox" name="CVDRCHTrim2SX" value="1"></div>
                    <div id="CVDRCNTrim2S" class="Trim2SCVDR SumCVDRS3"><input type="checkbox" name="CVDRCNTrim2SX" value="1"></div>
                    <div id="CVDRCLTrim2S" class="Trim2SCVDR SumCVDRS4"><input type="checkbox" name="CVDRCLTrim2SX" value="1"></div>
                    <div id="CVDRDTrim2S" class="Trim2SCVDR SumCVDRS5"><input type="checkbox" name="CVDRDTrim2SX" value="1"></div>
                    <div id="CVDRLMTrim2S" class="Trim2SCVDR SumCVDRS6"><input type="checkbox" name="CVDRLMTrim2SX" value="1"></div>
                    <div id="CVDRMZTrim2S" class="Trim2SCVDR SumCVDRS7"><input type="checkbox" name="CVDRMZTrim2SX" value="1"></div>
                    <div id="CVDRMRTrim2S" class="Trim2SCVDR SumCVDRS8"><input type="checkbox" name="CVDRMRTrim2SX" value="1"></div>
                    <div id="CVDROXTrim2S" class="Trim2SCVDR SumCVDRS9"><input type="checkbox" name="CVDROXTrim2SX" value="1"></div>
                    <div id="CVDRTMTrim2S" class="Trim2SCVDR SumCVDRS10"><input type="checkbox" name="CVDRTMTrim2SX" value="1"></div>
                    <div id="CVDRTJTrim2S" class="Trim2SCVDR SumCVDRS11"><input type="checkbox" name="CVDRTJTrim2SX" value="1"></div>
                    <div id="CVDRTXTrim2S" class="Trim2SCVDR SumCVDRS12"><input type="checkbox" name="CVDRTXTrim2SX" value="1"></div>
                    <div id="CVDRCHITrim2S" class="Trim2SCVDR SumCVDRS13"><input type="checkbox" name="CVDRCHITrim2SX" value="1"></div>
                    <div id="CVDRVTrim2S" class="Trim2SCVDR SumCVDRS14"><input type="checkbox" name="CVDRVTrim2SX" value="1"></div>
                    <div id="CVDRGTrim2S" class="Trim2SCVDR SumCVDRS15"><input type="checkbox" name="CVDRGTrim2SX" value="1"></div>
                    <div id="CVDRPTrim2S" class="Trim2SCVDR SumCVDRS16"><input type="checkbox" name="CVDRPTrim2SX" value="1"></div>
                    <div id="Total4Trim2S" class="Trim2SCVDRT"></div>
                    
                    <div id="CVDRCJTrim3S" class="Trim3SCVDR SumCVDRS1"><input type="checkbox" name="CVDRCJTrim3SX" value="1"></div>
                    <div id="CVDRCHTrim3S" class="Trim3SCVDR SumCVDRS2"><input type="checkbox" name="CVDRCHTrim3SX" value="1"></div>
                    <div id="CVDRCNTrim3S" class="Trim3SCVDR SumCVDRS3"><input type="checkbox" name="CVDRCNTrim3SX" value="1"></div>
                    <div id="CVDRCLTrim3S" class="Trim3SCVDR SumCVDRS4"><input type="checkbox" name="CVDRCLTrim3SX" value="1"></div>
                    <div id="CVDRDTrim3S" class="Trim3SCVDR SumCVDRS5"><input type="checkbox" name="CVDRDTrim3SX" value="1"></div>
                    <div id="CVDRLMTrim3S" class="Trim3SCVDR SumCVDRS6"><input type="checkbox" name="CVDRLMTrim3SX" value="1"></div>
                    <div id="CVDRMZTrim3S" class="Trim3SCVDR SumCVDRS7"><input type="checkbox" name="CVDRMZTrim3SX" value="1"></div>
                    <div id="CVDRMRTrim3S" class="Trim3SCVDR SumCVDRS8"><input type="checkbox" name="CVDRMRTrim3SX" value="1"></div>
                    <div id="CVDROXTrim3S" class="Trim3SCVDR SumCVDRS9"><input type="checkbox" name="CVDROXTrim3SX" value="1"></div>
                    <div id="CVDRTMTrim3S" class="Trim3SCVDR SumCVDRS10"><input type="checkbox" name="CVDRTMTrim3SX" value="1"></div>
                    <div id="CVDRTJTrim3S" class="Trim3SCVDR SumCVDRS11"><input type="checkbox" name="CVDRTJTrim3SX" value="1"></div>
                    <div id="CVDRTXTrim3S" class="Trim3SCVDR SumCVDRS12"><input type="checkbox" name="CVDRTXTrim3SX" value="1"></div>
                    <div id="CVDRCHITrim3S" class="Trim3SCVDR SumCVDRS13"><input type="checkbox" name="CVDRCHITrim3SX" value="1"></div>
                    <div id="CVDRVTrim3S" class="Trim3SCVDR SumCVDRS14"><input type="checkbox" name="CVDRVTrim3SX" value="1"></div>
                    <div id="CVDRGTrim3S" class="Trim3SCVDR SumCVDRS15"><input type="checkbox" name="CVDRGTrim3SX" value="1"></div>
                    <div id="CVDRPTrim3S" class="Trim3SCVDR SumCVDRS16"><input type="checkbox" name="CVDRPTrim3SX" value="1"></div>
                    <div id="Total4Trim3S" class="Trim3SCVDRT"></div>
                    
                    <div id="CVDRCJTrim4S" class="Trim4SCVDR SumCVDRS1"><input type="checkbox" name="CVDRCJTrim4SX" value="1"></div>
                    <div id="CVDRCHTrim4S" class="Trim4SCVDR SumCVDRS2"><input type="checkbox" name="CVDRCHTrim4SX" value="1"></div>
                    <div id="CVDRCNTrim4S" class="Trim4SCVDR SumCVDRS3"><input type="checkbox" name="CVDRCNTrim4SX" value="1"></div>
                    <div id="CVDRCLTrim4S" class="Trim4SCVDR SumCVDRS4"><input type="checkbox" name="CVDRCLTrim4SX" value="1"></div>
                    <div id="CVDRDTrim4S" class="Trim4SCVDR SumCVDRS5"><input type="checkbox" name="CVDRDTrim4SX" value="1"></div>
                    <div id="CVDRLMTrim4S" class="Trim4SCVDR SumCVDRS6"><input type="checkbox" name="CVDRLMTrim4SX" value="1"></div>
                    <div id="CVDRMZTrim4S" class="Trim4SCVDR SumCVDRS7"><input type="checkbox" name="CVDRMZTrim4SX" value="1"></div>
                    <div id="CVDRMRTrim4S" class="Trim4SCVDR SumCVDRS8"><input type="checkbox" name="CVDRMRTrim4SX" value="1"></div>
                    <div id="CVDROXTrim4S" class="Trim4SCVDR SumCVDRS9"><input type="checkbox" name="CVDROXTrim4SX" value="1"></div>
                    <div id="CVDRTMTrim4S" class="Trim4SCVDR SumCVDRS10"><input type="checkbox" name="CVDRTMTrim4SX" value="1"></div>
                    <div id="CVDRTJTrim4S" class="Trim4SCVDR SumCVDRS11"><input type="checkbox" name="CVDRTJTrim4SX" value="1"></div>
                    <div id="CVDRTXTrim4S" class="Trim4SCVDR SumCVDRS12"><input type="checkbox" name="CVDRTXTrim4SX" value="1"></div>
                    <div id="CVDRCHITrim4S" class="Trim4SCVDR SumCVDRS13"><input type="checkbox" name="CVDRCHITrim4SX" value="1"></div>
                    <div id="CVDRVTrim4S" class="Trim4SCVDR SumCVDRS14"><input type="checkbox" name="CVDRVTrim4SX" value="1"></div>
                    <div id="CVDRGTrim4S" class="Trim4SCVDR SumCVDRS15"><input type="checkbox" name="CVDRGTrim4SX" value="1"></div>
                    <div id="CVDRPTrim4S" class="Trim4SCVDR SumCVDRS16"><input type="checkbox" name="CVDRPTrim4SX" value="1"></div>
                    <div id="Total4Trim4S" class="Trim4SCVDRT"></div>
                    
                    <div id="CVDRCJT" class="SCVDR1"></div>
                    <div id="CVDRCHT" class="SCVDR2"></div>
                    <div id="CVDRCNT" class="SCVDR3"></div>
                    <div id="CVDRCLT" class="SCVDR4"></div>
                    <div id="CVDRDT" class="SCVDR5"></div>
                    <div id="CVDRLMT" class="SCVDR6"></div>
                    <div id="CVDRMZT" class="SCVDR7"></div>
                    <div id="CVDRMRT" class="SCVDR8"></div>
                    <div id="CVDROXT" class="SCVDR9"></div>
                    <div id="CVDRTMT" class="SCVDR10"></div>
                    <div id="CVDRTJT" class="SCVDR11"></div>
                    <div id="CVDRTXT" class="SCVDR12"></div>
                    <div id="CVDRCHIT" class="SCVDR13"></div>
                    <div id="CVDRVT" class="SCVDR14"></div>
                    <div id="CVDRGT" class="SCVDR15"></div>
                    <div id="CVDRPT" class="SCVDR16"></div>
                    <div id="Total4T" class="SCVDRT"></div>
                </div>
            </div>
            <div id="contfooter">
                <input id="Save" type="submit" value="Guardar"/>
                <input id="idioma" type="hidden" value=""/>
                <input id="Back" type="submit" value="Recuperar datos pasados"/>
                <input id="Send" type="submit" value="Enviar"/>
            </div>
        </form>
    </div>
</body>


<script type="text/javascript">
    
    const selectIdioma = document.getElementById('SelectNivel');
    const idioma = document.getElementById('idioma');

    // Agregar un event listener para el evento 'change'
    selectIdioma.addEventListener('change', () => {
        // Obtener el valor seleccionado del select
        const idiomaSeleccionado = selectIdioma.value;
        
        // Verificar si se ha seleccionado un idioma válido
        if (idiomaSeleccionado !== "") {
            // Se ha seleccionado un idioma, puedes realizar acciones aquí
            console.log("Se ha seleccionado el idioma: " + idiomaSeleccionado);
            idioma.value = idiomaSeleccionado;

        } else {
            // No se ha seleccionado ningún idioma válido
            console.log("No se ha seleccionado ningún idioma");
        }
    });


    let btnGuardar = document.getElementById("Send");

    btnGuardar.addEventListener('mouseover', () => {
        console.log("El mouse está sobre el botón guardar.");
        let form = document.getElementById("DataCelex");
        if (form) {
            form.action = "enviarDataF1.php"; // Reemplaza "nueva_url" con la URL deseada
            let form2 = document.getElementById("DataCelex");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    
    btnGuardar.addEventListener('mouseout', () => {
        let form = document.getElementById("DataCelex");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            let form2 = document.getElementById("DataCelex");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    let btnEnviar = document.getElementById("Save");
    
    btnEnviar.addEventListener('mouseover', () => {
        console.log("El mouse está sobre el botón enviar.");
        let form = document.getElementById("DataCelex");
        if (form) {
            form.action = "guardarDataF1.php"; // Reemplaza "nueva_url" con la URL deseada
            let form2 = document.getElementById("DataCelex");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    
    btnEnviar.addEventListener('mouseout', () => {
        let form = document.getElementById("DataCelex");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            let form2 = document.getElementById("DataCelex");
            console.log("Nuevo action del formulario:", form2);
        }
    });
</script>

</html>