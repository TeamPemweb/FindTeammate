@props([
    'title',
    'caption'
])

<div {{ $attributes -> merge(['class'=>'flex flex-col text-base font-normal gap-4'])}}>
    <x-project.title>{{ $title }}</x-project.title>
    <x-project.caption>{{ $caption }}</x-project.caption>
</div>