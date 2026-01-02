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
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $data = [
                'nama' => trim($_POST['nama']),
                'peran' => trim($_POST['peran']),
                'isi_testimoni' => trim($_POST['isi_testimoni']),
                'url_avatar' => '', // Will be filled by upload
                'rating' => (int)trim($_POST['rating']),
                'urutan' => (int)trim($_POST['urutan'])
            ];

            // Handle File Upload
            if(isset($_FILES['avatar_upload']) && $_FILES['avatar_upload']['error'] === 0){
                $uploadResult = $this->handleUpload($_FILES['avatar_upload']);
                if($uploadResult['success']){
                    $data['url_avatar'] = $uploadResult['path'];
                } else {
                     // Handle error or use default
                }
            }

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
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            // Get existing data to keep old avatar if not changed
            $existing = $this->model->getById($id);

            $data = [
                'id' => $id,
                'nama' => trim($_POST['nama']),
                'peran' => trim($_POST['peran']),
                'isi_testimoni' => trim($_POST['isi_testimoni']),
                'url_avatar' => $existing->url_avatar,
                'rating' => (int)trim($_POST['rating']),
                'urutan' => (int)trim($_POST['urutan'])
            ];

             // Handle File Upload
             if(isset($_FILES['avatar_upload']) && $_FILES['avatar_upload']['error'] === 0){
                $uploadResult = $this->handleUpload($_FILES['avatar_upload']);
                if($uploadResult['success']){
                    $data['url_avatar'] = $uploadResult['path'];
                }
            }

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

    private function handleUpload($file){
        $targetDir = dirname(dirname(dirname(__FILE__))) . '/public/uploads/testimonials/';
        
        // Create dir if not exists (although we did via command, safe check)
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = time() . '_' . basename($file['name']);
        $targetFile = $targetDir . $fileName;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        
        // Simple check
        $check = getimagesize($file["tmp_name"]);
        if($check === false) {
             return ['success' => false, 'msg' => 'File is not an image.'];
        }

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            // Return public accessible URL/path
            // Assuming cms/public is exposed. 
            // Better: Store relative path and prepend base URL in view.
            // Or store full public URL if ASSETS_PATH is set differently.
            // Let's store relative path from public root of CMS: 'uploads/testimonials/filename.jpg'
            // But wait, URLROOT is .../cms. 
            // If we assume a "public" folder inside "cms", then URLROOT . '/public/uploads/...' works.
            return ['success' => true, 'path' => URLROOT . '/public/uploads/testimonials/' . $fileName];
        } else {
            return ['success' => false, 'msg' => 'Error uploading file.'];
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
