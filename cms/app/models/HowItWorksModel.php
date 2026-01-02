<?php
class HowItWorksModel {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function countAll(){
        $this->db->query("SELECT COUNT(*) as total FROM konten_cara_kerja");
        $row = $this->db->single();
        return $row->total;
    }

    public function getPaginated($limit, $offset){
        $this->db->query("SELECT * FROM konten_cara_kerja ORDER BY nomor_langkah ASC LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        return $this->db->resultSet();
    }

    public function getById($id){
        $this->db->query("SELECT * FROM konten_cara_kerja WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data){
        $this->db->query("INSERT INTO konten_cara_kerja (nomor_langkah, judul, deskripsi, path_ikon_svg) VALUES (:nomor_langkah, :judul, :deskripsi, :path_ikon_svg)");
        
        $this->db->bind(':nomor_langkah', $data['nomor_langkah']);
        $this->db->bind(':judul', $data['judul']);
        $this->db->bind(':deskripsi', $data['deskripsi']);
        $this->db->bind(':path_ikon_svg', $data['path_ikon_svg']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function update($data){
        $this->db->query("UPDATE konten_cara_kerja SET nomor_langkah = :nomor_langkah, judul = :judul, deskripsi = :deskripsi, path_ikon_svg = :path_ikon_svg WHERE id = :id");
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nomor_langkah', $data['nomor_langkah']);
        $this->db->bind(':judul', $data['judul']);
        $this->db->bind(':deskripsi', $data['deskripsi']);
        $this->db->bind(':path_ikon_svg', $data['path_ikon_svg']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){
        $this->db->query("DELETE FROM konten_cara_kerja WHERE id = :id");
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
