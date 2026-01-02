<?php
class Testimonials extends Controller {
    private $model;

    public function __construct(){
        $this->model = $this->model('TestimonialsModel');
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
            'title' => 'Testimoni Klien',
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
        $this->view('testimonials/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'nama' => trim($_POST['nama']),
                'peran' => trim($_POST['peran']),
                'isi_testimoni' => trim($_POST['isi_testimoni']),
                'url_avatar' => trim($_POST['url_avatar']),
                'rating' => (int)trim($_POST['rating']),
                'urutan' => (int)trim($_POST['urutan'])
            ];

            if($this->model->add($data)){
                header('location: ' . URLROOT . '/testimonials?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $data = [
                'title' => 'Tambah Testimoni',
                'nama' => '',
                'peran' => '',
                'isi_testimoni' => '',
                'url_avatar' => '',
                'rating' => 5,
                'urutan' => ''
            ];
            $this->view('testimonials/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'nama' => trim($_POST['nama']),
                'peran' => trim($_POST['peran']),
                'isi_testimoni' => trim($_POST['isi_testimoni']),
                'url_avatar' => trim($_POST['url_avatar']),
                'rating' => (int)trim($_POST['rating']),
                'urutan' => (int)trim($_POST['urutan'])
            ];

            if($this->model->update($data)){
                header('location: ' . URLROOT . '/testimonials?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $item = $this->model->getById($id);

            $data = [
                'title' => 'Edit Testimoni',
                'id' => $id,
                'nama' => $item->nama,
                'peran' => $item->peran,
                'isi_testimoni' => $item->isi_testimoni,
                'url_avatar' => $item->url_avatar,
                'rating' => $item->rating,
                'urutan' => $item->urutan
            ];
            $this->view('testimonials/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->model->delete($id)){
                header('location: ' . URLROOT . '/testimonials?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
             header('location: ' . URLROOT . '/testimonials');
        }
    }
}
