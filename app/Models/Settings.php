<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    /**get a string value by key */
    public static function getValue($key, $default=null)
    {
        $settings = static::where('key', $key)->first();
        return $settings ? $settings->value : $default;
    }

    /**set a setting value by key */
    public  static function setValue($key, $value)
    {
        return static::updateorCreate(['key' => $key], ['value' => $value]);
    }
}
