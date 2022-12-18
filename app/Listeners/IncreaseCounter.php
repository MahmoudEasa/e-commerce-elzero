<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use App\Models\User;
use App\Models\viewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        $this->updateView($event);
    }

    function createAndIncrementViewer($video, $user_id) {
        viewer::create(['user'=>$user_id, 'video'=> $video->id]);
        $video->viewers++;
        $video->save();
    }

    function updateView($event)
    {
        $user_id = Auth::user()->id;
        $video = $event->video;
        // $viewer_id = viewer::get()->where('user', $user_id);
        $viewer_id = viewer::get()->where('user', $user_id)->where('video', $video->id);

        if(count($event->viewer) == 0){
            $this->createAndIncrementViewer($video, $user_id);
        }else {
            if(count($viewer_id) == 0) {
                $this->createAndIncrementViewer($video, $user_id);
            }
        }

    }
}