<?php

namespace App\Repository;

use App\Message;

class MessageRepository
{
    /**
     * @param array $attributes
     * @return static
     */
    public function create(array $attributes)
    {
        return Message::create($attributes);
    }

    /**
     * @param $dialogId
     * @return mixed
     */
    public function getMessagesById($dialogId)
    {
        return Message::where('dialog_id',$dialogId) ->with(['fromUser' => function ($query) {
            return $query->select(['id','name','avatar']);
        },'toUser' => function ($query) {
            return $query->select(['id','name','avatar']);
        }])->latest()->get();
    }

    /**
     * @return mixed
     */
    public function getAllMessages()
    {
        return Message::where('to_user_id',user()->id)
            ->orWhere('from_user_id',user()->id)
            ->with(['fromUser' => function ($query) {
                return $query->select(['id','name','avatar']);
            },'toUser' => function ($query) {
                return $query->select(['id','name','avatar']);
            }])->latest()->get();
    }

    /**
     * @param $dialogId
     * @return mixed
     */
    public function ById($dialogId)
    {
        return Message::where('dialog_id',$dialogId)->first();
    }
}