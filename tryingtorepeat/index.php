<?php
    require 'header.php';
?>
    <main>
        <?php
            if(isset($_SESSION["ID"])){
                echo "YOU ARE LOGGED IN";
            }
            else{
                echo "YOU ARE LOGGED OUT";
            }
        ?>

    </main>
<?php
    require 'footer.php';
?>