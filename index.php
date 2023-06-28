<!--Header-->
<?php 
    include_once __DIR__ . '/templates/header.php';
?>
<!--Header-->

<!--Sidebar-->
<?php 
    include_once __DIR__ . '/templates/sidebar.php';
?>
<!--Sidebar-->

<!--Contenido-->
<section id="content">

    <!--navBarUno-->
    <?php 
        include_once __DIR__ . '/templates/navBarUno.php';
    ?>
    <!--navBarUno-->

    <!-- NAVBAR DOS -->
    <?php 
        include_once __DIR__ . '/templates/navBarDos.php';
    ?>
    <!-- NAVBAR DOS -->

    <!--Main, va a estar todo el cuerpo de la pagina-->
    <main>
        
        <section id="registro">
            <h1 class="title text-center"></h1>
            <section id="formCampers">

                <?php 
                    include_once __DIR__ . '/view/Camper/formCamper.php';
                ?>

            </section>
        </section>

    </main>
    <!--Main-->
</section>
<!--Contenido-->

<!--Footer-->
<?php 
    include_once __DIR__ . '/templates/footer.php';
?>
<!--Footer-->