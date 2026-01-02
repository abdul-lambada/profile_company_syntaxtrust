<?php
class TeamModel {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function countAll(){
        $this->db->query("SELECT COUNT(*) as total FROM konten_tim");
        $row = $this->db->single();
        return $row->total;
    }

    public function getPaginated($limit, $offset){
        $this->db->query("SELECT * FROM konten_tim ORDER BY urutan ASC LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        return $this->db->resultSet();
    }

    public function getById($id){
        $this->db->query("SELECT * FROM konten_tim WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data){
        $this->db->query("INSERT INTO konten_tim (nama, posisi, foto_path, link_linkedin, link_instagram, urutan) VALUES (:nama, :posisi, :foto_path, :link_linkedin, :link_instagram, :urutan)");
        
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':posisi', $data['posisi']);
        $this->db->bind(':foto_path', $data['foto_path']);
        $this->db->bind(':link_linkedin', $data['link_linkedin']);
        $this->db->bind(':link_instagram', $data['link_instagram']);
        $this->db->bind(':urutan', $data['urutan']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function update($data){
        $this->db->query("UPDATE konten_tim SET nama = :nama, posisi = :posisi, foto_path = :foto_path, link_linkedin = :link_linkedin, link_instagram = :link_instagram, urutan = :urutan WHERE id = :id");
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':posisi', $data['posisi']);
        $this->db->bind(':foto_path', $data['foto_path']);
        $this->db->bind(':link_linkedin', $data['link_linkedin']);
        $this->db->bind(':link_instagram', $data['link_instagram']);
        $this->db->bind(':urutan', $data['urutan']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){
        $this->db->query("DELETE FROM konten_tim WHERE id = :id");
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
