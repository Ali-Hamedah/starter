<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        if(!session() -> has('VideoIsVisited')){
           $this->updateViewer($event->video);
        }else
        return false;

    }

    public function updateViewer($video)
    {
        $video->viewers = $video->viewers + 1;
        $video->save();
        session()->put('VideoIsVisited', $video -> id );
    }
}
