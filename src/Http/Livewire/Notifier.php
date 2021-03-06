<?php

namespace Slakbal\TallNotifier\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;

class Notifier extends Component
{
    public $messages;

    /**
     * Message from attributes bag
     *
     * @var String
     */
    public $message;
    /**
     * Duration of one message is shown
     *
     * @var integer
     */
    public $duration;
    public $listeners = [
        'message' => 'addMsg',
        'render' => 'render'
    ];
    /**
     * Catch session messages in the constructor
     *
     * @return void
     */
    public function mount()
    {
        $this->messages = collect($this->messages);
        $this->message && $this->addMsg($this->message);
        $this->reset('message');
        if ($msg = session('notifier')) {
            $this->addMsg($msg);
        }
        $this->duration = $this->duration ?? config('tall-notifier.duration');
    }
    /**
     * Add message to messages bag.
     *
     * @param mixed $options
     * @return void
     */
    public function addMsg($message)
    {
        if (!is_array($message) && $json = json_decode($message)) {
            $message = $json;
        } elseif (is_string($message)) {
            $message = ['text' => $message];
        }
        $message = array_merge([
            'text' => '',
            'title' => '',
            'icon' => '',
            'type' => 'success',
        ], $message);
        $this->messages->push($message);
    }

    public function render()
    {
        return view('tall-notifier::livewire.notifier');
    }
}
