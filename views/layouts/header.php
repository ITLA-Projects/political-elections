<?php

$auth = new Auth();

?>

<div class="bg-dark d-flex justify-content-between">
    <div class="d-flex align-items-center">
        <h2 class="ml-3 text-white">Political Elections</h2>
    </div>
    <div>
        <ul class="d-flex justify-content-end align-items-center mb-0">
            <?php if ($auth->checkAuthentication() ): ?>
                <li class="p-3"><a class="text-white" href="#">
                        <span class="text-warning">
                            Welcome <?php echo $auth->retrieve()->firstname ?>
                        </span>
                    </a></li>
                <li class="p-3"><a class="text-white" href="<?php echo constant('URL'); ?>selection">Manage</a></li>
                <li class="p-3"><a class="text-white" href="<?php echo constant('URL'); ?>logout">Logout</a></li>
            <?php elseif($auth->checkAuthentication('citizen')) : ?>
                <li class="p-3"><a class="text-white" href="#">
                        <span class="text-warning">
                            Welcome <?php echo $auth->retrieve('citizen')->firstname ?>
                        </span>
                    </a></li>
                <li class="p-3"><a class="text-white" href="<?php echo constant('URL'); ?>selection">Selection</a></li>
                <li class="p-3"><a class="text-white" href="<?php echo constant('URL'); ?>logout">Exit Election</a></li>
            <?php else: ?>
                <li class="p-3"><a class="text-white" href="<?php echo constant('URL'); ?>">Home</a></li>
                <li class="p-3"><a class="text-white" href="<?php echo constant('URL'); ?>login">Admin Login</a></li>
            <?php endif; ?>

        </ul>
    </div>
</div>