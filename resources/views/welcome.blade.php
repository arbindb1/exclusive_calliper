<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <style>
        .calliper-container {
            display: flex;
            background: none !important;
            padding-left: 250px;
            margin-top: 100px;
            margin-left: 200px;
            background-color: white; /* To ensure transparent background is handled properly */
        }

        .calliper-container .calliper_head {
            flex-shrink: 0;
        }

        .digits {
            display: flex;
            position: absolute;
            top: 230px;
            right: 307px;
        }

        .bead_image {
            position: absolute;
            top: 480px;
            left: -220px;
            width: 150px;
            height: 150px;
            object-fit: content;
        }

        .moving-parts {
            position: relative;
            right: 720px;
        }

        /* Download Button */
        #download-btn {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        form input[type="text"]{
            padding:10px;
            margin:10px;
            width:200px;
        }
        form input[type="submit"]{
            padding:10px;
            margin:10px;
            background-color: #28a745;
            color: #fff;
        }
        form input[type="file"]{
            padding:10px;
            margin:10px;
        }

        
    </style>
    
    <!-- Load html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

</head>

<body class="bg-[#FDFDFC] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

    <form action="{{ route('calliper.data')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" placeholder="Size" name="size">
        <input type="file" name="bead_image">
        <input type="submit" value="Submit" name="submit">
    </form>

    <!-- Calliper Container (Image to Capture) -->
    <div id="capture-area" class="calliper-container">
        <img class="calliper_head" src="{{ url('misc/certificate/nepa-rudraksha/calliper_head_irl.png') }}" alt="calliper head">

        <div class="moving-parts" style="right: {{ $finalRightPosition ?? 720 }}px !important;">
            <div class="digits">
                @if(isset($matchedUrls))
                @foreach($matchedUrls as $url)
                <img src="{{$url}}" alt="digit">
                @endforeach
                @endif
            </div>

            @if(isset($outputFilePath))
            <img src="{{ $outputFilePath }}" alt="" class="bead_image" style="left:{{ $beadMovement }}px; transform: scale({{ $beadScale }});">
            @endif

            <img class="calliper_tail" src="{{ url('misc/certificate/nepa-rudraksha/jam_irl.png') }}" alt="calliper head">
        </div>
    </div>

    <!-- Download Button -->
    <button id="download-btn">Download Image</button>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    document.getElementById('download-btn').addEventListener('click', function () {
        let element = document.querySelector('.calliper-container'); // Select the container

        html2canvas(element, {
            scale: window.devicePixelRatio, // Ensure high-quality image
            backgroundColor: 'rgba(0,0,0,0)', // Force transparent background
            useCORS: true, // Load external images properly
            allowTaint: true, // Allow cross-origin images
            logging: true // Debugging if needed
        }).then(canvas => {
            let ctx = canvas.getContext('2d');
            let imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
            
            // Ensure proper transparency
            for (let i = 0; i < imageData.data.length; i += 4) {
                if (imageData.data[i] === 255 && imageData.data[i + 1] === 255 && imageData.data[i + 2] === 255) {
                    imageData.data[i + 3] = 0; // Make white pixels transparent
                }
            }
            ctx.putImageData(imageData, 0, 0);

            let link = document.createElement('a');
            link.download = 'calliper-image.png'; 
            link.href = canvas.toDataURL("image/png"); 
            link.click();
        });
    });
</script>




</body>
</html>
