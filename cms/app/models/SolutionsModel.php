<?php
class SolutionsModel {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function countAll(){
        $this->db->query("SELECT COUNT(*) as total FROM konten_solusi");
        $row = $this->db->single();
        return $row->total;
    }

    public function getPaginated($limit, $offset){
        $this->db->query("SELECT * FROM konten_solusi LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        return $this->db->resultSet();
    }

    public function getById($id){
        $this->db->query("SELECT * FROM konten_solusi WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data){
        $this->db->query("INSERT INTO konten_solusi (label_kategori, judul_utama, deskripsi, gambar_path, peran_list_json) VALUES (:label_kategori, :judul_utama, :deskripsi, :gambar_path, :peran_list_json)");
        
        $this->db->bind(':label_kategori', $data['label_kategori']);
        $this->db->bind(':judul_utama', $data['judul_utama']);
        $this->db->bind(':deskripsi', $data['deskripsi']);
        $this->db->bind(':gambar_path', $data['gambar_path']);
        $this->db->bind(':peran_list_json', $data['peran_list_json']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function update($data){
        $this->db->query("UPDATE konten_solusi SET label_kategori = :label_kategori, judul_utama = :judul_utama, deskripsi = :deskripsi, gambar_path = :gambar_path, peran_list_json = :peran_list_json WHERE id = :id");
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':label_kategori', $data['label_kategori']);
        $this->db->bind(':judul_utama', $data['judul_utama']);
        $this->db->bind(':deskripsi', $data['deskripsi']);
        $this->db->bind(':gambar_path', $data['gambar_path']);
        $this->db->bind(':peran_list_json', $data['peran_list_json']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){
        $this->db->query("DELETE FROM konten_solusi WHERE id = :id");
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
