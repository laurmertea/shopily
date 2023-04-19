<?php

 partial('head', compact('title')); ?>
 <div class="content_container flex-column-center" id="content">
    <h1>Your Lists</h1>
    <div class="white-bg rounded-10 border-2 shadowed list">
        <?php foreach ($lists as $list): ?>
            <div class="flex-column-center bordered-item">
                <div style="display: flex; min-width: 400px; min-height: 2em; margin: 0.75em 0em;">
                    <div class="left">
                        <div 
                            class="tooltip" 
                            style="position: relative; top: 50%; -webkit-transform: translateY(-50%); -ms-transform: translateY(-50%); transform: translateY(-50%);">
                            <div class="status <?= ($list->completed) ? 'finished' : 'active'; ?>"></div>
                            <span class="tooltipText">Status</span>
                        </div>
                    </div>
                    <div class="flex-column-center" style="margin-left: 0.5em;">
                        <?= ($list->title); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
 </div>
