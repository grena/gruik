<?php

class Tag extends Eloquent {

    protected $fillable = [
        'user_id',
        'label'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function posts()
    {
        return $this->belongsToMany('Post', 'post_tags');
    }

}