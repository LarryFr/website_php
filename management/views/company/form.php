<?php
require_once('views/resumenavbar/resumenavbar.php');
?>
<h1>Société</h1>
<?php
//require('views/countryselect.php');
?>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <?php if (isset($viewModel['id']))
    {
        ?>
        <div class="form-group">
            <label>ID</label>
            <input type="text" name="id" value="<?= $viewModel['id']; ?>" readonly />
        </div>
        <?php
    }
    ?>
    <div class="form-group">
        <label>Nom</label>
        <input type="text" name="name" value="<?= isset($viewModel['name']) ? $viewModel['name'] : ''; ?>" required />
    </div>
    <input class="btn btn-primary" name="submit" type="submit" value="Submit" />
    <a class="btn btn-warning" href="<?= ROOT_MNGT; ?>company">Cancel</a>
    <?php if (isset($viewModel['id']))
    {
        ?>
        <a class="btn btn-danger" href="<?= ROOT_MNGT.'company/delete/'.$viewModel['id']; ?>">Delete</a><br>
        <?php
    }
    ?>
</form>
