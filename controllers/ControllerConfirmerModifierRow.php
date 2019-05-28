<?php
    require_once('views/View.php');
    require_once('controllers/ControllerHelper.php');
    class ControllerConfirmerModifierRow
    {

        private $_view;
        private $_model;

        public function __construct($url)
        {

            if(isset($url) && count($url) > 1){
                throw new Exception('Page introuvable');
            }else if(isset($_POST['database']) && isset($_POST['table'])){
                $databases = $_POST['database'];
                $conn = ControllerHelper::buildConnection();
                $this->afficherRows($conn , $databases , $_POST['table'], $_POST['rowid']);
            }else{
                throw new Exception('Page introuvable');
            }
        }    

        private function afficherRows(Connection $conn , String $databaseName , String $tableName, $myid){
            $model = new ModelsManager();
            $model->implementsDatabasesIntoConnection($conn);
            //ici, la connection a implementer toute les bases de donnée sans les tables
            $database = ControllerHelper::getDatabaseWithName($conn, $databaseName);
            //ici, la variable database contient la bonne base de donnée à qui il faut ajouter les tables
            $model->implementsTablesIntoDatabase($conn , $database);
            // ici, la base de donnée contient toutes les tables 
            $table = ControllerHelper::getTableWithName($database , $tableName);  //ici, il faut construire la table: au complet
            // $table = ControllerHelper::getColumnsFromTable($database , $tableName);  //ici, il faut construire la table: au complet
            //ici, la table est la bonne
            $table = $model->implementsRowsIntoTable($conn ,$database, $table);
            $table->setArrayColumns($model->getAllColumnsFromTable($conn,$database->name(),$tableName));

            // $temp_columns = $table->arrayColumns();
            // array_shift($temp_columns);
            // $table->setArrayColumns($temp_columns);

            
            $OldRow = null;
            foreach($table->arrayRow() as $row){
                if($row->myId() == $myid){
                    $OldRow = $row;
                    break;
                }
            }
            // $_tempOldArrayItem = $OldRow->arrayItems();
            // array_shift($_tempOldArrayItem);
            // $OldRow->setArrayItems($_tempOldArrayItem);

            $_NewRow = new Row(null , $myid);
            $_tempNewArrayItem = array();
            foreach($table->arrayColumns() as $_col){
                $content = null;
                if($_col->displayableType() == 'file'){
                    $content = $_FILES[$_col->name()];
                    //du site

                    $statusMsg = '';

                    // File upload path
                    $targetDir = "./STOCKAGE/";
                    $fileName = basename($_FILES[$_col->name()]["name"]);
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

                    // echo("<p>".$targetDir."</p>");
                    // echo("<p>".$fileName."</p>");
                    // echo("<p>".$targetFilePath."</p>");
                    // echo("<p>".$fileType."</p>");

                    $filename = "uploads/".$_FILES[$_col->name()]["tmp_name"];

                    if(move_uploaded_file($_FILES[$_col->name()]["tmp_name"], $targetFilePath))
                    {
                        $content = file_get_contents($targetFilePath);                        
                    }
                     $content = $fileName."#".base64_encode($content);
                }else{
                    $content = $_POST[$_col->name()];
                }
                $_item = new Item($content);
                $_item->setType($_col->type());
                array_push($_tempNewArrayItem , $_item);
            }
            $_NewRow->setArrayItems($_tempNewArrayItem);
            
            $message = "";
            $model = new Model();
            if($model->updateRowWhere($conn ,$databaseName, $tableName, $table->arrayColumns() , $OldRow , $_NewRow) > 0){
                $message = "La rangée à bien été sauvegarder!";
            }else{
                $message = "Aucune rangée n'a été affectée , IL SEMBLE Y AVOIR EU UNE ERREUR!";
            }
            $this->_view = new View('message');
            $this->_view->generate(array('message' => $message));


        }
    }


?>
