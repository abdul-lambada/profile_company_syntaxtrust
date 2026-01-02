<?php
class Solutions extends Controller {
    private $solutionsModel;

    public function __construct(){
        $this->solutionsModel = $this->model('SolutionsModel');
    }

    public function index(){
        // Pagination Logic
        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        
        $offset = ($page - 1) * $limit;
        
        $totalRows = $this->solutionsModel->countAll();
        $totalPages = ceil($totalRows / $limit);

        $solutions = $this->solutionsModel->getPaginated($limit, $offset);

        $data = [
            'title' => 'Konten Solusi & Akses',
            'solutions' => $solutions,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'has_previous' => $page > 1,
                'has_next' => $page < $totalPages,
                'previous_page' => $page - 1,
                'next_page' => $page + 1
            ]
        ];
        $this->view('solutions/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Handle Peran List (Array to JSON)
            $peranList = isset($_POST['peran']) ? $_POST['peran'] : [];
            // Remove empty values
            $peranList = array_filter($peranList, function($value) { return !is_null($value) && $value !== ''; });
            // Re-index array
            $peranList = array_values($peranList);
            
            $jsonPeran = json_encode($peranList, JSON_UNESCAPED_UNICODE);

            $data = [
                'label_kategori' => trim($_POST['label_kategori']),
                'judul' => trim($_POST['judul']),
                'deskripsi' => trim($_POST['deskripsi']),
                'gambar_path' => trim($_POST['gambar_path']),
                'peran_list_json' => $jsonPeran,
                'err' => ''
            ];

            if($this->solutionsModel->add($data)){
                header('location: ' . URLROOT . '/solutions?status=success');
            } else {
                die('Something went wrong');
            }

        } else {
            $data = [
                'title' => 'Tambah Solusi',
                'label_kategori' => '',
                'judul' => '',
                'deskripsi' => '',
                'gambar_path' => '',
                'peran_list' => [] // Empty for add view
            ];

            $this->view('solutions/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Handle Peran List (Array to JSON)
            $peranList = isset($_POST['peran']) ? $_POST['peran'] : [];
            $peranList = array_filter($peranList, function($value) { return !is_null($value) && $value !== ''; });
            $peranList = array_values($peranList);

            $jsonPeran = json_encode($peranList, JSON_UNESCAPED_UNICODE);

            $data = [
                'id' => $id,
                'label_kategori' => trim($_POST['label_kategori']),
                'judul' => trim($_POST['judul']),
                'deskripsi' => trim($_POST['deskripsi']),
                'gambar_path' => trim($_POST['gambar_path']),
                'peran_list_json' => $jsonPeran,
                'err' => ''
            ];

            if($this->solutionsModel->update($data)){
                header('location: ' . URLROOT . '/solutions?status=success');
            } else {
                die('Something went wrong');
            }

        } else {
            $solution = $this->solutionsModel->getById($id);
            
            // Decode JSON to Array for View
            $peranList = json_decode($solution->peran_list_json, true);
            if(!$peranList) $peranList = [];

            $data = [
                'title' => 'Edit Solusi',
                'id' => $id,
                'label_kategori' => $solution->label_kategori,
                'judul' => $solution->judul,
                'deskripsi' => $solution->deskripsi,
                'gambar_path' => $solution->gambar_path,
                'peran_list' => $peranList
            ];

            $this->view('solutions/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->solutionsModel->delete($id)){
                header('location: ' . URLROOT . '/solutions?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
             header('location: ' . URLROOT . '/solutions');
        }
    }
}
