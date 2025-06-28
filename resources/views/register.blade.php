<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
        <form id="registration-form" method="POST" action="/register-user" class="w-full space-y-4">
            @csrf
    
            <!-- County -->
            <div>
                <label for="county" class="block mb-1 font-semibold">County</label>
                <select id="county" name="county" class="w-full p-2 border rounded">
                    <option value="">Select County</option>
                    <!-- Populate from backend or blade loop -->
                    @foreach($counties as $county)
                        <option value="{{ $county->county_name }}">{{ $county->county_name }}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- Constituency -->
            <div>
                <label for="constituency" class="block mb-1 font-semibold">Constituency</label>
                <select id="constituency" name="constituency" class="w-full p-2 border rounded" disabled>
                    <option value="">Select Constituency</option>
                </select>
            </div>
    
            <!-- Ward -->
            <div>
                <label for="ward" class="block mb-1 font-semibold">Ward</label>
                <select id="ward" name="ward" class="w-full p-2 border rounded" disabled>
                    <option value="">Select Ward</option>
                </select>
            </div>
            <!-- Polling Station -->
            <div>
                <label for="polling_station" class="block mb-1 font-semibold">Polling Station</label>
                <select id="polling_station" name="polling_station" class="w-full p-2 border rounded" disabled>
                    <option value="">Select Polling Station</option>
                </select>
            </div>
    
            <!-- Submit -->
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">
                Register
            </button>
        </form>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const countySelect = document.getElementById("county");
            const constituencySelect = document.getElementById("constituency");
            const wardSelect = document.getElementById("ward");
            const pollingStationSelect = document.getElementById("polling_station");
        
            countySelect.addEventListener("change", function () {
                const county = this.value;
        
                constituencySelect.innerHTML = '<option value="">Select Constituency</option>';
                constituencySelect.disabled = true;
                wardSelect.innerHTML = '<option value="">Select Ward</option>';
                wardSelect.disabled = true;
                pollingStationSelect.innerHTML = '<option value="">Select Polling Station</option>';
                pollingStationSelect.disabled = true;
        
                if (county) {
                    fetch(`/api/constituencies?county=${encodeURIComponent(county)}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(item => {
                                const option = document.createElement("option");
                                option.value = item.constituency_name;
                                option.textContent = item.constituency_name;
                                constituencySelect.appendChild(option);
                            });
                            constituencySelect.disabled = false;
                        })
                        .catch(err => console.error("Error fetching constituencies:", err));
                }
            });
        
            constituencySelect.addEventListener("change", function () {
                const constituency = this.value;
        
                wardSelect.innerHTML = '<option value="">Select Ward</option>';
                wardSelect.disabled = true;
                pollingStationSelect.innerHTML = '<option value="">Select Polling Station</option>';
                pollingStationSelect.disabled = true;
        
                if (constituency) {
                    fetch(`/api/wards?constituency=${encodeURIComponent(constituency)}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(item => {
                                const option = document.createElement("option");
                                option.value = item.ward_name;
                                option.textContent = item.ward_name;
                                wardSelect.appendChild(option);
                            });
                            wardSelect.disabled = false;
                        })
                        .catch(err => console.error("Error fetching wards:", err));
                }
            });
        
            wardSelect.addEventListener("change", function () {
                const ward = this.value;
        
                pollingStationSelect.innerHTML = '<option value="">Select Polling Station</option>';
                pollingStationSelect.disabled = true;
        
                if (ward) {
                    fetch(`/api/polling-stations?ward=${encodeURIComponent(ward)}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(item => {
                                const option = document.createElement("option");
                                option.value = item.polling_station_name;
                                option.textContent = item.polling_station_name;
                                pollingStationSelect.appendChild(option);
                            });
                            pollingStationSelect.disabled = false;
                        })
                        .catch(err => console.error("Error fetching polling stations:", err));
                }
            });
        });
    </script>
</body>
</html>