<?php

class IndexContr extends IndexView {
    
    public function __construct() {
        $this->setCurrentView();        
    }


    public function setCurrentView() {
        // Define the allowed views
        $allowedViews = 
        ['products', 'orders', 'profile', 'admin', 
        'home', 'success', 'fail', 'login', 'signup', 'cart'];
    
        // Get the "view" parameter from the GET request
        if (isset($_GET['view'])) {

            $requestedView = htmlspecialchars($_GET['view']);
    
            // Check if the requested view is in the allowed views
            if (in_array($requestedView, $allowedViews)) {
                // Set the session variable if the view is allowed
                $_SESSION['current_view'] = $requestedView;
            }
            // Set default view if view is not allowed
            else {
                $_SESSION['current_view'] = '404';
            }

        } else {
            // Set a default view if the "view" parameter is not present
            $_SESSION['current_view'] = 'index';
        }
    }

    public function renderView() {
        $this->renderCurrentView();
    }
}