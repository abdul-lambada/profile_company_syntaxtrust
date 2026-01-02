<?php
class Dashboard extends Controller {
    private $featuresModel;
    private $testimonialsModel;
    private $teamModel;
    private $pricingModel;
    private $faqModel;
    private $clientMapModel;

    public function __construct(){
        // Ensure user is logged in
        if(!isset($_SESSION['user_id'])){
            header('location: ' . URLROOT . '/login');
            exit; // Stop execution
        }

        $this->featuresModel = $this->model('FeaturesModel');
        $this->testimonialsModel = $this->model('TestimonialsModel');
        $this->teamModel = $this->model('TeamModel');
        $this->pricingModel = $this->model('PricingModel');
        $this->faqModel = $this->model('FaqModel');
        $this->clientMapModel = $this->model('ClientMapModel');
    }

    public function index(){
        $stats = [
            'features_count' => $this->featuresModel->countAll(),
            'testimonials_count' => $this->testimonialsModel->countAll(),
            'team_count' => $this->teamModel->countAll(),
            'pricing_count' => $this->pricingModel->countAll(),
            'faq_count' => $this->faqModel->countAll(),
            'clients_count' => $this->clientMapModel->countAll()
        ];

        $data = [
            'title' => 'Dashboard',
            'stats' => $stats
        ];
        
        $this->view('dashboard/index', $data);
    }
}
