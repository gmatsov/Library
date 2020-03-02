<?php
if (isset($_SESSION["flash"])):?>
    <div class=' m-3 alert alert-<?= $_SESSION['flash']['type'] ?>'> <?= $_SESSION['flash']['message'] ?></div>
    <?php
    unset($_SESSION["flash"]);
endif;
