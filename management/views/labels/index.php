<h1>Labels</h1>
<h5><a href="<?= ROOT_MNGT.'labels/add'; ?>">Nouveau label</a></h5>
<br>
<div class="navbar-index">
    <table style="width:95%; text-align: left;">
        <tr>
            <th style="width:5%;">Id</th>
            <th style="width:25%;">Référence</th>
        </tr>
    </table>
    <?php
    foreach ($viewModel as $item)
    {
    ?>
        <a href="<?= ROOT_MNGT.'labels/update/'.$item['id']; ?>">
            <table style="width:95%;">
                <tr>
                    <td style="width:5%;"><?= $item['id']; ?></td>
                    <td style="width:25%;"><?= $item['ref']; ?></td>
                </tr>
            </table>
        </a>
    <?php
    }
    ?>
</div>
