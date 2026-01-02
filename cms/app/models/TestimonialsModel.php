<?php
class TestimonialsModel {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function countAll(){
        $this->db->query("SELECT COUNT(*) as total FROM konten_testimoni");
        $row = $this->db->single();
        return $row->total;
    }

    public function getPaginated($limit, $offset){
        $this->db->query("SELECT * FROM konten_testimoni ORDER BY urutan ASC LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        return $this->db->resultSet();
    }

    public function getById($id){
        $this->db->query("SELECT * FROM konten_testimoni WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data){
        $this->db->query("INSERT INTO konten_testimoni (nama, peran, isi_testimoni, url_avatar, rating, urutan) VALUES (:nama, :peran, :isi_testimoni, :url_avatar, :rating, :urutan)");
        
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':peran', $data['peran']);
        $this->db->bind(':isi_testimoni', $data['isi_testimoni']);
        $this->db->bind(':url_avatar', $data['url_avatar']);
        $this->db->bind(':rating', $data['rating']);
        $this->db->bind(':urutan', $data['urutan']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function update($data){
        $this->db->query("UPDATE konten_testimoni SET nama = :nama, peran = :peran, isi_testimoni = :isi_testimoni, url_avatar = :url_avatar, rating = :rating, urutan = :urutan WHERE id = :id");
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':peran', $data['peran']);
        $this->db->bind(':isi_testimoni', $data['isi_testimoni']);
        $this->db->bind(':url_avatar', $data['url_avatar']);
        $this->db->bind(':rating', $data['rating']);
        $this->db->bind(':urutan', $data['urutan']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){
        $this->db->query("DELETE FROM konten_testimoni WHERE id = :id");
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
