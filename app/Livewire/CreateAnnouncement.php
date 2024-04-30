<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use App\Models\Announcement;
use Livewire\WithFileUploads;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Mime\Part\File;

class CreateAnnouncement extends Component
{
    use WithFileUploads;
    public $temporary_images = [];
    public $images = [];
    public $title;
    public $description;
    public $price;
    public $category;
    public $announcement;


    protected $rules = [
        'title' => 'required',
        'description' => 'required',
        'price' => 'required',
        'category' => 'required',
        'temporary_images.*' => 'image',
        'images.*' => 'image',
    ];
    protected $messages = [
        'title.required' => 'Inserisci il titolo',
        'description.required' => 'Inserisci la descrizione',
        'price.required' => 'Inserisci il prezzo',
        'category.required' => 'Inserisci la categoria'
    ];

    public function updatedTemporaryImages()
    {
        if ($this->validate([
            'temporary_images.*' => 'image',
        ])) {
            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }
        }
    }

    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }

    public function save()
    {
        $this->validate();
        $this->announcement = Category::find($this->category)->announcements()->create($this->validate());
        if (count($this->images)) {
            foreach ($this->images as $image) {
                // $this->announcement->images()->create(['path' => $image->store('img', 'public')]);

                $newFileName= "announcements/{$this->announcement->id}";
                $newImage=$this->announcement->images()->create(['path' => $image->store($newFileName, 'public')]);

                RemoveFaces::withChain([
                   new ResizeImage($newImage->path, 450, 500),
                   new GoogleVisionSafeSearch ($newImage->id),
                   new GoogleVisionLabelImage ($newImage->id)

                ])->dispatch($newImage->id);

            }
        //    File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }
        Auth::user()->announcements()->save($this->announcement);
        session()->flash('message', 'Articolo inserito con successo, sarà pubblicato dopo la revisione');
        $this->cleanForm();
        return redirect(route('createAnnouncement'));
    }

    public function cleanForm()
    {
        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->category = '';
        // $this->image = '';
        $this->images = [];
        $this->temporary_images = [];
        // $this->form_id = rand();
    }
    public function updated($propertyName)

    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.create-announcement');
    }
}
