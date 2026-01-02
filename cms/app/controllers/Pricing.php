<?php
class Pricing extends Controller {
    private $model;

    public function __construct(){
        $this->model = $this->model('PricingModel');
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
            'title' => 'Paket Harga',
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
        $this->view('pricing/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Handle Fitur List (Array to JSON)
            $fiturList = isset($_POST['fitur']) ? $_POST['fitur'] : [];
            $fiturList = array_filter($fiturList, function($value) { return !empty($value); });
            $fiturList = array_values($fiturList);
            $jsonFitur = json_encode($fiturList, JSON_UNESCAPED_UNICODE);

            $data = [
                'nama_paket' => trim($_POST['nama_paket']),
                'harga' => trim($_POST['harga']),
                'deskripsi_singkat' => trim($_POST['deskripsi_singkat']),
                'fitur_list_json' => $jsonFitur,
                'is_populer' => isset($_POST['is_populer']) ? 1 : 0,
                'urutan' => (int)trim($_POST['urutan'])
            ];

            if($this->model->add($data)){
                header('location: ' . URLROOT . '/pricing?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $data = [
                'title' => 'Tambah Paket Harga',
                'nama_paket' => '',
                'harga' => '',
                'deskripsi_singkat' => '',
                'fitur_list' => [],
                'is_populer' => 0,
                'urutan' => ''
            ];
            $this->view('pricing/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Handle Fitur List (Array to JSON)
            $fiturList = isset($_POST['fitur']) ? $_POST['fitur'] : [];
            $fiturList = array_filter($fiturList, function($value) { return !empty($value); });
            $fiturList = array_values($fiturList);
            $jsonFitur = json_encode($fiturList, JSON_UNESCAPED_UNICODE);

            $data = [
                'id' => $id,
                'nama_paket' => trim($_POST['nama_paket']),
                'harga' => trim($_POST['harga']),
                'deskripsi_singkat' => trim($_POST['deskripsi_singkat']),
                'fitur_list_json' => $jsonFitur,
                'is_populer' => isset($_POST['is_populer']) ? 1 : 0,
                'urutan' => (int)trim($_POST['urutan'])
            ];

            if($this->model->update($data)){
                header('location: ' . URLROOT . '/pricing?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $item = $this->model->getById($id);
            
            // Decode Fitur List
            $fiturList = json_decode($item->fitur_list_json, true);
            if(!$fiturList) $fiturList = [];

            $data = [
                'title' => 'Edit Paket Harga',
                'id' => $id,
                'nama_paket' => $item->nama_paket,
                'harga' => $item->harga,
                'deskripsi_singkat' => $item->deskripsi_singkat,
                'fitur_list' => $fiturList,
                'is_populer' => $item->is_populer,
                'urutan' => $item->urutan
            ];
            $this->view('pricing/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->model->delete($id)){
                header('location: ' . URLROOT . '/pricing?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
             header('location: ' . URLROOT . '/pricing');
        }
    }
}
