<?php if (isset($_SESSION['message'])):?> 
    <?php foreach ($_SESSION['message'] as $status => $message) :?>
         <div class="container alert alert-<?= $status == 'success' ? 'success' : 'danger'; ?>" role= "alert"> <!-- affiche danger en rouge si c'est faux et success en vert si c'est bon-->
        <?php echo $message;
        unset($_SESSION['message'][$status]);
        ?>
       
    </div>
    <?php endforeach; ?>
<?php endif; ?>