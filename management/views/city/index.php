<?php
require_once('views/resumenavbar/resumenavbar.php');
?>
<h1>Villes</h1>
<h5><a href="<?php echo ROOT_MNGT.'city/add'; ?>">Nouvelle ville</a></h5>
<div class="navbar-index">
    <table style="width:100%; text-align: left;">
        <tr>
            <th style="width:5%;">Id</th>
            <th style="width:15%;">Nom français</th>
            <th style="width:15%;">Nom anglais</th>
            <th style="width:15%;">Pays</th>
        </tr>
    </table>
    <?php
    foreach ($viewModel as $item)
    {
    ?>
        <a href="<?php echo ROOT_MNGT.'city/update/'.$item['id']; ?>">
            <table style="width:100%;">
                <tr>
                    <td style="width:5%;"><?php echo $item['id']; ?></td>
                    <td style="width:15%;"><?php echo $item['title_fr']; ?></td>
                    <td style="width:15%;"><?php echo $item['title_en']; ?></td>
                    <td style="width:15%;"><?php echo $item['country']; ?></td>
                </tr>
            </table>
        </a>
    <?php
    }
    ?>
</div>
