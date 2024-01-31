<?php

class IndexContr extends IndexView {
    
    public function __construct() {
        $this->setCurrentView();        
    }


    public function setCurrentView() {
        // Define the allowed views
        $allowedViews = 
        ['products', 'cart', 'orders', 'profile', 'sales', 
        'home', 'success', 'fail', 'login', 'signup'];
    
        // Get the "view" parameter from the GET request
        if (isset($_GET['view'])) {
            $requestedView = $_GET['view'];
    
            // Check if the requested view is in the allowed views
            if (in_array($requestedView, $allowedViews)) {
                // Set the session variable if the view is allowed
                $_SESSION['current_view'] = $requestedView;
            } else {
                // Set a default view or handle the case when the view is not allowed
                $_SESSION['current_view'] = 'home';
            }
        } else {
            // Set a default view if the "view" parameter is not present
            $_SESSION['current_view'] = 'home';
        }
    }

    public function renderView() {
        $this->renderCurrentView();
    }
}