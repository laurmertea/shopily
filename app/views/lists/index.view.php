<?= "<li class='list grid_item shadowed rounded-10 border-2 {$data->status()}' title='{$data->title}' onclick='show({$data->toJson()});'>" ;?>
    <?= "<img src='../img/{$data->status()}.png' alt='list status check' width='10%' style='float: left;'>" ;?>
    <?= $data->title ;?>
</li>