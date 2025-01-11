<style>
    .card {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #fff;
        border-radius: 12px;
        padding: 20px; /* Adjust padding to fit smaller width */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        width: 220px; /* Adjust width */
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .card-image {
        width: 100%;
        border-radius: 8px;
        margin-bottom: 15px; /* Adjust margin for spacing */
        object-fit: cover;
    }

    .card-content {
        width: 100%; /* Ensure content spans full card width */
        text-align: left; /* Align text to the left */
    }

    .card-badge {
        font-size: 12px; /* Adjust font size */
        color: #f26724;
        font-weight: bold;
        margin-bottom: 10px;
        display: block; /* Ensure badge respects container width */
    }

    .card-title {
        font-size: 18px; /* Adjust font size */
        font-weight: 600;
        color: #000;
        margin: 8px 0;
        word-wrap: break-word; /* Break long words if needed */
    }

    .card-description {
        font-size: 14px; /* Adjust font size */
        color: #666;
        margin: 10px 0; /* Adjust margin */
        word-wrap: break-word; 
    }

    .card-price {
        font-size: 16px; /* Adjust font size */
        font-weight: 600;
        color: #000;
        margin-top: 10px;
    }
</style>

<div class="card">
    <img src="{{ $image }}" alt="{{ $title }}" class="card-image">
    <div class="card-content">
        <span class="card-badge">NEW</span>
        <h3 class="card-title">{{ $title }}</h3>
        <p class="card-description">{{ $description }}</p>
        <p class="card-price">{{ $price }}</p>
    </div>
</div>
