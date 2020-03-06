<?php function draw_report($title, $reason, $date) { ?>
    <tr>
        <td><?=$title?></td>
        <td><?=$reason?></td>
        <td><?=$date?></td>
        <td class="dropdown">
            <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Move</a>
                <a class="dropdown-item" href="#">Delete</a>
                <a class="dropdown-item" href="#">Resolve</a>
                <a class="dropdown-item" href="#">Revert</a>
                <a class="dropdown-item" href="#">Ignore</a>
            </div>
        </td>
    </tr>
<?php } ?>
