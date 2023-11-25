<?php

namespace App\Listeners;

use App\Events\videoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class Increasecounter
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {



    }

    /**
     * Handle the event.
     */
    public function handle(videoViewer $event): void
    {

        if (!session()->has('videoIsVisited')) {
            $this->updateViewr($event->video);
        }

    }

    function  updateViewr($video){



        $video->viewers = $video->viewers + 1;
        $video->save();
        session()->put('videoIsVisited', $video->id);

    }

}
