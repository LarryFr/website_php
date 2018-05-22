<?php
$oldFramework = '';
foreach ($viewModel as $project)
{
    if ($oldFramework != $project['framework'])
    {
        // Fermeture du DIV framework-summary après changement de framework (sauf le premier)
        if ($oldFramework != '') { ?> </div> <?php }

        // Ouverture du DIV framework-summary ?>
        <div class="framework-summary">
        <h2><?php echo $project['framework']; ?></h2>
        <?php
    }
    $uniqueId = $project['id'].$project['title'];
    ?>

    <!-- DEBUT Partie à mettre à jour -->
    <div class="project-summary">
        <form method="post">
            <button class="project-btn" type="submit" formaction="<?php echo ROOT_URL.'project/display/'.$project['id']; ?>">
                <img src="data:image/jpeg;base64,<?php echo $project['img_blob']; ?>" alt="<?php echo $project['title']; ?>">
                <h4><?php echo $project['title']; ?></h4>
            </button>
        </form>
    </div>
    <!-- FIN Partie à mettre à jour -->

    <?php
    $oldFramework = $project['framework'];
}
?>
</div> <!-- Fermeture du dernier DIV framework-summary -->