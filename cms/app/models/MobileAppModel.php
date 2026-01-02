<?php
class MobileAppModel {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function countAll(){
        $this->db->query("SELECT COUNT(*) as total FROM konten_aplikasi_mobile");
        $row = $this->db->single();
        return $row->total;
    }

    public function getPaginated($limit, $offset){
        $this->db->query("SELECT * FROM konten_aplikasi_mobile LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        return $this->db->resultSet();
    }

    public function getById($id){
        $this->db->query("SELECT * FROM konten_aplikasi_mobile WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data){
        $this->db->query("INSERT INTO konten_aplikasi_mobile (label_badge, judul_utama, deskripsi, gambar_mockup, fitur_list_json, store_links_json) VALUES (:label_badge, :judul_utama, :deskripsi, :gambar_mockup, :fitur_list_json, :store_links_json)");
        
        $this->db->bind(':label_badge', $data['label_badge']);
        $this->db->bind(':judul_utama', $data['judul_utama']);
        $this->db->bind(':deskripsi', $data['deskripsi']);
        $this->db->bind(':gambar_mockup', $data['gambar_mockup']);
        $this->db->bind(':fitur_list_json', $data['fitur_list_json']);
        $this->db->bind(':store_links_json', $data['store_links_json']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function update($data){
        $this->db->query("UPDATE konten_aplikasi_mobile SET label_badge = :label_badge, judul_utama = :judul_utama, deskripsi = :deskripsi, gambar_mockup = :gambar_mockup, fitur_list_json = :fitur_list_json, store_links_json = :store_links_json WHERE id = :id");
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':label_badge', $data['label_badge']);
        $this->db->bind(':judul_utama', $data['judul_utama']);
        $this->db->bind(':deskripsi', $data['deskripsi']);
        $this->db->bind(':gambar_mockup', $data['gambar_mockup']);
        $this->db->bind(':fitur_list_json', $data['fitur_list_json']);
        $this->db->bind(':store_links_json', $data['store_links_json']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){
        $this->db->query("DELETE FROM konten_aplikasi_mobile WHERE id = :id");
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
