<?php

class UserPreference extends Eloquent {

    protected $fillable = [
        'user_id',
        'key',
        'value'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_preferences';

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

    public function getValueAttribute($value)
    {
        return boolval($value);
    }

}