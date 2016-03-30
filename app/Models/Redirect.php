<?php

namespace Nightwing\Models;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'path', 'target', 'http_status',
  ];
}
