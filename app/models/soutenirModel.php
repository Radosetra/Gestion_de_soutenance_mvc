<?php 

class Soutenir 
{
    private $matricule;
    private $annee_univ;
    private $id_org;
    private $note;
    private $president;
    private $examinateur;
    private $rapporteur_int;
    private $rapporteur_ext;

    public function __construct($matricule,$annee_univ,$id_org,$note,$president,$examinateur,$rapporteur_int,$rapporteur_ext){
        $this->matricule = $matricule;
        $this->annee_univ = $annee_univ;
        $this->id_org = $id_org;
        $this->note = floatval($note);
        $this->president = $president;
        $this->examinateur = $examinateur;
        $this->rapporteur_int = $rapporteur_int;
        $this->rapporteur_ext = $rapporteur_ext;
    }

    public function getMatricule(){
        return $this->matricule;
    }
    public function getAnnee_univ(){
        return $this->annee_univ;
    }
    public function getId_org(){
        return $this->id_org;
    }
    public function getNote(){
        return $this->note;
    }
    public function getPresident(){
        return $this->president;
    }
    public function getExaminateur(){
        return $this->examinateur;
    }
    public function getRapporteur_int(){
        return $this->rapporteur_int;
    }
    public function getRapporteur_ext(){
        return $this->rapporteur_ext;
    }

    // SET FUNCTIONS 
    public function SetMatricule($matricule){
        $this->matricule = $matricule;
    }
    public function setAnnee_univ($annee_univ){
        $this->annee_univ = $annee_univ;
    }
    public function setId_org($id_org){
        $this->id_org = $id_org;
    }
    public function setNote($note){
        $this->note = $note;
    }
    public function setPresident($president){
        $this->president = $president;
    }
    public function setExaminateur($examinateur){
        $this->examinateur = $examinateur;
    }
    public function setRapporteur_int($rapporteur_int){
        $this->rapporteur_int = $rapporteur_int;
    }
    public function setRapporteur_ext($rapporteur_ext){
        $this->rapporteur_ext = $rapporteur_ext;
    }

    // CRUD
    public function create(){
        $pdo = Database::connect();

        $qry = "INSERT INTO `soutenir` (matricule, annee_univ, id_org, note, president, examinateur, rapporteur_int, rapporteur_ext)
        VALUES (:matricule, :annee_univ, :id_org, :note, :president, :examinateur, :rapporteur_int, :rapporteur_ext)";

        $preparedQry = $pdo->prepare($qry);
        $preparedQry->bindParam(':matricule',$this->matricule,PDO::PARAM_STR);
        $preparedQry->bindParam(':annee_univ',$this->annee_univ,PDO::PARAM_STR);
        $preparedQry->bindParam(':id_org',$this->id_org,PDO::PARAM_INT);
        // A noter que note est de type `float` mais la bdd le transformera automatiquement
        $preparedQry->bindParam(':note',$this->note,PDO::PARAM_STR);
        $preparedQry->bindParam(':president',$this->president,PDO::PARAM_STR);
        $preparedQry->bindParam(':examinateur',$this->examinateur,PDO::PARAM_STR);
        $preparedQry->bindParam(':rapporteur_int',$this->rapporteur_int,PDO::PARAM_STR);
        $preparedQry->bindParam(':rapporteur_ext',$this->rapporteur_ext,PDO::PARAM_STR);

        $success = true;
        try{
            $preparedQry->execute();
        } catch (PDOException $e){
            echo $e->getMessage();
            $success = false;
        }

        Database::disconnect();

        return $success;
    }

    public static function readAll(){
        $pdo = Database::connect();

        $qry = 
        "SELECT s.matricule as `Matricule`, 
                e.nom_etudiant as `Nom`, 
                e.prenom_etudiant as `Prenom(s)`, 
                o.design as `Organisme`, 
                s.note as `Note`, 
                s.annee_univ as `Annee universitaire`, 
                CONCAT(p1.nom_prof, ' ', p1.prenom_prof) AS `President`, 
                CONCAT(p2.nom_prof, ' ', p2.prenom_prof) AS `Examinateur`, 
                CONCAT(p3.nom_prof, ' ', p3.prenom_prof) AS `Rapporteur Int`, 
                CONCAT(p4.nom_prof, ' ', p4.prenom_prof) AS `Rapporteur Ext`
        FROM soutenir s
        JOIN organismes o ON s.id_org = o.id_org
        JOIN etudiants e ON s.matricule = e.matricule
        JOIN professeurs p1 ON s.president = p1.id_prof
        JOIN professeurs p2 ON s.examinateur = p2.id_prof
        JOIN professeurs p3 ON s.rapporteur_int = p3.id_prof
        JOIN professeurs p4 ON s.rapporteur_ext = p4.id_prof;";

        $preparedQry = $pdo->prepare($qry);
        $preparedQry->execute();

        $response = $preparedQry->fetchAll();

        Database::disconnect();

        return $response;
    }

    public static function update($id,$data){
        $pdo = Database::connect();

        $qry = 
        "UPDATE soutenir 
        SET matricule = :matricule, 
        annee_univ = :annee_univ, 
        id_org = :id_org, 
        note = :note, 
        president = :president, 
        examinateur = :examinateur, 
        rapporteur_int = :rapporteur_int, 
        rapporteur_ext = :rapporteur_ext
        WHERE matricule = :id";

        $preparedQry = $pdo->prepare($qry);

        $preparedQry->bindParam(':matricule',$data['matricule'],PDO::PARAM_STR);
        $preparedQry->bindParam(':annee_univ',$data['annee_univ'],PDO::PARAM_STR);
        $preparedQry->bindParam(':id_org',$data['id_org'],PDO::PARAM_INT);
        $preparedQry->bindParam(':note',$data['note']);
        $preparedQry->bindParam(':president',$data['president'],PDO::PARAM_STR);
        $preparedQry->bindParam(':examinateur',$data['examinateur'],PDO::PARAM_STR);
        $preparedQry->bindParam(':rapporteur_int',$data['rapporteur_int'],PDO::PARAM_STR);
        $preparedQry->bindParam(':rapporteur_ext',$data['rapporteur_ext'],PDO::PARAM_STR);
        $preparedQry->bindParam(':id',$id,PDO::PARAM_STR);

        $success = true;
        try{
            $preparedQry->execute();
        } catch (PDOException $e){
            echo $e->getMessage();
            $success = false;
        }

        Database::disconnect();

        return $success;
    }

    public static function delete($id){
        $pdo = Database::connect();

        $qry = 
        "DELETE FROM soutenir
        WHERE matricule = :id";

        $preparedQry = $pdo->prepare($qry);

        $preparedQry->bindParam(':id',$id,PDO::PARAM_STR);

        $success = true;
        try{
            $preparedQry->execute();
        } catch (PDOException $e){
            echo $e->getMessage();
            $success = false;
        }

        Database::disconnect();

        return $success;
    }

    public static function getSoutenanceByDate($date){
        $pdo = Database::connect();

        $qry = 
        "SELECT s.matricule as `matricule`, 
                e.nom_etudiant as `Nom`, 
                e.prenom_etudiant as `Prenom`, 
                o.design as `Organisme`, 
                s.note as `Note`, 
                s.annee_univ as `Annee universitaire`, 
                p1.id_prof as `id_president`,
                CONCAT(p1.nom_prof, ' ', p1.prenom_prof) AS `President`, 
                p2.id_prof as `id_examinateur`,
                CONCAT(p2.nom_prof, ' ', p2.prenom_prof) AS `Examinateur`, 
                p3.id_prof as `id_rapporteur_int`,
                CONCAT(p3.nom_prof, ' ', p3.prenom_prof) AS `Rapporteur_Int`, 
                p4.id_prof as `id_rapporteur_ext`,
                CONCAT(p4.nom_prof, ' ', p4.prenom_prof) AS `Rapporteur_Ext`
        FROM soutenir s
        JOIN organismes o ON s.id_org = o.id_org
        JOIN etudiants e ON s.matricule = e.matricule
        JOIN professeurs p1 ON s.president = p1.id_prof
        JOIN professeurs p2 ON s.examinateur = p2.id_prof
        JOIN professeurs p3 ON s.rapporteur_int = p3.id_prof
        JOIN professeurs p4 ON s.rapporteur_ext = p4.id_prof
        WHERE annee_univ = :param;";

        $preparedQry = $pdo->prepare($qry);
        $preparedQry->bindParam(':param',$date,PDO::PARAM_STR);
        $preparedQry->execute();

        $response = $preparedQry->fetchAll();

        Database::disconnect();

        return $response;
    }

    public static function getSoutenanceByMatricule($matricule){
        $pdo = Database::connect();

        $qry = 
        "SELECT s.matricule as `matricule`, 
                e.nom_etudiant as `Nom`, 
                e.prenom_etudiant as `Prenom`, 
                s.id_org as `id_org`,
                o.design as `Organisme`, 
                s.note as `Note`, 
                s.annee_univ as `Annee universitaire`, 
                p1.id_prof as `id_president`,
                CONCAT(p1.nom_prof, ' ', p1.prenom_prof) AS `President`, 
                p2.id_prof as `id_examinateur`,
                CONCAT(p2.nom_prof, ' ', p2.prenom_prof) AS `Examinateur`, 
                p3.id_prof as `id_rapporteur_int`,
                CONCAT(p3.nom_prof, ' ', p3.prenom_prof) AS `Rapporteur_Int`, 
                p4.id_prof as `id_rapporteur_ext`,
                CONCAT(p4.nom_prof, ' ', p4.prenom_prof) AS `Rapporteur_Ext`
        FROM soutenir s
        JOIN organismes o ON s.id_org = o.id_org
        JOIN etudiants e ON s.matricule = e.matricule
        JOIN professeurs p1 ON s.president = p1.id_prof
        JOIN professeurs p2 ON s.examinateur = p2.id_prof
        JOIN professeurs p3 ON s.rapporteur_int = p3.id_prof
        JOIN professeurs p4 ON s.rapporteur_ext = p4.id_prof
        WHERE s.matricule = :param;";

        $preparedQry = $pdo->prepare($qry);

        $preparedQry->bindParam(':param',$matricule,PDO::PARAM_STR);

        $preparedQry->execute();

        $response = $preparedQry->fetchAll();

        Database::disconnect();

        return $response;
    }

    // 
}

?>