<?php
partial('head', compact('title')); ?>
<div class="content_container flex-column-center" id="content">
    <div class="flex-column-center">
        <h2>Create your new item</h2>
        <div id="new-item" class="white-bg rounded-10 border-2 shadowed list">
            <form action="/addItem" method="post">
                <input type="hidden" name="list_id" value="<?=$id;?>" required>
                <div class="flex-column-center">
                    <div class="flex-center" style="width: -webkit-fill-available;">
                        <div class="tooltip list-item" style="margin-right: 0.5em;">
                            <div class="dot flex-center">
                                <span style="font-size: smaller;">i</span>
                            </div>
                            <span class="tooltipText">Your new list item title; required</span>
                        </div>
                        <input type="text" name="title" placeholder="List item title" required>
                    </div>

                    <div class="flex-center" style="width: -webkit-fill-available; border-bottom: 1px solid #c3c3c3;">
                        <div class="tooltip list-item" style="margin-right: 0.5em;">
                            <div class="dot flex-center">
                                <span style="font-size: smaller;">i</span>
                            </div>
                            <span class="tooltipText">Your new list item description</span>
                        </div>
                        <input type="text" name="description" placeholder="List item description">
                    </div>

                    <div id="add">
                        <div class="flex-column-center">
                            <div style="display: flex; justify-content: space-between; min-width: 400px; min-height: 2em; margin: 0.75em 0.5em;">
                                <input type="submit" style="background-color: green;">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php partial('foot'); ?>
