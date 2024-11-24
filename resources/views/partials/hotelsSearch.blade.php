
                
<!-- Hotel Grid -->
@foreach ($hotels2 as $hotel)
    <div class="hotel-card">
        <img src="{{ asset('images/'.$hotel->photo_url) }}" alt="Hotel Image">
        <div class="hotel-info">
            <h4>{{ $hotel->hotelname }}</h4>
            <p>Location: {{ $hotel->location }}</p>
            <p>Rating: {{ $hotel->rating }} ⭐</p>
            <button class="details-button" onclick="location.href='#'">View Details</button>
        </div>
    </div>
@endforeach
                