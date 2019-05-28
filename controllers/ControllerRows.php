<?php
    require_once('views/View.php');
    require_once('controllers/ControllerHelper.php');
    class ControllerRows
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
                $this->afficherRows($conn , $databases , $_POST['table']);
            }else{
                throw new Exception('Page introuvable');
            }
        }    

        private function afficherRows(Connection $conn , String $databaseName , String $tableName){
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
            //ici, la table contient toutes les rangées avec les items
            // var_dump($database->arrayTables());
            // var_dump($table->arrayRow());
            
            foreach($table->arrayRow() as $_tempRow){
                for($i = 0 ; $i<count($_tempRow->arrayItems()); $i++){
                    $content = $_tempRow->arrayItems()[$i]->value();
                    if(Type::getcustomType($_tempRow->arrayItems()[$i]->type()) == 'file'){
                        
                        // echo("<img src='data:image/jpeg;base64,'".base64_encode($content)."'" );
                        //You dont need to decode it again.
                        $filename = explode('#' , $content)[0];
                        $content = trim(explode('#' , $content)[1] , '#');
                        if(substr($filename, strrpos($filename, '.')+1) == 'png' || substr($filename, strrpos($filename, '.')+1) == 'jpg' ){
                            $content = "<img src='data:;base64,{$content}'/>";
                        }else{
                            $content = $_tempRow->arrayItems()[$i]->type().'[CONTENT]';
                        }

                        $_tempRow->arrayItems()[$i]->setValue($content);
                    }else{
                        $_tempRow->arrayItems()[$i]->setValue($content);
                    }
                }
            }
            
            $this->_view = new View('Rows');
            $this->_view->generate(array('table' => $table));
        }
    }


?>
