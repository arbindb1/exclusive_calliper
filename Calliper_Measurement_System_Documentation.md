# Calliper Measurement System Documentation

## Overview
The Calliper Measurement System is a web-based tool for accurately measuring and displaying bead dimensions using a digital calliper. The system allows users to input bead sizes, upload images, and view measurements in real-time.

## Features
- Upload and process bead images
- Display calliper measurement with bead placement
- Trim whitespace around images for better visualization
- Remove image backgrounds using `rembg`
- Download measurement images with annotations

## Technologies Used
- **Backend:** Laravel (PHP)
- **Frontend:** HTML, CSS, JavaScript
- **Image Processing:** Python (`rembg`, `ImageMagick`)

## Dependencies
### Laravel Packages:
- `Laravel Framework` (v12.2.0)
- `Livewire` (for interactive components)
- `Intervention Image` (for image processing)
- `File System` (for managing storage)

### Python Packages:
- `rembg` (Background removal)
- `Pillow` (Image manipulation)
- `ImageMagick` (for trimming images)

## Installation & Setup
### 1. Install Laravel Dependencies
```sh
composer install
php artisan migrate
```

### 2. Install Python Dependencies
```sh
pip install rembg pillow
```

### 3. Set Up ImageMagick (for trimming)
- Windows: Download from [ImageMagick website](https://imagemagick.org)
- Linux:
```sh
sudo apt install imagemagick
```

## System Architecture
```mermaid
graph TD;
    User -->|Uploads Image| Laravel Backend;
    Laravel Backend -->|Saves Image| Storage;
    Laravel Backend -->|Calls Python Script| Python Engine;
    Python Engine -->|Processes Image| Storage;
    Storage -->|Returns Processed Image| Frontend;
    Frontend -->|Displays Measurement| User;
```

## API Routes
| Method | Route | Description |
|--------|-------|-------------|
| POST | `/calliper/data` | Upload bead image and process measurement |
| GET | `/download/image` | Download the processed image |

## Code Structure
```
/app
  /Http/Controllers
    CalliperController.php
/public
  /misc/certificate/nepa-rudraksha/beads
/resources/views
  welcome.blade.php
```

## CSS Improvements
- Used `flexbox` for layout structure
- Improved spacing and positioning
- Added better scaling for responsiveness

## Conclusion
This system allows accurate bead measurement using a digital calliper interface. With real-time image processing and enhanced visualization, it provides an efficient solution for Rudraksha bead measurements.
