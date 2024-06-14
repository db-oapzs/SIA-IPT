<?php
    //include 'menu.php';
    include 'menuFinal.php';
?>

    <div class="container-padre">
        <div class="container-hijo">
            <img src="../recursos/media/logo2.png" alt="">
            <h1>¡Bienvenido, Administrador!</h1>
            
            <div class="container-clock">
                <p id="date">date</p>
                <p id="time">00:00:00</p>
            </div>

            
        </div>
        
    </div>
    
    
</body>
<script>
    const time = document.getElementById('time');
    const date = document.getElementById('date');

    const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];

    const interval = setInterval(() => {

        const local = new Date();
        
        let day = local.getDate(),
            month = local.getMonth(),
            year = local.getFullYear();

        time.innerHTML = local.toLocaleTimeString();
        date.innerHTML = `${day} ${monthNames[month]} ${year}`;

    }, 1000);
</script>
</html>