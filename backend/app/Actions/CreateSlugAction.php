<?php

namespace App\Actions;

use Illuminate\Support\Str;

class CreateSlugAction
{
    public function handle($name){
        $slug = Str::slug($name);
        $slug = str_replace('-', ' ', $slug);
        $slug = ucwords($slug);
        $slug = str_replace(' ', '', $slug);
        return $slug;
    }
}
