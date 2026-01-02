<?php
class ClientMap extends Controller {
    private $model;

    public function __construct(){
        $this->model = $this->model('ClientMapModel');
    }

    public function index(){
        $limit = 10; // Show more items for map list
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        $offset = ($page - 1) * $limit;
        
        $totalRows = $this->model->countAll();
        $totalPages = ceil($totalRows / $limit);
        $items = $this->model->getPaginated($limit, $offset);

        $data = [
            'title' => 'Peta Klien',
            'items' => $items,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'has_previous' => $page > 1,
                'has_next' => $page < $totalPages,
                'previous_page' => $page - 1,
                'next_page' => $page + 1
            ]
        ];
        $this->view('client_map/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'nama_sekolah' => trim($_POST['nama_sekolah']),
                'kota' => trim($_POST['kota']),
                'koordinat_x' => (int)trim($_POST['koordinat_x']),
                'koordinat_y' => (int)trim($_POST['koordinat_y']),
                'status' => trim($_POST['status']),
                'urutan' => (int)trim($_POST['urutan'])
            ];

            if($this->model->add($data)){
                header('location: ' . URLROOT . '/client_map?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $data = [
                'title' => 'Tambah Klien Peta',
                'nama_sekolah' => '',
                'kota' => '',
                'koordinat_x' => '',
                'koordinat_y' => '',
                'status' => 'aktif',
                'urutan' => ''
            ];
            $this->view('client_map/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'nama_sekolah' => trim($_POST['nama_sekolah']),
                'kota' => trim($_POST['kota']),
                'koordinat_x' => (int)trim($_POST['koordinat_x']),
                'koordinat_y' => (int)trim($_POST['koordinat_y']),
                'status' => trim($_POST['status']),
                'urutan' => (int)trim($_POST['urutan'])
            ];

            if($this->model->update($data)){
                header('location: ' . URLROOT . '/client_map?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $item = $this->model->getById($id);

            $data = [
                'title' => 'Edit Klien Peta',
                'id' => $id,
                'nama_sekolah' => $item->nama_sekolah,
                'kota' => $item->kota,
                'koordinat_x' => $item->koordinat_x,
                'koordinat_y' => $item->koordinat_y,
                'status' => $item->status,
                'urutan' => $item->urutan
            ];
            $this->view('client_map/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->model->delete($id)){
                header('location: ' . URLROOT . '/client_map?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
             header('location: ' . URLROOT . '/client_map');
        }
    }
}
