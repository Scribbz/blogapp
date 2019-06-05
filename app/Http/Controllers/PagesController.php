<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //My Methods
    public function index(){
        $title = 'Welcome to My CRUD Blog Application! 😊';
        
        // Passing Single Values
        return view ('pages.index', compact('title') );
    }

    public function about(){
        $title = 'About Me 😎';

        //Passing Multiple Values
        return view ('pages.about') -> with ('title', $title);
    }

    public function services(){

        //Passing arrays
        $data = array(

            'title' => 'What I Offer ✔',
            'services' => ['Web Design', 'Programming', 'SEO']
            
        );
        return view ('pages.services') -> with ($data);
    }
}