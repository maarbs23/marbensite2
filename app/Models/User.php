<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class User extends Model{

    protected $table = 'student';

    protected $fillable = [
    'username', 'password', 'gender'
    ];

    protected $hidden = ['password'];
    public $timestamps = false;
 }