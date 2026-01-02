<?php
class HeroModel {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getAll(){
        $this->db->query("SELECT * FROM konten_hero");
        return $this->db->resultSet();
    }

    public function getById($id){
        $this->db->query("SELECT * FROM konten_hero WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function countAll(){
        $this->db->query("SELECT COUNT(*) as total FROM konten_hero");
        $row = $this->db->single();
        return $row->total;
    }

    public function getPaginated($limit, $offset){
        $this->db->query("SELECT * FROM konten_hero LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        return $this->db->resultSet();
    }

    public function add($data){
        $this->db->query("INSERT INTO konten_hero (judul_utama, judul_highlight, sub_judul, teks_tombol_utama, teks_tombol_sekunder, teks_tombol_tersier, label_badge) VALUES (:judul_utama, :judul_highlight, :sub_judul, :teks_tombol_utama, :teks_tombol_sekunder, :teks_tombol_tersier, :label_badge)");
        
        $this->db->bind(':judul_utama', $data['judul_utama']);
        $this->db->bind(':judul_highlight', $data['judul_highlight']);
        $this->db->bind(':sub_judul', $data['sub_judul']);
        $this->db->bind(':teks_tombol_utama', $data['teks_tombol_utama']);
        $this->db->bind(':teks_tombol_sekunder', $data['teks_tombol_sekunder']);
        $this->db->bind(':teks_tombol_tersier', $data['teks_tombol_tersier']);
        $this->db->bind(':label_badge', $data['label_badge']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function update($data){
        $this->db->query("UPDATE konten_hero SET judul_utama = :judul_utama, judul_highlight = :judul_highlight, sub_judul = :sub_judul, teks_tombol_utama = :teks_tombol_utama, teks_tombol_sekunder = :teks_tombol_sekunder, teks_tombol_tersier = :teks_tombol_tersier, label_badge = :label_badge WHERE id = :id");
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':judul_utama', $data['judul_utama']);
        $this->db->bind(':judul_highlight', $data['judul_highlight']);
        $this->db->bind(':sub_judul', $data['sub_judul']);
        $this->db->bind(':teks_tombol_utama', $data['teks_tombol_utama']);
        $this->db->bind(':teks_tombol_sekunder', $data['teks_tombol_sekunder']);
        $this->db->bind(':teks_tombol_tersier', $data['teks_tombol_tersier']);
        $this->db->bind(':label_badge', $data['label_badge']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){
        $this->db->query("DELETE FROM konten_hero WHERE id = :id");
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
