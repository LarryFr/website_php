<?php

class Country extends Controller
{
    protected function index()
    {
        $this->checkLogin();
        $viewmodel = new CountryModel();
        $this->returnView($viewmodel->Index());
    }

    protected function add()
    {
        $this->checkLogin();
        $viewmodel = new CountryModel();
        $this->returnView($viewmodel->Add());
    }

    protected function update()
    {
        $this->checkLogin();
        if ($_GET['id'] == '')
        {
            header('Location: '.ROOT_MNGT.'/'.strtolower(get_class($this)));
        }
        $viewmodel = new CountryModel();
        $this->returnView($viewmodel->Update());
    }

    protected function delete()
    {
        $this->checkLogin();
        if ($_GET['id'] == '')
        {
            header('Location: '.ROOT_MNGT.'/'.strtolower(get_class($this)));
        }
        $viewmodel = new CountryModel();
        $this->returnView($viewmodel->Delete());
    }
}

?>