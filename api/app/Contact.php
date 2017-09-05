<?php

namespace App;

/**
 * Contact
 * Basic implemention of Contact using Eloquent
 * @author Ronald Lee <ronald@ronaldlee.co.uk>
 */
use Illuminate\Database\Eloquent\Model;
class Contact extends Model
{
    protected $fillable = ['name', 'email', 'location', 'primary'];
}
