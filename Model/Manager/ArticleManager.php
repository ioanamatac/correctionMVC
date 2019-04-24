<?php
    class ArticleManager extends DbManager {
        public function __construct()
        {
            parent::__construct();
        }

        public function selectAll()
        {
            $articles = [];
            $sql =  'SELECT * FROM article ORDER BY date_creation';
            foreach  ($this->bdd->query($sql) as $row) {
                $articles[] = new Article($row['id'], $row['titre'], $row['contenu'], $row['date_creation']);
            }

            return $articles;
        }

        public function insert(Article $article)
        {
            $requete = $this->bdd->prepare("INSERT INTO article (titre, contenu, date_creation) VALUES (?,?,?)");
            $requete->bindParam(1, $article->getTitre());
            $requete->bindParam(2, $article->getContenu());
            $requete->bindParam(3, $article->getDateCreation());
            $requete->execute();
            $article->setId($this->bdd->lastInsertId());
        }

        public function delete($id)
        {
            $requete = $this->bdd->prepare("DELETE FROM article where id = ?");
            $requete->bindParam(1,$id);
            $requete->execute();
        }

        public function select($id)
        {
            $requete = $this->bdd->prepare("SELECT * FROM article WHERE id=?");
            $requete->bindParam(1, $id);
            $requete->execute();
            $res = $requete->fetch();
            $article = new Article($res['id'], $res['titre'], $res['contenu'], $res['date_creation']);

            return $article;
        }

        public function update(Article $article)
        {
            $requete = $this->bdd->prepare("UPDATE  article SET titre =? , contenu = ?, date_creation = ?");
            $requete->bindParam(1, $article->getTitre());
            $requete->bindParam(2, $article->getContenu());
            $requete->bindParam(3, $article->getDateCreation());
            $requete->execute();
        }

    }
?>