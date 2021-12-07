<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RightsGroup extends Model
{
    use HasFactory;
    /**
   * The table associated with the model.
   *
   * @var string
   */
    protected $table = 'rights_group';


    public function view()
    {
        return RightsGroup::leftjoin('users', 'rights_group.created_by', '=', 'users.id')
                  ->select('rights_group.*', 'users.first_name', 'users.last_name')
                  ->orderBy('id', 'asc')
                  ->get();
    }


    public function deleteGroup($request)
    {
        $rights = RightsGroup::find(request('rights_group_id'));
        $rights->status = 0;
        $rights->save();

        return $rights;
    }
}
