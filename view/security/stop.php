<?php 
use App\Session;

?>
<img class="patches" src="public\img\assets\patches.jpg" alt="patches crouching on you">

<p class="stop">

    <?= Session::getFlash("stop") ?>
</p>