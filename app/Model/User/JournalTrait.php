<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 01.02.18
 * Time: 21:21
 */
namespace App\Model\User;

trait JournalTrait
{
    /**
     * @return mixed
     */
    public function getUnreadJournals()
    {
        return Journal::where('user_id', $this->id)
            ->where('is_read', 0)
            ->count();
    }
}