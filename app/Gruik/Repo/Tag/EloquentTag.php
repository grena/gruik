<?php namespace Gruik\Repo\Tag;

use Gruik\Repo\RepoAbstract;
use Gruik\Repo\RepoInterface;

use \Tag;

class EloquentTag extends RepoAbstract implements RepoInterface, TagInterface {

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function byLabel($label)
    {
        return $this->model->where('label', $label)->first();
    }

    public function byPostId($id_post)
    {
        $postRepo = \App::make('Gruik\Repo\Post\PostInterface');
        return $postRepo->byId($id_post)->tags;
    }

    public function byUserId($id_user)
    {
        return $this->model->where('user_id', $id_user)->get();
    }

    public function createFromString($label, $user_id)
    {
        $tag = $this->make([
            'user_id' => $user_id,
            'label' => $label
        ]);

        $tag->save();

        return $tag;
    }

    public function labelToId($labels, $user_id, $create = true)
    {
        $ids = [];

        if(empty($labels))
        {
            return [];
        }

        foreach ($labels as $label)
        {
            $tag = $this->byLabel($label);

            if($tag)
            {
                $ids[] = $tag->id;
            }
            else
            {
                if($create)
                {
                    $ids[] = $this->createFromString($label, $user_id)->id;
                }
            }
        }

        return $ids;
    }

    public function idToLabel($ids)
    {
        return $this->model->whereIn('id', $ids)->lists('label');
    }
}