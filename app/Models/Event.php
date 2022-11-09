<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $appends = ['type_name','name_limit', 'link_limit','month_day','year'];

    public function members(): HasManyThrough
    {
        return $this->hasManyThrough(Member::class, EventMember::class, 'event_id', 'id', 'id', 'member_id');
    }

    public function speakers()
    {
        return $this->hasMany(EventSpeaker::class);
    }

    public function getTypeNameAttribute()
    {
        if ($this->type == 'live-webinars') return 'Live webinars';
        if ($this->type == 'cad') return 'CAD recording techniques';
        if ($this->type == 'workshop') return 'On site workshop';
        return null;
    }

    public function getLinkLimitAttribute()
    {
        if ($this->link) return Str::limit($this->link, 20);
        return null;
    }
    public function getNameLimitAttribute()
    {
        if ($this->name) return Str::limit($this->name, 30);
        return null;
    }
    public function getMonthDayAttribute()
    {
        return Carbon::parse($this->event_date)->translatedFormat('M d');
    }

    public function getYearAttribute()
    {
        return Carbon::parse($this->event_date)->translatedFormat('Y');
    }
}
