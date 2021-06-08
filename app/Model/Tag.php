<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $table = 'tags';

    public function products()
    {
        return $this->belongsToMany('App\Model\Product', 'product_tag', 'tag_id', 'product_id');
    }

    public function insertTag($name, $title_seo, $meta_seo, $description, $status)
    {
        $tag = new Tag;

        $tag->name = $name;
        $tag->slug = Str::slug($name);
        $tag->title_seo = $title_seo;
        $tag->meta_seo= $meta_seo;
        $tag->description = $description;
        $tag->status = $status;
        $tag->created_at = date('Y-m-d H:i:s');
        $tag->updated_at = null;

        if($tag->save()){
            return true;
        }
        return false;
        /*
         * Tương đương câu lệnh tạo query builder
         *    DB:table('tags')->insert([
         *       'name' => $name,
         *       'slug' => Str::slug($name),
         *       ...
         *    ]);
         *
         * */
    }

    public function updateTag($id, $name)
    {
        $update = Tag::findOrFail($id);
        $update->name = $name;
        $update->slug = Str::slug($name);

        if($update->save()){
            return true;
        }
        return false;

        /*
         * Tương đương câu lệnh tạo query builder
         *    DB:table('tags')
         *    ->where('id', $id)
         *    ->update([
         *       'name' => $name,
         *       'slug' => Str::slug($name),
         *       ...
         *    ]);
         *
         * */
    }

    public function deleteTag($id)
    {
        $delete = Tag::find($id);
        if($delete){
            if($delete->delete()){
                return true;
            }
        }
        return false;

        /*
         * Tương đương câu lệnh tạo query builder
         *    DB:table('tags')
         *    ->where('id', $id)
         *    ->delete();
         *
         * */
    }
}
