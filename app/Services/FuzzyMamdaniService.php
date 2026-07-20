<?php

namespace App\Services;

/**
 * Fuzzy Inference System (Mamdani) untuk skor evaluasi/prediksi kelulusan
 * mata kuliah, berdasarkan 3 variabel input: Kehadiran, Nilai Tugas, dan
 * Keaktifan Diskusi.
 *
 * Sesuai rancangan:
 * - Fuzzifikasi   : fungsi keanggotaan trapesium/segitiga per variabel
 * - Inferensi     : rule base 14 aturan, operator MIN untuk antesenden,
 *                    komposisi MAX untuk konsekuen per himpunan output
 * - Defuzzifikasi : weighted average berbasis titik representatif tiap
 *                    himpunan output (Gagal=15, Cukup=50, Lulus=70,
 *                    Sangat Memuaskan=95)
 */
class FuzzyMamdaniService
{
    /**
     * Titik representatif tiap himpunan output, dipakai saat defuzzifikasi.
     */
    protected array $zRepresentatif = [
        'Gagal'             => 15,
        'Cukup'             => 50,
        'Lulus'             => 70,
        'Sangat Memuaskan'  => 95,
    ];

    // ─────────────────────────────────────────────────────────────
    // FUNGSI KEANGGOTAAN
    // ─────────────────────────────────────────────────────────────

    /**
     * Trapesium turun (bahu kiri): 1 di kiri, turun linear dari c ke d, 0 di kanan.
     */
    protected function trapesiumTurun(float $x, float $a, float $b, float $c, float $d): float
    {
        if ($x <= $b) return 1;
        if ($x >= $d) return 0;
        if ($x > $b && $x < $c) return 1;
        // $x antara c dan d -> turun
        return ($d - $x) / ($d - $c);
    }

    /**
     * Segitiga: naik dari a ke b (puncak = 1), turun dari b ke c.
     */
    protected function segitiga(float $x, float $a, float $b, float $c): float
    {
        if ($x <= $a || $x >= $c) return 0;
        if ($x == $b) return 1;
        if ($x < $b) return ($x - $a) / ($b - $a);
        return ($c - $x) / ($c - $b);
    }

    /**
     * Trapesium naik (bahu kanan): 0 di kiri, naik linear dari a ke b, 1 di kanan.
     */
    protected function trapesiumNaik(float $x, float $a, float $b, float $c, float $d): float
    {
        if ($x <= $a) return 0;
        if ($x >= $c) return 1;
        if ($x > $b && $x < $c) return 1;
        // $x antara a dan b -> naik
        return ($x - $a) / ($b - $a);
    }

    // ─────────────────────────────────────────────────────────────
    // 1. FUZZIFIKASI
    // ─────────────────────────────────────────────────────────────

    /**
     * Hitung derajat keanggotaan (μ) untuk ketiga variabel input.
     *
     * @return array{kehadiran: array, nilai_tugas: array, keaktifan: array}
     */
    public function fuzzifikasi(float $kehadiran, float $nilaiTugas, float $keaktifan): array
    {
        return [
            'kehadiran' => [
                'Rendah' => round($this->trapesiumTurun($kehadiran, 0, 0, 40, 60), 4),
                'Sedang' => round($this->segitiga($kehadiran, 40, 60, 80), 4),
                'Tinggi' => round($this->trapesiumNaik($kehadiran, 60, 80, 100, 100), 4),
            ],
            'nilai_tugas' => [
                'Rendah' => round($this->trapesiumTurun($nilaiTugas, 0, 0, 50, 70), 4),
                'Sedang' => round($this->segitiga($nilaiTugas, 50, 70, 90), 4),
                'Tinggi' => round($this->trapesiumNaik($nilaiTugas, 70, 90, 100, 100), 4),
            ],
            'keaktifan' => [
                'Rendah' => round($this->trapesiumTurun($keaktifan, 0, 0, 40, 60), 4),
                'Sedang' => round($this->segitiga($keaktifan, 40, 60, 80), 4),
                'Tinggi' => round($this->trapesiumNaik($keaktifan, 60, 80, 100, 100), 4),
            ],
        ];
    }

    // ─────────────────────────────────────────────────────────────
    // RULE BASE (14 aturan, representatif dari 27 kombinasi)
    // ─────────────────────────────────────────────────────────────

    protected function ruleBase(): array
    {
        return [
            ['kehadiran' => 'Tinggi', 'nilai_tugas' => 'Tinggi', 'keaktifan' => 'Tinggi', 'output' => 'Sangat Memuaskan'],
            ['kehadiran' => 'Tinggi', 'nilai_tugas' => 'Tinggi', 'keaktifan' => 'Sedang', 'output' => 'Lulus'],
            ['kehadiran' => 'Tinggi', 'nilai_tugas' => 'Sedang', 'keaktifan' => 'Tinggi', 'output' => 'Lulus'],
            ['kehadiran' => 'Sedang', 'nilai_tugas' => 'Tinggi', 'keaktifan' => 'Tinggi', 'output' => 'Lulus'],
            ['kehadiran' => 'Tinggi', 'nilai_tugas' => 'Tinggi', 'keaktifan' => 'Rendah', 'output' => 'Lulus'],
            ['kehadiran' => 'Tinggi', 'nilai_tugas' => 'Sedang', 'keaktifan' => 'Sedang', 'output' => 'Cukup'],
            ['kehadiran' => 'Sedang', 'nilai_tugas' => 'Tinggi', 'keaktifan' => 'Sedang', 'output' => 'Lulus'],
            ['kehadiran' => 'Sedang', 'nilai_tugas' => 'Sedang', 'keaktifan' => 'Tinggi', 'output' => 'Lulus'],
            ['kehadiran' => 'Sedang', 'nilai_tugas' => 'Sedang', 'keaktifan' => 'Sedang', 'output' => 'Cukup'],
            ['kehadiran' => 'Tinggi', 'nilai_tugas' => 'Rendah', 'keaktifan' => 'Rendah', 'output' => 'Cukup'],
            ['kehadiran' => 'Rendah', 'nilai_tugas' => 'Tinggi', 'keaktifan' => 'Rendah', 'output' => 'Cukup'],
            ['kehadiran' => 'Rendah', 'nilai_tugas' => 'Rendah', 'keaktifan' => 'Tinggi', 'output' => 'Cukup'],
            ['kehadiran' => 'Sedang', 'nilai_tugas' => 'Sedang', 'keaktifan' => 'Rendah', 'output' => 'Cukup'],
            ['kehadiran' => 'Rendah', 'nilai_tugas' => 'Rendah', 'keaktifan' => 'Rendah', 'output' => 'Gagal'],
        ];
    }

    // ─────────────────────────────────────────────────────────────
    // 2. INFERENSI (min antesenden, max komposisi konsekuen)
    // ─────────────────────────────────────────────────────────────

    /**
     * Terapkan rule base terhadap hasil fuzzifikasi. Hanya rule dengan
     * alpha-predikat > 0 yang dikembalikan (rule aktif).
     */
    public function terapkanRule(array $fuzzy): array
    {
        $ruleAktif = [];

        foreach ($this->ruleBase() as $i => $rule) {
            $alpha = min(
                $fuzzy['kehadiran'][$rule['kehadiran']],
                $fuzzy['nilai_tugas'][$rule['nilai_tugas']],
                $fuzzy['keaktifan'][$rule['keaktifan']]
            );

            if ($alpha > 0) {
                $ruleAktif[] = [
                    'rule'        => 'R' . ($i + 1),
                    'kehadiran'   => $rule['kehadiran'],
                    'nilai_tugas' => $rule['nilai_tugas'],
                    'keaktifan'   => $rule['keaktifan'],
                    'alpha'       => round($alpha, 4),
                    'output'      => $rule['output'],
                ];
            }
        }

        return $ruleAktif;
    }

    // ─────────────────────────────────────────────────────────────
    // 3. DEFUZZIFIKASI (weighted average / centroid titik representatif)
    // ─────────────────────────────────────────────────────────────

    /**
     * @return array{alpha_per_output: array, skor: float, kategori: string}
     */
    public function defuzzifikasi(array $ruleAktif): array
    {
        $alphaPerOutput = array_fill_keys(array_keys($this->zRepresentatif), 0.0);

        foreach ($ruleAktif as $r) {
            $alphaPerOutput[$r['output']] = max($alphaPerOutput[$r['output']], $r['alpha']);
        }

        $numerator = 0;
        $denominator = 0;

        foreach ($alphaPerOutput as $kategori => $alpha) {
            $numerator   += $alpha * $this->zRepresentatif[$kategori];
            $denominator += $alpha;
        }

        $skor = $denominator > 0 ? round($numerator / $denominator, 2) : 0;

        // Kategori final = himpunan output dengan alpha (derajat keyakinan) terbesar
        $kategori = array_search(max($alphaPerOutput), $alphaPerOutput);
        if ($kategori === false || max($alphaPerOutput) == 0) {
            $kategori = 'Gagal';
        }

        return [
            'alpha_per_output' => $alphaPerOutput,
            'skor'             => $skor,
            'kategori'         => $kategori,
        ];
    }

    // ─────────────────────────────────────────────────────────────
    // ORKESTRATOR: jalankan seluruh pipeline sekaligus
    // ─────────────────────────────────────────────────────────────

    public function hitung(float $kehadiran, float $nilaiTugas, float $keaktifan): array
    {
        $fuzzy     = $this->fuzzifikasi($kehadiran, $nilaiTugas, $keaktifan);
        $ruleAktif = $this->terapkanRule($fuzzy);
        $hasil     = $this->defuzzifikasi($ruleAktif);

        return [
            'input'            => [
                'kehadiran'   => $kehadiran,
                'nilai_tugas' => $nilaiTugas,
                'keaktifan'   => $keaktifan,
            ],
            'fuzzifikasi'      => $fuzzy,
            'rule_aktif'       => $ruleAktif,
            'alpha_per_output' => $hasil['alpha_per_output'],
            'skor'             => $hasil['skor'],
            'kategori'         => $hasil['kategori'],
        ];
    }
}
