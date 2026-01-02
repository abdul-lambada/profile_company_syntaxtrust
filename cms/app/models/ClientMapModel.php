<?php
class ClientMapModel {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function countAll(){
        $this->db->query("SELECT COUNT(*) as total FROM konten_peta_klien");
        $row = $this->db->single();
        return $row->total;
    }

    public function getPaginated($limit, $offset){
        $this->db->query("SELECT * FROM konten_peta_klien ORDER BY urutan ASC LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        return $this->db->resultSet();
    }

    public function getById($id){
        $this->db->query("SELECT * FROM konten_peta_klien WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data){
        $this->db->query("INSERT INTO konten_peta_klien (nama_sekolah, kota, koordinat_x, koordinat_y, status, urutan) VALUES (:nama_sekolah, :kota, :koordinat_x, :koordinat_y, :status, :urutan)");
        
        $this->db->bind(':nama_sekolah', $data['nama_sekolah']);
        $this->db->bind(':kota', $data['kota']);
        $this->db->bind(':koordinat_x', $data['koordinat_x']);
        $this->db->bind(':koordinat_y', $data['koordinat_y']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':urutan', $data['urutan']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function update($data){
        $this->db->query("UPDATE konten_peta_klien SET nama_sekolah = :nama_sekolah, kota = :kota, koordinat_x = :koordinat_x, koordinat_y = :koordinat_y, status = :status, urutan = :urutan WHERE id = :id");
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nama_sekolah', $data['nama_sekolah']);
        $this->db->bind(':kota', $data['kota']);
        $this->db->bind(':koordinat_x', $data['koordinat_x']);
        $this->db->bind(':koordinat_y', $data['koordinat_y']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':urutan', $data['urutan']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){
        $this->db->query("DELETE FROM konten_peta_klien WHERE id = :id");
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
