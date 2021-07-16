<?php
class prodModl extends Modl {
    function __construct() {
        parent::__construct();
    }
    public function Listar()
    {
        try
        {
            $result = array();

            $stm = $this->_db->prepare("SELECT * FROM Productos");
            $stm->execute();

            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = $this->loadEntd('prod');

                $alm->__SET('IdProd',       $r->IdProd);
                $alm->__SET('Codigo',       $r->Codigo);
                $alm->__SET('Descripcion',  $r->Descripcion);
                $alm->__SET('Marca',        $r->Marca);
                $alm->__SET('Modelo',       $r->Modelo);
                $alm->__SET('PrecioU',      $r->PrecioU);
                $alm->__SET('Existencia',   $r->Existencia);
                $alm->__SET('Imagen',       $r->Imagen);

                $result[] = $alm;
            }
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function Obtener($id)
    {
        try 
        {
            $stm = $this->_db
            ->prepare("SELECT * FROM Productos WHERE IdProd = ?");

            $stm->execute(array($id));
            
            
            $stm->setFetchMode(PDO::FETCH_ASSOC);
            return $stm->fetchAll();
            
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $alm = $this->loadEntd('prod');
            $alm->__SET('IdProd',       $r->IdProd);
            $alm->__SET('Codigo',       $r->Codigo);
            $alm->__SET('Descripcion',  $r->Descripcion);
            $alm->__SET('Marca',        $r->Marca);
            $alm->__SET('Modelo',       $r->Modelo);
            $alm->__SET('PrecioU',      $r->PrecioU);
            $alm->__SET('Existencia',   $r->Existencia);
            $alm->__SET('Imagen',       $r->Imagen);
            //return $alm;
            
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
    public function Obtiene()
    {
        try 
        {
            $stm = $this->_db->prepare("SELECT * FROM Productos");
            $stm->execute();
            
            $stm->setFetchMode(PDO::FETCH_ASSOC);
            return $stm->fetchAll();
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try 
        {
            $stm = $this->_db
            ->prepare("DELETE FROM Productos WHERE IdProd = ?");                      

            $stm->execute(array($id));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function Actualizar(prodEntd $data)
    {
        try 
        {
            $sql = "UPDATE Productos SET 
                Codigo      = ?,
                Descripcion = ?,
                Marca       = ?,
                Modelo      = ?,
                PrecioU     = ?,
                Existencia  = ?,
                Imagen      = ?
               WHERE IdProd = ?";

            $this->_db->prepare($sql)
            ->execute(
            array(
                $data->__GET('Codigo'), 
                $data->__GET('Descripcion'), 
                $data->__GET('Marca'),
                $data->__GET('Modelo'),
                $data->__GET('PrecioU'),
                $data->__GET('Existencia'),
                $data->__GET('Imagen'),
                $data->__GET('IdProd')
                )
            );
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function Registrar(prodEntd $data)
    {
        try 
        {
        $sql = "INSERT INTO Productos (IdProd,Codigo,Descripcion,Marca,Modelo,PrecioU,Existencia,Imagen) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $rslt = $this->_db->prepare($sql)
            ->execute(
            array(
                NULL,
                $data->__GET('Codigo'), 
                $data->__GET('Descripcion'), 
                $data->__GET('Marca'),
                $data->__GET('Modelo'),
                $data->__GET('PrecioU'),
                $data->__GET('Existencia'),
                $data->__GET('Imagen')
                )
            );
            if ($rslt) {
                $Ultimo = $this->_db->lastInsertId();
            } else {
                $Ultimo = NULL;
            }
            return $Ultimo;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}