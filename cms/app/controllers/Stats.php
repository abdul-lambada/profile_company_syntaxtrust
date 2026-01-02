<?php
class Stats extends Controller {
    private $model;

    public function __construct(){
        $this->model = $this->model('StatsModel');
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
            'title' => 'Konten Statistik',
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
        $this->view('stats/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'label' => trim($_POST['label']),
                'nilai' => trim($_POST['nilai']),
                'deskripsi' => trim($_POST['deskripsi']),
                'urutan' => (int)trim($_POST['urutan'])
            ];

            if($this->model->add($data)){
                header('location: ' . URLROOT . '/stats?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $data = [
                'title' => 'Tambah Statistik',
                'label' => '',
                'nilai' => '',
                'deskripsi' => '',
                'urutan' => ''
            ];
            $this->view('stats/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'label' => trim($_POST['label']),
                'nilai' => trim($_POST['nilai']),
                'deskripsi' => trim($_POST['deskripsi']),
                'urutan' => (int)trim($_POST['urutan'])
            ];

            if($this->model->update($data)){
                header('location: ' . URLROOT . '/stats?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $item = $this->model->getById($id);

            $data = [
                'title' => 'Edit Statistik',
                'id' => $id,
                'label' => $item->label,
                'nilai' => $item->nilai,
                'deskripsi' => $item->deskripsi,
                'urutan' => $item->urutan
            ];
            $this->view('stats/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->model->delete($id)){
                header('location: ' . URLROOT . '/stats?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
             header('location: ' . URLROOT . '/stats');
        }
    }
}
