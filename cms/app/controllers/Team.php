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
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $data = [
                'nama' => trim($_POST['nama']),
                'jabatan' => trim($_POST['jabatan']),
                'url_foto' => '', // Will be filled by upload
                'kutipan' => trim($_POST['kutipan']),
                'urutan' => (int)trim($_POST['urutan'])
            ];

             // Handle File Upload
             if(isset($_FILES['foto_upload']) && $_FILES['foto_upload']['error'] === 0){
                $uploadResult = $this->handleUpload($_FILES['foto_upload']);
                if($uploadResult['success']){
                    $data['url_foto'] = $uploadResult['path'];
                }
            }

            if($this->model->add($data)){
                header('location: ' . URLROOT . '/team?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $data = [
                'title' => 'Tambah Anggota Tim',
                'nama' => '',
                'jabatan' => '',
                'url_foto' => '',
                'kutipan' => '',
                'urutan' => ''
            ];
            $this->view('team/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $existing = $this->model->getById($id);

            $data = [
                'id' => $id,
                'nama' => trim($_POST['nama']),
                'jabatan' => trim($_POST['jabatan']),
                'url_foto' => $existing->url_foto,
                'kutipan' => trim($_POST['kutipan']),
                'urutan' => (int)trim($_POST['urutan'])
            ];

             // Handle File Upload
             if(isset($_FILES['foto_upload']) && $_FILES['foto_upload']['error'] === 0){
                $uploadResult = $this->handleUpload($_FILES['foto_upload']);
                if($uploadResult['success']){
                    $data['url_foto'] = $uploadResult['path'];
                }
            }

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
                'jabatan' => $item->jabatan,
                'url_foto' => $item->url_foto,
                'kutipan' => $item->kutipan,
                'urutan' => $item->urutan
            ];
            $this->view('team/edit', $data);
        }
    }

    private function handleUpload($file){
        $targetDir = dirname(dirname(dirname(__FILE__))) . '/public/uploads/team/';
        
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = time() . '_' . basename($file['name']);
        $targetFile = $targetDir . $fileName;
        
        $check = getimagesize($file["tmp_name"]);
        if($check === false) {
             return ['success' => false, 'msg' => 'File is not an image.'];
        }

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return ['success' => true, 'path' => URLROOT . '/public/uploads/team/' . $fileName];
        } else {
            return ['success' => false, 'msg' => 'Error uploading file.'];
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
