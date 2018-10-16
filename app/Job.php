<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    /**
     * @var array
     */
    protected $fillable = [
        'sex', 'title', 'subTitle', 'vacancies', 'required', 'companyId'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
}
