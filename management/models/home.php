<?php

class HomeModel extends Model
{
    public function Index()
    {
        $display = array(
            array(  'title' => 'Barre de navigation',
                    'dest'  => 'navbar',
                    'datas' => array($this->countNavItems(), $this->countVisibleNavItems(), $this->countNotVisibleNavItems())
            ),
            array(  'title' => 'Contenu page principale',
                    'dest'  => 'content',
                    'datas' => array($this->countContent(), $this->countVisibleContent(), $this->countNotVisibleContent())
            ),
            array(  'title' => 'Configurations',
                    'dest'  => 'configs',
                    'datas' => array($this->countConfigs(), 'N/A', 'N/A')
            ),
            array(  'title' => 'Projets',
                    'dest'  => 'projects',
                    'datas' => array($this->countProjects(), $this->countVisibleProjects(), $this->countNotVisibleProjects())
            ),
            array(  'title' => 'Expériences professionnelles',
                    'dest'  => 'resume',
                    'datas' => array($this->countExp(), $this->countVisibleExp(), $this->countNotVisibleExp())
            ),
            array(  'title' => 'Parcours scolaire',
                    'dest'  => 'education',
                    'datas' => array($this->countEduc(), $this->countVisibleEduc(), $this->countNotVisibleEduc())
            ),
            array(  'title' => 'Poèmes',
                    'dest'  => 'poeme',
                    'datas' => array($this->countPoeme(), 'N/A', 'N/A')
            )
        );

        return $display;
    }

    private function countVisibleNavItems() { return (int)$this->countNavItems(true); }
    private function countNotVisibleNavItems() { return (int)$this->countNavItems(false); }
    private function countNavItems($bVisible = null)
    {
        $query = 'SELECT count(id) nb FROM indexitems WHERE id_Category = 1';
        if (!is_null($bVisible))
        {
            $query .= ' AND bVisible = '.(int)$bVisible;
        }
        $this->query($query);
        $rows = $this->single();
        $this->close();
        return $rows['nb'];
    }
    private function countVisibleContent() { return (int)$this->countContent(true); }
    private function countNotVisibleContent() { return (int)$this->countContent(false); }
    private function countContent($bVisible = null)
    {
        $query = 'SELECT count(id) nb FROM indexitems WHERE id_Category = 2';
        if (!is_null($bVisible))
        {
            $query .= ' AND bVisible = '.(int)$bVisible;
        }
        $this->query($query);
        $rows = $this->single();
        $this->close();
        return $rows['nb'];
    }
    private function countConfigs()
    {
        $query = 'SELECT count(id) nb FROM config';
        $this->query($query);
        $rows = $this->single();
        $this->close();
        return $rows['nb'];
    }
    private function countVisibleProjects() { return (int)$this->countProjects(true); }
    private function countNotVisibleProjects() { return (int)$this->countProjects(false); }
    private function countProjects($bVisible = null)
    {
        $query = 'SELECT count(id) nb FROM project';
        if (!is_null($bVisible))
        {
            $query .= ' WHERE bVisible = '.(int)$bVisible;
        }
        $this->query($query);
        $rows = $this->single();
        $this->close();
        return $rows['nb'];
    }
    private function countVisibleExp() { return (int)$this->countExp(true); }
    private function countNotVisibleExp() { return (int)$this->countExp(false); }
    private function countExp($bVisible = null)
    {
        $query = 'SELECT count(id) nb FROM experience';
        if (!is_null($bVisible))
        {
            $query .= ' WHERE bVisible = '.(int)$bVisible;
        }
        $this->query($query);
        $rows = $this->single();
        $this->close();
        return $rows['nb'];
    }
    private function countVisibleEduc() { return (int)$this->countEduc(true); }
    private function countNotVisibleEduc() { return (int)$this->countEduc(false); }
    private function countEduc($bVisible = null)
    {
        $query = 'SELECT count(id) nb FROM education';
        if (!is_null($bVisible))
        {
            $query .= ' WHERE bVisible = '.(int)$bVisible;
        }
        $this->query($query);
        $rows = $this->single();
        $this->close();
        return $rows['nb'];
    }
    private function countVisiblePoeme() { return (int)$this->countPoeme(); }
    private function countNotVisiblePoeme() { return (int)$this->countPoeme(); }
    private function countPoeme($bVisible = null)
    {
        $query = 'SELECT count(id) nb FROM poeme';
        $this->query($query);
        $rows = $this->single();
        $this->close();
        return $rows['nb'];
    }
}
?>