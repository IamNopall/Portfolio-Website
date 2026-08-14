<template>
    <footer class="fixed bottom-0 left-0 right-0 z-40 pointer-events-none inverted-chrome">
        <div
            class="px-4 sm:px-8 pb-4 pt-3 sm:pb-6 sm:pt-4 flex justify-between w-full text-[9px] sm:text-[11px] tracking-[0.18em] font-sans chrome-font uppercase">
            <span></span>
            <span class="pointer-events-auto">
                {{ displayText }}
            </span>
        </div>
    </footer>
</template>

<script setup>
import { onMounted, onBeforeUnmount, ref } from 'vue';

const displayText = ref('LOCATING...');
const locationString = ref('LOCATING...');
let clockInterval;

// 🔹 fallback timezone (pasti ada)
const getTimezoneFallback = () => {
    return Intl.DateTimeFormat().resolvedOptions().timeZone.replace('_', ' ').split('/').pop();
    // .split('/').pop() mengubah "Asia/Jakarta" menjadi "Jakarta" agar lebih rapi
};

onMounted(async () => {
    // =========================
    // 0. CEK CACHE LOKASI (Agar lebih cepat)
    // =========================
    const cachedLocation = localStorage.getItem('user_location');
    if (cachedLocation) {
        locationString.value = cachedLocation;
    }

    if (!cachedLocation) {
        try {
            // =========================
            // 1. GET IP DATA (lat/lon)
            // =========================
            const ipRes = await fetch('https://ipwho.is/');
            const ipData = await ipRes.json();

            let finalLocation = '';

            if (ipData.success && ipData.latitude && ipData.longitude) {
                const { latitude, longitude } = ipData;

                try {
                    // =========================
                    // 2. REVERSE GEOCODING
                    // =========================
                    const geoRes = await fetch(
                        `https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`,
                        {
                            headers: {
                                // Nominatim sangat ketat soal User-Agent
                                'User-Agent': 'VuePortfolioApp/1.0 (contact@yourdomain.com)'
                            }
                        }
                    );

                    if (!geoRes.ok) throw new Error('Nominatim error');

                    const geoData = await geoRes.json();
                    const addr = geoData.address || {};

                    // 🔹 Ambil dari tingkat paling kecil/spesifik ke besar
                    const specificArea =
                        addr.neighbourhood ||
                        addr.quarter ||
                        addr.suburb ||
                        addr.city_district ||
                        addr.borough ||
                        addr.village;

                    const city =
                        addr.city ||
                        addr.town ||
                        addr.county ||
                        addr.municipality ||
                        ipData.city;

                    const region = addr.state || ipData.region;

                    // =========================
                    // 3. BUILD LOCATION STRING
                    // =========================
                    if (specificArea && city && specificArea !== city) {
                        finalLocation = `${specificArea}, ${city}`;
                    } else if (city && region) {
                        finalLocation = `${city}, ${region}`;
                    } else if (city) {
                        finalLocation = city;
                    }
                } catch (geoError) {
                    // fallback kalau reverse gagal (limit API dll)
                    if (ipData.city && ipData.region) {
                        finalLocation = `${ipData.city}, ${ipData.region}`;
                    } else if (ipData.city) {
                        finalLocation = ipData.city;
                    }
                }
            }

            // =========================
            // 4. FINAL FALLBACK & SAVE CACHE
            // =========================
            if (!finalLocation) {
                finalLocation = getTimezoneFallback();
            }

            const formattedLocation = finalLocation.toUpperCase();
            locationString.value = formattedLocation;

            // Simpan ke localStorage agar visit berikutnya instan
            localStorage.setItem('user_location', formattedLocation);

        } catch (err) {
            locationString.value = getTimezoneFallback().toUpperCase();
        }
    }

    // =========================
    // 5. CLOCK LOOP
    // =========================
    const updateClock = () => {
        const now = new Date();

        const h = String(now.getHours()).padStart(2, '0');
        const m = String(now.getMinutes()).padStart(2, '0');
        const s = String(now.getSeconds()).padStart(2, '0');

        displayText.value = `${locationString.value} ${h}:${m}:${s}`;
    };

    updateClock(); // Eksekusi langsung agar tidak nunggu 1 detik
    clockInterval = setInterval(updateClock, 1000);
});

onBeforeUnmount(() => {
    if (clockInterval) clearInterval(clockInterval);
});
</script>