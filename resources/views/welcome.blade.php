<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <style>
    .calliper-container {
        display: flex;
    }

    .calliper-container .calliper_head {
        flex-shrink: 0;
    }


    .digits {
        display: flex;
        position: absolute;
        top:230px;
        right:307px;
    }
    .bead_image{
        position:absolute;
        top:250px;
        left:-220px;
        width:150px;
        height:150px;
        object-fit:content;
    }
    .moving-parts{
        position: relative;
        right: 720px;
    }
    </style>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>

<body class="bg-[#FDFDFC] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <form action="{{ route('calliper.data')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" placeholder="Size" name="size">
        <input type="file" name="bead_image">
        <input type="submit" value="Submit" name="submit">
    </form>
    <div class="calliper-container">
        <img class="calliper_head" src="{{ url('misc/certificate/nepa-rudraksha/calliper_head_irl.png') }}" alt="calliper head">
        <!-- <?php
        
if(!isset($finalRightPosition)){
    $finalRightPosition = 720;
}
        ?> -->
        <div class="moving-parts" style="right: {{ $finalRightPosition}}px !important;">
            <div class="digits">
                @if(isset($matchedUrls))
                @foreach($matchedUrls as $url)
                <img src="{{$url}}" alt="digit">
                @endforeach
                @endif
            </div>
            @if(isset($imagePath))
            <img src="{{ $imagePath }}" alt="" class="bead_image" style="left:{{ $beadMovement }}px; transform: scale({{ $beadScale }});">
            @endif
            <img class="calliper_tail" src="{{ url('misc/certificate/nepa-rudraksha/jam_irl.png') }}" alt="calliper head">
        </div>
    </div>
</body>

</html>