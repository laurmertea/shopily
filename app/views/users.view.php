<?php partial('head'); ?>

    <div class="content-container">

        <form action="/users" method="post">
            <input placeholder="Type a name here ..." type="text" name="name"></input>
            <button type="submit">Add</button>
        </form>

        <hr />

        <?php if (count($users) > 0): ?>
            <div class="center">
                <!-- Current usernames list title -->
                <div>
                    <h1 id="title">Current Registered Usernames</h1>
                </div>
                <!-- Current usernames list -->
                <ul class="nb_list">
                    <?php foreach ($users as $user): ?>
                        <li>
                            <?= $user->username; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else: ?>
            <!-- Empty usernames list content -->
            <div class="center" id="empty_container">
                <h3 id="title">There are no usernames currently registered ...</h3>
                <img src="../img/sleeping.png" alt="Sleeping cloud" width="10%">
            </div>
        <?php endif;?>
    </div>

<?php partial('foot');?>
