@extends('layouts.app')

@section('content')
<div class="main-div">
    <div class="welcome-message-div">
        <h1>Mantras Collection</h1>
    </div>

    <div class="feature-box">
        <table style="width:100%; border-collapse: collapse;">
            <thead>
                <tr style="background:#1B4D3F; color:white;">
                    <th style="padding:8px;">Title</th>
                    <th>Author</th>
                    <th>Year</th>
                    <th>Book</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mantras as $mantra)
                <tr style="border-bottom:1px solid #ccc;">
                    <td style="padding:8px;">
                        <a href="{{ route('mantra-shloka-bhajan-content',['lang' => app()->getLocale(), 'id' => $mantra->id]) }}" style="color:#1B4D3F; font-weight:bold;">
                            {{ $mantra->title }}
                        </a>
                    </td>
                    <td>{{ $mantra->id}}</td>
                    <td>{{ $mantra->author }}</td>
                    <td>{{ $mantra->year }}</td>
                    <td>{{ $mantra->book }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
