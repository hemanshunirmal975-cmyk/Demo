<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pagecontroller extends Controller
{
    function home(){
        return "home";
    }

    public function getabout(){
        return "about";
    }

    public function getcontact(){
        return "conatact : 984527362";
    }

    public function getblog(){
        return "blog";
    }
    
    public function getservice(){
        return "service";
    }
    
    public function getgallery(){
        return "gallery";
    }
    
    public function getfaq(){
        return "faq";
    }
    
    public function getcarrer(){
        return "carrer";
    }
     
    public function getteam(){
        return "team";
    }
    
    public function gethelp(){
    
        return "help";
    }
    

}
