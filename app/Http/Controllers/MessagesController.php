<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\Messages\StoreRequest as MessageStoreRequest;
use App\Http\Requests\Complaint\StoreRequest as ComplainStoreRequest;
use App\Http\Requests\Messages\UpdateRequest;
use App\Http\Resources\Messages\MessagesResources;
use App\Models\Messages;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $ids = Str::of($data['content'])->matchAll('/@[\d]+/')->unique()->transform(
            function ($id) {
                $id = Str::of($id)->replace('@', '')->value();
                return $id;
            }
        );

        $imageIds = Str::of($data['content'])->matchAll('/data-img_id="(\d+)"/')->unique()->transform(
            function ($id) {
                $id = Str::of($id)->replace('/data-img_id=/', '')->value();
                return $id;
            }
        );

        dd($imageIds);

        $message = Messages::create($data);

        Image::whereIn('id', $imageIds)->update([
            'message_id' => $message->id
        ]);

        Image::where('user_id', auth()->id())
            ->whereNull('message_id')
            ->get()
            ->pluck('path')
            ->each(
                function ($path) {
                    Storage::disk('public')->delete($path);
            });

        $message->answeredUsers()->attach($ids);
        $message->loadCount('likedUsers');

        return MessagesResources::make($message)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Messages $messages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Messages $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Messages $messages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Messages $messages)
    {
        //
    }

    public function toggleLikes(Messages $message)
    {
        $message->likedUsers()->toggle(auth()->id());
    }

    public function storeComplains(ComplainStoreRequest $request, Messages $messages)
    {
        $data = $request->validated();

        $messages->complaintdUsers()->attach(auth()->user(), $data);

        return MessagesResources::make($messages)->resolve();
    }
}
