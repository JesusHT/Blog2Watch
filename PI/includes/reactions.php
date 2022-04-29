<?php 

    require 'db.php';

    

?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
    <p class="clasificacion">
        <input id="radio1<?php echo $result -> id_post; ?>" type="radio" name="estrellas" value="5">
        <label for="radio1<?php echo $result -> id_post; ?>"><i class="fa-solid fa-popcorn"></i></label>
        <input id="radio2<?php echo $result -> id_post; ?>" type="radio" name="estrellas" value="4">
        <label for="radio2<?php echo $result -> id_post; ?>"><i class="fa-solid fa-popcorn"></i></label>
        <input id="radio3<?php echo $result -> id_post; ?>" type="radio" name="estrellas" value="3">
        <label for="radio3<?php echo $result -> id_post; ?>"><i class="fa-solid fa-popcorn"></i></label>
        <input id="radio4<?php echo $result -> id_post; ?>" type="radio" name="estrellas" value="2">
        <label for="radio4<?php echo $result -> id_post; ?>"><i class="fa-solid fa-popcorn"></i></label>
        <input id="radio5<?php echo $result -> id_post; ?>" type="radio" name="estrellas" value="1">
        <label for="radio5<?php echo $result -> id_post; ?>"><i class="fa-solid fa-popcorn"></i></label>
    </p>
</form>