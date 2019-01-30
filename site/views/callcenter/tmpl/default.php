<?php
defined('_JEXEC') or die('Restricted Access');
?>

<div class="codigotitulo">
<?php 
    echo '<h1>'.$this->texto_principal.'</h1>';
    echo '<p>'.$this->texto_secundario.'</p>';
?>

<div class="formulario" style="display: table;margin: 0 auto;">
   <?php
       echo $this->loadTemplate('form');
    ?>
    </div>
</div>
