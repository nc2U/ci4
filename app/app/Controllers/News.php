<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
    public function index(): string
    {
        $model = model(NewsModel::class);

        $data = [
            'news_list' => $model->getNews(),
            'title' => 'News archive',
        ];

        return view('templates/header', $data)
            .view('news/index')
            .view('templates/footer');
    }

    public function show(?string $slug = null): string
    {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($slug);

        if ($data['news'] === null) {
            throw new PageNotFoundException('Cannot find the news item' . $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            .view('news/view')
            .view('templates/footer');
    }

    public function new(): string
    {
        helper('form');

        return view('templates/header', ['title' => 'Create a news item'])
            .view('news/create')
            .view('templates/footer');
    }

    public function create(): string
    {
        helper('form');

        $data = $this->request->getPost(['title', 'body']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'title' => 'required|min_length[3]|max_length[255]',
            'body' => 'required|min_length[10]|max_length[5000]',
        ])) {
            // The validation fails, so returns the form.
            return $this->new();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(NewsModel::class);

        $model->save([
            'title' => $post['title'],
            'slug' => url_title($post['title'], '-', true),
            'body' => $post['body'],
        ]);

        return view('templates/header', ['title' => 'Create a news item'])
            .view('news/success')
            .view('templates/footer');
    }
}