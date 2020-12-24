<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public $data;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->data = new Data();
    }

    public function getAllNews(): array
    {

        $arrNews = array_map([$this, 'changeIdToText'], $this->data->GetAllNews());

        return array_reverse($arrNews);
    }

    public function getUser($id): ?array
    {
        return $this->searchInArray($this->data->getUsers(), $id);
    }

    public function getNews($id): ?array
    {
        return $this->searchInArray($this->GetAllNews(), $id);
    }

    public function getCategory($id): ?array
    {
        return $this->searchInArray($this->data->getCategories(), $id);
    }

    public function getLastThreeNews(): array
    {
        return array_slice($this->GetAllNews(), -0, 3);

    }

    public function getNewsInCategory($id): array
    {
        return array_filter($this->GetAllNews(), function($news) use ($id) {
            return $news['category_id']['id'] === $id;
        });
    }

    private function changeIdToText($arr): array
    {
        $arr['author_id'] = $this->getUser($arr['author_id'])['name'];
        $arr['category_id'] = $this->getCategory($arr['category_id']);

        return $arr;
    }

    private function searchInArray($arr, $search): ?array
    {
        foreach ($arr as $value) {
            if ($value['id'] == $search) {
                return $value;
            }
        }
        return null;
    }
}
