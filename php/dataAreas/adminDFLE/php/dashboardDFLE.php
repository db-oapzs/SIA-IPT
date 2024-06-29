<?php
    //include 'menu.php';
    include 'menuFinal.php';
?>

<style type="text/css">
    #contPDashDFLE{
        width: 100vw;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }
    #contPDashDFLE > #conTHijDs{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-left: 50px;
        border-radius:5px;
        overflow: hidden;
        box-shadow: 0px 0px 14px -1px rgba(0,0,0,0.10);
    }
    #contPDashDFLE > #conTHijDs > #framEid{
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
</style>
<div id="contPDashDFLE">
    <div id="conTHijDs">
    <iframe id="framEid" title="Plantilla" src="https://app.powerbi.com/view?r=eyJrIjoiMmI4ZDFjYmItMmI2Zi00ZjA2LTkyNzMtZDE1Zjk2Njg1OWU0IiwidCI6ImY5NGJmNGQ5LTgwOTctNDc5NC1hZGY2LWE1NDY2Y2EyODU2MyIsImMiOjR9" frameborder="0" allowFullScreen="true"></iframe>
    </div>
</div>
</body>
</html>