<?= "<li class='list grid_item shadowed rounded-10 border-2 {$list->status()}' title='{$list->title}' onclick='show({$list->toJson()});'>" ;?>
    <?= "<img src='../img/{$list->status()}.png' alt='list status check' width='10%' style='float: left;'>" ;?>
    <?= $list->title ;?>
</li>