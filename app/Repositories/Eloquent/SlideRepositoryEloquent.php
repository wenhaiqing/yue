<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\SlideRepository;
use App\Models\Picture;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class SlideRepositoryEloquent extends BaseRepository implements SlideRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Picture::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
