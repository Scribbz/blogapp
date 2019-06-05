<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Changing Table Name
    protected $table = 'posts';

    //Changing Primary-key 
    public $primaryKey = 'id';

    //Setting timestamps
    public $timestamps = true;

    //Creating relationships btwn posts and their users
    public function user(){
        return $this -> belongsTo('App\User'); 
    }
}
