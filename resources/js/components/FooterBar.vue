<template>
    <footer class="fixed bottom-0 left-0 right-0 z-40 pointer-events-none">
        <div
            class="inverted-chrome px-8 pb-6 pt-4 flex justify-between w-full text-[11px] tracking-[0.18em] font-sans uppercase"
        >
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
    return Intl.DateTimeFormat().resolvedOptions().timeZone.replace('_', ' ');
};

onMounted(async () => {
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
                            'User-Agent': 'portfolio-app'
                        }
                    }
                );

                const geoData = await geoRes.json();
                const addr = geoData.address || {};

                // 🔹 ambil paling spesifik yang tersedia
                const district =
                    addr.suburb ||
                    addr.city_district ||
                    addr.village ||
                    addr.town;

                const city =
                    addr.city ||
                    addr.town ||
                    addr.county ||
                    ipData.city;

                const region = addr.state || ipData.region;

                // =========================
                // 3. BUILD LOCATION STRING
                // =========================
                if (district && city) {
                    finalLocation = `${district}, ${city}`;
                } else if (city && region) {
                    finalLocation = `${city}, ${region}`;
                } else if (city) {
                    finalLocation = city;
                }
            } catch (geoError) {
                // fallback kalau reverse gagal
                if (ipData.city && ipData.region) {
                    finalLocation = `${ipData.city}, ${ipData.region}`;
                } else if (ipData.city) {
                    finalLocation = ipData.city;
                }
            }
        }

        // =========================
        // 4. FINAL FALLBACK
        // =========================
        if (!finalLocation) {
            finalLocation = getTimezoneFallback();
        }

        locationString.value = finalLocation.toUpperCase();
    } catch (err) {
        locationString.value = getTimezoneFallback().toUpperCase();
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

    updateClock();
    clockInterval = setInterval(updateClock, 1000);
});

onBeforeUnmount(() => {
    if (clockInterval) clearInterval(clockInterval);
});
</script>
