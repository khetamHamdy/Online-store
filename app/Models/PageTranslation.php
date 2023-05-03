<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;



class PageTranslation extends Model

{

    use SoftDeletes;

    protected $fillable = ['locale', 'page_id', 'title', 'description'];

}

