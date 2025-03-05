<?php

namespace App\Livewire;

use App\Models\GalleryImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\WireUiActions;

class Gallery extends Component
{
    use WithFileUploads, WireUiActions;

    // Admin upload properties
    public $name = '';
    public $image = null;
    
    // Image view properties
    public $selectedImage = null;
    public $showImageModal = false;
    
    // Admin check
    public $isAdmin = false;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'image' => 'required|image|max:5120', // 5MB max
    ];

    public function mount()
    {
        // Check if user is admin
        $this->isAdmin = Auth::check() && Auth::user()->is_admin == 1;
    }

    public function render()
    {
        $images = GalleryImage::orderBy('created_at', 'desc')->get();
        return view('livewire.gallery', [
            'images' => $images
        ])->extends('layouts.app');
    }

    public function save()
    {
        $this->validate();

        // Store the image
        $path = $this->image->store('gallery', 'public');
        
        // Create gallery image record
        GalleryImage::create([
            'name' => $this->name,
            'image_path' => $path,
            'user_id' => Auth::id(),
        ]);

        // Reset form
        $this->reset(['name', 'image']);
        
        // Show success message
        $this->notification()->success(
            'Success',
            'Image uploaded successfully!'
        );
    }

    public function viewImage($imageId)
    {
        $this->selectedImage = GalleryImage::find($imageId);
        $this->showImageModal = true;
    }

    public function closeImageModal()
    {
        $this->showImageModal = false;
        $this->selectedImage = null;
    }

    public function confirmDelete($imageId)
    {
        $this->dialog()->confirm([
            'title' => 'Delete Image',
            'description' => 'Are you sure you want to delete this image? This action cannot be undone.',
            'icon' => 'warning',
            'accept' => [
                'label' => 'Delete',
                'method' => 'deleteImage',
                'params' => $imageId,
            ],
            'reject' => [
                'label' => 'Cancel',
            ],
        ]);
    }

    public function deleteImage($imageId)
    {
        $image = GalleryImage::find($imageId);
        
        if ($image) {
            // Delete the file from storage
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            
            // Delete the record
            $image->delete();
            
            // Show success message
            $this->notification()->success(
                'Success',
                'Image deleted successfully!'
            );
        }
    }
}
