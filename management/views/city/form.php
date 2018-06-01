<h1>Ville</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <?php if (isset($viewModel['id']))
    {
        ?>
        <div class="form-group">
            <label>ID</label>
            <input type="text" name="id" value="<?php echo $viewModel['id']; ?>" readonly />
        </div>
        <?php
    }
    ?>
    <div class="form-group">
        <label>Pays</label>
        <select name="id_Country" required>
            <option value=""></option>
            <?php
            $clm = new CountryModel();
            $clmlist = $clm->getList();
            foreach ($clmlist as $item)
            {
                ?>
                <option value="<?php echo $item['id']; ?>" <?php echo $viewModel['id_Country'] == $item['id'] ? 'selected' : ''; ?>><?php echo $item['name']; ?></option>
                <?php
            }
            ?>
        </select>
        <a href="<?php echo ROOT_MNGT; ?>country/add">Ajout</a>
    </div>
    <div class="form-group">
        <label>Nom français</label>
        <input type="text" name="name_fr" value="<?php echo isset($viewModel['name_fr']) ? $viewModel['name_fr'] : ''; ?>" required />
    </div>
    <div class="form-group">
        <label>Nom anglais</label>
        <input type="text" name="name_en" value="<?php echo isset($viewModel['name_en']) ? $viewModel['name_en'] : ''; ?>" required />
    </div>
    <input class="btn btn-primary" name="submit" type="submit" value="Submit" />
    <a class="btn btn-danger" href="<?php echo ROOT_MNGT; ?>city">Cancel</a>
    <?php if (isset($viewModel['id']))
    {
        ?>
        <a class="btn btn-danger" href="<?php echo ROOT_MNGT.'city/delete/'.$viewModel['id']; ?>">Delete</a><br>
        <?php
    }
    ?>
</form>
