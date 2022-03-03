<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Str;

class Posts extends Component
{
    public $title, $body, $post_id, $post;
    
    public $isModalOpen = false;

    public function create()
    {
        $this->resetCreateForm();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        $this->title = '';
        $this->body  = '';
    }
    
    public function save()
    {
        $this->validate([
            'title' => 'required',
            'body'  => 'required',
        ]);

        Post::updateOrCreate(['id' => $this->post_id], [
            'user_id'   => auth()->user()->id,
            'title'     => $this->title,
            'slug'      => $this->title,
            'body'      => $this->body,
        ]);

        session()->flash('message', $this->post_id ? 'Data updated successfully.' : 'Data added successfully.');

        $this->closeModal();

        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $post           = Post::findOrFail($id);
        $this->post_id  = $id;
        $this->title    = $post->title;
        $this->body     = $post->body;
    
        $this->openModal();
    }
    
    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Data deleted successfully.');
    }

    public function render()
    {
        $posts = Post::latest()->get();
        return view('livewire.posts', compact('posts'));
    }
}