<?php
class Badges extends Controller {
    private $badgesModel;

    public function __construct(){
        $this->badgesModel = $this->model('BadgesModel');
    }

    public function index(){
        // Pagination Logic
        $limit = 5; // Rows per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        
        $offset = ($page - 1) * $limit;
        
        $totalRows = $this->badgesModel->countAll();
        $totalPages = ceil($totalRows / $limit);

        $badges = $this->badgesModel->getPaginated($limit, $offset);

        $data = [
            'title' => 'Konten Lencana & Mitra',
            'badges' => $badges,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'has_previous' => $page > 1,
                'has_next' => $page < $totalPages,
                'previous_page' => $page - 1,
                'next_page' => $page + 1
            ]
        ];
        $this->view('badges/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'label' => trim($_POST['label']),
                'ikon_svg_path' => trim($_POST['ikon_svg_path']),
                'err' => ''
            ];

            if($this->badgesModel->add($data)){
                // Redirect
                header('location: ' . URLROOT . '/badges?status=success');
            } else {
                die('Something went wrong');
            }

        } else {
            $data = [
                'title' => 'Tambah Lencana',
                'label' => '',
                'ikon_svg_path' => ''
            ];

            $this->view('badges/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'label' => trim($_POST['label']),
                'ikon_svg_path' => trim($_POST['ikon_svg_path']),
                'err' => ''
            ];

            if($this->badgesModel->update($data)){
                // Redirect
                header('location: ' . URLROOT . '/badges?status=success');
            } else {
                die('Something went wrong');
            }

        } else {
            // Get post
            $badge = $this->badgesModel->getById($id);

            $data = [
                'title' => 'Edit Lencana',
                'id' => $id,
                'label' => $badge->label,
                'ikon_svg_path' => $badge->ikon_svg_path
            ];

            $this->view('badges/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->badgesModel->delete($id)){
                header('location: ' . URLROOT . '/badges?status=success');
            } else {
                die('Something went wrong');
            }
        } else {
             header('location: ' . URLROOT . '/badges');
        }
    }
}
