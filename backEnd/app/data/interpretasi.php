<?php 

return [

    // 1. Berat Badan menurut Umur (BB/U; WAZ)
    "berat" => [
        [
            "status" => "Berat badan sangat kurang (severely underweight)",
            "color" => "#FF6E76",
            "range_z" => "Z < -3",
            "interpretasi" => "BB menurut umur jauh di bawah standar untuk usianya.",
            "saran" => [
                "Rujuk segera ke faskes; tata laksana gizi buruk sesuai pedoman.",
                "Konseling gizi intensif; evaluasi penyakit infeksi/kronis.",
                "Pemantauan berat badan mingguan hingga stabil."
            ]
        ],
        [
            "status" => "Berat badan kurang (underweight)",
            "color" => "#FDDD60",
            "range_z" => "-3 ≤ Z < -2",
            "interpretasi" => "BB menurut umur lebih rendah dari standar.",
            "saran" => [
                "Perbaiki asupan energi-protein (MPASI adekuat/ASI sesuai usia).",
                "Konseling pola makan/jadwal makan; cek penyakit penyerta.",
                "Kontrol ulang 2–4 minggu dan pantau tren kenaikan BB."
            ]
        ],
        [
            "status" => "Berat badan normal",
            "color" => "#7CFFB2",
            "range_z" => "-2 ≤ Z ≤ +1",
            "interpretasi" => "BB menurut umur sesuai standar.",
            "saran" => [
                "Pertahankan pola makan seimbang dan praktik pemberian makan responsif.",
                "Pantau pertumbuhan berkala (1–3 bulan)."
            ]
        ],
        [
            "status" => "Risiko berat badan lebih",
            "color" => "#FDDD60",
            "range_z" => "Z > +1",
            "interpretasi" => "BB menurut umur di atas rerata untuk usia, berisiko berlebih.",
            "saran" => [
                "Tinjau kembali porsi, frekuensi camilan manis/berlemak.",
                "Dorong aktivitas fisik sesuai usia; kurangi screen time.",
                "Pantau BB 1 bulan; bila tren naik cepat, evaluasi dengan BB/TB & IMT/U."
            ]
        ]
    ],

    // 2. Tinggi/Panjang Badan menurut Umur (TB/U atau PB/U; HAZ)
    "tinggi" => [
        [
            "status" => "Sangat pendek (severe stunting)",
            "color" => "#FF6E76",
            "range_z" => "Z < -3",
            "interpretasi" => "Panjang/TB menurut umur sangat rendah (stunting berat).",
            "saran" => [
                "Rujuk evaluasi komprehensif (riwayat infeksi, asupan, stimulasi).",
                "Intervensi gizi spesifik & sensitif; pantau pertumbuhan ketat (4 minggu)."
            ]
        ],
        [
            "status" => "Pendek (stunting)",
            "color" => "#FDDD60",
            "range_z" => "-3 ≤ Z < -2",
            "interpretasi" => "Panjang/TB menurut umur di bawah standar (stunting).",
            "saran" => [
                "Konseling gizi dan praktik pengasuhan/stimulasi dini.",
                "Tindak infeksi berulang; pantau TB tiap 1–3 bulan."
            ]
        ],
        [
            "status" => "Normal",
            "color" => "#FDDD60",
            "range_z" => "-2 ≤ Z ≤ +3",
            "interpretasi" => "Panjang/TB menurut umur sesuai standar.",
            "saran" => [
                "Pertahankan pola makan dan stimulasi tumbuh kembang.",
                "Pantau rutin sesuai jadwal posyandu/faskes."
            ]
        ],
        [
            "status" => "Tinggi",
            "color" => "#FDDD60",
            "range_z" => "Z > +3",
            "interpretasi" => "Lebih tinggi dari rata-rata usianya.",
            "saran" => [
                "Umumnya tidak bermasalah; pantau konsistensi pertumbuhan.",
                "Rujuk bila ada gejala/endokrin atau laju pertumbuhan tak wajar."
            ]
        ]
    ],

    // 3. Berat menurut Tinggi/Panjang (BB/TB atau BB/PB; WHZ)
    "berat/tinggi" => [
        [
            "status" => "Gizi buruk (severe wasting)",
            "color" => "#FF6E76",
            "range_z" => "Z < -3",
            "interpretasi" => "Berat terhadap tinggi/panjang sangat rendah.",
            "saran" => [
                "Rujuk segera; tata laksana gizi buruk akut.",
                "Rehidrasi/terapi infeksi sesuai indikasi; pemantauan BB mingguan."
            ]
        ],
        [
            "status" => "Gizi kurang (wasting)",
            "color" => "#FDDD60",
            "range_z" => "-3 ≤ Z < -2",
            "interpretasi" => "Berat terhadap tinggi/panjang rendah.",
            "saran" => [
                "Konseling peningkatan densitas energi-protein; PMT sesuai program.",
                "Kontrol 2–4 minggu; bila tidak membaik, evaluasi lebih lanjut."
            ]
        ],
        [
            "status" => "Gizi baik (normal)",
            "color" => "#7CFFB2",
            "range_z" => "-2 ≤ Z ≤ +1",
            "interpretasi" => "Proporsi berat terhadap tinggi/panjang ideal.",
            "saran" => [
                "Pertahankan pola makan seimbang dan aktivitas fisik harian.",
                "Pantau tren tiap 1–3 bulan."
            ]
        ],
        [
            "status" => "Berisiko gizi lebih",
            "color" => "#FDDD60",
            "range_z" => "+1 < Z ≤ +2",
            "interpretasi" => "Mulai ada kecenderungan berat berlebih untuk tinggi.",
            "saran" => [
                "Atur porsi; batasi minuman manis/ultra-proses.",
                "Perbanyak permainan aktif; tindak lanjuti 1 bulan."
            ]
        ],
        [
            "status" => "Gizi lebih (overweight)",
            "color" => "#FF6E76",
            "range_z" => "+2 < Z ≤ +3",
            "interpretasi" => "Berat berlebih terhadap tinggi/panjang.",
            "saran" => [
                "Rencana makan seimbang sesuai usia; kurangi energi kosong.",
                "Pantau 2–4 minggu; konseling gizi bila tren berlanjut."
            ]
        ],
        [
            "status" => "Obesitas (obese)",
            "color" => "#FF6E76",
            "range_z" => "Z > +3",
            "interpretasi" => "Berat sangat berlebih terhadap tinggi/panjang.",
            "saran" => [
                "Rujuk penilaian komprehensif; manajemen gizi & aktivitas.",
                "Screening komorbid sesuai usia/indikasi; follow-up ketat."
            ]
        ]
    ],

    // 4. IMT menurut Umur (IMT/U; BAZ)
    "imt" => [
        [
            "status" => "Gizi buruk (severely thinness)",
            "color" => "#FF6E76",
            "range_z" => "Z < -3",
            "interpretasi" => "IMT menurut umur sangat rendah.",
            "saran" => [
                "Rujuk; intervensi gizi intensif dan penanganan infeksi.",
                "Pemantauan ketat; target kenaikan bertahap."
            ]
        ],
        [
            "status" => "Gizi kurang (thinness)",
            "color" => "#FF6E76",
            "range_z" => "-3 ≤ Z < -2",
            "interpretasi" => "IMT menurut umur rendah.",
            "saran" => [
                "Tingkatkan energi-protein, variasikan sumber pangan.",
                "Kontrol 2–4 minggu; evaluasi penyebab dasar bila stagnan."
            ]
        ],
        [
            "status" => "Gizi baik (normal)",
            "color" => "#7CFFB2",
            "range_z" => "-2 ≤ Z ≤ +1",
            "interpretasi" => "IMT menurut umur dalam batas normal.",
            "saran" => [
                "Pertahankan pola makan sehat, tidur cukup, aktivitas sesuai usia.",
                "Pantau berkala 1–3 bulan."
            ]
        ],
        [
            "status" => "Berisiko gizi lebih",
            "color" => "#FDDD60",
            "range_z" => "+1 < Z ≤ +2",
            "interpretasi" => "IMT mulai meningkat menuju berlebih.",
            "saran" => [
                "Review porsi & camilan; lebihkan sayur/buah & air putih.",
                "Aktivitas fisik harian; kontrol 1 bulan."
            ]
        ],
        [
            "status" => "Gizi lebih (overweight)",
            "color" => "#7CFFB2",
            "range_z" => "+2 < Z ≤ +3",
            "interpretasi" => "IMT menurut umur berlebih.",
            "saran" => [
                "Konseling gizi personal; kurangi gula tambahan & gorengan.",
                "Pantau 2–4 minggu; intervensi keluarga berbasis kebiasaan."
            ]
        ],
        [
            "status" => "Obesitas (obese)",
            "color" => "#7CFFB2",
            "range_z" => "Z > +3",
            "interpretasi" => "IMT menurut umur sangat berlebih.",
            "saran" => [
                "Rujuk untuk manajemen obesitas anak; skrining komorbid.",
                "Rencana aktivitas bertahap; pendampingan keluarga; follow-up ketat."
            ]
        ]
    ],

    // 5. Lingkar Kepala menurut Umur (LK/U; HCZ)
    "lingkarKepala" => [
        [
            "status" => "Sangat kecil (severe microcephaly)",
            "color" => "#FF6E76",
            "range_z" => "Z < -3",
            "interpretasi" => "Lingkar kepala anak sangat kecil untuk usianya.",
            "saran" => [
                "Segera rujuk ke fasilitas kesehatan untuk pemeriksaan neurologis.",
                "Evaluasi riwayat kehamilan, persalinan, dan infeksi.",
                "Pantau perkembangan motorik dan kognitif secara ketat."
            ]
        ],
        [
            "status" => "Kecil (microcephaly)",
            "color" => "#FF6E76",
            "range_z" => "-3 ≤ Z < -2",
            "interpretasi" => "Lingkar kepala anak lebih kecil dari standar.",
            "saran" => [
                "Konsultasikan ke dokter anak/neurologi untuk pemeriksaan lanjutan.",
                "Pantau pertumbuhan lingkar kepala tiap bulan.",
                "Lakukan stimulasi dini perkembangan sesuai usia."
            ]
        ],
        [
            "status" => "Normal",
            "color" => "#7CFFB2",
            "range_z" => "-2 ≤ Z ≤ +2",
            "interpretasi" => "Lingkar kepala anak dalam batas normal.",
            "saran" => [
                "Pertahankan pola asuh, gizi, dan stimulasi sesuai usia.",
                "Pantau LK secara berkala di posyandu/faskes."
            ]
        ],
        [
            "status" => "Besar (macrocephaly ringan)",
            "color" => "#FF6E76",
            "range_z" => "+2 < Z ≤ +3",
            "interpretasi" => "Lingkar kepala anak lebih besar dari standar usianya.",
            "saran" => [
                "Pantau laju pertumbuhan lingkar kepala setiap bulan.",
                "Evaluasi faktor keluarga (genetik) dan riwayat penyakit.",
                "Rujuk bila pertumbuhan terlalu cepat atau disertai gejala klinis."
            ]
        ],
        [
            "status" => "Sangat besar (severe macrocephaly)",
            "color" => "#FF6E76",
            "range_z" => "Z > +3",
            "interpretasi" => "Lingkar kepala anak sangat besar untuk usianya.",
            "saran" => [
                "Segera rujuk untuk pemeriksaan neurologi dan pencitraan.",
                "Pantau perkembangan motorik, kognitif, dan tanda peningkatan tekanan intrakranial.",
                "Diskusikan lebih lanjut dengan tenaga kesehatan spesialis."
            ]
        ]
    ]

];
?>

];
?>