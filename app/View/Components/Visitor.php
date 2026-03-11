<?php

namespace App\View\Components;

use App\Services\GoogleAnalyticsService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Visitor extends Component
{
    public $todayVisitors;
    public $yesterdayVisitors;
    public $last7DaysVisitors;
    /**
     * Create a new component instance.
     */
    public function __construct(GoogleAnalyticsService $analytics)
    {
        $this->todayVisitors = $analytics->getTodayVisitors();
        $this->yesterdayVisitors = $analytics->getYesterdayVisitors();
        $this->last7DaysVisitors = $analytics->getLast7DaysVisitors();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visitor');
    }
}
