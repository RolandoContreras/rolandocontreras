<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed"); 
/*****
* Generator Class MC v.1.55
BITSHARE S.A.C
* Proyecto
* V. 1.0
* Iniciado: 29/09/2015
* Descripcion: Este Modelo controla la tabla de la base de datos con su mismo nombre
******/

/***
* @EXTIENDE EL MODELO
* Descripcion: se utilizara para nuevas funciones
* Creador: Rolando Contreras H.
* Fecha: 16/11/2016
****/

class customer_model_atributos{	
    var $customer_id='';
    var $email='';
    var $password='';
    var $name='';
    var $last_name='';
    var $dni='';
    var $sexo='';
    var $address='';
    var $country='';
    var $phone='';
    var $active=''; 
    var $status_value='';
    var $valid_email='';
    var $created_at='';
    var $created_by='';
    var $updated_at='';
    var $updated_by='';
}

class Customer_Model extends CI_Model{ 

    public function __construct() {
        parent::__construct();  
        $this->table = 'customer';
	$this->table_id = 'customer_id';
        $this->customer_id='';
        $this->range_id='';
        $this->email='';
        $this->password='';
	$this->name='';
        $this->last_name='';
        $this->dni='';
        $this->sexo='';
        $this->address='';
        $this->country='';
	$this->phone='';
        $this->active='';
        $this->valid_email='';
	$this->status_value='';
	$this->created_at='';
	$this->created_by='';
	$this->updated_at='';
	$this->updated_by='';
	$this->fields = new customer_model_atributos();
    }   
    
    public function fields(){
    }
    
    public function checkUser($userData = array()){
            //check whether user data already exists in database with same oauth info
            $this->db->select($this->table_id);
            $this->db->from($this->table);
            $this->db->where(array('oauth_provider'=>$userData['oauth_provider'], 'oauth_uid'=>$userData['oauth_uid']));
            $prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();
            if($prevCheck > 0){
                return true;
            }else{
                return false;
            }
    }
    
     public function Is_already_register_google($id){
            //check whether user data already exists in database with same oauth info
            $this->db->select($this->table_id);
            $this->db->from($this->table);
            $this->db->where(array('oauth_provider'=>"google", 'oauth_uid'=>$id));
            $prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();
            if($prevCheck > 0){
                return true;
            }else{
                return false;
            }
    }
    
    public function insert($data){
      $this->db->insert($this->table, $data);
      return $this->db->insert_id();
    }
  
    public function insert_lote($data){
      $this->db->insert_batch($this->table, $data);
    }
  
    public function update($pk, $data){
        $this->db->where($this->table_id, $pk);
        return $this->db->update($this->table, $data);
    }

    public function delete($pk){
        $this->db->where($this->table_id, $pk);
        return $this->db->delete($this->table);
    }
  
    public function get_search_row($data){
        if (isset($data["select"])&& $data["select"]!=""){$this->db->select($data["select"]);}
        if (isset($data["where"]) && $data["where"]!=""){$this->db->where($data["where"]);}
        if (isset($data["order"]) && $data["order"]!=""){$this->db->order_by($data["order"]);}
        if (isset($data["group"]) && $data["group"]!=""){$this->db->group_by($data["group"]);}
        if (isset($data["join"])){if (count($data["join"])>0){ foreach ($data["join"] as $rowJoin){$split = explode(",",$rowJoin);$this->db->join($split[0],$split[1]);}}}
       $this->db->from($this->table);       
       $query=  $this->db->get();
       return $query->row();
    }

    public function search($data){ 
        if (isset($data["select"])&& $data["select"]!=""){$this->db->select($data["select"]);}
        if (isset($data["where"]) && $data["where"]!=""){$this->db->where($data["where"]);}
        if (isset($data["order"]) && $data["order"]!=""){$this->db->order_by($data["order"]);}
        if (isset($data["group"]) && $data["group"]!=""){$this->db->group_by($data["group"]);}
        if (isset($data["join"])){if (count($data["join"])>0){ foreach ($data["join"] as $rowJoin){$split = explode(",",$rowJoin);$this->db->join($split[0],$split[1]);}}}
        if (isset($data["limit"]) && $data["limit"]!=""){$this->db->limit($data["limit"]);}
        $this->db->from($this->table);
        $query = $this->db->get();
        $dato = $query->result();
        return $dato;
    }

    public function total_records($data){        
        if (isset($data["select"])&& $data["select"]!=""){$this->db->select($data["select"]);}
        if (isset($data["where"]) && $data["where"]!=""){$this->db->where($data["where"]);}
        if (isset($data["order"]) && $data["order"]!=""){$this->db->order_by($data["order"]);}
        if (isset($data["group"]) && $data["group"]!=""){$this->db->group_by($data["group"]);}
        if (isset($data["join"])){if (count($data["join"])>0){ foreach ($data["join"] as $rowJoin){$split = explode(",",$rowJoin);$this->db->join($split[0],$split[1]);}}}      
        $this->db->from($this->table);
        $query = $this->db->get();
        $dato = $query->num_rows();
        return $dato;      
  }

  public function search_data($data,$inicio,$num_reg){       
        if (isset($data["select"])&& $data["select"]!=""){$this->db->select($data["select"]);}
        if (isset($data["where"]) && $data["where"]!=""){$this->db->where($data["where"]);}
        if (isset($data["order"]) && $data["order"]!=""){$this->db->order_by($data["order"]);}
        if (isset($data["group"]) && $data["group"]!=""){$this->db->group_by($data["group"]);}
        if (isset($data["join"])){if (count($data["join"])>0){ foreach ($data["join"] as $rowJoin){$split = explode(",",$rowJoin);$this->db->join($split[0],$split[1]);}}}
        //if (isset($data["limit"]) && $data["limit"]!=""){$this->db->limit($data["limit"]);}        
        $this->db->from($this->table);       
        $query = $this->db->get("",$inicio,$num_reg);        
        $dato = $query->result();
        return $dato;       
  }
  
  public function search_data_rows($data,$inicio,$num_reg){       
        if (isset($data["select"])&& $data["select"]!=""){$this->db->select($data["select"]);}
        if (isset($data["where"]) && $data["where"]!=""){$this->db->where($data["where"]);}
        if (isset($data["order"]) && $data["order"]!=""){$this->db->order_by($data["order"]);}
        if (isset($data["group"]) && $data["group"]!=""){$this->db->group_by($data["group"]);}
        if (isset($data["join"])){if (count($data["join"])>0){ foreach ($data["join"] as $rowJoin){$split = explode(",",$rowJoin);$this->db->join($split[0],$split[1]);}}}
        //if (isset($data["limit"]) && $data["limit"]!=""){$this->db->limit($data["limit"]);}        
        $this->db->from($this->table);       
        $query = $this->db->get("",$inicio,$num_reg);        
        $dato = $query->row();
        return $dato;       
  }
  
   public function verificar_username($username,$password){        
        $this->db->where('$username',$username);
        $this->db->where('password', $password);
        $this->db->from($this->table);
        $query = $this->db->get();                     
        return $query->row();        
   }
  
} //FIN DEL MODELO EXTENDIDO
?>