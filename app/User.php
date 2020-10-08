<?php namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

// Changed the actual User.php into User.original.php
// This file is added for now to test the database connection.

class User extends Eloquent {

    protected $collection = 'users';

}