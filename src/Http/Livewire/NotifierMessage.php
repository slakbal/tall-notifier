<?php

namespace Slakbal\TallNotifier\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;

class NotifierMessage extends Component
{
    /**
     * Message from attributes bag
     *
     * @var String
     */
    public $message;
    /**
     * Time in ms which message is shown
     * 0 for unlimited time
     * @var integer
     */
    public $duration;

    public $msgClass;
    public $progressClass;
    /**
     * Whether message is closable by click
     *
     * @var boolean
     */
    public $closable = true;
    /**
     * Mount lifecycle action
     *
     * @return void
     */
    public function mount()
    {
        $this->duration = $this->duration ?? config('tall-notifier.duration');
        $this->closable = $this->closable ?? config('tall-notifier.closable');
        $this->msgClass = $this->msgClass ?? config('tall-notifier.types.' . ($this->message['type'] ?? 'default') . '.msgClass', config('tall-notifier.types.default.msgClass'));
        $this->progressClass = $this->progressClass ?? config('tall-notifier.types.' . ($this->message['type'] ?? 'default') . '.progressClass', config('tall-notifier.types.default.progressClass'));
    }

    public function render()
    {
        $this->message = array_merge([
            'text' => '',
            'title' => '',
            'icon' => '',
            'type' => 'success',
            'duration' => $this->duration,
            'msgClass' =>  $this->msgClass,
            'progressClass' =>  $this->progressClass,
            'closable' => $this->closable,
        ], $this->message);
        return view('tall-notifier::livewire.notifier-message');
    }
}
