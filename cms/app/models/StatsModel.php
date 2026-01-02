<?php
class StatsModel {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function countAll(){
        $this->db->query("SELECT COUNT(*) as total FROM konten_statistik");
        $row = $this->db->single();
        return $row->total;
    }

    public function getPaginated($limit, $offset){
        $this->db->query("SELECT * FROM konten_statistik ORDER BY urutan ASC LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        return $this->db->resultSet();
    }

    public function getById($id){
        $this->db->query("SELECT * FROM konten_statistik WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data){
        $this->db->query("INSERT INTO konten_statistik (label, nilai, deskripsi, urutan) VALUES (:label, :nilai, :deskripsi, :urutan)");
        
        $this->db->bind(':label', $data['label']);
        $this->db->bind(':nilai', $data['nilai']);
        $this->db->bind(':deskripsi', $data['deskripsi']);
        $this->db->bind(':urutan', $data['urutan']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function update($data){
        $this->db->query("UPDATE konten_statistik SET label = :label, nilai = :nilai, deskripsi = :deskripsi, urutan = :urutan WHERE id = :id");
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':label', $data['label']);
        $this->db->bind(':nilai', $data['nilai']);
        $this->db->bind(':deskripsi', $data['deskripsi']);
        $this->db->bind(':urutan', $data['urutan']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){
        $this->db->query("DELETE FROM konten_statistik WHERE id = :id");
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
