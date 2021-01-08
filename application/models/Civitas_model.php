<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Civitas_model extends CI_Model { 
    var $table = 'civitas';
    var $column_order = array(null,'status','username','nama_civitas',null); //set column field database for datatable orderable
    var $column_search = array('nama_civitas','username', 'status'); //set column field database for datatable searchable 
    var $order = array('tgl_input' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 

        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    
    public function get_username_terakhir($tgl){
        $bulan = date("m", strtotime($tgl));
        $tahun = date("Y", strtotime($tgl));

        $this->db->select("substr(username, 5, 4) as id");
        $this->db->from("civitas");
        $this->db->where("MONTH(tgl_masuk) = $bulan AND YEAR(tgl_masuk) = $tahun");
        $this->db->order_by("id", "DESC");
        return $this->db->get()->row_array();
    }
 
}