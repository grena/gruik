<?php

class Post extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}