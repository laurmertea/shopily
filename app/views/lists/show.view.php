<div class="flex-column-center">
    <h2>Here's your list</h2>
    <div id="current-list" class="white-bg rounded-10 border-2 shadowed list">
        <div class="left">
            <div class="tooltip">
                <div class="status <?= ($data->completed) ? 'finished' : 'active'; ?>"></div>
                <span class="tooltipText">Status</span>
            </div>
        </div>
        <div class="flex-column-center">
            <div class="tooltip list-item">
                <h1 style="margin: 0; border-bottom: 1px solid black;"><?= $data->title; ?></h1>
                <span class="tooltipText">Your list</span>
            </div>

            <div class="tooltip list-item">
                <h6 style="margin: 0;"><?= $data->modified_on; ?></h6>
                <span class="tooltipText">Last accessed</span>
            </div>

            <div id="items">
                <?php foreach ($data->items as $item) : ?>
                    <?php view('items/index', $item); ?>
                <?php endforeach; ?>
                
                <div class="flex-column-center">
                    <div style="display: flex; justify-content: space-between; min-width: 400px; min-height: 2em; margin: 0.75em 0.5em;">
                        <a class="action-link" href="/addItem">Add a new item</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>