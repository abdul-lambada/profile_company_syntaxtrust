<?php
class FeaturesModel {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getAll(){
        $this->db->query("SELECT * FROM konten_fitur");
        return $this->db->resultSet();
    }

    public function getById($id){
        $this->db->query("SELECT * FROM konten_fitur WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function countAll(){
        $this->db->query("SELECT COUNT(*) as total FROM konten_fitur");
        $row = $this->db->single();
        return $row->total;
    }

    public function getPaginated($limit, $offset){
        $this->db->query("SELECT * FROM konten_fitur LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        return $this->db->resultSet();
    }

    public function add($data){
        $this->db->query("INSERT INTO konten_fitur (judul, deskripsi, ikon_svg_path) VALUES (:judul, :deskripsi, :ikon_svg_path)");
        
        $this->db->bind(':judul', $data['judul']);
        $this->db->bind(':deskripsi', $data['deskripsi']);
        $this->db->bind(':ikon_svg_path', $data['ikon_svg_path']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function update($data){
        $this->db->query("UPDATE konten_fitur SET judul = :judul, deskripsi = :deskripsi, ikon_svg_path = :ikon_svg_path WHERE id = :id");
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':judul', $data['judul']);
        $this->db->bind(':deskripsi', $data['deskripsi']);
        $this->db->bind(':ikon_svg_path', $data['ikon_svg_path']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){
        $this->db->query("DELETE FROM konten_fitur WHERE id = :id");
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
