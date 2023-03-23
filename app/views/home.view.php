<?php partial('head', compact('title')); ?>

    <div class="content_container flex-center" id="content">
        <?php if (count($lists) > 0): ?>
            <div id="current-lists">
                <!-- Current lists list title -->
                <h1 class="title">Your lists <span class="subtitle"><?= currentDate() ;?></span></h1>
                <!-- Current lists list -->
                <ul class="grid_container nb_list">
                    <?php foreach ($lists as $list): ?>
                        <?php view('lists/index', $list); ?>
                    <?php endforeach; ?>
                    <li class="list grid_item shadowed rounded-10 border-2 add">
                        <img src='../img/add.png' alt='Add new list' width='10%' style='float: left;'>
                        Add another list
                    </li>
                </ul>
            </div>
            
            <!-- Current list -->
            <div class="flex-grow-8 rounded-10 border-2 border-white white-bg shadowed hidden" id="current-list" style="padding-left: 10px;">
                <div class="flex">
                    <div id="current-list-status"></div>
                    <h1 class="title" id="current-list-title" style="margin-left: 8px; margin-top: 8px;">list title</h1>
                    <span class="subtitle" id="current-list-created" style="margin-left: 8px; margin-top: 8px;">list created at</span>
                    <div class="right" style="margin-left: auto; margin-right: 8px; margin-top: 4px; text-decoration: none;" id="close-current" onclick="hide()">&#10006;</div>
                </div>
                <div id="current-list-description" style="margin-left: 8px; margin-top: 8px;">list description</div>

                <div id="current-items">
                    <div id="add-item-form" class="hidden">
                        <form action="addItem" method="post">
                            <input type="text" id="item_title" name="title" placeholder="Item Title"><br />
                            <label class="error left hide-in-5" for="item_title"><?= ($errors['item_title']) ?? "";?></label>
                            <input type="text" id="item_description" name="description" placeholder="Item Description"><br />
                            <label class="error left hide-in-5" for="item_description"><?= ($errors['item_description']) ?? "";?></label>
                            <input type="text" id="item_list_id" name="list_id" value="<?= $list->id;?>" hidden><br />
                            <input type="checkbox" id="item_completed" name="completed" value="0" hidden><br />
                            <input class="blue-bg" id="add_item_btn" type="submit" value="Add Item">
                        </form>
                    </div>

                    <ul id="current-items-list" class="nb_list">
                        <li>Add an item</li>
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <?php view('lists/empty'); ?>
        <?php endif;?>
    </div>

<?php partial('foot');?>
