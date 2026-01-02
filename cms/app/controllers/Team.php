<?php
class Team extends Controller {
    private $model;

    public function __construct(){
        $this->model = $this->model('TeamModel');
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
            'title' => 'Tim Kami',
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
        $this->view('team/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'nama' => trim($_POST['nama']),
                'posisi' => trim($_POST['posisi']),
                'foto_path' => trim($_POST['foto_path']),
                'link_linkedin' => trim($_POST['link_linkedin']),
                'link_instagram' => trim($_POST['link_instagram']),
                'urutan' => (int)trim($_POST['urutan'])
            ];

            if($this->model->add($data)){
                header('location: ' . URLROOT . '/team?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $data = [
                'title' => 'Tambah Anggota Tim',
                'nama' => '',
                'posisi' => '',
                'foto_path' => '',
                'link_linkedin' => '',
                'link_instagram' => '',
                'urutan' => ''
            ];
            $this->view('team/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'nama' => trim($_POST['nama']),
                'posisi' => trim($_POST['posisi']),
                'foto_path' => trim($_POST['foto_path']),
                'link_linkedin' => trim($_POST['link_linkedin']),
                'link_instagram' => trim($_POST['link_instagram']),
                'urutan' => (int)trim($_POST['urutan'])
            ];

            if($this->model->update($data)){
                header('location: ' . URLROOT . '/team?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $item = $this->model->getById($id);

            $data = [
                'title' => 'Edit Anggota Tim',
                'id' => $id,
                'nama' => $item->nama,
                'posisi' => $item->posisi,
                'foto_path' => $item->foto_path,
                'link_linkedin' => $item->link_linkedin,
                'link_instagram' => $item->link_instagram,
                'urutan' => $item->urutan
            ];
            $this->view('team/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->model->delete($id)){
                header('location: ' . URLROOT . '/team?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
             header('location: ' . URLROOT . '/team');
        }
    }
}
