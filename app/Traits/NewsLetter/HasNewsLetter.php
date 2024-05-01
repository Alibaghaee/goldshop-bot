<?php
namespace App\Traits\NewsLetter;

use App\Models\General\NewsLetter;

trait HasNewsLetter{


    /**
     * Define a polymorphic many-to-many relationship to NewsLetter.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function newsLetters()
    {
        return $this->morphToMany(NewsLetter::class, 'news_letterable');
    }
}
