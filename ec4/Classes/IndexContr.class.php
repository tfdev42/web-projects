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
    
        // Get the "view" and the key parameter from the GET request
        if (isset($_GET['view'], $_GET['key'])) {

            $requestedView = htmlspecialchars($_GET['view']);
            $requestedKey = htmlspecialchars($_GET['key']);
    
            // Check if the requested view is in the allowed views and if key is correct
            if (in_array($requestedView, $allowedViews) && $requestedKey === $_SESSION['redirect_key']) {
                // Set the session variable if the view is allowed
                $_SESSION['current_view'] = $requestedView;

                // Reset the key to avoid using it multiple times
                unset($_SESSION['redirect_key']);
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