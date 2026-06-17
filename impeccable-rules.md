# Impeccable Design System - SIM Microteaching

Dokumen ini adalah "Otak UI/UX" yang akan memandu AI dan Developer dalam membangun antarmuka web SIM Microteaching agar selalu terlihat premium, modern, dan tidak terkesan murahan ("AI-generated look").
Project ini menggunakan **Tailwind CSS v4**.

## 1. Color System (Logo OKLCH Palette)
*   **Wajib** gunakan warna kustom dari logo yang sudah didaftarkan di `app.css`.
    *   **Primary (Hijau):** `bg-primary-500`, `text-primary-600` untuk elemen utama/sukses.
    *   **Gold (Kuning Emas):** `bg-gold-500`, `text-gold-600` untuk warning/highlight/aksen sekunder.
    *   **Accent (Biru):** `bg-accent-500`, `text-accent-600` untuk tombol CTA atau info.
*   **Text:** **HARAM** menggunakan hitam murni `#000000`. Gunakan warna `text-primary-900` untuk teks gelap.
*   **Surface:** Gunakan `bg-primary-50` atau `bg-slate-50` untuk layer background agar terlihat menyatu.

## 2. Spatial Design & Spacing
*   Gunakan *spacing scale* bawaan Tailwind (`p-4`, `m-8`, `gap-6`). Skala ini sudah mengikuti kelipatan 4px/8px dengan sempurna.
*   Jangan pernah menggunakan margin/padding *arbitrary* seperti `p-[13px]`.

## 3. Typography
*   Gunakan font *sans-serif* modern.
*   **Heading:** Gunakan `leading-tight` atau `leading-snug` dengan `font-semibold` atau `font-bold`.
*   **Body Text:** Gunakan `leading-relaxed` agar mudah dibaca.

## 4. Radii & Borders
*   Gunakan konsistensi dari Tailwind: `rounded-md` untuk tombol, `rounded-xl` atau `rounded-2xl` untuk Card utama.
*   Hindari border hitam tebal. Gunakan `border border-gray-200/50` atau border yang sangat tipis dan subtle.

## 5. Shadows & Depth
*   Hindari `shadow` standar. Gunakan `shadow-sm`, `shadow-md`, atau racik shadow berlapis (*multi-layered*) agar terlihat natural.
*   Gunakan efek *Glassmorphism* (misal: `bg-white/80 backdrop-blur-md`) pada header navigasi.

## 6. Micro-Interactions
*   Setiap tombol atau card yang bisa diklik **wajib** menggunakan transisi: `transition-all duration-200 ease-out`.
*   Berikan efek hover ringan: `hover:bg-gray-50 hover:shadow-md`.
*   Beri efek *scale* saat di-klik (contoh: `active:scale-95`).

---
**Instruksi untuk AI (Antigravity):**
Selalu ikuti pedoman kelas atas ini setiap kali diinstruksikan untuk mendesain komponen atau halaman baru menggunakan Tailwind CSS.
