<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    public $title, $content, $post_id;
    public $isOpen = 0;
    public $itemsPerPage = 10;
    public $query = '';
    public $search = '';
    protected $updatesQueryString = ['search' => ['except' => '']];
    public function render(
    ) {
        $posts = Post::where("title", "like", "%{$this->query}%")->paginate($this->itemsPerPage);
        $posts = Post::latest()
            ->when($this->search, function ($query) {
                return $query->where('title', 'like', "%{$this->search}%");
            })
            ->paginate($this->itemsPerPage);
        return view('livewire.posts.show', compact('posts'));
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->content = '';
        $this->post_id = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Post::updateOrCreate(['id' => $this->post_id], [
            'title' => $this->title,
            'content' => $this->content
        ]);

        session()->flash(
            'message',
            $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->openModal();
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }

    public function search()
    {
        $this->resetPage();
    }
    public function updateItemsPerPage($value)
    {
        $this->itemsPerPage = $value;
        $this->resetPage();
    }

}