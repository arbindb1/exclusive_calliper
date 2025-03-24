<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <style>
        body{
            padding:0;
            margin:0;
        }
        .calliper-container {
            display: flex;
            background: none !important;
            padding-left: 250px;
            margin-top: 100px;
            margin-left: 100px;
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
            margin-left:700px;
        margin-top: 100px;
        padding: 12px 20px;
        /* background-color: #007bff; */
        background: linear-gradient(90deg, #dbad62 0%, #e6c569 0.01%, #ca8401 100%);

        color: white;
        border: none;
        border-radius: 6px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
    }

    #download-btn:hover {
        background-color: #0056b3;
        transform: scale(1.02);
    }

    #download-btn:active {
        transform: scale(0.98);
    }
        /* form input[type="text"]{
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
        } */
        .form-wrapper {
            margin-left:500px;
        margin-top: 40px;
        background: #ffffff;
        padding: 25px 40px;
        border-radius: 10px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-wrapper h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .form-wrapper input[type="text"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 16px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        transition: border 0.3s;
    }

    .form-wrapper input[type="text"]:focus {
        outline: none;
        border-color: #007bff;
    }

    .custom-file-upload {
        display: block;
        width: 100%;
        padding: 12px;
        margin-bottom: 16px;
        border: 2px dashed #aaa;
        border-radius: 6px;
        text-align: center;
        color: #555;
        background-color: #f9f9f9;
        cursor: pointer;
        transition: border-color 0.3s ease, background-color 0.3s ease;
    }

    .custom-file-upload:hover {
        background-color: #f0f0f0;
        border-color: #007bff;
    }

    .form-wrapper input[type="file"] {
        display: none;
    }

    .form-wrapper input[type="submit"] {
        width: 100%;
        padding: 12px;
        /* background-color: #007bff; */
        background: linear-gradient(90deg, #dbad62 0%, #e6c569 0.01%, #ca8401 100%);

        border: none;
        color: white;
        font-weight: 600;
        font-size: 15px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .form-wrapper input[type="submit"]:hover {
        background-color: #0056b3;
    }

    #file-name {
        font-size: 13px;
        color: #333;
        margin-bottom: 10px;
        text-align: center;
        display: none;
    }
    .navbar {
    display: flex;
    align-items: center;
    padding: 15px 30px;
    background-color: #1a1a1a;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    color: white;
}

.navbar-logo-title {
    display: flex;
    align-items: center;
    gap: 15px;
}

.logo {
    width: 40px;
    height: 40px;
}

.navbar {
    display: flex;
    align-items: center;
    background-color: #1a202c; /* Dark theme */
    padding: 10px 20px;
    color: white;
}

.logo-title {
    display: flex;
    align-items: center;
}
.logo-title a{
    text-decoration: none;
}
.logo {
    border:solid 1px #e6c569;
    width: 50px;
    height: 50px;
    border-radius: 50%; /* Makes it circular */
    margin-right: 15px;
    object-fit: cover;
    border: 2px solid white;
}

.navbar h1 {
    font-size: 24px;
    font-weight: 600;
    margin: 0;
}

.navbar-title{
    background: linear-gradient(90deg, #dbad62 0%, #e6c569 0.01%, #ca8401 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;

}
    </style>
    
    <!-- Load html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

</head>

<body class="bg-[#FDFDFC] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
<nav class="navbar">
    <div class="logo-title">

        <img src="{{ asset('logo/exclusive-calliper-logo.png') }}" alt="Exclusive Calliper Logo" class="logo">
        <a href="{{ route('welcome') }}"> <h1 class="navbar-title">Exclusive Calliper</h1>
        </a>
    </div>
</nav>


<div class="form-wrapper">
    <h2>Upload Bead Image</h2>
    <form action="{{ route('calliper.data')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="size" placeholder="Enter Bead Size" required>

        <label class="custom-file-upload" for="bead_image">📁 Click to upload bead image</label>
        <input type="file" id="bead_image" name="bead_image" required onchange="showFileName(this)">
        <div id="file-name"></div>

        <input type="submit" value="Submit" name="submit">
    </form>
</div>

    <!-- Calliper Container (Image to Capture) -->
    @if(isset($beadMovement) && isset($beadScale)) 
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
    @endif

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
    function showFileName(input) {
        const fileNameDiv = document.getElementById('file-name');
        if (input.files.length > 0) {
            fileNameDiv.style.display = 'block';
            fileNameDiv.innerText = `Selected: ${input.files[0].name}`;
        } else {
            fileNameDiv.style.display = 'none';
        }
    }
</script>




</body>
</html>
