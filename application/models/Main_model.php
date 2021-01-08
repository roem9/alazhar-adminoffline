<?php
class Main_model extends CI_MODEL{
    // tes 
        public function add_data($table, $data){
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }

        public function get_one($table, $where){
            $this->db->from($table);
            $this->db->where($where);
            return $this->db->get()->row_array();
        }

        public function get_all($table, $where = "", $order = "", $by = "ASC"){
            $this->db->from($table);
            if($where)
                $this->db->where($where);
            if($order)
                $this->db->order_by($order, $by);
            return $this->db->get()->result_array();
        }

        public function get_all_group_by($table, $where = "", $group = ""){
            $this->db->from($table);
            if($where)
                $this->db->where($where);
            if($group)
                $this->db->group_by($group);
            return $this->db->get()->result_array();
        }

        public function edit_data($table, $where, $data){
            $this->db->where($where);
            $this->db->update($table, $data);
            return $this->db->affected_rows();
        }

        public function delete_data($table, $where){
            $this->db->where($where);
            $this->db->delete($table);
            return $this->db->affected_rows();
        }

        public function nominal($nominal){
            $nominal = $this->input->post('nominal', true);
            $nominal = str_replace("Rp. ", "", $nominal);
            $nominal = str_replace(".", "", $nominal);
            return $nominal;
        }
    // tes 

    // username
        public function get_username_terakhir($tgl){
            $bulan = date("m", strtotime($tgl));
            $tahun = date("Y", strtotime($tgl));

            $this->db->select("substr(no_peserta, 5, 4) as id");
            $this->db->from("peserta");
            $this->db->where("YEAR(tgl_daftar) = $tahun");
            $this->db->order_by("id", "DESC");
            return $this->db->get()->row_array();
        }

        public function rupiah_to_int($data){
            $data = str_replace("Rp. ", "", $data);
            $data = str_replace(".", "", $data);
            return $data;
        }
       
        public function rupiah($angka){           
            $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
            return $hasil_rupiah;
        }

        public function get_no_syahadah_terakhir($tahun){
            $this->db->from("kelas_peserta");
            $this->db->where("tahun", $tahun);
            $this->db->order_by("no_syahadah", "desc");
            return $this->db->get()->row_array();
        }
}