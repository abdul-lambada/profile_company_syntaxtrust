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
        $this->db->query("INSERT INTO konten_tim (nama, jabatan, url_foto, kutipan, urutan) VALUES (:nama, :jabatan, :url_foto, :kutipan, :urutan)");
        
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':jabatan', $data['jabatan']);
        $this->db->bind(':url_foto', $data['url_foto']);
        $this->db->bind(':kutipan', $data['kutipan']);
        $this->db->bind(':urutan', $data['urutan']);

        return $this->db->execute();
    }

    public function update($data){
        $this->db->query("UPDATE konten_tim SET nama = :nama, jabatan = :jabatan, url_foto = :url_foto, kutipan = :kutipan, urutan = :urutan WHERE id = :id");
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':jabatan', $data['jabatan']);
        $this->db->bind(':url_foto', $data['url_foto']);
        $this->db->bind(':kutipan', $data['kutipan']);
        $this->db->bind(':urutan', $data['urutan']);

        return $this->db->execute();
    }

    public function delete($id){
        $this->db->query("DELETE FROM konten_tim WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
