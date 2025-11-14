@component('mail::message')
# Task Completed

Your task **{{ $task->title }}** was marked as completed.

**Due date:** {{ $task->due_date ? $task->due_date->toFormattedDateString() : 'N/A' }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
