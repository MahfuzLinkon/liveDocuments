<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
       'title',
       'body',
    ];

//    protected $hidden = [
//      'title'
//    ];

    protected $casts = [
      'body' => 'array',
    ];

//    protected $appends = [
//        'title_upper_case'
//    ];

    //    Accessor //
//    public function getTitleUpperCaseAttribute(){
//        return strtoupper($this->title);
//    }
    // Mutator
//    public function setTitleAttribute($value){
//        $this->attributes['title'] = strtolower($value);
//    }



    public function users()
    {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'post_id');
    }
}
