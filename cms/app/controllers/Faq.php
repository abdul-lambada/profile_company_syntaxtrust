<?php
class Faq extends Controller {
    private $model;

    public function __construct(){
        $this->model = $this->model('FaqModel');
    }

    public function index(){
        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        $offset = ($page - 1) * $limit;
        
        $totalRows = $this->model->countAll();
        $totalPages = ceil($totalRows / $limit);
        $items = $this->model->getPaginated($limit, $offset);

        $data = [
            'title' => 'FAQ',
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
        $this->view('faq/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'pertanyaan' => trim($_POST['pertanyaan']),
                'jawaban' => trim($_POST['jawaban']),
                'urutan' => (int)trim($_POST['urutan'])
            ];

            if($this->model->add($data)){
                header('location: ' . URLROOT . '/faq?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $data = [
                'title' => 'Tambah FAQ',
                'pertanyaan' => '',
                'jawaban' => '',
                'urutan' => ''
            ];
            $this->view('faq/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'pertanyaan' => trim($_POST['pertanyaan']),
                'jawaban' => trim($_POST['jawaban']),
                'urutan' => (int)trim($_POST['urutan'])
            ];

            if($this->model->update($data)){
                header('location: ' . URLROOT . '/faq?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $item = $this->model->getById($id);

            $data = [
                'title' => 'Edit FAQ',
                'id' => $id,
                'pertanyaan' => $item->pertanyaan,
                'jawaban' => $item->jawaban,
                'urutan' => $item->urutan
            ];
            $this->view('faq/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->model->delete($id)){
                header('location: ' . URLROOT . '/faq?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
             header('location: ' . URLROOT . '/faq');
        }
    }
}
