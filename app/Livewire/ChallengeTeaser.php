<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Challenge;
use Livewire\Attributes\Url;

class ChallengeTeaser extends Component
{
    use WithFileUploads;

    public $title, $body, $image;
    public $public = true;
    #[Url]
    public $filter = 'public';

    protected $rules = [
        'title' => 'required|string|max:255',
        'body' => 'required',
        'image' => 'nullable|image|max:2048',
    ];

    public function mount()
    {
        $this->filter = Auth::check() ? 'own' : 'public';
    }

    public function submit()
    {
        $this->validate();
        
        $imagePath = $this->image ? $this->image->store('images', 'public') : null;

        $challenge = Challenge::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'body' => $this->body,
            'image_path' => $imagePath,
            'public' => $this->public,
        ]);

        $this->reset(['title', 'body', 'image']);
        session()->flash('success', 'Erfolgreich erstellt!');
    }

    public function getChallengesProperty()
    {
        $userId = Auth::id();

        return \App\Models\Challenge::query()
            ->when($this->filter === 'own' && $userId, fn($q) => $q->where('user_id', $userId))
            ->when($this->filter === 'public' || (!$userId && $this->filter === 'all'), fn($q) => $q->where('public', true))
            ->when($this->filter === 'all' && $userId, function($q) use ($userId) {
            $q->where(function($sub) use ($userId) {
                $sub->where('public', true)
                    ->orWhere('user_id', $userId);
            });
        })
        ->latest()
        ->get();
    }

    public function render()
    {
        return view('livewire.challenge-teaser', ['challenges' => $this->challenges,]);
    }
}
