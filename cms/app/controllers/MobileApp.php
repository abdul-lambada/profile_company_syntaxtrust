<?php
class MobileApp extends Controller {
    private $mobileAppModel;

    public function __construct(){
        $this->mobileAppModel = $this->model('MobileAppModel');
    }

    public function index(){
        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        $offset = ($page - 1) * $limit;
        
        $totalRows = $this->mobileAppModel->countAll();
        $totalPages = ceil($totalRows / $limit);
        $apps = $this->mobileAppModel->getPaginated($limit, $offset);

        $data = [
            'title' => 'Konten Aplikasi Mobile',
            'apps' => $apps,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'has_previous' => $page > 1,
                'has_next' => $page < $totalPages,
                'previous_page' => $page - 1,
                'next_page' => $page + 1
            ]
        ];
        $this->view('mobile_app/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Handle Features List
            $features = isset($_POST['features']) ? $_POST['features'] : [];
            $features = array_filter($features, function($v) { return !empty($v); });
            $jsonFeatures = json_encode(array_values($features), JSON_UNESCAPED_UNICODE);

            // Handle Store Links (Manual construct JSON object)
            $storeLinks = [
                'playstore' => trim($_POST['playstore'] ?? ''),
                'appstore' => trim($_POST['appstore'] ?? '')
            ];
            $jsonStoreLinks = json_encode($storeLinks, JSON_UNESCAPED_UNICODE);

            $data = [
                'judul_badge' => trim($_POST['judul_badge']),
                'judul_utama' => trim($_POST['judul_utama']),
                'deskripsi' => trim($_POST['deskripsi']),
                'gambar_mockup' => trim($_POST['gambar_mockup']),
                'fitur_list_json' => $jsonFeatures,
                'store_links_json' => $jsonStoreLinks
            ];

            if($this->mobileAppModel->add($data)){
                header('location: ' . URLROOT . '/mobile_app?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $data = [
                'title' => 'Tambah Konten Mobile App',
                'judul_badge' => '',
                'judul_utama' => '',
                'deskripsi' => '',
                'gambar_mockup' => '',
                'playstore' => '',
                'appstore' => '',
                'features' => []
            ];
            $this->view('mobile_app/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $features = isset($_POST['features']) ? $_POST['features'] : [];
            $features = array_filter($features, function($v) { return !empty($v); });
            $jsonFeatures = json_encode(array_values($features), JSON_UNESCAPED_UNICODE);

            $storeLinks = [
                'playstore' => trim($_POST['playstore'] ?? ''),
                'appstore' => trim($_POST['appstore'] ?? '')
            ];
            $jsonStoreLinks = json_encode($storeLinks, JSON_UNESCAPED_UNICODE);

            $data = [
                'id' => $id,
                'judul_badge' => trim($_POST['judul_badge']),
                'judul_utama' => trim($_POST['judul_utama']),
                'deskripsi' => trim($_POST['deskripsi']),
                'gambar_mockup' => trim($_POST['gambar_mockup']),
                'fitur_list_json' => $jsonFeatures,
                'store_links_json' => $jsonStoreLinks
            ];

            if($this->mobileAppModel->update($data)){
                header('location: ' . URLROOT . '/mobile_app?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
            $app = $this->mobileAppModel->getById($id);
            
            $features = json_decode($app->fitur_list_json, true) ?? [];
            $storeLinks = json_decode($app->store_links_json, true) ?? [];

            $data = [
                'title' => 'Edit Konten Mobile App',
                'id' => $id,
                'judul_badge' => $app->judul_badge,
                'judul_utama' => $app->judul_utama,
                'deskripsi' => $app->deskripsi,
                'gambar_mockup' => $app->gambar_mockup,
                'playstore' => $storeLinks['playstore'] ?? '',
                'appstore' => $storeLinks['appstore'] ?? '',
                'features' => $features
            ];
            $this->view('mobile_app/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->mobileAppModel->delete($id)){
                header('location: ' . URLROOT . '/mobile_app?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
             header('location: ' . URLROOT . '/mobile_app');
        }
    }
}
