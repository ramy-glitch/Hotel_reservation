                <!-- Hotel Grid -->
                <div class="hotel-grid">
                    @foreach ($hotels as $hotel)
                        <div class="hotel-card">
                            <img src="{{ asset('images/'. $hotel->firstPhoto) }}" alt="Hotel Image">
                            <div class="hotel-info">
                                <h4>{{ $hotel->name }}</h4>
                                <p>Location: {{ $hotel->location }}</p>
                                <p>Rating: ⭐{{ $hotel->rating }}</p>
                                <button class="details-button" onclick="location.href='#'">View Details</button>
                            </div>
                        </div>
                    @endforeach
                </div>