<?php
class Hero extends Controller {
    private $heroModel;

    public function __construct(){
        $this->heroModel = $this->model('HeroModel');
    }

    public function index(){
        // Pagination Logic
        $limit = 5; // Rows per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        
        $offset = ($page - 1) * $limit;
        
        $totalRows = $this->heroModel->countAll();
        $totalPages = ceil($totalRows / $limit);

        $heroes = $this->heroModel->getPaginated($limit, $offset);

        $data = [
            'title' => 'Konten Hero',
            'heroes' => $heroes,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'has_previous' => $page > 1,
                'has_next' => $page < $totalPages,
                'previous_page' => $page - 1,
                'next_page' => $page + 1
            ]
        ];
        $this->view('hero/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'judul_utama' => trim($_POST['judul_utama']),
                'judul_highlight' => trim($_POST['judul_highlight']),
                'sub_judul' => trim($_POST['sub_judul']),
                'teks_tombol_utama' => trim($_POST['teks_tombol_utama']),
                'teks_tombol_sekunder' => trim($_POST['teks_tombol_sekunder']),
                'teks_tombol_tersier' => trim($_POST['teks_tombol_tersier']),
                'label_badge' => trim($_POST['label_badge']),
                'err' => ''
            ];

            if($this->heroModel->add($data)){
                // Redirect
                header('location: ' . URLROOT . '/hero?status=success');
            } else {
                die('Something went wrong');
            }

        } else {
            $data = [
                'title' => 'Tambah Hero',
                'judul_utama' => '',
                'judul_highlight' => '',
                'sub_judul' => '',
                'teks_tombol_utama' => '',
                'teks_tombol_sekunder' => '',
                'teks_tombol_tersier' => '',
                'label_badge' => ''
            ];

            $this->view('hero/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'judul_utama' => trim($_POST['judul_utama']),
                'judul_highlight' => trim($_POST['judul_highlight']),
                'sub_judul' => trim($_POST['sub_judul']),
                'teks_tombol_utama' => trim($_POST['teks_tombol_utama']),
                'teks_tombol_sekunder' => trim($_POST['teks_tombol_sekunder']),
                'teks_tombol_tersier' => trim($_POST['teks_tombol_tersier']),
                'label_badge' => trim($_POST['label_badge']),
                'err' => ''
            ];

            if($this->heroModel->update($data)){
                // Redirect
                header('location: ' . URLROOT . '/hero?status=success');
            } else {
                die('Something went wrong');
            }

        } else {
            // Get post
            $hero = $this->heroModel->getById($id);

            $data = [
                'title' => 'Edit Hero',
                'id' => $id,
                'judul_utama' => $hero->judul_utama,
                'judul_highlight' => $hero->judul_highlight,
                'sub_judul' => $hero->sub_judul,
                'teks_tombol_utama' => $hero->teks_tombol_utama,
                'teks_tombol_sekunder' => $hero->teks_tombol_sekunder,
                'teks_tombol_tersier' => $hero->teks_tombol_tersier,
                'label_badge' => $hero->label_badge
            ];

            $this->view('hero/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->heroModel->delete($id)){
                header('location: ' . URLROOT . '/hero?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
             header('location: ' . URLROOT . '/hero');
        }
    }
}
