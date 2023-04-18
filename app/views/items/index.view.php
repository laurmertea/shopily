<div class="flex-column-center" style="border-bottom: 1px solid black;">
    <li 
        style="display: flex; justify-content: space-between; min-width: 400px; min-height: 2em; margin: 0.75em 0.5em;" id="<?= $data->id;?>" 
        onmouseover="show(this.id)" onmouseleave="hide(this.id)">
        <div class="left" style="display: flex; flex-direction: column;">
            <div style="display: flex;">
                <form action="updateItem" method="post">
                    <input type="hidden" name="id" value="<?= $data->id;?>">
                    <input type="hidden" name="list_id" value="<?= $data->list_id;?>">
                    <input type="hidden" name="title" value="<?= $data->title;?>">
                    <input type="hidden" name="description" value="<?= $data->description;?>">
                    <input 
                        style="margin-right: .5em;"
                        type="checkbox" id="list-item-<?= $data->id;?>" 
                        name="completed"
                        onChange="this.form.submit()"
                        <?php if ($data->completed == 1): ?>
                            checked
                        <?php endif; ?>>           
                    </input>
                </form>
                <div>
                    <?= $data->title; ?>
                </div>
            </div>
            
            <div style="font-style: italic; color: gray; font-size: small; margin-left: 2em;">
                <?= $data->description; ?>
            </div>
        </div>

        <div 
            class="hidden right" 
            id="actions-list-item-<?= $data->id;?>" style="cursor: pointer;">
            <form action="deleteItem" method="post">
                <input type="hidden" name="id" value="<?= $data->id;?>">
                <input style="background-color: red; color: white;" id="delete_item_btn" value="Delete" type="submit">
            </form>
        </div>
    </li>
</div>

<script>
    function toggle(id) {
        const currentEl = document.querySelector('#actions-list-item-' + id);
        if (currentEl.classList.contains('shown')) { 
            currentEl.classList.remove('shown');
            currentEl.classList.add('hidden');
        } else {
            currentEl.classList.remove('hidden');
            currentEl.classList.add('shown');
        }
    }

    function show(id) {
        const currentEl = document.querySelector('#actions-list-item-' + id);
        currentEl.classList.remove('hidden');
        currentEl.classList.add('shown');
    }

    function hide(id) {
        const currentEl = document.querySelector('#actions-list-item-' + id);
        currentEl.classList.remove('shown');
        currentEl.classList.add('hidden');
    }
    
</script>