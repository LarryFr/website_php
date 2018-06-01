<?php

class ResumeModel extends Model
{
    const curDB = 'lacombed_experiences';

    public function Index()
    {
        $this->changeDatabase(self::curDB);
        $this->query("SELECT e.id, e.date_start, e.date_end, e.bVisible,
                             efr.title title_fr, een.title title_en,
                             cfr.name city_fr, ctfr.name country_fr,
                             cen.name city_en, cten.name country_en,
                             cpy.name company
                      FROM experience AS e
                        INNER JOIN experience_tr AS efr ON e.id = efr.id AND efr.id_Language = 1
                        INNER JOIN experience_tr AS een ON e.id = een.id AND een.id_Language = 2
                        INNER JOIN city AS c ON e.id_City = c.id
                        INNER JOIN city_tr AS cfr ON c.id = cfr.id AND cfr.id_Language = 1
                        INNER JOIN city_tr AS cen ON c.id = cen.id AND cen.id_Language = 2
                        INNER JOIN country AS ct ON c.id_Country = ct.id
                        INNER JOIN country_tr AS ctfr ON ct.id = ctfr.id AND ctfr.id_Language = 1
                        INNER JOIN country_tr AS cten ON ct.id = cten.id AND cten.id_Language = 2
                        INNER JOIN company AS cpy ON e.id_Company = cpy.id
                      WHERE e.bVisible = 1
                      ORDER BY e.bVisible DESC, e.date_end DESC, e.date_start DESC");
        $rows = $this->resultSet();
        $this->close();
        return $rows;
    }

    public function Add()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if ($post['submit'])
        {
            date_default_timezone_set('Europe/Paris');
            if ($post['title_fr'] == '' || $post['title_en'] == '' 
             || $post['content_fr'] == '' || $post['content_en'] == ''
             || $post['date_start'] == '' || $post['id_Company'] == '' 
             || $post['id_City'] == '')
            {
                Messages::setMsg('Please fill in all mandatory fields', 'error');
            }
            else if ($post['date_end'] != '' && strtotime($post['date_end']) <= strtotime($post['date_start']))
            {
                Messages::setMsg("End Date must be greater than the Start Date", 'error');
            }
            else
            {
                // Insert into MySQL
                var_dump($post);
                $this->changeDatabase(self::curDB);
                $this->startTransaction();
                //Insertion des données générales
                $this->query("INSERT INTO experience (id_Company, id_City, date_start, date_end, bVisible)
                            VALUES (:id_Company, :id_City, :date_start, :date_end, :bVisible)");
                $this->bind(':id_Company', $post['id_Company']);
                $this->bind(':id_City', $post['id_City']);
                $this->bind(':date_start', $post['date_start']);
                $this->bind(':date_end', $post['date_end'] != '' ? $post['date_end'] : NULL);
                $this->bind(':bVisible', isset($post['bVisible']) ? $post['bVisible'] : 0);
                $resp = $this->execute();
                $id = $this->lastIndexId();
                echo $id;
                //Insertion du titre français
                $this->query('INSERT INTO experience_tr (id, id_Language, title, content)
                            VALUES(:id, 1, :title, :content)');
                $this->bind(':id', $id);
                $this->bind(':title', $post['title_fr']);
                $this->bind(':content', $post['content_fr']);
                $respfr = $this->execute();
                //Insertion du titre anglais
                $this->query('INSERT INTO experience_tr (id, id_Language, title, content)
                            VALUES(:id, 2, :title, :content)');
                $this->bind(':id', $id);
                $this->bind(':title', $post['title_en']);
                $this->bind(':content', $post['content_en']);
                $respen = $this->execute();

                //Verify
                if($resp && $respen && $respfr)
                {
                    $this->commit();
                    $this->close();
                    $this->returnToPage('resume');
                }
                $this->rollback();
                $this->close();
                Messages::setMsg('Error(s) during insert : [resp='.$resp.', respen='.$respen.', respfr='.$respfr.']', 'error');
            }
        }
        return;
    }

    public function Update()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if ($post['submit'])
        {
            date_default_timezone_set('Europe/Paris');
            if ($post['title_fr'] == '' || $post['title_en'] == '' 
             || $post['content_fr'] == '' || $post['content_en'] == ''
             || $post['date_start'] == '' || $post['id_Company'] == '' 
             || $post['id_City'] == '')
            {
                Messages::setMsg('Please fill in all mandatory fields', 'error');
            }
            else if ($post['date_end'] != '' && strtotime($post['date_end']) <= strtotime($post['date_start']))
            {
                Messages::setMsg("End Date must be greater than the Start Date", 'error');
            }
            else
            {
                // Insert into MySQL
                $this->changeDatabase(self::curDB);
                $this->startTransaction();
                //Insertion des données générales
                $this->query("INSERT INTO experience (id_Company, id_Country, date_start, date_end, bVisible)
                            VALUES (:id_Company, :id_Country, :date_start, :date_end, :bVisible)");
                $this->bind(':id_Company', $post['id_Company']);
                $this->bind(':id_Country', $post['id_Country']);
                $this->bind(':date_start', $post['date_start']);
                $this->bind(':date_end', $post['date_end']);
                $this->bind(':bVisible', isset($post['bVisible']) ? $post['bVisible'] : 0);
                $resp = $this->execute();
                $id = $this->lastIndexId();
                //Insertion du titre français
                $this->query('INSERT INTO experience_tr (id, id_Language, title, description)
                            VALUES(:id, 1, :title, :description)');
                $this->bind(':id', $id);
                $this->bind(':title', $post['title_fr']);
                $this->bind(':description', $post['description_fr']);
                $respfr = $this->execute();
                //Insertion du titre anglais
                $this->query('INSERT INTO experience_tr (id, id_Language, title, description)
                            VALUES(:id, 2, :title, :description)');
                $this->bind(':id', $id);
                $this->bind(':title', $post['title_en']);
                $this->bind(':description', $post['description_en']);
                $respen = $this->execute();

                //Verify
                if($resp && $respen && $respfr)
                {
                    $this->commit();
                    $this->close();
                    $this->returnToPage('resume');
                }
                $this->rollback();
                $this->close();
                Messages::setMsg('Error(s) during insert : [resp='.$resp.', respen='.$respen.', respfr='.$respfr.']', 'error');
            }
        }
        $this->query("SELECT e.id, efr.title title_fr, een.title title_en, e.id_Company, e.id_City, e.bVisible,
                             e.date_start, e.date_end, efr.content content_fr, een.content content_en
                      FROM experience AS e 
                        INNER JOIN experience_tr AS efr ON e.id = efr.id AND efr.id_Language = 1
                        INNER JOIN experience_tr AS een ON e.id = een.id AND een.id_Language = 2
                      WHERE e.id = :id");
        $this->bind(':id', $_GET['id']);
        $rows = $this->single();
        $this->close();
        if (!$rows)
        {
            Messages::setMsg('Record "'.$_GET['id'].'" not found', 'error');
            $this->returnToPage('resume');
        }
        return $rows;
    }

    public function Delete()
    {
        return;
    }
}

?>