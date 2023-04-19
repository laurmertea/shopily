<?php

 partial('head', compact('title')); ?>
    <div class="content_container flex-column-center" id="content">
        <?php if (count($lists) > 0): ?>
            
            <?php view('lists/latest', $latestList); ?>

            <div style="margin-top: 2em;">
                See your <a class="action-link" href="/lists">other</a> lists
            </div>
        <?php else: ?>
            <?php view('lists/empty'); ?>
        <?php endif;?>
    </div>

<?php partial('foot');?>
