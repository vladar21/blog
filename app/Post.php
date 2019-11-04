<?php

namespace App;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

    const IS_DRAFT = 0;
    const IS_PUBLIC = 1;

    protected $fillable = ['title', 'content', 'date', 'description'];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {        
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'post_tags',
            'post_id',
            'tag_id'
        );
    }

    public static function add($fields)
    {
        $post = new static;
        $post->fill($fields);
        $post->user_id = Auth::user()->id;
        $post->save();

        // $doc = new DOMDocument();
        // $doc->load('https://inform-ua.info/feed/rss/v1');
        // dd($doc->saveXML());

        return $post;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove()
    {
        $this->removeImage();
        $this->delete();
    }

    public function removeImage()
    {
        if($this->image != null)
        {
            //dd($this->image);
            Storage::delete('uploads/'. $this->image);
        }
    }

    public function uploadImage($image)
    {
        if ($image == null){ return; }

        $this->removeImage();
       
        $filename = str_random(10).'.'.$image->extension();
        $image->storeAs('uploads', $filename);
        $this->image = $filename;
        $this->save();
    }

    public function getImage()
    {
        if ($this->image == null)
        {
            return '/img/no-image.jpg';
        }
        return '/uploads/' . $this->image;
    }

    public function setCategory($id)
    {
        if($id == null) {return;}
    	$this->category_id = $id;
    	$this->save();
    }

    public function setTags($ids)
    {
        if ($ids == null) { return; }
        $this->tags()->sync($ids);
    }

    public function setDraft()
    {
        $this->status = 0;
        // $this->status = Post::IS_DRAFT;
        $this->save();
    }

    public function setPublic()
    {
       $this->status = 1;
    //    $this->status = Post::IS_PUBLIC;
        $this->save();        
    }

    public function toggleStatus($value)
    {
        if ($value == null) 
        {
            return $this->setDraft();
        }
        return $this->setPublic();
    }

    public function setFeatured()
    {
        $this->is_featured = 1;
        $this->save();
    }

    public function setStandart()
    {
        $this->is_featured = 0;
        $this->save();        
    }

    public function toggleFeatured($value)
    {
        if ($value == null) 
        {
            return $this->setStandart();
        }
        return $this->setFeatured();
    }
    
    public function setDateAttribute($value)
    {
        $date = Carbon::createFromFormat('d/m/y', $value)->format('Y-m-d');
        $this->attributes['date'] = $date;  
    }

    public function getDateAttribute($value)
    {
        $date = Carbon::createFromFormat('Y-m-d', $value)->format('d/m/y');
       return $date;  
    }

    public function getCategoryTitle()
    {       
        return ($this->category != null) 
                ?   $this->category->title
                :   'Нет категории';
    }

    public function getTagTitle()
    {
        if(!$this->tags->isEmpty())
        {
            return implode(', ', $this->tags->pluck('title')->all());
        }
        return 'Нет тегов';
    }

    public function getCategoryID()
    {
        return ($this->category != null) ? $this->category->id : null;
    }

    public function getDate()
    {
        return Carbon::createFromFormat('d/m/y', $this->date)->format('M d, Y');
    }

    public function hasPrevious()
    {
        return self::where('id', '<', $this->id)->max('id');
    }

    public function getPrevious()
    {
        $postID = $this->hasPrevious();
        return self::find($postID);
    }

    public function hasNext()
    {
        return self::where('id', '>', $this->id)->min('id');
    }

    public function getNext()
    {
        $postID = $this->hasNext();
        return self::find($postID);
    }

    public function related()
    {
        return self::all()->except($this->id);
    }

    public function hasCategory()
    {
        return $this->category != null ? true : false;
    }

    public static function getPopularPosts()
    {    

        return self::orderBy('views', 'desc');
    }

    public static function getRecentPosts()
    {   
        // возвращаем последние пять новостей 
        return self::orderBy('date', 'desc');//->reject(function ($value, $key) {
        //     return $key > 0;
        //   });
    }

    public function getComments()
    {
        return $this->comments()->where('status', 1)->get();
    }

    public function lastNews()
    {
        $posts = ModelName::all();
        return $last_post = collect($posts)->last();
    }
}
