<?php

namespace Bumsgames;

use Illuminate\Database\Eloquent\Model;

class BumsUser_Article extends Model
{
	protected $table = 'bums_user_articles';

	protected $fillable = [
		'id_bumsuser',
		'id_article',
		'porcentaje',
		'permiso'
	];
}
