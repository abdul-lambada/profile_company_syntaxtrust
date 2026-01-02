<?php
class HowItWorks extends Controller {
    private $model;

    public function __construct(){
        $this->model = $this->model('HowItWorksModel');
    }

    public function index(){
        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        $offset = ($page - 1) * $limit;
        
        $totalRows = $this->model->countAll();
        $totalPages = ceil($totalRows / $limit);
        $items = $this->model->getPaginated($limit, $offset);

        $data = [
            'title' => 'Konten Cara Kerja',
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
        $this->view('how_it_works/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'nomor_langkah' => trim($_POST['nomor_langkah']),
                'judul' => trim($_POST['judul']),
                'deskripsi' => trim($_POST['deskripsi']),
                'path_ikon_svg' => trim($_POST['path_ikon_svg'])
            ];

            if($this->model->add($data)){
                header('location: ' . URLROOT . '/how_it_works?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $data = [
                'title' => 'Tambah Cara Kerja',
                'nomor_langkah' => '',
                'judul' => '',
                'deskripsi' => '',
                'path_ikon_svg' => ''
            ];
            $this->view('how_it_works/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'nomor_langkah' => trim($_POST['nomor_langkah']),
                'judul' => trim($_POST['judul']),
                'deskripsi' => trim($_POST['deskripsi']),
                'path_ikon_svg' => trim($_POST['path_ikon_svg'])
            ];

            if($this->model->update($data)){
                header('location: ' . URLROOT . '/how_it_works?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $item = $this->model->getById($id);

            $data = [
                'title' => 'Edit Cara Kerja',
                'id' => $id,
                'nomor_langkah' => $item->nomor_langkah,
                'judul' => $item->judul,
                'deskripsi' => $item->deskripsi,
                'path_ikon_svg' => $item->path_ikon_svg
            ];
            $this->view('how_it_works/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->model->delete($id)){
                header('location: ' . URLROOT . '/how_it_works?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
             header('location: ' . URLROOT . '/how_it_works');
        }
    }
}
