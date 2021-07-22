<?php

namespace App\Models;

use App\Models\Dept;
use App\Models\User;
use App\Models\Group;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'type',
        'description',
        'taken',
        'supervisor_id',
        'dept_id',
        'directory_id'
    ];
    public function dept()
    {
        return $this->belongsTo(Dept::class,'dept_id');
    }
    public function supervisor()
    {
        return $this->belongsTo(User::class,'supervisor_id','id');
    }
    public function group()
    {
        return $this->hasOne(Group::class);
    }
    public function users()
    {
        return $this->hasManyThrough(User::class,Group::class);
    }
    public function directory()
    {
        return $this->belongsTo(Directory::class,'directory_id');
    }
    public function media()
    {
        return $this->hasManyThrough(Directory::class,Media::class);
    }
}
