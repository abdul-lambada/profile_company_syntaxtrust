<?php
class Features extends Controller {
    private $featuresModel;

    public function __construct(){
        $this->featuresModel = $this->model('FeaturesModel');
    }

    public function index(){
        // Pagination Logic
        $limit = 5; // Rows per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        
        $offset = ($page - 1) * $limit;
        
        $totalRows = $this->featuresModel->countAll();
        $totalPages = ceil($totalRows / $limit);

        $features = $this->featuresModel->getPaginated($limit, $offset);

        $data = [
            'title' => 'Konten Fitur Unggulan',
            'features' => $features,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'has_previous' => $page > 1,
                'has_next' => $page < $totalPages,
                'previous_page' => $page - 1,
                'next_page' => $page + 1
            ]
        ];
        $this->view('features/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'judul' => trim($_POST['judul']),
                'deskripsi' => trim($_POST['deskripsi']),
                'ikon_svg_path' => trim($_POST['ikon_svg_path']),
                'err' => ''
            ];

            if($this->featuresModel->add($data)){
                // Redirect
                header('location: ' . URLROOT . '/features?status=success');
            } else {
                die('Something went wrong');
            }

        } else {
            $data = [
                'title' => 'Tambah Fitur',
                'judul' => '',
                'deskripsi' => '',
                'ikon_svg_path' => ''
            ];

            $this->view('features/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'judul' => trim($_POST['judul']),
                'deskripsi' => trim($_POST['deskripsi']),
                'ikon_svg_path' => trim($_POST['ikon_svg_path']),
                'err' => ''
            ];

            if($this->featuresModel->update($data)){
                // Redirect
                header('location: ' . URLROOT . '/features?status=success');
            } else {
                die('Something went wrong');
            }

        } else {
            // Get post
            $feature = $this->featuresModel->getById($id);

            $data = [
                'title' => 'Edit Fitur',
                'id' => $id,
                'judul' => $feature->judul,
                'deskripsi' => $feature->deskripsi,
                'ikon_svg_path' => $feature->ikon_svg_path
            ];

            $this->view('features/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->featuresModel->delete($id)){
                header('location: ' . URLROOT . '/features?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
             header('location: ' . URLROOT . '/features');
        }
    }
}
